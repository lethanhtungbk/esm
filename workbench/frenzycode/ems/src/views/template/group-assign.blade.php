<div class="portlet box blue" ng-app="emsApp">
    <div class="portlet-title">
        <div class="caption">
            Group Assign                    
        </div>        
    </div>
    <div class="portlet-body form" ng-controller="GroupController" ng-init="getGroupFields()">
        <form action="#" class="form-horizontal">
            <div class="form-body">
                <div class="form-group">
                    <label class="col-md-3 control-label">Group</label>
                    <div class="col-md-4">
                        <input type="text" class="form-control" ng-model="group.name" readonly="true">                                
                    </div>
                </div>                        
                <div class="form-group">
                    <label class="col-md-3 control-label">Fields</label>
                    <div class="col-md-4">
                        <select class="form-control"  
                                ng-model="field" 
                                ng-options="field.name for field in fields" multiple></select>
                    </div>
                    <div class="col-md-1">
                        <a ng-click="onAssignField()" class="btn blue"><i class="fa fa-chain"></i>  Assign</a>
                    </div>
                </div>                        
                <div class="form-group">
                    <label class="col-md-3 control-label">Group fields</label>
                    <div class="col-md-4">
                        <table class="table table-bordered">
                            <thead>
                                <tr>                    
                                    <th >Field</th>
                                    <th width='110px !important' />
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="assignField in group.fields">                   
                                    <td>
                                        @{{assignField.name}}
                                    </td>
                                    <td>
                                        <div class="btn-group pull-right">
                                            <a class="btn blue"><i class="fa fa-share-alt"></i></a>
                                            <a ng-click="onUnAssignField($index)"  class="btn red-flamingo"><i class="fa fa-chain-broken"></i></a>
                                        </div>        
                                    </td>                    
                                </tr>                                                          
                            </tbody>
                        </table>
                    </div>
                </div>  
            </div>
            <div class="form-actions">
                <div class="col-md-offset-3 col-md-9">
                    <input type="hidden" value="{{$templateData->id}}" id="id"/>
                    <input type="hidden" value="{{$templateData->action}}" id="action"/>
                    <a class="btn blue" ng-click="onAssignSubmit()"><i class="fa fa-save"></i> Save</a>                        
                    <a class="btn default" href="{{URL::to('setting/groups')}}">Cancel</a> 
                </div>
            </div>
        </form>
    </div>
</div>