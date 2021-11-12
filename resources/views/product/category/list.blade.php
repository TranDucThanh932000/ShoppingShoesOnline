@extends('layouts.master')

@section('title')
	<title>Sản phẩm</title>
@endsection

@section('css')
	<link rel="stylesheet" href="{{asset('home/home.css')}}">
@endsection

@section('js')
	<link href="{{asset('home/home.js')}}">
@endsection

@section('content')
    <section>
		<div class="container">
			<div class="row">
				
                @include('components.sidebar')
				
				
				<div class="col-sm-9 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Sản phẩm</h2>
                        @foreach($products as $product)
						<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
									<div class="productinfo text-center">
										<img src="{{$product->feature_image_path}}" alt="" />
										<h2>{{number_format($product->price)}} VNĐ</h2>
										<p>{{$product->name}}</p>
										<!-- <a href="#" data-url="{{route('addToCart',['id' => $product->id,'size' => 0])}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</a> -->
									</div>
									<div class="product-overlay">
										<a href="{{ route('showProduct',['id' => $product->id ]) }}">
											<div class="overlay-content">
												<h2>{{number_format($product->price)}} VNĐ</h2>
												<p>{{$product->name}}</p>
												<a href="#" data-url="{{route('addToCart',['id' => $product->id, 'size' => 0])}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</a>
											</div>
										</a>
									</div>
								</div>
							</div>
						</div>		
                        @endforeach				
					</div><!--features_items-->
					<div class="text-center">
                        {{$products->links('pagination::bootstrap-4')}}
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection

