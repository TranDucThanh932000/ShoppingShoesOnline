@extends('layouts.master')

@section('title')
	<title>Trang chủ</title>
@endsection

@section('css')
	<link rel="stylesheet" href="{{asset('home/home.css')}}">
@endsection

@section('js')
	<link src="{{asset('home/home.js')}}">
@endsection

@section('content')

	<section>
		<div class="container">
			<div class="row">
                <div class="col-sm-12 padding-right">

                    <image-show 
                        v-bind:id="{{$product->id}}">
                    </image-show>


                    <div class="col-sm-8 padding-right">
                        <h4>Tên sản phẩm: {{$product->name}}</h4>
                        <h4>Giá: {{number_format($product->price)}} VNĐ</h4>
                        <h4>Mô tả: {{$product->content}}</h4>
                        <h4>Vận chuyển: Miễn phí vận chuyển cho đơn hàng trên 50.000 VNĐ</h4>
                        <h4 style="display: inline-block;margin-top: 0px;">Size: </h4>
                        <select name="size" id="size" style="width: 50px;">
                                @foreach($sizes as $size)
                                    <option value="{{$size->size}}">{{$size->size}}</option>
                                @endforeach
                        </select>
                        <div>
                            <a style="background-color: green;" href="#" data-url="{{route('addToCart',['id' => $product->id, 'size' => 0])}}" class="btn btn-default add-to-cart"><button style="background: none;border:none;color:white"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</button></a>
                        </div>
                        <button id="first-muangay" onclick="firstMuangay()" style="background-color: #ee4d2d;color:white;padding: 8px 15px;margin-top:-10px;border:none;">Mua ngay</button>
                        <div id="form-muangay" style="display: none;">
                            <location-selector></location-selector>
                            <form  action="" method="">
                                @csrf
                                <textarea id="txtDetail" name="detail" style="border-radius: 5px;border: 2px solid black;" cols="30" rows="10" placeholder="Nhập số nhà và mô tả chi tiết hơn"></textarea>
                                <button onclick="secondMuangay()" id="second-muangay" style="background-color: #ee4d2d;color:white;padding: 8px 15px;margin:10px 0px;border:none;float:right;">Mua ngay</button>
                            </form>
                        </div>
                    </div>
                    <feedback-component v-bind:id="{{$product->id}}"></feedback-component>
                </div>	
				
			</div>
		</div>
	</section>
	

@endsection

</html>