@extends('layouts.master')

@section('title')
	<title>Giỏ hàng</title>
@endsection

@section('css')
	<link rel="stylesheet" href="{{asset('home/home.css')}}">
@endsection

@section('js')
	<link href="{{asset('home/home.js')}}">
@endsection

@section('content')
<div class="cart_wrapper">
@include('product.components.cart_component')
</div>
@endsection



