/**
 * Created by tim on 18/05/16.
 */

angular.module('elyko')
    .controller('SkillsCtrl', [
        '$scope',
        '$stateParams',
        'skillsPromise',
        function($scope, $stateParams, skillsPromise) {
            
            $scope.data = [get(skillsPromise, 'data')];
            $scope.labels = get(skillsPromise, 'labels');
            $scope.semester = $stateParams.semester;

            function get(skillsPromise, thingToGet) {
                var tab = [];

                for (var skill in skillsPromise) {
                    if (skillsPromise.hasOwnProperty(skill)) {
                        if (thingToGet=='labels') tab.push(skill + " (" + skillsPromise[skill][1] + ")");
                        else if (thingToGet=='data') tab.push(skillsPromise[skill][0]);
                    }
                }

                return tab;
            }

        }
        
    ]);

