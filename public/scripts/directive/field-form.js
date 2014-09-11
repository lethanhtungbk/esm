emsApp.directive('emsFieldForm', function(baseURL) {
    return {
        scope: {
            id:"@",
            action:'@',
            success:'&',
            cancel:'&',
            successurl:'@',
            cancelurl:'@'
        },
        restrict: 'A',
        replace: true,
        templateUrl: baseURL + '/template/ems-field-form.html',
        controller: 'FieldFormController',
    };
});

