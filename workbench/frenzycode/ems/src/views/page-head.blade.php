<meta charset="utf-8"/>
@if ($pageHead != null)
<title>{{$pageHead->title}}</title>
@endif
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1" name="viewport"/>
<meta content="Entity Management System" name="description"/>
<meta content="bluesitevn" name="author"/>
<!-- BEGIN CUSTOM META STYLES -->
@foreach ($pageHead->customMetas as $meta)
<meta {{$meta}}/>
@endforeach
<!-- END CUSTOM META STYLES -->
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<link href="{{URL::asset('assets/global/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{URL::asset('assets/global/plugins/simple-line-icons/simple-line-icons.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{URL::asset('assets/global/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{URL::asset('assets/global/plugins/uniform/css/uniform.default.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{URL::asset('assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css')}}" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN THEME STYLES -->
<link href="{{URL::asset('assets/global/css/components.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{URL::asset('assets/global/css/plugins.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{URL::asset('assets/admin/layout/css/layout.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{URL::asset('assets/admin/layout/css/themes/default.css')}}" rel="stylesheet" type="text/css" id="style_color"/>
<link href="{{URL::asset('assets/admin/layout/css/custom.css')}}" rel="stylesheet" type="text/css"/>
<!-- BEGIN CUSTOM STYLES -->
@foreach ($pageHead->customStyles as $style)
<link href="{{$style}}" rel="stylesheet" type="text/css"/>
@endforeach
<!-- END CUSTOM STYLES -->
<link rel="shortcut icon" href="favicon.ico"/>
