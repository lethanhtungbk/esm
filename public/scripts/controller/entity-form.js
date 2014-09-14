emsApp.controller('EntityFormController', function($scope, entityService)
{
    $scope.getEntity = function() {
        var id = ($scope.id != undefined) ? $scope.id : '';
        var requestData = {id: id, link: $scope.link};
        entityService.getEntity(requestData).then(function(data) {
            $scope.fields = data.fields;
            $scope.entity = data.entity;
            for (var i = 0; i < $scope.fields.length; i++)
            {
                var field = $scope.fields[i];


                var fieldValue = searchObject($scope.entity.fieldValues, 'field_id', field.id);

                if (fieldValue !== undefined)
                {

                    switch (field.fieldValueType)
                    {
                        case 1:
                            field.selected = fieldValue.value;
                            break;
                        case 2:
                            field.selected = searchObject(field.defineValues, 'id', parseInt(fieldValue.value));
                            break;
                        case 3:
                            field.selected = [];

                            for (var j = 0; j < fieldValue.value.length; j++)
                            {
                                var id = fieldValue.value[j];
                                var defineValue = searchObject(field.defineValues, 'id', parseInt(id));
                                if (defineValue !== undefined)
                                {
                                    field.selected.push(defineValue);
                                }
                            }
                            break;
                    }
                }
            }
        });
    };

    $scope.validate = function() {
        return true;
    };

    $scope.getSelectedValue = function(selected) {
        var selectedType = Object.prototype.toString.call(selected).split(/\W/)[2];
        switch (selectedType)
        {
            case "String":
                return selected;

            case "Object":
                return selected.id;

            case "Array":
                var ids = [];
                for (var i = 0; i < selected.length; i++)
                {
                    ids.push(selected[i].id);
                }
                return ids;
        }
        return null;
    };

    $scope.saveEntity = function() {
        if ($scope.entity.fieldValues === undefined)
        {
            $scope.entity.fieldValues = [];
        }

        for (var i = 0; i < $scope.fields.length; i++)
        {
            var field = $scope.fields[i];

            if (field.selected !== undefined)
            {
                var fieldValue = searchObject($scope.entity.fieldValues, 'field_id', field.id);
                if (fieldValue === undefined)
                {
                    fieldValue = {};
                    fieldValue.field_id = field.id;
                    $scope.entity.fieldValues.push(fieldValue);
                }
                fieldValue.value = $scope.getSelectedValue(field.selected);
            }
        }

        if ($scope.validate())
        {
            var id = ($scope.id != undefined) ? $scope.id : '';
            var requestData = {
                action: $scope.action,
                id: id,
                data: JSON.stringify($scope.entity)
            };
            entityService.saveEntity(requestData).then(function(data) {
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
});