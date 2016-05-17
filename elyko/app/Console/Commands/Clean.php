<?php

namespace App\Console\Commands;

use App\Evaluation;
use App\Inscription;
use App\Skill;
use App\Student;
use App\Note;
use App\SkillAssessed;
use App\Uv;
use Illuminate\Console\Command;

class Clean extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clean';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean data from elyko';

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
        Student::truncate();
        Evaluation::truncate();
        Note::truncate();
        Uv::truncate();
        Inscription::truncate();
        SkillAssessed::truncate();
        Skill::truncate();
    }
}