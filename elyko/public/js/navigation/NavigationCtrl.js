angular.module('elyko')
    .controller('TabCtrl', [
        '$scope',
        '$location'
        , function ($scope, $location) {
            $scope.selectedIndex = 0;


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