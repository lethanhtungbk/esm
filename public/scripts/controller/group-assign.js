emsApp.controller('GroupAssignController', function($scope, groupService)
{
    $scope.getGroupFields = function() {
        var id = ($scope.id != undefined) ? $scope.id : '';
        var requestData = {id: id};
        groupService.getGroupFields(requestData).then(function(data) {
            $scope.group = data.group;
            $scope.fields = data.fields;
            console.log(data);
        });
    };
    
    $scope.validate = function() {
        return true;
    };
    
    $scope.onAssignSubmit = function() {
        console.log($scope.group);
        var id = ($scope.id != undefined) ? $scope.id : '';
        if ($scope.validate())
        {
            var requestData = {
                action: $scope.action,
                id: id,
                data: JSON.stringify($scope.group)
            };
            groupService.saveGroupFields(requestData).then(function(data) {
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
    }
    
    $scope.onAssignField = function() {
        if ($scope.field == undefined || $scope.field.length == 0)
        {
            alert("Please select field to assign.");
            return;
        }

        for (i = 0; i < $scope.field.length; i++)
        {
            $scope.group.fields.push($scope.field[i]);
            $scope.fields.splice($scope.fields.indexOf($scope.field[i]), 1);
        }
        $scope.field = [];
    };

    $scope.onUnAssignField = function($index) {
        $scope.fields.push($scope.group.fields[$index]);
        $scope.group.fields.splice($index, 1);
    };

    $scope.fieldCreated = function()
    {
        $('#full').modal('toggle');
        $scope.getGroupFields();
    };

    $scope.cancel = function()
    {
        $('#full').modal('toggle');
    };
});