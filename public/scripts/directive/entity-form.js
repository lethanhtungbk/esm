emsApp.directive('emsEntityForm', function(baseURL) {
    return {
        scope: {
            action:'@',
            id:'@',
            link:'@',
            successurl:'@',
            cancelurl:'@'
        },
        restrict: 'A',
        replace: true,
        templateUrl: baseURL + '/template/ems-entity-Form.html',
        controller: 'EntityFormController',
    };
});

