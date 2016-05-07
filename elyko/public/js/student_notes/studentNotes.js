angular.module('elyko')
    .factory('studentNotes', [
        '$http',
        function ($http) {
            var o = {};

            o.getNotes = function (studentLogin) {
                return $http.get('/student/' + studentLogin).then(function (response) {
                    return response.data;
                });
            };

            return o;
        }
    ]);
