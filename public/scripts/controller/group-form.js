emsApp.controller('GroupFormController', function($scope, groupService)
{
    $scope.getGroup = function() {
        var id = ($scope.id != undefined) ? $scope.id : '';
        var requestData = {id: id};
        groupService.getGroup(requestData).then(function(data) {
            console.log(data);
            $scope.group = data.group;
        });
    };

    $scope.validate = function() {
        return true;
    };

    $scope.onSubmit = function() {
        console.log($scope.group);
        if ($scope.validate())
        {
             var id = ($scope.id != undefined) ? $scope.id : '';
            var requestData = {
                action: $('#action').val(),
                id: id,
                data: JSON.stringify($scope.group)
            };
            groupService.saveGroup(requestData).then(function(data) {
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

    $scope.onKeyUp = function() {
        $scope.group.link = convertText2Link($scope.group.name);
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