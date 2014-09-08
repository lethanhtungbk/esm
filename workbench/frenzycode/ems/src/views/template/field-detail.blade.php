<div class="portlet box blue" ng-app="emsApp">
    <div class="portlet-title">
        <div class="caption">
            Add field                      
        </div>        
    </div>
    <div class="portlet-body form" ng-controller="FieldController" ng-init="getField()">
        <div class="form-horizontal">
            <div class="form-body">
                <div class="form-group">
                    <label class="col-md-3 control-label">Name</label>
                    <div class="col-md-4">
                        <input type="text" class="form-control" ng-model="field.name">                                
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">Field type</label>
                    <div class="col-md-4">
                        <select class="form-control"  
                                ng-model="fieldType" 
                                ng-options="fieldType.name group by fieldType.group for fieldType in fieldTypes"></select>
                    </div>
                </div>

                <div class="form-group" ng-show="fieldType.groupId == 2 || fieldType.groupId == 3">
                    <label class="control-label col-md-3">Value Type</label>
                    <div class="col-md-4" row>
                        <select class="form-control"  
                                ng-model="valueType" 
                                ng-options="valueType.name for valueType in valueTypes"></select>

                        <!-- Assign to object START-->
                        <div class="form-group" style="margin-top: 10px;margin-bottom: 10px" ng-show="valueType.id == 2">
                            <label class="control-label col-md-2" style="text-align: left">Object</label>
                            <div class="col-md-10">
                                <select class="form-control"  
                                        ng-model="object" 
                                        ng-options="object.name for object in objects"></select>
                            </div>
                        </div>
                        <div class="form-group" style="margin-top: 10px;margin-bottom: 10px" ng-show="valueType.id == 2">
                            <label class="control-label col-md-2" style="text-align: left">Attribute</label>
                            <div class="col-md-10">
                                <select class="form-control"  
                                        ng-model="field" 
                                        ng-options="field.name for field in object.fields"></select>
                            </div>
                        </div>
                        <!-- Assign to object END-->
                        <!-- Assign itselft START-->
                        <div class="row" style="margin-top: 10px;margin-bottom: 10px" ng-show="valueType.id == 1">
                            <div ng-repeat="defineValue in field.defineValues">
                                <div class="col-md-7">
                                    <input type="text" class="form-control" ng-model="defineValue.value"/>
                                </div>
                                <div class="btn-group tabletools-btn-group col-md-5">
                                    <a class="btn blue" ng-click="onCustomValueAdd($index)"><i class="fa fa-plus"></i></a>
                                    <a class="btn blue" ng-click="onCustomValueRemove($index)" ng-disabled="definedValues.length == 1"><i class="fa fa-minus" ></i></a>
                                    <a class="btn blue" ng-click="onCustomValueUp($index)" ng-disabled="$index == 0"><i class="fa fa-arrow-up"></i></a>
                                    <a class="btn blue" ng-click="onCustomValueDown($index)" ng-disabled="$index == definedValues.length - 1"><i class="fa fa-arrow-down"></i></a>
                                </div>
                            </div>                                    
                        </div>
                        <!-- Assign itselft END-->
                    </div>
                </div>

            </div>
            <div class="form-actions">
                <div class="col-md-offset-3 col-md-9">      
                    <input type="hidden" value="{{$templateData->id}}" id="id"/>
                    <input type="hidden" value="{{$templateData->action}}" id="action"/>
                    <a class="btn blue" ng-click="onSubmit()"><i class="fa fa-save"></i> Save</a>                        
                    <button type="button" class="btn default">Cancel</button>
                </div>
            </div>
        </div>


    </div>
</div>