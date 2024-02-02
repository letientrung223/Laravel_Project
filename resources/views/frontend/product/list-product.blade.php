@extends('frontend.layouts.app')

@section('content')
<!-- {{$products}} -->
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
						<h2 class="title text-center">List Product</h2>
						<div class="table-responsive cart_info">
						<table class="table table-condensed">
							<thead>
								<tr class="cart_menu">
									<td class="id">ID</td>
									<td class="name">Name</td>
									<td class="image">Image</td>
									<td class="price">Price</td>
									<td class="total">Action</td>
									<td></td>
								</tr>
							</thead>
							<tbody>

        						@foreach ($products as $product)
								
								<tr>
									<td class="id_product">
										<a href="">{{ $product->id }}</a>
									</td>

									<td class="name_product">
										<h4><a href="">{{ $product->name }}</a></h4>
									</td>

									<td class="image_product">
										<p><img src="{{ asset('upload/product/' . $product->images[0]) }}" alt="hehe" width="70" height="70"></p>
									</td>

									<td class="price_product">
										<p>{{ $product->price }}</p>
									</td>

									<td class="action_product">
										<a class="cart_quantity_edit" href="{{ route('editProduct', ['id' => $product->id]) }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></i> Edit   </a>
										<a class="cart_quantity_delete" href="{{ route('deleteProduct', ['id' => $product->id]) }}"><i class="fa fa-times"></i> Delete</a>
									</td>
								</tr>
							
        						@endforeach
								
							
							</tbody>
						</table>
						<a href="{{ route('addProduct') }}">
							<input type="button" class="btn btn-default" value ="ADD PRODUCT" style="color:white; background-color: orange;">
						</a>
					</div>
						
					</div>
				</div>
			</div>
		</div>
		<br>

	</section>



@endsection