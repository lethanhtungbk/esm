<div class="page-content-wrapper">
    <div class="page-content" ng-app="emsApp">        
        <!-- BEGIN PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                <h3 class="page-title">{{$pageBody->title}}</h3>
                <ul class="page-breadcrumb breadcrumb">
                    @foreach ($pageBody->breadcrumbs as $index => $breadcrumb)
                    <li>
                        <i class="fa {{$breadcrumb->icon}}"></i>
                        @if ($breadcrumb->link != '')
                        <a href="{{URL::to($breadcrumb->link)}}">{{$breadcrumb->title}}</a>
                        @else
                        <span>{{$breadcrumb->title}}</span>
                        @endif
                        @if ($index != count($pageBody->breadcrumbs) - 1)
                        <i class="fa fa-angle-right"></i>
                        @endif
                    </li>
                    @endforeach                    
                </ul>
                <!-- END PAGE TITLE & BREADCRUMB-->
            </div>
        </div>
        <!-- END PAGE HEADER-->
        
        <!-- BEGIN PAGE CONTENT-->
        @include('frenzycode::'.$pageBody->template,array('templateData' => $pageBody->templateData))
        <!-- END PAGE CONTENT-->
    </div>
</div>