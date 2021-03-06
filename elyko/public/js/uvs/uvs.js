/**
 * Created by tim on 20/05/16.
 */
angular.module('elyko')
    .factory('uvs', [
        '$http',
        'SERVER_PATH',
        function ($http, SERVER_PATH) {

            var o = {};

            o.get = function (id) {
                return $http.get(SERVER_PATH + 'uv/' + id).then(function (response) {
                    return response.data;
                })
            };

            return o;

        }]);