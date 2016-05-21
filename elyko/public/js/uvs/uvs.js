/**
 * Created by tim on 20/05/16.
 */
angular.module('elyko')
    .factory('uvs', [
        '$http',
        function ($http) {

            var o = {};

            o.get = function (id) {
                return $http.get('index.php/uv/' + id).then(function (response) {
                    return response.data;
                })
            };

            return o;

        }]);