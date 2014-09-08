<div class="page-footer">
    <div class="page-footer-inner">
        {{$pageFooter->title}}
    </div>
    <div class="page-footer-tools">
        <span class="go-top">
            <i class="fa fa-angle-up"></i>
        </span>
    </div>
</div>

<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="../../assets/global/plugins/respond.min.js"></script>
<script src="../../assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
<script>
    var baseURL = "{{URL::to('/')}}";  
</script>
{{HTML::script('assets/global/plugins/jquery-1.11.0.min.js')}}
{{HTML::script('assets/global/plugins/jquery-migrate-1.2.1.min.js')}}
<!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
{{HTML::script('assets/global/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js')}}
{{HTML::script('assets/global/plugins/bootstrap/js/bootstrap.min.js')}}
{{HTML::script('assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js')}}
{{HTML::script('assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}
{{HTML::script('assets/global/plugins/jquery.blockui.min.js')}}
{{HTML::script('assets/global/plugins/jquery.cokie.min.js')}}
{{HTML::script('assets/global/plugins/uniform/jquery.uniform.min.js')}}
{{HTML::script('assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}
<!-- END CORE PLUGINS -->
{{HTML::script('assets/global/scripts/metronic.js')}}
{{HTML::script('assets/admin/layout/scripts/layout.js')}}
{{HTML::script('assets/admin/layout/scripts/quick-sidebar.js')}}

<!-- BEGIN CUSTOM SCRIPT -->
@foreach ($pageFooter->customScripts as $script)
{{$script}}
@endforeach
<!-- END CUSTOM SCRIPT -->

<!-- END CORE PLUGINS -->
<script>
<!-- BEGIN CUSTOM FUNCTION -->
{{$pageFooter->customFunction}}        
<!-- END CUSTOM FUNCTION -->
jQuery(document).ready(function() {
    Metronic.init(); // init metronic core components
    Layout.init(); // init current layout
    QuickSidebar.init() // init quick sidebar    
    //BEGIN CUSTOM INIT
    {{$pageFooter->initScript}}    
    //END CUSTOM INIT
    
    
});
</script>