angular.module('elyko')
    .controller('StudentNotesCtrl', [
        '$scope',
        'notesPromise'
        , function ($scope, notesPromise) {
            $scope.student = notesPromise[0];
            console.log($scope.student);
        }]);