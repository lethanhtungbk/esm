emsApp.controller('FieldFormController', function($scope, fieldService, groupService)
{
    $scope.formInit = function() {
        $scope.groups_loaded = false;

        var id = ($scope.id != undefined) ? $scope.id : '';
        var requestData = {id: id};

        fieldService.getField(requestData).then(function(data) {
            console.log(data);
            $scope.field = data.field;
            $scope.fieldTypes = data.fieldTypes;
            $scope.fieldType = searchObject($scope.fieldTypes, 'id', $scope.field.field_type_id);
            $scope.valueTypes = data.valueTypes;
            $scope.valueType = searchObject($scope.valueTypes, 'id', $scope.field.value_type);
            if ($scope.valueType != undefined)
            {
                $scope.onValueTypeChanged();
            }

            if ($scope.field.defineValues == undefined || $scope.field.defineValues.length == 0)
            {
                //default value
                $scope.field.defineValues = [{id: "-1", value: ""}];
            }
        });


    };

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
        //Validate file name        
        if ($scope.field.name === null || $scope.field.name.length < 0)
        {
            alert('Field name requires at least 3 characters');
            return false;
        }

        //Validate field type
        if ($scope.fieldType === undefined)
        {
            alert('Please select field type.');
            return false;
        }
        $scope.field.field_type_id = $scope.fieldType.id;



        if ($scope.fieldType.groupId == 1)
        {
            delete $scope.field.value_type;
            delete $scope.field.object_id;
            delete $scope.field.attribute_id;
            delete $scope.field.defineValues;
            return true;
        }
        else if ($scope.fieldType.groupId === 2 || $scope.fieldType.groupId === 3)
        {
            //Validate value type
            if ($scope.valueType === undefined)
            {
                alert('Please select value type');
                return false;
            }

            $scope.field.value_type = $scope.valueType.id;

            if ($scope.field.value_type == 1)
            {
                delete $scope.field.object_id;
                delete $scope.field.attribute_id;

                for (var i = 0; i < $scope.field.defineValues.length; i++)
                {
                    var defineValue = $scope.field.defineValues[i];
                    if (defineValue.value === "")
                    {
                        $scope.field.defineValues.splice(i, 1);
                    }
                }
                return true;
            }
            else if ($scope.field.value_type == 2)
            {
                delete $scope.field.defineValues;

                if ($scope.object != undefined)
                {
                    $scope.field.object_id = $scope.object.id;

                    if ($scope.attribute != undefined)
                    {
                        $scope.field.attribute_id = $scope.attribute.id;
                    }
                }

                return true;
            }
            else
            {
                alert('Unknown Value Type.');
                return false;
            }
        }
    };

    $scope.onSubmit = function() {

        var id = ($scope.id != undefined) ? $scope.id : '';
        if ($scope.validate())
        {
            var requestData = {
                action: $scope.action,
                id: id,
                data: JSON.stringify($scope.field)
            };

            fieldService.saveField(requestData).then(function(data) {
                console.log(data);
                if (data.success !== undefined)
                {
                    alert(data.success.message);
                    if ($scope.successurl != undefined && $scope.successurl != "")
                    {
                        window.location = $scope.successurl;
                        return;
                    }

                    if ($scope.success != undefined)
                    {
                        $scope.success();
                        return;
                    }
                }
            });
        }
    };

    $scope.onCancel = function() {
        if ($scope.cancelurl != undefined && $scope.cancelurl != "")
        {
            window.location = $scope.cancelurl;
            return;
        }

        if ($scope.cancel != undefined)
        {
            $scope.cancel();
            return;
        }
    };

    $scope.onValueTypeChanged = function() {
        if ($scope.valueType.id == 2 && !$scope.groups_loaded)
        {
            //assign group case
            groupService.getGroups().then(function(data) {
                $scope.objects = data;
                for (var i = 0; i < $scope.objects.length; i++)
                {
                    $scope.objects[i].loaded = false;
                    $scope.object = searchObject($scope.objects, 'id', $scope.field.object_id);
                    if ($scope.object != undefined)
                    {
                        $scope.onObjectChanged();
                    }
                }
                $scope.groups_loaded = true;
            });
        }
    };

    $scope.onObjectChanged = function() {
        if (!$scope.object.loaded)
        {
            var requestData = {id: $scope.object.id};
            groupService.getGroupFields(requestData).then(function(data) {
                $scope.object.fields = data.group.fields;
                $scope.object.loaded = true;

                $scope.attribute = searchObject($scope.object.fields, 'id', $scope.field.attribute_id);
            });
        }
        else {
            $scope.attribute = searchObject($scope.object.fields, 'id', $scope.field.attribute_id);
        }
    };
});