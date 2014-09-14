emsApp.directive('emsFieldList', function(baseURL) {
    return {
        scope: {
            add : '@',
            edit : '@'
        },
        restrict: 'A',
        replace: true,
        templateUrl: baseURL + '/template/ems-field-list.html',
        controller: 'FieldTableController',
    };
});

