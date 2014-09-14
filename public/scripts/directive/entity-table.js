emsApp.directive('emsEntityList', function(baseURL) {
    return {
        scope: {
            add:'@',
            edit:'@',
            link:'@'
        },
        restrict: 'A',
        replace: true,
        templateUrl: baseURL + '/template/ems-entity-list.html',
        controller: 'EntityTableController',
    };
});

