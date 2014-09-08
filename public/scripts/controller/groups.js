emsApp.controller("GroupController", function($scope, groupService)
{
    $scope.getGroups = function() {
        groupService.getGroups().then(function(data) {
            $scope.groups = data;
        });
    };

    $scope.getGroup = function() {
        var requestData = {id: $('#id').val()};
        groupService.getGroup(requestData).then(function(data) {
            console.log(data);
            $scope.group = data.group;
        });
    };

    $scope.getGroupFields = function() {
        var requestData = {id: $('#id').val()};
        groupService.getGroupFields(requestData).then(function(data) {
            $scope.group = data.group;
            $scope.fields = data.fields;
            console.log(data);
        });
    };


    $scope.validate = function() {
        return true;
    };

    $scope.onSubmit = function() {
        console.log($scope.group);
        if ($scope.validate())
        {
            var requestData = {
                action: $('#action').val(),
                id: $('#id').val(),
                data: JSON.stringify($scope.group)
            };
            groupService.saveGroup(requestData).then(function(data) {
                console.log(data);
                if (data.success !== undefined)
                {
                    alert(data.success.message);
                    if (data.success.url !== undefined)
                    {
                        window.location = data.success.url;
                    }
                }
            });
        }
    };
    
    
    $scope.onAssignSubmit = function() {
        console.log($scope.group);
        if ($scope.validate())
        {
            var requestData = {
                action: $('#action').val(),
                id: $('#id').val(),
                data: JSON.stringify($scope.group)
            };
            groupService.saveGroupFields(requestData).then(function(data) {
                console.log(data);
                if (data.success !== undefined)
                {
                    alert(data.success.message);
                    if (data.success.url !== undefined)
                    {
                        window.location = data.success.url;
                    }
                }
            });
        }
    };

    $scope.onKeyUp = function() {
        $scope.group.link = convertText2Link($scope.group.name);
    };

    $scope.onAssignField = function() {
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
});