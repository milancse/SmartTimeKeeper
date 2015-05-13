<meta charset="UTF-8">
<title>SmartTimeKeeper| @yield('page_title')</title>
<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
<meta name="_token" content="{{ csrf_token() }}" />

<link href="{{ URL::asset('bootstrap-3.3.4/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{ URL::asset('css/font-awesome-4.3.0/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
<!-- Ionicons -->
<link rel="stylesheet" href="{{ URL::asset('css/ionicons-2.0.1/css/ionicons.min.css') }}" rel="stylesheet" type="text/css" />



@yield('custom_style')

<!-- Theme style -->
<link rel="stylesheet" href="{{ URL::asset('css/AdminLTE.css') }}" rel="stylesheet" type="text/css" />

<link rel="stylesheet" href="{{ URL::asset('css/custom_style.css') }}" rel="stylesheet" type="text/css" />

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
<![endif]-->