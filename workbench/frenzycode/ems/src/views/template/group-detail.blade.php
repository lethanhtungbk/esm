<div class="portlet box blue" ng-app="emsApp">
    <div class="portlet-title">
        <div class="caption">
            Edit group                      
        </div>        
    </div>
    <div class="portlet-body form" ng-controller="GroupController" ng-init="getGroup()">
        <div class="form-horizontal">
            <div class="form-body">
                <div class="form-group">
                    <label class="col-md-3 control-label">Name</label>
                    <div class="col-md-4">
                        <input type="text" class="form-control" ng-model="group.name" ng-keyup="onKeyUp()">                                
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Link</label>
                    <div class="col-md-4">
                        <input type="text" class="form-control" ng-model="group.link">                                
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Icon</label>
                    <div class="col-md-4">
                        <input type="text" class="form-control" ng-model="group.icon">                                
                    </div>
                </div>
            </div> 
            
            <div class="form-actions">
                <div class="col-md-offset-3 col-md-9">      
                    <input type="hidden" value="{{$templateData->id}}" id="id"/>
                    <input type="hidden" value="{{$templateData->action}}" id="action"/>
                    <a class="btn blue" ng-click="onSubmit()"><i class="fa fa-save"></i> Save</a>                        
                    <a class="btn default" href="{{URL::to('setting/groups')}}">Cancel</a>                        
                </div>
            </div>
        </div>
    </div>
</div>