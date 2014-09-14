emsApp.directive('emsGroupList', function(baseURL) {
    return {
        scope: {
            add : '@',
            edit : '@',
            assign : '@'
        },
        restrict: 'A',
        replace: true,
        templateUrl: baseURL + '/template/ems-group-list.html',
        controller: 'GroupTableController',
    };
});

