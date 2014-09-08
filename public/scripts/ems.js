var emsApp = angular.module('emsApp', []);
emsApp.value('baseURL', baseURL);


emsApp.directive('emsTextInput', function(baseURL) {
    return {
        scope: {
            label: '@',
            model: '='
        },
        restrict: 'AE',
        replace: true,
        templateUrl: baseURL + '/template/ems-textinput.html',
    };
});

emsApp.directive('emsTextArea', function(baseURL) {
    return {
        scope: {
            label: '@',
            model: '='
        },
        restrict: 'AE',
        replace: true,
        templateUrl: baseURL + '/template/ems-textarea.html',
    };
});

emsApp.directive('emsSelect', function(baseURL) {
    return {
        scope: {
            label: '@',
            model: '=',
            options: '=',
        },
        restrict: 'AE',
        replace: true,
        templateUrl: baseURL + '/template/ems-select.html',
    };
});

emsApp.directive('emsSelectMultiple', function(baseURL) {
    return {
        scope: {
            label: '@',
            model: '=',
            options: '=',
        },
        restrict: 'AE',
        replace: true,
        templateUrl: baseURL + '/template/ems-select-multiple.html',
    };
});


