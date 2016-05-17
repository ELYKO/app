angular.module('elyko')
    .factory('studentNotes', [
        '$http',
        function ($http) {
            var o = {};

            o.getNotes = function (studentLogin, semester) {
                return $http.get('/student/' + studentLogin + "/" + semester).then(function (response) {
                    return response.data;
                });
            };

            return o;
        }
    ]);
