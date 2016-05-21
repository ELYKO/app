angular.module('elyko')
    .controller('StudentNotesCtrl', [
        '$scope',
        'notesPromise',
        '$state',
        '$stateParams',
        function ($scope, notesPromise, $state, $stateParams) {
            $scope.student = notesPromise[0];
            $scope.state = $state;
            $scope.semester = $stateParams.semester;
        }
    ]);