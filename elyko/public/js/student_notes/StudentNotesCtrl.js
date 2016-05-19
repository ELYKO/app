angular.module('elyko')
    .controller('StudentNotesCtrl', [
        '$scope',
        'notesPromise',
        function ($scope, notesPromise) {
            $scope.student = notesPromise[0];
        }
    ]);