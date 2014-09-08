<!DOCTYPE html>
<html lang="en" class="no-js">
    <head>
        <!-- BEGIN HEAD -->
        @include('frenzycode::page-head',array('pageHead' => $pageData->head))
        <!-- END HEAD -->
    </head>    
    <body class="page-header-fixed page-quick-sidebar-over-content page-header-fixed-mobile page-footer-fixed1">
        <!-- BEGIN BODY -->
        @include('frenzycode::page-body',array('pageBody' => $pageData->body))
        <!-- END BODY -->
        <!-- BEGIN FOOTER -->
        @include('frenzycode::page-footer',array('pageFooter' => $pageData->footer))
        <!-- END FOOTER -->       
    </body>
</html>
