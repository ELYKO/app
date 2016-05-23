/**
 * Created by sebastian on 16/05/16.
 */
angular.module('elyko')
    .factory('student', [
        '$http',
        'SERVER_PATH',
        function ($http, SERVER_PATH) {

            var o = {};

            o.getStudent = function () {
                return $http.get(SERVER_PATH + 'student/').then(function (response) {
                    o = response.data[0];
                    return o;
                });
            };

            o.semesters = [];

            o.getSemesters = function () {
                return $http.get(SERVER_PATH + "student/semesters").then(function (response) {
                    o.semesters = response.data;
                    return o.semesters;
                })
            };

            return o;

        }]);