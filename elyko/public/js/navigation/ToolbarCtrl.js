angular.module('elyko')
    .controller('ToolbarCtrl', [
        '$scope',
        '$mdSidenav',
        '$state',
        function ($scope, $mdSidenav, $state) {

            $scope.showSearchBar = false;

            $scope.searchButtonIsVisible = function () {
                return $state.is('notes');
            };

            $scope.searchBarIsVisible = function () {
                return $scope.showSearchBar && $state.is('notes');
            };

            $scope.showMenu = function () {
                $mdSidenav('left').toggle();
            };


        }]);