angular.module('elyko')
    .factory('studentNotes', [
        '$http',
        'SERVER_PATH',
        function ($http, SERVER_PATH) {
            var o = {};
            
            o.getNotes = function (semester) {
                return $http.get(SERVER_PATH + 'notes/' + semester).then(function (response) {
                    return response.data;
                });
            };

            return o;
        }
    ]);
