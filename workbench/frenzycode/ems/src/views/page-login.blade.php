<!DOCTYPE html>
<html lang="en" class="no-js">
    <head>
        <!-- BEGIN HEAD -->
        @include('frenzycode::page-head',array('pageHead' => $pageData->head))
        <!-- END HEAD -->
    </head>    
    <body class="login">
        <!-- BEGIN LOGO -->
        <div class="logo">
            <a href="index.html">
                <img src="../../assets/admin/layout/img/logo-big.png" alt=""/>
            </a>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
        <div class="menu-toggler sidebar-toggler">
        </div>
        <!-- END SIDEBAR TOGGLER BUTTON -->
        <!-- BEGIN LOGIN -->
        <div class="content">
            <!-- BEGIN LOGIN FORM -->
            {{ Form::open(array('url' => 'login','class' => 'login-form','enctype' => 'multipart/form-data')) }}
            <h3 class="form-title">Login to your account</h3>
            @if($errors->any())
            <div class="alert alert-danger">
                <button class="close" data-close="alert"></button>
                @foreach ($errors->all() as $err)
                <span>{{$err}}</span><br/>
                @endforeach                
            </div>
            @endif

            <div class="form-group">
                <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                <label class="control-label visible-ie8 visible-ie9">Username</label>
                <div class="input-icon">
                    <i class="fa fa-user"></i>
                    <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Username" name="username"/>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label visible-ie8 visible-ie9">Password</label>
                <div class="input-icon">
                    <i class="fa fa-lock"></i>
                    <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password"/>
                </div>
            </div>
            <div class="form-actions">
                <label class="checkbox">
                    <input type="checkbox" name="remember" value="1"/> Remember me </label>
                    <button type="submit" class="btn green pull-right">Login <i class="m-icon-swapright m-icon-white"></i></button>
            </div>               
            {{ Form::close() }}
            <!-- END LOGIN FORM -->                  
        </div>
        <!-- END LOGIN -->

        <!-- BEGIN FOOTER -->
        @include('frenzycode::page-footer',array('pageFooter' => $pageData->footer))
        <!-- END FOOTER -->       
    </body>
</html>
