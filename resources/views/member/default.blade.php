<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>The Contento</title>
    <meta name="description"
          content="Contento is a content provision solution. The application is developed to make contents available to web masters via a range if sources."/>
    <meta property="og:title" content="The Contento"/>
    <meta property="og:type" content="website"/>
    <meta property="og:description"
          content="Contento is a content provision solution. The application is developed to make contents available to web masters via a range if sources."/>
    <meta property="og:image" content="{{asset('logo.png')}}"/>
    <meta property="og:site_name" content="The Contento"/>
    <meta property="fb:app_id" content="750981271736320"/>
    <meta property="og:locale" content="en_US"/>
    <meta name="theme-color" content="#FF4444">
    <meta name="keywords"
          content="'contents', 'content', 'contento', 'aggregator', 'blog', 'automated content provider', 'fetch contents automatically', 'femtosh','wordpress contents automatic'"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@weare_femtosh">
    <meta name="twitter:creator" content="@weare_femtosh">
    <meta name="twitter:title" content="The Contento">
    <meta name="twitter:description"
          content="Contento is a content provision solution. The application is developed to make contents available to web masters via a range if sources.">
    <meta name="twitter:image" content="{{asset('images/logo.png')}}">
    <link rel="apple-touch-icon" href="{{asset('/images/favicon.ico')}}">
    <link rel="shortcut icon" href="{{asset('/images/favicon.ico')}}">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{asset('member/global/css/bootstrap.min3f0d.css?v2.2.0')}}">
    <link rel="stylesheet" href="{{asset('member/global/css/bootstrap-extend.min3f0d.css?v2.2.0')}}">
    <link rel="stylesheet" href="{{asset('member/topbar/assets/css/site.min3f0d.css?v2.2.0')}}">
    <!-- Plugins -->
    <link rel="stylesheet" href="{{asset('member/global/vendor/animsition/animsition.min3f0d.css?v2.2.0')}}">
    <link rel="stylesheet" href="{{asset('member/global/vendor/asscrollable/asScrollable.min3f0d.css?v2.2.0')}}">
    <link rel="stylesheet" href="{{asset('member/global/vendor/switchery/switchery.min3f0d.css?v2.2.0')}}">
    <link rel="stylesheet" href="{{asset('member/global/vendor/intro-js/introjs.min3f0d.css?v2.2.0')}}">
    <link rel="stylesheet" href="{{asset('member/global/vendor/slidepanel/slidePanel.min3f0d.css?v2.2.0')}}">
    <link rel="stylesheet" href="{{asset('member/global/vendor/flag-icon-css/flag-icon.min3f0d.css?v2.2.0')}}">

    <!-- Plugins For This Page -->
@stack('styles')

<!-- Fonts -->
    <link rel="stylesheet" href="{{asset('member/global/fonts/web-icons/web-icons.min3f0d.css?v2.2.0')}}">
    <link rel="stylesheet" href="{{asset('member/global/fonts/brand-icons/brand-icons.min3f0d.css?v2.2.0')}}">
    <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'>


    <!--[if lt IE 9]>
    <script src="{{asset('member/global/vendor/html5shiv/html5shiv.min.js')}}"></script>
    <![endif]-->

    <!--[if lt IE 10]>
    <script src="{{asset('member/global/vendor/media-match/media.match.min.js')}}')}}"></script>
    <script src="{{asset('member/global/vendor/respond/respond.min.js')}}"></script>
    <![endif]-->

    <!-- Scripts -->
    <script src="{{asset('member/global/vendor/modernizr/modernizr.min.js')}}"></script>
    <script src="{{asset('member/global/vendor/breakpoints/breakpoints.min.js')}}"></script>
    <script>
        Breakpoints();
    </script>
    <!-- Google Tag Manager -->
    <script>(function (w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(), event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                    j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                    'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-TDZLNTR');</script>
    <!-- End Google Tag Manager -->
</head>
<body class="dashboard site-navbar-small">
<!-- Google Tag Manager (noscript) -->
<noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TDZLNTR"
            height="0" width="0" style="display:none;visibility:hidden"></iframe>
</noscript>
<!-- End Google Tag Manager (noscript) -->
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade
    your browser</a> to improve your experience.</p>
<![endif]-->

<nav class="site-navbar navbar navbar-default navbar-fixed-top navbar-mega navbar-inverse"
     role="navigation">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle hamburger hamburger-close navbar-toggle-left hided"
                data-toggle="menubar">
            <span class="sr-only">Toggle navigation</span>
            <span class="hamburger-bar"></span>
        </button>
        <button type="button" class="navbar-toggle collapsed" data-target="#site-navbar-collapse"
                data-toggle="collapse">
            <i class="icon wb-more-horizontal" aria-hidden="true"></i>
        </button>
        <a class="navbar-brand navbar-brand-center" href="{{url('/')}}">
            <img class="navbar-brand-logo navbar-brand-logo-normal"
                 src="{{asset('/images/logo-white.png')}}"
                 title="Contento">
            <img class="navbar-brand-logo navbar-brand-logo-special"
                 src="{{asset('/images/logo.png')}}"
                 title="Contento">
            <span class="navbar-brand-text"> Contento</span>
        </a>
        <button type="button" class="navbar-toggle collapsed" data-target="#site-navbar-search"
                data-toggle="collapse">
            <span class="sr-only">Toggle Search</span>
            <i class="icon wb-search" aria-hidden="true"></i>
        </button>
    </div>

    <div class="navbar-container container-fluid">
        <!-- Navbar Collapse -->
        <div class="collapse navbar-collapse navbar-collapse-toolbar" id="site-navbar-collapse">
            <!-- Navbar Toolbar -->
            <ul class="nav navbar-toolbar">
                <li class="hidden-float" id="toggleMenubar">
                    <a data-toggle="menubar" href="#" role="button">
                        <i class="icon hamburger hamburger-arrow-left">
                            <span class="sr-only">Toggle menubar</span>
                            <span class="hamburger-bar"></span>
                        </i>
                    </a>
                </li>
                <li class="hidden-xs" id="toggleFullscreen">
                    <a class="icon icon-fullscreen" data-toggle="fullscreen" href="#" role="button">
                        <span class="sr-only">Toggle fullscreen</span>
                    </a>
                </li>
                <li class="hidden-float">
                    <a class="icon wb-search" data-toggle="collapse" href="#" data-target="#site-navbar-search"
                       role="button">
                        <span class="sr-only">Toggle Search</span>
                    </a>
                </li>
            </ul>
            <!-- End Navbar Toolbar -->

            <!-- Navbar Toolbar Right -->
            <ul class="nav navbar-toolbar navbar-right navbar-toolbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li role="presentation">
                            <a href="{{url('/user/profile')}}" role="menuitem"><i class="icon wb-user"
                                                                                  aria-hidden="true"></i>
                                Profile</a>
                        </li>
                        @if(Auth::user()->user_role_id ==5)
                            <li role="presentation">
                                <a href="{{url('/admin/dashboard')}}" role="menuitem"><i class="icon wb-user"
                                                                                         aria-hidden="true"></i>
                                    Admin Dashboard</a>
                            </li>
                            <li role="presentation">
                                <a href="{{url('/user/dashboard')}}" role="menuitem"><i class="icon wb-user"
                                                                                        aria-hidden="true"></i>
                                    User Dashboard</a>
                            </li>
                        @endif
                        <li role="presentation">
                            <a href="{{url('/user/settings')}}" role="menuitem"><i class="icon wb-settings"
                                                                                   aria-hidden="true"></i> Settings</a>
                        </li>


                        <li class="divider" role="presentation"></li>
                        <li role="presentation">
                            <a href="#" role="menuitem"><i class="icon wb-settings"
                                                           aria-hidden="true"></i> Change Password</a>
                        </li>
                        <li class="divider" role="presentation"></li>
                        <li role="presentation">
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>

                    </ul>
                </li>
                <li class="dropdown">
                    <a data-toggle="dropdown" id="notify" title="Notifications" aria-expanded="false"
                       data-animation="scale-up" role="button">
                        <i class="icon wb-bell" aria-hidden="true"></i>
                        <span class="badge badge-danger up">{{count(Auth::user()->unreadnotifications)}}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right dropdown-menu-media" role="menu">
                        <li class="dropdown-menu-header" role="presentation">
                            <h5>NOTIFICATIONS</h5>
                            <span class="label label-round label-danger">New {{count(Auth::user()->unreadnotifications)}}</span>
                        </li>

                        <li class="list-group" role="presentation">
                            <div data-role="container">
                                <div data-role="content">
                                    @if(count(Auth::user()->unreadnotifications) <6)
                                        @foreach(Auth::user()->unreadnotifications as $notification)
                                            <a class="list-group-item" role="menuitem">
                                                <div class="media">
                                                    <div class="media-left padding-right-10">
                                                        <i class="icon wb-order bg-red-600 white icon-circle"
                                                           aria-hidden="true"></i>
                                                    </div>
                                                    <div class="media-body">
                                                        <h6 class="media-heading">{{$notification->data['notification_message']}}</h6>
                                                        <time class="media-meta"
                                                              datetime="{{$notification->created_at}}">{{$notification->created_at->diffForHumans()}}
                                                        </time>
                                                    </div>
                                                </div>
                                            </a>
                                        @endforeach
                                    @else
                                        @for ($i=0;$i<=5;$i++)

                                            <a class="list-group-item" role="menuitem">
                                                <div class="media">
                                                    <div class="media-left padding-right-10">
                                                        <i class="icon wb-order bg-red-600 white icon-circle"
                                                           aria-hidden="true"></i>
                                                    </div>
                                                    <div class="media-body">
                                                        <h6 class="media-heading">{{Auth::user()->unreadnotifications[$i]->data['notification_message']}}</h6>
                                                        <time class="media-meta"
                                                              datetime="{{Auth::user()->unreadnotifications[$i]->created_at}}">{{Auth::user()->unreadnotifications[$i]->created_at->diffForHumans()}}
                                                        </time>
                                                    </div>
                                                </div>
                                            </a>
                                        @endfor
                                    @endif

                                </div>
                            </div>
                        </li>
                        <li class="dropdown-menu-footer" role="presentation">
                            <a class="dropdown-menu-footer-btn" href="javascript:void(0)" role="button">
                                <i class="icon wb-settings" aria-hidden="true"></i>
                            </a>
                            <a href="javascript:void(0)" role="menuitem">
                                All notifications
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- End Navbar Toolbar Right -->
        </div>
        <!-- End Navbar Collapse -->

        <!-- Site Navbar Seach -->
        <div class="collapse navbar-search-overlap" id="site-navbar-search">
            <form role="search">
                <div class="form-group">
                    <div class="input-search">
                        <i class="input-search-icon wb-search" aria-hidden="true"></i>
                        <input type="text" class="form-control" name="site-search" placeholder="Search...">
                        <button type="button" class="input-search-close icon wb-close" data-target="#site-navbar-search"
                                data-toggle="collapse" aria-label="Close"></button>
                    </div>
                </div>
            </form>
        </div>
        <!-- End Site Navbar Seach -->
    </div>
</nav>
@yield('topbar')

@yield('content')
<!-- Page -->
<!-- End Page -->

<!-- Add Item Dialog -->
<!-- Footer -->
<footer class="site-footer">
    <div class="site-footer-legal">© {{date('Y')}} <a href="http://www.contento.com.ng">The Contento</a>
    </div>
    <div class="site-footer-right">
        With <i class="red-600 wb wb-heart"></i> by <a href="http://www.femtosh.com">Femtosh Global Solutions.</a>
    </div>
</footer>
<!-- Core  -->
<script src="{{asset('member/global/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('member/global/vendor/bootstrap/bootstrap.min.js')}}"></script>
<script src="{{asset('member/global/vendor/animsition/animsition.min.js')}}"></script>
<script src="{{asset('member/global/vendor/asscroll/jquery-asScroll.min.js')}}"></script>
<script src="{{asset('member/global/vendor/mousewheel/jquery.mousewheel.min.js')}}"></script>
<script src="{{asset('member/global/vendor/asscrollable/jquery.asScrollable.all.min.js')}}"></script>
<script src="{{asset('member/global/vendor/ashoverscroll/jquery-asHoverScroll.min.js')}}"></script>

<!-- Plugins -->
<script src="{{asset('member/global/vendor/switchery/switchery.min.js')}}"></script>
<script src="{{asset('member/global/vendor/intro-js/intro.min.js')}}"></script>
<script src="{{asset('member/global/vendor/screenfull/screenfull.min.js')}}"></script>
<script src="{{asset('member/global/vendor/slidepanel/jquery-slidePanel.min.js')}}"></script>

@stack('scripts')
<!-- Scripts -->
<script src="{{asset('member/global/js/core.min.js')}}"></script>
<script src="{{asset('member/topbar/assets/js/site.min.js')}}"></script>

<script src="{{asset('member/topbar/assets/js/sections/menu.min.js')}}"></script>
<script src="{{asset('member/topbar/assets/js/sections/menubar.min.js')}}"></script>
<script src="{{asset('member/topbar/assets/js/sections/sidebar.min.js')}}"></script>

<script src="{{asset('member/global/js/configs/config-colors.min.js')}}"></script>
<script src="{{asset('member/topbar/assets/js/configs/config-tour.min.js')}}"></script>

<script src="{{asset('member/global/js/components/asscrollable.min.js')}}"></script>
<script src="{{asset('member/global/js/components/animsition.min.js')}}"></script>
<script src="{{asset('member/global/js/components/slidepanel.min.js')}}"></script>
<script src="{{asset('member/global/js/components/switchery.min.js')}}"></script>

<script src="{{asset('member/global/js/components/matchheight.min.js')}}"></script>
<script src="{{asset('member/global/js/components/aspieprogress.min.js')}}"></script>
<script src="{{asset('member/global/js/components/bootstrap-datepicker.min.js')}}"></script>


<script src="{{asset('member/topbar/assets/examples/js/dashboard/team.min.js')}}"></script>
<script>
    $('#notify').on('click', function (e) {
        $.ajax({
            type: 'POST',
            url: "{{url('/user/notifications')}}",
            data: {"read": "yes", "_token": "{{csrf_token()}}"},
            success: function (data) {

            },
            error: function (exception) {
            }
        });
        e.preventDefault();
    });
</script>
</body>
</html>