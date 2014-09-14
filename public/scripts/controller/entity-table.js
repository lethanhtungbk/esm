emsApp.controller('EntityTableController', function($scope, entityService)
{
    $scope.textSearch = {};

    $scope.resetSearch = function()
    {
        $scope.getEntities();
    };


    $scope.search = function()
    {
        if ($scope.fields !== undefined)
        {
            var data = {};
            data.fields = [];
            for (var i = 0; i < $scope.fields.length; i++)
            {
                var field = $scope.fields[i];
                if (field.selected !== undefined)
                {
                    data.fields.push({fieldId: field.id, selected: $scope.getSelectedValue(field.selected), fieldValueType: field.fieldValueType});
                }
            }
            data.link = $('#link').val();
            if ($scope.textSearch.value !== "")
            {
                data.searchText = $scope.textSearch.value;
            }
            entityService.searchEntities(data).then(function(data) {
                $scope.entities = data;
            });
        }
    };

    $scope.getEntities = function() {
        var requestData = {
            link: $scope.link,
        };
        entityService.getEntities(requestData).then(function(data) {
            //console.log(data);
            $scope.textSearch.value = "";
            $scope.entities = data.entities;
            $scope.fields = data.fields;
            for (var i = 0; i < $scope.fields.length; i++)
            {
                var field = $scope.fields[i];
                if (field.fieldValueType === 2)
                {
                    field.selected = searchObject(field.defineValues, 'id', 0);
                }
            }
            $scope.hasTextSearch = data.hasTextSearch;
        });
    };

});