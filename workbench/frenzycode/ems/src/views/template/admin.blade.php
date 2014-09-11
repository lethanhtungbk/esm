@if (Session::has('success'))
<div class="alert alert-success alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
    {{Session::get('success')}}
</div>
@endif

<div class="row">
    <div class="col-md-12">
        <div class="btn-group tabletools-btn-group">
            <a href="{{URL::to('admin/import')}}" class="btn blue"><i class="fa fa-upload"></i> Import sample</a>
        </div>
    </div>
</div>