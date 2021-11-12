<div class="features_items">
						<h2 class="title text-center">Sản phẩm đặc trưng</h2>
						@foreach($products as $product)
						<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
										<div class="productinfo text-center">
											<img src="{{$product->feature_image_path}}" alt="" style="height:319.36px"/>
											<h2>{{number_format($product->price)}} VNĐ</h2>
											<p>{{$product->name}}</p>
											<!-- <a href="#" data-url="{{route('addToCart',['id' => $product->id, 'size' => 0])}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</a> -->
										</div>
										<a href="{{ route('showProduct',['id' => $product->id ]) }}">
											<div class="product-overlay">
												<div class="overlay-content">
													<h2>{{number_format($product->price)}} VNĐ</h2>
													<p>{{$product->name}}</p>
													<a href="#" data-url="{{route('addToCart',['id' => $product->id, 'size' => 0])}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</a>
												</div>
											</div>
										</a>
								</div>

							</div>
						</div>
						@endforeach
					</div>