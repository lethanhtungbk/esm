<div class="portlet box blue" ng-app="emsApp">
    <div class="portlet-title">
        <div class="caption">
            Add new 
        </div>        
    </div>
    <div class="portlet-body form" ng-controller="EntityController" ng-init="getEntity()">
        <div class="form-horizontal">
            <div class="form-body">
                <div class="from-group">
                    <ems-text-input label="Name" model="entity.name" />
                </div>
                <div ng-repeat="field in fields" ng-switch="field.display">
                    <div ems-text-input label="@{{field.name}}" model="field.selected" ng-switch-when="textfield"></div>
                    <div ems-text-area label="@{{field.name}}" model="field.selected" ng-switch-when="textarea"></div>    
                    <div ems-select label="@{{field.name}}" model="field.selected" options="field.defineValues" ng-switch-when="dropdown" ></div>
                    <div ems-select label="@{{field.name}}" model="field.selected" options="field.defineValues" ng-switch-when="radio" ></div>
                    <div ems-select-multiple label="@{{field.name}}" model="field.selected" options="field.defineValues" ng-switch-when="list" ></div>
                    <div ems-select-multiple label="@{{field.name}}" model="field.selected" options="field.defineValues" ng-switch-when="checkbox" ></div>
                    <div ems-file-upload label="@{{field.name}}" model="field.selected" ng-switch-when="image" type="image" ></div>
                    <div ems-file-upload label="@{{field.name}}" model="field.selected" ng-switch-when="audio" type="audio" ></div>
                    <div ems-file-upload label="@{{field.name}}" model="field.selected" ng-switch-when="video" type="video" ></div>
                    <div ems-file-upload label="@{{field.name}}" model="field.selected" ng-switch-when="video" type="attachment" ></div>
                </div>
            </div>            


            <div class="form-actions">
                <div class="col-md-offset-3 col-md-9">      
                    <input type="hidden" value="{{$templateData->groupLink}}" id="link"/>
                    <input type="hidden" value="{{$templateData->action}}" id="action"/>
                    <input type="hidden" value="{{$templateData->id}}" id="id"/>
                    <a class="btn blue" ng-click="saveEntity()"><i class="fa fa-save"></i> Save</a>                        
                    <button type="button" class="btn default">Cancel</button>
                </div>
            </div>
        </div>


    </div>
</div>