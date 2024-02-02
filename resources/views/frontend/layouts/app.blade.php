<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
    <meta content="ja" http-equiv="Content-Language">
    <meta content="text/css" http-equiv="Content-Style-Type">
    <meta content="text/javascript" http-equiv="Content-Script-Type">
	
	<!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Home | E-Shopper</title>

   

   
    <link href="{{asset('frontend/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/animate.css')}}" rel="stylesheet">
	<link href="{{asset('frontend/css/main.css')}}" rel="stylesheet">
	<link href="{{asset('frontend/css/responsive.css')}}" rel="stylesheet">
	 <link type="text/css" rel="stylesheet" href="{{asset('rate/css/rate.css')}}">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">

    <script src="{{ asset('frontend/js/jquery.js') }}"></script>

</head><!--/head-->

<body>
    @php
         $currentPath = request()->path();
    @endphp

    @include('frontend.layouts.header')
    @if(!str_contains($currentPath, 'account')&&!str_contains($currentPath, 'product')&&!str_contains($currentPath, 'cart')&&!str_contains($currentPath, 'search'))
        @include('frontend.layouts.slide')
    @endif

	<section>
		<div class="container">
			<div class="row">
				
                @if(!str_contains($currentPath, 'account')&&!str_contains($currentPath, 'checkout'))

                <div class="col-sm-3">
                    @include('frontend.layouts.menu-left')
                </div>
                 @endif
				<div class="col-sm-9 padding-right"  id="app">
    				@yield('content')
    			</div>
			</div>
		</div>
	</section>

    @include('frontend.layouts.footer')
	<script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('frontend/js/jquery.scrollUp.min.js') }}"></script>
	<script src="{{ asset('frontend/js/price-range.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.prettyPhoto.js') }}"></script>
    <script src="{{ asset('frontend/js/main.js') }}"></script>
</body>
</html>