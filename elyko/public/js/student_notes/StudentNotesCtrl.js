angular.module('elyko')
    .controller('StudentNotesCtrl', [
        '$scope',
        'notesPromise',
        '$state',
        '$stateParams',
        'evaluations',
        function ($scope, notesPromise, $state, $stateParams, evaluations) {
            $scope.student = notesPromise[0];
            $scope.state = $state;
            $scope.semester = $stateParams.semester;

            $scope.viewEvaluation = function (evaluation) {
                evaluations.studentNote = evaluation.students[0].note;
                $state.go('evaluation', {id: evaluation.id});
            };

        }
    ]);