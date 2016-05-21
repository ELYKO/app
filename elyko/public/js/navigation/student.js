/**
 * Created by sebastian on 16/05/16.
 */
angular.module('elyko')
    .factory('student', [
        '$http',
        'SERVER_PATH',
        function ($http, SERVER_PATH) {

            var o = {};

            var login = "abarre14";

            o.setLogin = function (newLogin) {
                login = newLogin;
            };

            o.getLogin = function () {
                return login;
            };

            o.getSemesters = function () {
                return $http.get(SERVER_PATH+"student/" + login + "/semesters").then(function (response) {
                    return response.data;
                })
            };

            return o;

        }]);