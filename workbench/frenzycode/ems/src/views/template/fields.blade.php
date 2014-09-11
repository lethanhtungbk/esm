<div class="portlet box blue" >
    <div class="portlet-title">
        <div class="caption">
            Fields                      
        </div>        
    </div>
    <div class="portlet-body" ng-controller="FieldTableController" ng-init="getFields()">
        <div class="row">
            <div class="col-md-12">                
                <div class="btn-group tabletools-btn-group pull-left">
                    <input type="text" class="form-control" placeholder="Search field.." ng-model="searchField"/>
                </div>
                <div class="btn-group tabletools-btn-group pull-right">
                    <a href="{{URL::to('/setting/fields/add')}}" class="btn blue"><i class="fa fa-plus"></i> Add field</a>
                    <a href="/fields/add" class="btn red-flamingo"><i class="fa fa-minus"></i> Remove fields</a>
                </div>
            </div>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>                    
                    <th width="50%">
                        Field
                    </th>
                    <th >
                        Field Type
                    </th>
                    <th width='105px !important'>
                        Action    
                    </th>                    
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat="field in fields| filter:{name:searchField}">                   
                    <td>
                        <a ng-href="{{URL::to('/setting/fields/edit/')}}/@{{field.id}}">@{{field.name}}</a>
                    </td>
                    <td>
                        @{{field.field_type}}
                    </td>
                    <td>
                        <div class="btn-group tabletools-btn-group pull-right">
                            <a ng-href="{{URL::to('/setting/fields/edit/')}}/@{{field.id}}" class="btn blue"><i class="fa fa-edit"></i></a>
                            <a ng-click="onRemove($index)" class="btn red-flamingo"><i class="fa fa-minus"></i></a>
                        </div>
                    </td>                    
                </tr>                  
            </tbody>
        </table>
    </div>
</div>