emsApp.directive('emsGroupAssign', function(baseURL) {
    return {
        scope: {
            id:'@',
            action:'@',
            successurl:'@',
            cancelurl:'@'
        },
        restrict: 'A',
        replace: true,
        templateUrl: baseURL + '/template/ems-group-assign.html',
        controller: 'GroupAssignController',
    };
});

