/**
 * Created by sebastian on 16/05/16.
 */
angular.module('elyko')
    .controller('EvaluationCtrl', [
        '$scope',
        'evaluationPromise',
        'evaluations',
        function ($scope, evaluationPromise, evaluations) {

            $scope.name = evaluationPromise.name;
            $scope.coefficient = evaluationPromise.coefficient;
            $scope.average = evaluationPromise.average;
            $scope.note = evaluations.studentNote;
            $scope.labels = getLabels();
            $scope.data = getData();

            function getLabels() {
                var labels = [];

                for (var label in evaluationPromise.notes) {
                    if (evaluationPromise.notes[label] != 0 && evaluationPromise.notes.hasOwnProperty(label)) {
                        labels.push(label);
                    }
                }

                return labels;
            }

            function getData() {
                var data = [];

                for (var label in evaluationPromise.notes) {
                    if (evaluationPromise.notes[label] != 0 && evaluationPromise.notes.hasOwnProperty(label)) {
                        data.push(evaluationPromise.notes[label]);
                    }
                }

                return [data];
            }

        }]);