emsApp.controller('GroupTableController', function($scope, groupService)
{
    $scope.getGroups = function() {
        groupService.getGroups().then(function(data) {
            $scope.groups = data;
        });
    };
});