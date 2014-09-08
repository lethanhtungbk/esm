emsApp.service('groupService', function(baseService) {

    return ({
        getGroups: getGroups,
        saveGroup : saveGroup,
        getGroup : getGroup,
        getGroupFields : getGroupFields,
        saveGroupFields : saveGroupFields,
    });
    
    function getGroupFields(data)
    {
        return baseService.postData(data,"group-fields");   
    }
    
    function getGroups()
    {
        return baseService.postData({},"groups"); 
    }
    
    function getGroup(data)
    {
        return baseService.postData(data,"group");
    }
    
    function saveGroup(data)
    {
        return baseService.postData(data,"group/save");
    }
    
    function saveGroupFields(data)
    {
        return baseService.postData(data,"group-fields/save");
    }
});