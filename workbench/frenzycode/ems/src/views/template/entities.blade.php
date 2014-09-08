<div class="portlet box blue" ng-app="emsApp">
    <div class="portlet-title">
        <div class="caption">
            {{$templateData->portletTitle}}   
        </div>        
    </div>
    <div class="portlet-body" ng-controller="EntityController" ng-init="getEntities()">
        <div class="row">
            <div class="col-md-12">
                <div class="btn-group tabletools-btn-group pull-right">
                    <a href="{{URL::to('entities/'.$templateData->groupLink.'/add')}}" class="btn blue"><i class="fa fa-plus"></i> Add {{$templateData->portletTitle}}</a>
                    <a href="/" class="btn red-flamingo"><i class="fa fa-minus"></i> Remove {{$templateData->portletTitle}}</a>
                </div>
            </div>
        </div>
        <div class="portlet solid grey-cararra" style="border: 1px solid #ddd">
            
            <div class="portlet-body">
                <div class="row">
                    <div class="col-md-4 form-group" ng-if="hasTextSearch">
                        <label>Search</label>                         
                        <input type="text" class="form-control" ng-model="textSearch.value"/>
                    </div>
                    <div class="col-md-4 form-group" ng-repeat="field in fields">
                        <label>@{{field.name}}</label>                         
                        <select class="form-control"  
                                ng-model="field.selected" 
                                ng-options="item.value for item in field.defineValues" ng-if="field.fieldValueType == 2"></select>
                        <select class="form-control"  
                                multiple="true"
                                ng-model="field.selected" 
                                ng-options="item.value for item in field.defineValues" ng-if="field.fieldValueType == 3"></select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="btn-group tabletools-btn-group pull-right">
                            <a ng-click="search()" class="btn blue"><i class="fa fa-search"></i> Search</a>
                            <a ng-click="resetSearch()" class="btn blue"><i class="fa fa-recycle"></i> Reset search</a>
                            <input type="hidden" value="{{$templateData->groupLink}}" id="link"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <table class="table table-bordered">
            <thead>
                <tr>                    
                    <th>
                        Entities
                    </th>                    
                    <th width='105px !important'>
                        Actions
                    </th>                    
                </tr>
            </thead>
            <tbody>
                <tr>                   
                    <td>
                        <input type="text" class="form-control" placeholder="Quick search.." ng-model="searchEntity"/>
                    </td>                    
                    <td>

                    </td>                    
                </tr>                                   
                <tr ng-repeat="entity in entities|filter:{name:searchEntity}">
                    <td><a ng-href="{{URL::to('/entities/'.$templateData->groupLink.'/edit/')}}/@{{entity.id}}" >@{{entity.name}}</a></td>
                    <td>
                        <div class="btn-group tabletools-btn-group pull-right">
                            <a ng-href="{{URL::to('/entities/'.$templateData->groupLink.'/edit/')}}/@{{entity.id}}" class="btn blue"><i class="fa fa-edit"></i></a>
                            <a ng-click="onRemove($index)" class="btn red-flamingo"><i class="fa fa-minus"></i></a>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>

    </div>
</div>