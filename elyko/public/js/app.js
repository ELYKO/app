angular.module('elyko', ['ui.router', 'ngMaterial', 'md.data.table'])
    .config([
        '$stateProvider',
        '$urlRouterProvider',
        '$mdThemingProvider',
        function ($stateProvider, $urlRouterProvider, $mdThemingProvider) {

            $stateProvider
                .state('notes', {
                    url: '/notes/{student_login}',
                    templateUrl: '/js/student_notes/_student_notes.html',
                    controller: 'StudentNotesCtrl',
                    resolve: {
                        notesPromise: ['$stateParams', 'studentNotes', function ($stateParams, studentNotes) {
                            return studentNotes.getNotes($stateParams.student_login);
                        }]
                    }
                })
                .state('skills', {
                    url: '/skills',
                    templateUrl: 'js/skills/_skills.html'
                });

            $urlRouterProvider.otherwise('studentNotes');

            $mdThemingProvider.theme('default')
                .primaryPalette("amber")
                .accentPalette("yellow");


        }
    ]);
