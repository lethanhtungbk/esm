emsApp.controller('FieldTableController', function($scope, fieldService)
{
    $scope.getFields = function () {
        fieldService.getFields().then(function(fields) {
            $scope.fields = fields;            
        });
    }
});