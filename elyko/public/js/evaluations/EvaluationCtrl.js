/**
 * Created by sebastian on 16/05/16.
 */
angular.module('elyko')
    .controller('EvaluationCtrl', [
        '$scope',
        'evaluationPromise',
        function ($scope, evaluationPromise) {

            $scope.labels = getLabels();
            $scope.data = getData();

            function getLabels() {
                var labels = [];

                for (var label in evaluationPromise) {
                    if (evaluationPromise[label] != 0 && evaluationPromise.hasOwnProperty(label)) {
                        labels.push(label);
                    }
                }

                return labels;
            }

            function getData() {
                console.log(evaluationPromise);
                var data = [];

                for (var label in evaluationPromise) {
                    if (evaluationPromise[label] != 0 && evaluationPromise.hasOwnProperty(label)) {
                        data.push(evaluationPromise[label]);
                    }
                }

                return data;
            }

        }]);