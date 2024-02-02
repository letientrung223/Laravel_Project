
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Sign up | E-Shopper</title>


    <link href="{{asset('frontend/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/animate.css')}}" rel="stylesheet">
	<link href="{{asset('frontend/css/main.css')}}" rel="stylesheet">
	<link href="{{asset('frontend/css/responsive.css')}}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->

<body>
    @include('frontend.layouts.header')
	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
					<div class="signup-form"><!--sign up form-->
						<h2>New User Signup!</h2>
						<form action="#" method="post" enctype="multipart/form-data">
							@csrf
							<input type="text" name="name" placeholder="Full Name"/>
							<input type="email"name="email" placeholder="Email Address"/>
							<input type="password" name="password" placeholder="Password"/>
							<input type="text" name="phone" placeholder="Phone Number"/>
							<input type="text" name="address" placeholder="Address"/>
							<input type="file" name="avatar">
							<label>Choose the country</label>
                            <select name="id_country" class="form-control form-control-line">
                                @foreach ($countries as $country)
                                    <option value='{{$country->id}}'> {{$country->name}} </option>
                                @endforeach
                            </select>
							<button type="submit" class="btn btn-default">Signup</button>
						</form>
					</div><!--/sign up form-->
					@if($errors->any())
       						 	<br><br>
						  
       						 <div class="alert alert-danger alert-dismissible">
            					<ul>
               						 @foreach($errors->all() as $error)
                   					 <li>{{$error}}</li>
                					 @endforeach
            					</ul>
        					 </div>
  						  @endif
				</div>

			</div>
		</div>
	</section>
	<br>

    @include('frontend.layouts.footer')
    <script src="{{ asset('frontend/assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.js') }}"></script>
	<script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('frontend/js/jquery.scrollUp.min.js') }}"></script>
	<script src="{{ asset('frontend/js/price-range.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.prettyPhoto.js') }}"></script>
    <script src="{{ asset('frontend/js/main.js') }}"></script>
</body>
</html>
