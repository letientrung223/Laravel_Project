@extends('frontend.layouts.app')

@section('content')
<!-- {{$product}} -->
	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
						<h2>Account</h2>
						<div class="panel-group category-products" id="accordian"><!--category-productsr-->


							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="{{route('account')}}">My account</a></h4>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="{{route('showMyProduct')}}">My product</a></h4>
								</div>
							</div>

						</div>
					</div>
				</div>
				<div class="col-sm-9">
					@if ($errors->any())
    					<div class="alert alert-danger">
        					<ul>
            					@foreach ($errors->all() as $error)
                					<li>{{ $error }}</li>
            					@endforeach
        					</ul>
    					</div>
					@endif
					<div class="blog-post-area">
						<h2 class="title text-center">Edit Product</h2>
						<div class="signup-form">
						<form method="post" enctype="multipart/form-data">
							@csrf
							<input type="text" name="name" value="{{$product['name']}}" ><br>
							<input type="text" name="price" value="{{$product['price']}}"><br>

							<select name="id_category" class="form-control form-control-line" >
								<option value="">Vui lòng chọn thể loại</option>
                                @foreach ($categories as $category)

                                <option value='{{$category["id"]}}' {{ $category["id"] == $product["id_category"] ? 'selected' : '' }} > {{$category['category_name']}}  </option>
                                @endforeach
                            </select>
                            <select name="brand_name" class="form-control form-control-line">
								<option value="">Vui lòng chọn nhãn hàng</option>

                                @foreach ($brands as $brand)
                                    <!-- <option value='{{$brand->id}}'> {{$brand->brand_name}} </option> -->
                                    <option value='{{$brand->id}}' {{ $brand->id == $product['brand_name'] ? 'selected' : '' }} > {{$brand->brand_name}}  </option>
                                @endforeach
                            </select>

                            <select name="status" id="id_sale" class="form-control form-control-line">
								<option value="0">New</option>
								<option value="1">Sale</option>
                            </select>
                            <div id="salePercentageContainer" style="display: none;">
    							<label for="sale_percentage">Phần trăm Sale:</label>
    							<input type="text" name="sale" style="width: 40%;" id="sale_percentage" class="form-control">
							</div>
							<input type="text" name="company" value="{{$product['company']}}"><br>
							<input type="file" name="images[]" multiple><br>
							@if (!empty($product->images))
							<div class="image-container">
        						@foreach ($product->images as $index => $image)
            						<div class="image-checkbox-container">
                						<img src="{{ asset('upload/product/' . $image) }}" alt="hehe" width="70" height="70">
                						<input type="checkbox" name="selected_images[]" value="{{ $image }}">
            						</div>
        						@endforeach
        					</div>
   							@endif
							<textarea name="detail" id="detail" name= "detail" rows="5" class="form-control" value="{{$product['detail']}}"></textarea>
							<input type="submit" class="btn btn-default" name='updateProduct' 
								value ="UPDATE PRODUCT" style="color:white; background-color: orange;">
						</form>
						
					</div>
						
					</div>
				</div>
			</div>
		</div>
		<br>

	</section>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function () {
            $('#id_sale').change(function () {
                console.log($(this).val());
            	if ($(this).val() == 1) {
                    $('#salePercentageContainer').show();
                } else {
                    $('#salePercentageContainer').hide();
                }
            });
        });
</script>
<style>
	  .image-container {
        display: flex;
        justify-content: space-around; /* Các phần tử bên trong sẽ nằm cách đều nhau */
    }
    .image-checkbox-container {
        display: inline-block;
        margin-right: 10px;
    }

    .image-checkbox-container img {
        width: 70px;
        height: 70px;
    }
</style>


@endsection