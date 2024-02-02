@extends('frontend.layouts.app')

@section('content')
		<section id="cart_items">
			<div class="container">
				<div class="breadcrumbs">
					<ol class="breadcrumb">
						<li><a href="#">Home</a></li>
						<li class="active">Shopping Cart</li>
					</ol>
				</div>
				<div class="table-responsive cart_info" style="width: 90%;">
					<table class="table table-condensed" >
						<thead>
							<tr class="cart_menu">
								<td class="image">Item</td>
								<td class="description">Name</td>
								<td class="price">Price</td>
								<td class="quantity">Quantity</td>

								<!-- <td class="sale">Sale</td> -->

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
						</tbody>
					</table>
				</div>
			</div>
		</section> <!--/#cart_items-->

		<section id="do_action" >
			<div class="container" style="width: 90%;">
				<div class="heading">
					<h3>What would you like to do next?</h3>
					<p>Choose if you have a discount code or reward points you want to use or would like to estimate your
						delivery cost.</p>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<div class="chose_area">
							<ul class="user_option">
								<li>
									<input type="checkbox">
									<label>Use Coupon Code</label>
								</li>
								<li>
									<input type="checkbox">
									<label>Use Gift Voucher</label>
								</li>
								<li>
									<input type="checkbox">
									<label>Estimate Shipping & Taxes</label>
								</li>
							</ul>
							<ul class="user_info">
								<li class="single_field">
									<label>Country:</label>
									<select>
										<option>United States</option>
										<option>Bangladesh</option>
										<option>UK</option>
										<option>India</option>
										<option>Pakistan</option>
										<option>Ucrane</option>
										<option>Canada</option>
										<option>Dubai</option>
									</select>

								</li>
								<li class="single_field">
									<label>Region / State:</label>
									<select>
										<option>Select</option>
										<option>Dhaka</option>
										<option>London</option>
										<option>Dillih</option>
										<option>Lahore</option>
										<option>Alaska</option>
										<option>Canada</option>
										<option>Dubai</option>
									</select>

								</li>
								<li class="single_field zip-field">
									<label>Zip Code:</label>
									<input type="text">
								</li>
							</ul>
							<a class="btn btn-default update" href="">Get Quotes</a>
							<a class="btn btn-default check_out" href="">Continue</a>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="total_area">
							<ul>
								<li>Cart Sub Total <span ></span></li>
								<li>Eco Tax <span>$2</span></li>
								<li>Shipping Cost <span>Free</span></li>
								<li>Total <span id="totalAll">{{$totalAll}}</span></li>
							</ul>
							<a class="btn btn-default update" href="">Update</a>
							<a class="btn btn-default check_out" href="{{route('cartCheckout')}}">Check Out</a>
						</div>
					</div>
				</div>
			</div>
		</section><!--/#do_action-->
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
