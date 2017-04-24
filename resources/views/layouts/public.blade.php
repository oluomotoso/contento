<!DOCTYPE HTML>
<html>
<head>
    <title>The Contento</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no"/>
    <link rel="stylesheet" href="{{asset('front/assets/css/main.css')}}"/>
    <!--[if lte IE 9]>
    <link rel="stylesheet" href="{{asset('front/assets/css/ie9.css')}}"/><![endif]-->
    <noscript>
        <link rel="stylesheet" href="{{asset('front/assets/css/noscript.css')}}"/>
    </noscript>
</head>
<body>

<!-- Wrapper -->
<div id="wrapper">

    <!-- Header -->
@yield('content')

</div>

<!-- BG -->
<div id="bg"></div>

<!-- Scripts -->
<script src="{{asset('front/assets/js/jquery.min.js')}}"></script>
<script src="{{asset('front/assets/js/skel.min.js')}}"></script>
<script src="{{asset('front/assets/js/util.js')}}"></script>
<script src="{{asset('front/assets/js/main.js')}}"></script>

</body>
</html>

