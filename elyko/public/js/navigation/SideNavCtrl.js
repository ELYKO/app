angular.module('elyko')
    .controller('SideNavCtrl', [
        '$scope',
        'ssSideNav',
        'student',
        function ($scope, ssSideNav, student) {

            $scope.student = student.getStudent().then(function (response) {
               $scope.student = response;
            });

            student.getStudent().then(function (studentResponse) {
                initializeSideNav(studentResponse.semesters);
            });

            $scope.menu = ssSideNav;
            
            function initializeSideNav(semesters) {

                for (var i = 0; i < semesters.length; i++) {

                    var semester = semesters[i];

                    ssSideNav.sections[0].pages.push({
                        id: semester,
                        name: semester,
                        state: "notes({semester: '" + semester + "'})"
                    });

                    ssSideNav.sections[1].pages.push({
                        id: semesters[i],
                        name: semesters[i],
                        state: "skills({semester: '" + semester + "'})"
                    })
                }
            }

        }]);