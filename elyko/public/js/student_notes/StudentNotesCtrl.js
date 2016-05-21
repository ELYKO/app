angular.module('elyko')
    .controller('StudentNotesCtrl', [
        '$scope',
        'notesPromise',
        '$state',
        function ($scope, notesPromise, $state) {
            $scope.student = notesPromise[0];
            $scope.state = $state;
        }
    ]);