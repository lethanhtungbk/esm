emsApp.controller('FieldController', function($scope, fieldService)
{
    $scope.getFields = function () {
        fieldService.getFields().then(function(fields) {
            $scope.fields = fields;            
        });
    }
    
    
    $scope.getField = function() {
        var requestData = {id: $('#id').val()};
        fieldService.getField(requestData).then(function(data) {
            console.log(data);
            $scope.field = data.field;
            $scope.fieldTypes = data.fieldTypes;
            $scope.fieldType = searchObject($scope.fieldTypes, 'id', $scope.field.field_type_id);
            $scope.valueTypes = data.valueTypes;
            $scope.valueType = searchObject($scope.valueTypes, 'id', $scope.field.value_type);
            $scope.objects = data.objects;
            $scope.object = searchObject($scope.objects, 'id', $scope.field.object_id);
        });
    }


    $scope.onCustomValueAdd = function($index) {
        insertAt($scope.field.defineValues, $index + 1, {id: "-1", value: ""});
    };

    $scope.onCustomValueRemove = function($index) {
        $scope.field.defineValues.splice($index, 1);
    };

    $scope.onCustomValueUp = function($index) {
        $scope.field.defineValues.swap($index, $index - 1);
    };

    $scope.onCustomValueDown = function($index) {
        $scope.field.defineValues.swap($index, $index + 1);
    };

    $scope.validate = function() {
        var result = false;
        if ($scope.field.name === null || $scope.field.name.length < 3)
        {
            alert('Field name requires at least 3 characters');
            return result;
        }

        if ($scope.fieldType === undefined)
        {
            alert('Please select field type.');
            return result;
        }
        else
        {
            $scope.field.field_type_id = $scope.fieldType.id;
            if ($scope.fieldType.groupId === 2 || $scope.fieldType.groupId === 3)
            {
                if ($scope.valueType === undefined)
                {
                    alert('Please select value type');
                    return result;
                }

                $scope.field.value_type = $scope.valueType.id;
            }
        }

        result = true;
        return result;
    };

    $scope.onSubmit = function() {
        if ($scope.validate())
        {
            var requestData = {
                action: $('#action').val(),
                id: $('#id').val(),
                data: JSON.stringify($scope.field)
            };
            fieldService.saveField(requestData).then(function(data) {
                console.log(data);
                if (data.success !== undefined)
                {
                    alert(data.success.message);
                    window.location = data.success.url;
                }
            });
        }
    };

});