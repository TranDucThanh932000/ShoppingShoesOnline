<section id="slider"><!--slider-->
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div id="slider-carousel" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
							<li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
							<li data-target="#slider-carousel" data-slide-to="1"></li>
							<li data-target="#slider-carousel" data-slide-to="2"></li>
						</ol>
						<div class="carousel-inner">
								@foreach($sliders as $key => $slider)
								<div class="item {{$key  == 0 ? 'active':''}}" style="height: 100%;padding-left:0px;">
									<div class="col-sm-12">
										<div style="position: absolute;left:5%;">
											<h1><span>COC</span> Mountain</h1>
											<h2>{{$slider->name}}</h2>
											<p style="color: #547980"><b>{{$slider->description}}</b></p>
											<button type="button" class="btn btn-default get">Get it now</button>
										</div>
										<img src="{{$slider->image_path}}" class="girl img-responsive" style="width: 100%;height: 100%;object-fit: cover;" alt="" />
									</div>
								</div>
								@endforeach
							
						</div>
						
						<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
							<i class="fa fa-angle-left"></i>
						</a>
						<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
							<i class="fa fa-angle-right"></i>
						</a>
					</div>
					
				</div>
			</div>
		</div>
	</section><!--/slider-->