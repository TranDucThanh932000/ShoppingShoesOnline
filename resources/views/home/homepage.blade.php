@extends('layouts.master')

@section('title')
	<title>Trang chủ</title>
@endsection

@section('css')
	<link rel="stylesheet" href="{{asset('home/home.css')}}">
@endsection

@section('js')
	<link href="{{asset('home/home.js')}}">
@endsection

@section('content')
	
	@include('components.slider')

	<section>
		<div class="container">
			<div class="row">
				@include('components/sidebar')
				
				<div class="col-sm-9 padding-right">
					
					<!--features_items-->
					@include('home.components.feature_product')
					<!--features_items-->

					<!--category-tab-->
					@include('home.components.category_tab')
					<!--/category-tab-->

					<!--recommended_items-->
					@include('home.components.recommend_product')
					<!--/recommended_items-->
					
				</div>
			</div>
		</div>
	</section>
	

@endsection

</html>