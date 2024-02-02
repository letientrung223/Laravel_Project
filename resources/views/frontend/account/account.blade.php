@extends('frontend.layouts.app')

@section('content')
	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
						<h2>Account</h2>
						<div class="panel-group category-products" id="accordian"><!--category-productsr-->


							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="{{route('account')}}">account</a></h4>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="{{route('showMyProduct')}}">My product</a></h4>
								</div>
							</div>

						</div><!--/category-products-->


					</div>
				</div>
				<div class="col-sm-9">
					<div class="blog-post-area">
						<h2 class="title text-center">Update user</h2>
						<div class="signup-form"><!--sign up form-->
							<h2>Cập nhật thông tin cá nhân</h2>

							<form method="post" 
								action="{{ url('/account/update/'.auth()->user()->id) }}" 
								enctype="multipart/form-data">
								@csrf
                                @method('post')

								<input disabled type="email" name="email" placeholder="email" value="{{auth()->user()->email}}" />
								<input type="text" name="name" placeholder="name" value="{{auth()->user()->name}}" />
								<input type="password" name="password" placeholder="password" value="" />
								<input type="text" name="phone" placeholder="phone number" value="{{auth()->user()->phone}}" />
								<input type="text" name="address" placeholder="address" value="{{auth()->user()->address}}" />
								<input type="file" name="avatar" placeholder="avatar" value="" />
								<label>Choose the country</label>
                            	<select name="id_country" class="form-control form-control-line">
                                @foreach ($countries as $country)
                                   <option value='{{$country->id}}' {{ $country->id == (auth()->user()->id_country) ? 'selected' : '' }} > {{$country->name}} </option>
                                @endforeach
                            	</select>
								<button type="submit" name="btn-update" class="btn btn-default">Update</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>



@endsection