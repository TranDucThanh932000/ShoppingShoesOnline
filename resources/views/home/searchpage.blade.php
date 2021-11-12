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
					@include('home.components.search_product')
					<!--features_items-->
					
				</div>
			</div>
		</div>
	</section>
	

@endsection

</html>