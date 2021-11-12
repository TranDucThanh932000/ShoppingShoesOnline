<div class="recommended_items">
						<h2 class="title text-center">Sản phẩm được đề xuất</h2>
						
						<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
									
                                @foreach($productRecommend as $key => $recommend)
                                @if($key % 3 == 0)
                                <div class="item {{$key == 0 ? 'active':''}}">
                                @endif
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<a href="{{ route('showProduct',['id' => $recommend->id ]) }}">
												<div class="single-products">
													<div class="productinfo text-center">
														<img src="{{$recommend->feature_image_path}}" alt="" style="height: 255px;"/>
														<h2>{{number_format($recommend->price)}}</h2>
														<p>{{$recommend->name}}</p>
														<a href="#" data-url="{{route('addToCart',['id' => $recommend->id, 'size' => 0])}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</a>
													</div>
												</div>
											</a>
										</div>
									</div>
                                @if($key % 3 == 2)
                                </div>
                                @endif
                                @endforeach
							</div>
							 <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
								<i class="fa fa-angle-left"></i>
							  </a>
							  <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
								<i class="fa fa-angle-right"></i>
							  </a>			
						</div>
					</div>