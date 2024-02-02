@extends('frontend.layouts.app')

@section('content')

	<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Check out</li>
				</ol>
			</div><!--/breadcrums-->

			<!-- <div class="step-one">
				<h2 class="heading">Step1</h2>
			</div> -->
		<!-- 	<div class="checkout-options">
				<h3>New User</h3>
				<p>Checkout options</p>
				<ul class="nav">
					<li>
						<label><input type="checkbox"> Register Account</label>
					</li>
					<li>
						<label><input type="checkbox"> Guest Checkout</label>
					</li>
					<li>
						<a href=""><i class="fa fa-times"></i>Cancel</a>
					</li>
				</ul>
			</div>
			<!--/checkout-options--> 

			<!-- <div class="register-req">
				<p>Please use Register And Checkout to easily get access to your order history, or use Checkout as Guest</p>
			</div>
			<!--</register-req--> 

			<div class="shopper-informations">
				<div class="row">
						<div class="shopper-info" style="width:100%;">
							 @if(!Auth::check())
							<!-- <p>Shopper Information</p> -->
							 <div class="signup-form">
								<h2>New User Signup!</h2>
								<form action="{{route('memberRegister')}}" method="post" enctype="multipart/form-data">
									@csrf
										<input type="text" name="name" placeholder="Full Name"/>
										<input type="email"name="email" placeholder="Email Address"/>
										<input type="password" name="password" placeholder="Password"/>
										<input type="text" name="phone" placeholder="Phone Number"/>
										<input type="text" name="address" placeholder="Address"/>
										<input type="file" name="avatar" style="padding: 10px;">
		                            <select name="id_country" class="form-control form-control-line">
		                                @foreach ($countries as $country)
		                                    <option value='{{$country->id}}'> {{$country->name}} </option>
		                                @endforeach
		                            </select>
									<button type="submit" class="btn btn-default">Signup</button>
								</form>
							</div><!--/sign up form -->
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
						@else
							<a class="btn btn-primary" href="{{route('sendEmail')}}">Continue</a>
						@endif
						</div>
					<!-- <div class="col-sm-5 clearfix">
						<div class="bill-to">
							<p>Bill To</p>
							<div class="form-one">
								<form>
									<input type="text" placeholder="Company Name">
									<input type="text" placeholder="Email*">
									<input type="text" placeholder="Title">
									<input type="text" placeholder="First Name *">
									<input type="text" placeholder="Middle Name">
									<input type="text" placeholder="Last Name *">
									<input type="text" placeholder="Address 1 *">
									<input type="text" placeholder="Address 2">
								</form>
							</div>
							<div class="form-two">
								<form>
									<input type="text" placeholder="Zip / Postal Code *">
									<select>
										<option>-- Country --</option>
										<option>United States</option>
										<option>Bangladesh</option>
										<option>UK</option>
										<option>India</option>
										<option>Pakistan</option>
										<option>Ucrane</option>
										<option>Canada</option>
										<option>Dubai</option>
									</select>
									<select>
										<option>-- State / Province / Region --</option>
										<option>United States</option>
										<option>Bangladesh</option>
										<option>UK</option>
										<option>India</option>
										<option>Pakistan</option>
										<option>Ucrane</option>
										<option>Canada</option>
										<option>Dubai</option>
									</select>
									<input type="password" placeholder="Confirm password">
									<input type="text" placeholder="Phone *">
									<input type="text" placeholder="Mobile Phone">
									<input type="text" placeholder="Fax">
								</form>
							</div>
						</div>
					</div> -->
					<!-- <div class="col-sm-4">
						<div class="order-message">
							<p>Shipping Order</p>
							<textarea name="message"  placeholder="Notes about your order, Special Notes for Delivery" rows="16"></textarea>
							<label><input type="checkbox"> Shipping to bill address</label>
						</div>	
					</div> -->					
				</div>
			</div>
			<div class="review-payment">
				<h2>Review & Payment</h2>
			</div>

			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Item</td>
							<td class="description"></td>
							<td class="price">Price</td>
							<td class="quantity">Quantity</td>
							<td class="total">Total</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
						@foreach ($cartList as $cart)
							
								<tr> 
									<td class="cart_product">
										<a href=""><img class = "img_product" src="{{ asset('upload/product/2' . $cart['image']) }}" alt=""></a>
									</td>
									<td class="cart_description">
										<h4><a href="">{{$cart['name']}}</a></h4>
										<p class="idProduct" id ="{{$cart['id_product']}}"></p>										
									</td>
									<td class="cart_price">
										<p>{{$cart['price']}}</p>
									</td>
									<td class="cart_quantity">
										<div class="cart_quantity_button">
											<a class="cart_quantity_up" > + </a>
											<input class="cart_quantity_input" type="text" name="quantity" value="{{$cart['quantity']}}" autocomplete="off" size="2">
											<a class="cart_quantity_down" > - </a>
										</div>
									</td>

									<!-- <td class="cart_sale"> -->
										<!-- <p class="sale">Sale : {{$cart['sale']}} %</p> -->
									<!-- </td> -->

									<td class="cart_total">
										<p class="cart_total_price"> {{$cart['total']}}</p>
									</td>
									<td class="cart_delete">
										<a class="cart_quantity_delete" ><i class="fa fa-times"></i></a>
									</td>
								</tr>
								@endforeach
						<tr>
							<td colspan="4">&nbsp;</td>
							<td colspan="2">
								<table class="table table-condensed total-result">
									<tr>
										<td>Cart Sub Total</td>
										<td>$59</td>
									</tr>
									<tr>
										<td>Exo Tax</td>
										<td>$2</td>
									</tr>
									<tr class="shipping-cost">
										<td>Shipping Cost</td>
										<td>Free</td>										
									</tr>
									<tr>
										<td>Total</td>
										<td>$<span id="totalAll">{{$totalAll}}</span></td>
									</tr>
								</table>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="payment-options">
					<span>
						<label><input type="checkbox"> Direct Bank Transfer</label>
					</span>
					<span>
						<label><input type="checkbox"> Check Payment</label>
					</span>
					<span>
						<label><input type="checkbox"> Paypal</label>
					</span>
				</div>
		</div>
	</section> <!--/#cart_items-->
	<style type="text/css">
    .signup-form {
        text-align: center;
    }
    .shopper-info {
        text-align: center;
    }
    .signup-form form {
        display: inline-block;
        text-align: left;
    }

    .signup-form button {
       margin: 10px auto; /* Khoảng cách giữa select và button */
    }
     .shopper-info a  {
       margin: 10px auto; /* Khoảng cách giữa select và button */
    }
</style>
	
@endsection
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

		<script>
			
			$(document).ready(function() {
				$.ajaxSetup({
           			headers: {
                		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            		}
        	});
				function handleCart(idProduct, cart, isThis) {
					$.ajax({
						url: '{{ url("cart/") }}',
						type: 'POST',
						data: {
							idProduct: idProduct,
							cart: cart
					},
						dataType: 'json',
							success: (res) => {
							if (res.reload) {
								$(isThis).closest('tr').remove();
								$('span#totalAll').text(res.totalAll);
								$('p.nav_total').text(res.cartCount);
							} else {
								console.log(res.qly + "&&" + res.total)
								$(isThis).closest('.cart_quantity').find('input.cart_quantity_input').val(res.qty);
								$('span#totalAll').text(res.totalAll);
								$(isThis).closest('tr').find('p.cart_total_price').text('$' + res.total);
								$('p.nav_total').text(res.cartCount);
								
							}
							}
					})

				}
				
				$('.cart_quantity_up').click(function() {

					var getID = $(this).closest('tr').find('p.idProduct').attr('id');
					// alert("hello" + getID );
					
					handleCart(getID, 1, this);
					// console.log(getID);

				})

				$('.cart_quantity_down').click(function() {

					var getID = $(this).closest('tr').find('p.idProduct').attr('id');
					// alert("hello" + getID );
					
					handleCart(getID, 2, this);
				})
				// DELETE BUTTTON
				$(".cart_quantity_delete").click(function() {
					var getID = $(this).closest('tr').find('p.idProduct').attr('id');
					$(this).closest('tr').remove();
					handleCart(getID, 3, this);

				})
			})
		</script>
