angular.module('elyko')
    .controller('TabCtrl', [
        '$scope',
        '$location',
        'studentNotes'
        , function ($scope, $location, studentNotes) {
            $scope.selectedIndex = 0;

            $scope.student = studentNotes.getNotes("scuerv14");

            $scope.$watch('selectedIndex', function(current, old) {
                switch (current) {
                    case 0:
                        $location.url("/notes/scuerv14");
                        break;
                    case 1:
                        $location.url("/skills");
                        break;
                }
            });
       

        }]);