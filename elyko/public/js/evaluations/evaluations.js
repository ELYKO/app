/**
 * Created by sebastian on 16/05/16.
 */
angular.module('elyko')
    .factory('evaluations', [
        '$http',
        'SERVER_PATH',
        function ($http, SERVER_PATH) {

            var o = {};

            o.studentNote = null;

            o.get = function (id) {
                return $http.get(SERVER_PATH + 'evaluation/' + id).then(function (response) {
                    return response.data;
                })
            };


            return o;

        }]);