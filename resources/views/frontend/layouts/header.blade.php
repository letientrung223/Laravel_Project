<?php 
$cartList = Session::get('cart', []); 
$cartCount = 0;
foreach ($cartList as $item) {
    $cartCount += $item['quantity'];
}
?>
<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href="#"><i class="fa fa-phone"></i> +2 95 01 88 821</a></li>
								<li><a href="#"><i class="fa fa-envelope"></i> info@domain.com</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
								<li><a href="#"><i class="fa fa-dribbble"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header_top-->
		
		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-md-4 clearfix">
						<div class="logo pull-left">
							<a href="index.html"><img src="images/home/logo.png" alt="" /></a>
						</div>
						<div class="btn-group pull-right clearfix">
							<div class="btn-group">
								<button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
									USA
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a href="">Canada</a></li>
									<li><a href="">UK</a></li>
								</ul>
							</div>
							
							<div class="btn-group">
								<button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
									DOLLAR
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a href="">Canadian Dollar</a></li>
									<li><a href="">Pound</a></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-md-8 clearfix">
						<div class="shop-menu clearfix pull-right">
							<ul class="nav navbar-nav">
								@if(auth()->check())
									<li><a href="{{ url('account') }}"><i class="fa fa-user"></i> Account</a></li>
								@else
									<li><a href="#" onclick="showLoginAlert()"><i class="fa fa-user"></i> Account</a></li>	
								@endif
								<li><a href=""><i class="fa fa-star"></i> Wishlist</a></li>
								<li><a href="checkout.html"><i class="fa fa-crosshairs"></i> Checkout</a></li>
										
								<li><a href="{{ url('cart') }}"><i class="fa fa-shopping-cart"></i> Cart</a><p class="nav_total">{{$cartCount}}</p> </li>
								<!-- <li><a href="{{ route('memberLogin') }}"><i class="fa fa-lock"></i> Hello</a></li> -->
								@if(auth()->check())
            						<li><a href="{{ url('member/logout') }}"><i class="fa fa-unlock"></i> Log out</a></li>
        						@else
            						@if(Route::is('memberLogin'))
                					<!-- Trang Login -->
                						<li><a href="{{ url('member/register') }}"><i class="fa fa-lock"></i> Register</a></li>
            						@else
                					<!-- Các trang khác -->
                						<li><a href="{{ url('member/login') }}"><i class="fa fa-lock"></i> Log in</a></li>
            						@endif
        						@endif
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->
	
		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-9">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="{{ url('/homepage') }}" class="active">Home</a></li>
								<li class="dropdown"><a href="#">Shop<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="shop.html">Products</a></li>
										<li><a href="product-details.html">Product Details</a></li> 
										<li><a href="checkout.html">Checkout</a></li> 
										<li><a href="cart.html">Cart</a></li>


                                    </ul>
                                </li> 
								<li class="dropdown"><a href="#">Blog<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="{{ url('/view-blog') }}">Blog List</a></li>
										<li><a href="blog-single.html">Blog Single</a></li>
                                    </ul>
                                </li> 
								<li><a href="404.html">404</a></li>
								<li><a href="contact-us.html">Contact</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="search_box pull-right">
							<form id="searchForm" action="{{ route('search') }}" method="GET">
							    <input type="text" name="query" id="searchInput" placeholder="Tìm kiếm sản phẩm...">
							</form>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->
<!-- Sử dụng CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<style type="text/css">
	.nav_total {
    position: absolute;
    top: 0;
    left: 20px; /* Điều chỉnh khoảng cách từ số đến biểu tượng cart theo ý muốn */
    color: red; /* Màu chữ của số */
    border-radius: 50%; /* Bo góc để tạo hình tròn */
    padding: 1px 6px; /* Kích thước và khoảng cách bên trong số */
    font-size: 12px; /* Kích thước chữ */
}
</style>
<script>
	function searchOnEnter(event) {
            if (event.key === 'Enter') {
                event.preventDefault();
                // alert("data");
                
                var data =$('#Search').val();
                console.log(data+ "ở fun1");
                sendSearchData(data);
            }
    }
    function showLoginAlert() {
        Swal.fire({
            icon: 'info',
            title: 'Yêu cầu đăng nhập',
            text: 'Bạn cần đăng nhập để truy cập tài khoản.',
            confirmButtonText: 'Đóng'
        });
    }
    document.getElementById('searchInput').addEventListener('keyup', function(event) {
    if (event.key === 'Enter') {
        event.preventDefault();
        document.getElementById('searchForm').submit();
    }
});

</script>