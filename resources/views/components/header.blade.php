<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container" style="padding-right:0px;">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href="#"><i class="fa fa-phone"></i>{{getConfigValueFromSetting('phone_contact')}}</a></li>
								<li><a href="#"><i class="fa fa-envelope"></i>{{getConfigValueFromSetting('email_contact')}}</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<li><a href="{{getConfigValueFromSetting('facebook')}}"><i class="fa fa-facebook"></i></a></li>
								<li><a href="{{getConfigValueFromSetting('instagram')}}"><i class="fa fa-instagram"></i></a></li>
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
							<a href="{{route('home.homepage')}}"><img src="/eshopper/images/home/horizontal_on_white_by_logaster.png" alt="" /></a>
						</div>
					</div>
					<div class="col-md-8 clearfix" style="padding-right :0px;">
						<div class="shop-menu clearfix pull-right">
							<ul class="nav navbar-nav">
								<li><a href="{{route('showCart')}}"><i class="fa fa-shopping-cart"></i> Giỏ hàng</a></li>
								@if(session()->has('user'))
									<li><a href="{{route('logout')}}"><i class="fa fa-user"></i> Đăng xuất</a></li>
								@else
									<li><a href="{{route('login')}}"><i class="fa fa-lock"></i> Đăng nhập</a></li>
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

						@include('home.components.main_menu')

					</div>
					<div class="col-sm-3">
						<form action="{{route('searchproduct')}}" method = "get">
								<div class="search_box pull-right">
									<input type="text" style="padding-top:0px;padding-bottom:0px" name="text" placeholder="Tìm kiếm"/>
									<input style="width:35px;margin-left:-45px;padding:0px;height:34.5px" value="OK" type="submit">
								</div>
						</form>
					</div>
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->

