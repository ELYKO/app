angular.module('elyko', ['ui.router', 'ngMaterial', 'md.data.table', 'chart.js', 'sasrio.angular-material-sidenav'])
    .constant("SERVER_PATH", "")
    .config([
        '$stateProvider',
        '$urlRouterProvider',
        '$mdThemingProvider',
        'ssSideNavSectionsProvider',
        function ($stateProvider, $urlRouterProvider, $mdThemingProvider, ssSideNavSectionsProvider) {

            $stateProvider
                .state('notes', {
                    url: '/notes/{semester}',
                    templateUrl: 'js/student_notes/_student_notes.html',
                    controller: 'StudentNotesCtrl',
                    resolve: {
                        notesPromise: ['$stateParams', 'studentNotes', function ($stateParams, studentNotes) {
                            return studentNotes.getNotes($stateParams.semester);
                        }]
                    }
                })
                .state('evaluation', {
                    url: '/evaluations/{id}',
                    templateUrl: 'js/evaluations/_evaluation.html',
                    controller: 'EvaluationCtrl',
                    resolve: {
                        evaluationPromise: ['$stateParams', 'evaluations', function ($stateParams, evaluations) {
                            return evaluations.get($stateParams.id);
                        }]
                    }
                })
                .state('skills', {
                    url: '/skills/{semester}',
                    templateUrl: 'js/skills/_skills.html',
                    controller: 'SkillsCtrl',
                    resolve: {
                        skillsPromise: ['$stateParams', 'skills', function ($stateParams, skills) {
                            return skills.get($stateParams.semester);
                        }]
                    }
                })
                .state('uv', {
                    url: '/uv/{id}',
                    templateUrl: 'js/uvs/_uv.html',
                    controller: 'UvCtrl',
                    resolve: {
                        UvPromise: ['$stateParams', 'uvs', function ($stateParams, uvs) {
                            return uvs.get($stateParams.id);
                        }]
                    }
                });

            $urlRouterProvider.otherwise('studentNotes');


            $mdThemingProvider.theme('default')
                .primaryPalette("teal")
                .accentPalette("indigo");

            ssSideNavSectionsProvider.initWithSections([
                {
                    name: 'Mes Notes',
                    type: 'toggle',
                    pages: []
                },
                {
                    name: 'Mes Competences',
                    type: 'toggle',
                    pages: []

                }
            ]);

            ssSideNavSectionsProvider.initWithTheme($mdThemingProvider);


        }
    ]);
