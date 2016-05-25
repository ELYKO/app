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
                return $http.get(SERVER_PATH + 'student').then(function (response) {
                    o = response.data;
                    return o;
                });
            };
            
            return o;

        }]);