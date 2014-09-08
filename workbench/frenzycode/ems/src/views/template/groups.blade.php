<div class="portlet box blue" ng-app="emsApp">
    <div class="portlet-title">
        <div class="caption">
            Groups                      
        </div>        
    </div>
    <div class="portlet-body" ng-controller="GroupController" ng-init="getGroups()">
        <div class="row">
            <div class="col-md-12">
                <div class="btn-group tabletools-btn-group pull-right">
                    <a href="{{URL::to('setting/groups/add')}}" class="btn blue"><i class="fa fa-plus"></i> Add group</a>
                    <a href="/" class="btn red-flamingo"><i class="fa fa-minus"></i> Remove group</a>
                </div>
            </div>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>                    
                    <th width="60%">
                        Group
                    </th>
                    <th >
                        Fields
                    </th>
                    <th width='155px !important'>
                        Actions
                    </th>                    
                </tr>
            </thead>
            <tbody>
                <tr>                   
                    <td>
                        <input type="text" class="form-control" placeholder="Search group.." ng-model="searchGroup"/>
                    </td>
                    <td>
                        <select class="form-control" ></select>
                    </td>
                    <td>
                        
                    </td>                    
                </tr>
                <tr ng-repeat="group in groups| filter:{name:searchGroup}">                   
                    <td>
                        <a ng-href="{{URL::to('/setting/groups/assign/')}}/@{{group.id}}">@{{group.name}}</a>
                    </td>
                    <td>
                        <div ng-repeat="field in group.fields">
                            <a ng-href="{{URL::to('/setting/fields/edit/')}}/@{{field.id}}">@{{field.name}}</a>
                        </div>                        
                    </td>
                    <td>
                        <div class="btn-group pull-left">
                            <a ng-href="{{URL::to('/setting/groups/edit/')}}/@{{group.id}}" class="btn blue"><i class="fa fa-edit"></i></a>
                            <a ng-href="{{URL::to('/setting/groups/assign/')}}/@{{group.id}}" class="btn blue"><i class="fa fa-chain"></i></a>
                            <a ng-click="onAssignGroup($index)" class="btn red-flamingo"><i class="fa fa-minus"></i></a>
                        </div>
                    </td>                    
                </tr>                           
            </tbody>
        </table>
    </div>
</div>