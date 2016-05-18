<?php

namespace App\Console\Commands;

use App\Evaluation;
use App\Inscription;
use App\Student;
use App\Note;
use App\SkillAssessed;
use App\Uv;
use Illuminate\Console\Command;

class Migration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migration';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate data from Oasis to elyko';

    /**
     * Create a new command instance.
     *
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Pour mesurer le temps du script
        $timeStart = microtime(true);
        
        // Connexion a la vue de la base Oasis fourni (Server SQL)
        $conn = mssql_connect('bddoasis.emn.fr:1433','elyko','k53k0kyl3','Notes-eleves');

        // Select des eleves (tous, le filtrage des eleves present a l'ecole est fait en amont de la vue)
        $request = "SELECT intIdUtilisateur AS 'id', strNom AS 'last_name', strPrenom AS 'name', strEmail AS 'email', strLogin AS 'login'
        FROM eleves";

        // On execute la query
        $result = mssql_query($request, $conn);


        // Fonction qui remplit une array avec le resusltat d'une requete
        function getArray($result) {
            $array = array();
            if (mssql_num_rows($result) > 0) {
                $i = 0;
                while ($row = mssql_fetch_assoc($result)) {
                    $array[$i] = $row;
                    $i++;
                }
            }
            return $array;
        }

        // On appelle la fonction ci-dessus
        $students = getArray($result);

        // Select des evaluations
        $request = "SELECT DISTINCT eval.intIdEvaluation AS 'id', eval.intIdProcess AS 'uv_id', eval.strTitre AS 'name', eval.decCoefficient AS 'coefficient', eval.boolBloque AS 'locked'
        FROM bdn_notes note
        -- Associes a des evals
        INNER JOIN evaluations eval ON eval.intIdEvaluation = note.intIdEvaluation
        -- Associes a des modules
        INNER JOIN evaluations module ON eval.intIdBlocParent = module.intIdEvaluation
        -- Qui sont associes a des uvs : type FPC sans fils (permet de ne pas selectionner les competences)
        INNER JOIN process UV ON UV.intIdProcess = module.intIdProcess AND UV.strTypeReferentiel = 'FPC' AND UV.intNbFils > 0
        -- Ou des eleves sont inscrits
        INNER JOIN inscription_process iUV ON iUV.intIdProcess = UV.intIdProcess
        INNER JOIN eleves ON eleves.intIdUtilisateur = iUV.intIdUSer
        ORDER BY id";
        $result = mssql_query($request, $conn);
        $evaluations = getArray($result);


        // Select des notes
        $request = "SELECT intIdEvaluation AS 'evaluation_id', intIdEleve AS 'student_id', strvaleur AS 'note'
        FROM bdn_notes
        -- Associes a des eleves
        INNER JOIN eleves ON eleves.intIdUtilisateur = bdn_notes.intIdEleve
        -- Sans les competences
        WHERE strvaleur NOT IN ('-', '=', '+')
        ORDER BY evaluation_id";
        $result = mssql_query($request, $conn);
        $notes = getArray($result);


        // Select des uvs avec les parametres credits et semestre
        $request = "SELECT DISTINCT UV.intIdProcess AS 'id', UV.strNom AS 'name', credits.strValeur AS 'credits', sem.strNom AS 'semester'
        FROM eleves
        -- Inscription de l'eleve sur un semestre
        INNER JOIN Inscription_process isem ON isem.intIdUser = eleves.intIdUtilisateur
        -- Semestre : process de type ENS et de niveau 2
        INNER JOIN process sem ON sem.intIdProcess = isem.intIdProcess AND sem.strTypeReferentiel = 'ENS' AND sem.intNiveau = 2
        -- Inscription de l'eleve sur un UV
        INNER JOIN Inscription_process iUV ON iUV.intIdUser = eleves.intIdUtilisateur
        -- UV : process de type FPC avec des fils (permet de ne pas selectionner les competences)
        INNER JOIN process UV ON UV.intIdProcess = iUV.intIdProcess AND UV.strTypeReferentiel = 'FPC' AND UV.intNbFils > 0
        -- Credits : stocke dans dyn_valeurs avec un champ = 1143 et idProcess au format string
        LEFT OUTER JOIN dyn_valeurs credits ON credits.intIdChamp = 1143 AND credits.intIdRef = CAST(UV.intIdProcess AS NVARCHAR(255))
        -- Ou le semestre est celui de l'UV
        WHERE sem.intIdProcess = (CASE UV.intNiveau
        -- Un semestre est de niveau 2, on va chercher le nombre de fois necessaire le procces pere
        WHEN 3 THEN UV.intIdParent
        WHEN 4 THEN (SELECT intIdParent FROM process WHERE intidProcess = UV.intIdParent)
        WHEN 5 THEN (SELECT intIdParent FROM process WHERE intidProcess = (SELECT intIdParent FROM process WHERE intidProcess = UV.intIdParent))
        WHEN 6 THEN (SELECT intIdParent FROM process WHERE intidProcess = (SELECT intIdParent FROM process WHERE intidProcess = (SELECT intIdParent FROM process WHERE intidProcess = UV.intIdParent)))
        END)
        -- On ne garde que les process ayant des ECTS numeriques
        AND ISNUMERIC(credits.strValeur) > 0
        ORDER BY id, credits DESC";

        $result = mssql_query($request, $conn);

        $uvs = array();
        if (mssql_num_rows($result) > 0) {
            $i = 0;
            while ($row = mssql_fetch_assoc($result)) {
                // On elimine les uvs sans ECTS
                if ($row['credits'] > 0) {
                    if ($i == 0 || $row['id'] != $uvs[$i - 1]['id']) {
                        $uvs[$i] = $row;
                        $i++;
                    }
                }
            }
        }

        // Select des inscriptions aux uvs (student_uv) avec les grades calcule et force
        $request = "SELECT eleves.intIdUtilisateur AS 'student_id', UV.intIdProcess AS 'uv_id', grade.strValeur AS 'gradeCalcule', gradeForce.strGrade AS 'gradeForce'
        FROM eleves
        -- Inscription de l'eleve
        INNER JOIN Inscription_process iUV ON iUV.intIdUser = eleves.intIdUtilisateur
        -- UV : process de type FPC avec des fils (permet de ne pas selectionner les competences)
        INNER JOIN process UV ON UV.intIdProcess = iUV.intIdProcess AND UV.strTypeReferentiel = 'FPC' AND UV.intNbFils > 0
        -- Grade calcule : stocke dans dyn_valeurs avec le champ 1383 et l'id de l'inscription au format string
        INNER JOIN dyn_valeurs grade ON grade.intIdChamp = 1383 AND grade.intIdRef = CAST(iUV.intIdInscription AS NVARCHAR(255))
        -- Grade force (si il existe) : stocke dans bdn_buletin
        LEFT OUTER JOIN bdn_bulletin gradeForce ON gradeForce.intIdEleve = eleves.intIdUtilisateur AND gradeForce.intIdProcess = UV.intIdProcess
        ORDER BY uv_id";

        $result = mssql_query($request, $conn);

        $inscriptions = array();
        if (mssql_num_rows($result) > 0) {
            $i = 0;
            while($row = mssql_fetch_assoc($result)) {
                $inscriptions[$i]['student_id'] = $row['student_id'];
                $inscriptions[$i]['uv_id'] = $row['uv_id'];
                // Test l'absence d'un grade force
                if ($row['gradeForce']==" " or $row['gradeForce']=="")
                    $inscriptions[$i]['grade'] = $row['gradeCalcule']; // Oui : on prend le grade calcule
                else
                    $inscriptions[$i]['grade'] = $row['gradeForce']; // Non : on prend le grade force
                $i++;
            }
        }


        // Select des evaluations de competences avec leur nom et leur semestre
        $request = "SELECT skill.strNom AS 'name', sem.strNom AS 'semester', note.intIdEleve AS 'student_id', note.strvaleur AS 'value'
        FROM bdn_notes note
        -- Associes a des eleves
        INNER JOIN eleves ON eleves.intIdUtilisateur = note.intIdEleve
        -- Competence (skill) : process de type FPC sans fils
        INNER JOIN process skill ON skill.intIdProcess = note.intIdProcess AND skill.strTypeReferentiel = 'FPC' AND skill.intNbFils = 0
        -- Semestre : process de type ENS, de niveau 2
        INNER JOIN process sem ON sem.strTypeReferentiel = 'ENS' AND sem.intNiveau = 2
        -- On ne garde que les notes de competences
        WHERE note.strvaleur IN ('-', '=', '+')
        -- Le semestre est celui du skill
        AND sem.intIdProcess = (CASE  skill.intNiveau
        WHEN 3 THEN skill.intIdParent
        WHEN 4 THEN (SELECT intIdParent FROM process WHERE intidProcess = skill.intIdParent)
        WHEN 5 THEN (SELECT intIdParent FROM process WHERE intidProcess = (SELECT intIdParent FROM process WHERE intidProcess = skill.intIdParent))
        WHEN 6 THEN (SELECT intIdParent FROM process WHERE intidProcess = (SELECT intIdParent FROM process WHERE intidProcess = (SELECT intIdParent FROM process WHERE intidProcess = skill.intIdParent)))
        END)
        ORDER BY semester, name, value";

        $result = mssql_query($request, $conn);

        $skillsAssessed = array();
        if (mssql_num_rows($result) > 0) {
            $i = 0;
            while($row = mssql_fetch_assoc($result)) {
                $skillsAssessed[$i]['student_id'] = $row['student_id'];
                $skillsAssessed[$i]['value'] = $row['value'];
                // On associe chaque paire (name,semester) a un id pour eviter les repetitions dans la table skills
                $skillsAssessed[$i]['skill_id'] = getIdSkill($row['semester'],$row['name']);
                $i++;
            }
        }

        // Semestre = chiffre des dizaines (0 si non reconnu)
        // Nom = chiffre des unites (100 si non reconnu)
        function getIdSkill($sem, $name) {
            $numSem = getNumSem($sem);
            $numName = getNumName($name);
            return $numSem*10 + $numName;
        }

        function getNumSem($sem) {
            $num = 0;
            switch ($sem) {
                case "A1S1": $num = 1; break;
                case "A1S2": $num = 2; break;
                case "A2S1": $num = 3; break;
                case "A2S2": $num = 4; break;
                case "A3S1": $num = 5; break;
                case "A3S2": $num = 6; break;
            }
            return $num;
        }

        function getNumName($name) {
            $num = 100;
            // On garde le premier mot
            $name = substr($name,0,strpos($name," "));
            switch($name) {
                case "IGA" : $num = 0; break;
                case "IGB" : $num = 1; break;
                case "interpA" : $num = 2; break;
                case "interpB" : $num = 3; break;
                case "intraA" : $num = 4; break;
                case "intraB" : $num = 5; break;
                case "intraC" : $num = 6; break;
                case "STA" : $num = 7; break;
                case "STB" : $num = 8; break;
                case "STC" : $num = 9; break;
            }
            return $num;
        }

        // On ferme la connexion de la bdd Oasis
        mssql_close($conn);

        $intermediaryTime = microtime(true);
        echo "L'extraction s'execute en " . number_format($intermediaryTime - $timeStart, 3) . " sec </br>";

        $conn = mysqli_connect('cagiva.emn.fr', 'elyko', 'k53k0kyl3', 'elyko');

        mysqli_query($conn, 'TRUNCATE students');
        mysqli_query($conn, 'TRUNCATE evaluation_student');
        mysqli_query($conn, 'TRUNCATE evaluations');
        mysqli_query($conn, 'TRUNCATE uvs');
        mysqli_query($conn, 'TRUNCATE inscriptions');
        mysqli_query($conn, 'TRUNCATE skill_student');

        $sql = array();
        foreach ($students as $student) {
            $sql[] = '(' . $student['id'] . ', "' . $student['last_name'] . '", "' . $student['name'] . '", "' . $student['email'] . '", "' . $student['login'] . '")';
        }
        mysqli_query($conn, 'INSERT INTO students (id, last_name, name, email, login) VALUES ' . implode(',', $sql));

        $sql = array();
        foreach ($notes as $note) {
            $note['note'] = str_replace(",", ".", $note['note']);
            $sql[] = '(' . $note['evaluation_id'] . ', ' . $note['student_id'] . ', "' . $note['note'] . '")';
        }
        mysqli_query($conn, 'INSERT INTO evaluation_student (evaluation_id, student_id, note) VALUES ' . implode(',', $sql));

        $sql = array();
        foreach ($evaluations as $evaluation) {
            // On retire les " du name pour eviter une exception
            $evaluation['name'] = str_replace("\"", "", $evaluation['name']);
            if ($evaluation['coefficient'] <= 1)
                //Pour un affichage uni des coefficients
                $evaluation['coefficient'] *= 100;
            $sql[] = '(' . $evaluation['id'] . ', ' . $evaluation['uv_id'] . ', "' . $evaluation['name'] . '", ' . $evaluation['coefficient'] . ', ' . $evaluation['locked'] . ')';
        }
        mysqli_query($conn, 'INSERT INTO evaluations (id, uv_id, name, coefficient, locked) VALUES ' . implode(',', $sql));

        $sql = array();
        foreach ($uvs as $uv) {
            // Certains UV ont des credits non entiers avec virgule (car stocke sous string)
            $uv['credits'] = str_replace(",", ".", $uv['credits']);
            $sql[] = '(' . $uv['id'] . ', "' . $uv['name'] . '", ' . $uv['credits'] . ', "' . $uv['semester'] . '")';
        }
        mysqli_query($conn, 'INSERT INTO uvs (id, name, credits, semester) VALUES ' . implode(',', $sql));

        $sql = array();
        foreach($inscriptions as $inscription) {
            $sql[] = '(' . $inscription['student_id'] . ', ' . $inscription['uv_id'] . ', "' . $inscription['grade'] . '")';
        }
        mysqli_query($conn,'INSERT INTO student_uv (student_id, uv_id, grade) VALUES '.implode(',', $sql));

        $sql = array();
        foreach($skillsAssessed as $skillAssessed) {
            $sql[] = '(' . $skillAssessed['skill_id'] . ', ' . $skillAssessed['student_id'] . ', "' . $skillAssessed['value'] . '")';
        }
        mysqli_query($conn,'INSERT INTO skill_student (skill_id, student_id, value) VALUES '.implode(',', $sql));

        mysqli_close($conn);

        echo "L'insertion s'execute en " . number_format(microtime(true) - $intermediaryTime, 3) . " sec </br>";

        $this->info('Migration succeed');
    }
}
        
