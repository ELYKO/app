angular.module('elyko', ['ui.router', 'ngMaterial', 'md.data.table', 'chart.js'])
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
                .state('evaluation', {
                    url: '/evaluations/{id}',
                    templateUrl: '/js/evaluations/_evaluation.html',
                    controller: 'EvaluationCtrl',
                    resolve: {
                        evaluationPromise: ['$stateParams', 'evaluations', function ($stateParams, evaluations) {
                            return evaluations.get($stateParams.id);
                        }]
                    }
                })
                .state('skills', {
                    url: '/skills',
                    templateUrl: 'js/skills/_skills.html'
                });

            $urlRouterProvider.otherwise('studentNotes');

            //$mdThemingProvider.theme('default')
                //.primaryPalette("amber")
                //.accentPalette("yellow");


        }
    ]);
