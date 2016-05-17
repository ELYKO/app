/**
 * Created by sebastian on 16/05/16.
 */
angular.module('elyko')
    .factory('student', [
        '$http',
        function ($http) {

            var o = {};

            var login = "scuerv14";

            o.setLogin = function (newLogin) {
                login = newLogin;
            };

            o.getLogin = function () {
                return login;
            };

            o.getSemesters = function () {
                return ['A2S2', 'A2S1'];
            };

            return o;

        }]);