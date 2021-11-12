<div class="container" id="cart-form-lkc" style="position: relative;z-index: 0;padding-right:0px">

        <div class="col-md-12" style="position: absolute;z-index: 2">
            <div style="width: 50%;margin: 0px auto;">
                <div id="form-muangay" style="display: none;padding:5px 10px 40px 10px;background-color: #C06C84;border-radius: 8px;">
                    <form  action="{{route('send-mail-cart')}}" method="post">
                        @csrf
                        <location-selector></location-selector>
                        <input type="text" name="status" value="success" style="display: none;">
                        <textarea id="txtDetail" name="detail" style="border-radius: 5px;border: 2px solid black;" cols="30" rows="10" placeholder="Nhập số nhà và mô tả chi tiết hơn"></textarea>
                        <button onclick="secondMuangay()" id="second-muangay" style="background-color: #ee4d2d;color:white;padding: 8px 15px;margin:10px 0px;border:none;float:right;">Mua ngay</button>
                    </form>
                </div>
            </div>
        </div> 
    @if(session()->has('cart'))
    <div class="col-md-12" style="padding:0px;">
        <div>
                <table class="table update_cart_url">
                    <thead>
                        <tr>
                            <th scope="col">Tên</th>
                            <th scope="col">Giá</th>
                            <th scope="col">Size</th>
                            <th scope="col">SL</th>
                            <th scope="col-2" style="text-align:center;">Ảnh</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    @php 
                        $total = 0;
                    @endphp
                    <tbody>
                        @foreach($carts as $key => $cart)
                            <tr>
                                <td scope="col">{{$cart['name']}}</td> 
                                <td scope="col">{{number_format($cart['price'])}} VNĐ</td>
                                <td scope="col">{{$cart['size']}}</td> 
                                <td scope="col"><input class="quatity" style="width:50px" type="number" value="{{$cart['quantity']}}" min="1"></td>
                                <td scope="col-2" style="text-align:center;"><img style="width:100px; height:100px; object-fit:cover" src="{{$cart['image']}}" ></td>
                                <td scope="col" style="text-align: right;padding-right:0px;">
                                    <div style="margin-bottom:25px"><a href="" data-url="{{route('updateCart')}}" data-id="{{$key}}" class="btn btn-success update-product-cart">Cập nhật</a></div>
                                    <div><a href="" data-url="{{route('deleteProductCart')}}" data-id="{{$key}}" class="btn btn-danger delete-product-cart">Xóa</a></div>
                                </td>
                            </tr>
                            @php 
                                $total += $cart['price'] * $cart['quantity'] 
                            @endphp
                        @endforeach
                    </tbody>    
                </table>
        </div>
            

    </div>
    <div class="col-md-12" style="padding:0px">
        <p style="font-size:20px;float:left;padding:0px;">Tổng tiền: <b>{{number_format($total)}} VNĐ</b></p>
        @if(session()->has('user'))   
        <button id="first-muangay" onclick="formDangky()" style="background-color: #ee4d2d;color:white;padding: 8px 15px;margin-top:-10px;border:none;float:right">Đặt hàng</button>
        @else
        <form action="{{route('loginShowCart')}}" method="get">
            <button id="first-muangay" style="background-color: #ee4d2d;color:white;padding: 8px 15px;margin-top:-10px;border:none;float:right">Đặt hàng</button>
        </form>
        @endif
    </div>
    @else
    <div class="row" style="text-align:center;">
        <p style="font-size:25px"><b>Giỏ hàng không có gì cả!!!</b></p>
    </div>
    @endif        
</div>


