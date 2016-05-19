/**
 * Created by tim on 18/05/16.
 */

angular.module('elyko')
    .factory('skills', [
        '$http',
        function($http) {

            var o = {};

            o.get = function(login, semester) {
                return $http.get('/skills/' + login + '/' + semester).then(function(response) {
                    return response.data;
                })
            };
            
            return o;

        }]);