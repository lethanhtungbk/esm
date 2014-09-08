emsApp.service('fieldService', function(baseService) {
    return ({
        getFields: getFields,
        getField: getField,
        saveField: saveField
    });
    
    function saveField(data)
    {
        return baseService.postData(data,"field/save");           
    }

    function getField(data)
    {
       //data: {id : }
       return baseService.postData(data,"field");            
    }
    
    function getFields()
    {
       //data: {id : }
       return baseService.postData({},"fields");            
    }
});