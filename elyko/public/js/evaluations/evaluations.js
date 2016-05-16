/**
 * Created by sebastian on 16/05/16.
 */
angular.module('elyko')
    .factory('evaluations', [
        '$http',
        function ($http) {

            var o = {}

            o.get = function (id) {
                return $http.get('/evaluation/' + id).then(function (response) {
                    return response.data;
                })
            };

            return o;

        }]);