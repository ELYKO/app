angular.module('elyko')
    .controller('ToolbarCtrl', [
        '$scope',
        '$mdSidenav',
        function ($scope, $mdSidenav) {

            $scope.showMenu = function () {
                $mdSidenav('left').toggle();
            };


        }]);