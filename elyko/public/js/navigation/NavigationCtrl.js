angular.module('elyko')
    .controller('TabCtrl', [
        '$scope',
        '$location',
        '$mdSidenav',
        'ssSideNav',
        'student',
        function ($scope, $location, $mdSidenav, ssSideNav, student) {

            $scope.semesters = student.getSemesters().then(function (response) {
                initializeSideNav(response);
            });

            $scope.menu = ssSideNav;

            $scope.showMenu = function () {
                $mdSidenav('left').toggle();
            };

            function initializeSideNav(semesters) {

                for (var i = 0; i < semesters.length; i++) {

                    var semester = semesters[i];

                    ssSideNav.sections[0].pages.push({
                        id: semester,
                        name: semester,
                        state: "notes({student_login: '" + student.getLogin() + "', semester: '" + semester + "'})"
                    });

                    ssSideNav.sections[1].pages.push({
                        id: semesters[i],
                        name: semesters[i],
                        state: "skills({student_login: '" + student.getLogin() + "', semester: '" + semester + "'})"
                    })
                }
            }

        }]);