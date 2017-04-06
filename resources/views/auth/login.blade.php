<!doctype html>
<html class="fixed">
<head>

    <!-- Basic -->
    <meta charset="UTF-8">

    <title>The Contento</title>

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>

    <!-- Web Fonts  -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light"
          rel="stylesheet" type="text/css">

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="{{asset('admin_assets/vendor/bootstrap/css/bootstrap.css')}}"/>
    <link rel="stylesheet" href="{{asset('admin_assets/vendor/font-awesome/css/font-awesome.css')}}"/>
    <link rel="stylesheet" href="{{asset('admin_assets/vendor/magnific-popup/magnific-popup.css')}}"/>
    <link rel="stylesheet" href="{{asset('admin_assets/vendor/bootstrap-datepicker/css/datepicker3.css')}}"/>

    <!-- Theme CSS -->
    <link rel="stylesheet" href="{{asset('admin_assets/stylesheets/theme.css')}}"/>

    <!-- Skin CSS -->
    <link rel="stylesheet" href="{{asset('admin_assets/stylesheets/skins/default.css')}}"/>

    <!-- Theme Custom CSS -->
    <link rel="stylesheet" href="{{asset('admin_assets/stylesheets/theme-custom.css')}}">

    <!-- Head Libs -->
    <script src="{{asset('admin_assets/vendor/modernizr/modernizr.js')}}"></script>

</head>
<body>
<!-- start: page -->
<section class="body-sign">
    <div class="center-sign">
        <a href="{{url('/')}}" class="logo pull-left">
            <img src="{{asset('images/logo.png')}}" height="54" alt="Contento"/><b>CONTENTO</b>
        </a>

        <div class="panel panel-sign">
            <div class="panel-title-sign mt-xl text-right">
                <h2 class="title text-uppercase text-bold m-none"><i class="fa fa-user mr-xs"></i> Sign In</h2>
            </div>
            <div class="panel-body">
                <form role="form" method="POST" action="{{ url('/login') }}">
                    {{ csrf_field() }}
                    <div class="form-group mb-lg">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <label>Username</label>
                        <div class="input-group input-group-icon">
                            <input id="email" type="email" class="form-control input-lg" name="email"
                                   value="{{ old('email') }}">
                            <span class="input-group-addon">
										<span class="icon icon-lg">
											<i class="fa fa-user"></i>
										</span>
									</span>
                        </div>
                    </div>

                    <div class="form-group mb-lg{{ $errors->has('password') ? ' has-error' : '' }}">
                        <div class="clearfix">
                            <label class="pull-left">Password</label>
                            <a href="{{ route('password.request') }}" class="pull-right">Lost Password?</a>
                        </div>
                        <div class="input-group input-group-icon">
                            <input id="password" type="password" class="form-control input-lg" name="password">
                            @if ($errors->has('password'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                            <span class="input-group-addon">
										<span class="icon icon-lg">
											<i class="fa fa-lock"></i>
										</span>
									</span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-8">
                            <div class="checkbox-custom checkbox-default">
                                <label>
                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-4 text-right">
                            <button type="submit" class="btn btn-primary hidden-xs">Sign In</button>
                            <button type="submit" class="btn btn-primary btn-block btn-lg visible-xs mt-lg">Sign In
                            </button>
                        </div>
                    </div>
                    <span class="mt-lg mb-lg line-thru text-center text-uppercase">
								<span>or log-in with</span>
							</span>

                    <div class="mb-xs text-center">
                        <a class="btn btn-facebook mb-md ml-xs mr-xs"><i class="fa fa-facebook-square"> Facebook</i></a>
                        <a class="btn btn-twitter mb-md ml-xs mr-xs"><i class="fa fa-twitter"> Twitter</i></a>
                        <a class="btn btn-gplus mb-md ml-xs mr-xs"><i class="fa fa-google"> Google</i></a>
                    </div>

                    <p class="text-center">Don't have an account yet? <a href="{{url('/register')}}">Sign Up!</a>


                </form>
            </div>
        </div>

        <p class="text-center text-muted mt-md mb-md">&copy; Copyright {{date('Y')}}. All Rights Reserved.</p>
    </div>
</section>
<!-- end: page -->

<!-- Vendor -->
<script src="{{asset('admin_assets/vendor/jquery/jquery.js')}}"></script>
<script src="{{asset('admin_assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js')}}"></script>
<script src="{{asset('admin_assets/vendor/bootstrap/js/bootstrap.js')}}"></script>
<script src="{{asset('admin_assets/vendor/nanoscroller/nanoscroller.js')}}"></script>
<script src="{{asset('admin_assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"></script>
<script src="{{asset('admin_assets/vendor/magnific-popup/magnific-popup.js')}}"></script>
<script src="{{asset('admin_assets/vendor/jquery-placeholder/jquery.placeholder.js')}}"></script>

<!-- Theme Base, Components and Settings -->
<script src="{{asset('admin_assets/javascripts/theme.js')}}"></script>

<!-- Theme Custom -->
<script src="{{asset('admin_assets/javascripts/theme.custom.js')}}"></script>

<!-- Theme Initialization Files -->
<script src="{{asset('admin_assets/javascripts/theme.init.js')}}"></script>

</body>
</html>