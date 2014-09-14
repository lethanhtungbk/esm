emsApp.directive('emsGroupForm', function(baseURL) {
    return {
        scope: {
            id:"@",
            action:'@',
            successurl:'@',
            cancelurl:'@'
        },
        restrict: 'A',
        replace: true,
        templateUrl: baseURL + '/template/ems-group-form.html',
        controller: 'GroupFormController',
    };
});

