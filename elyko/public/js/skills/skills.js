/**
 * Created by tim on 18/05/16.
 */

angular.module('elyko')
    .factory('skills', [
        '$http',
        'SERVER_PATH',
        function ($http, SERVER_PATH) {

            var o = {};

            o.get = function (login, semester) {
                return $http.get(SERVER_PATH + 'skills/' + semester).then(function (response) {
                    return response.data;
                })
            };

            return o;

        }]);