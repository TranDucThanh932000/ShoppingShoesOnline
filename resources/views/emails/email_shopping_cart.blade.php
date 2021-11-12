<!DOCTYPE html>
<html>

<head>
    <title>Giỏ hàng</title>
</head>

<body>
    <p>Chào <b>{{$name}}!</b></p>
    <p>Chúng tôi đã nhận được đơn hàng của bạn, bao gồm: </p>

    <table class="table update_cart_url">
        <thead>
            <tr>
                <th scope="col-2">Tên</th>
                <th scope="col-2">Giá</th>
                <th scope="col">Size</th>
                <th scope="col">Số lượng</th>
                <th scope="col-2" style="text-align:center;">Ảnh</th>
            </tr>
        </thead>
        @php
        $total = 0;
        @endphp
        <tbody>
            @foreach($carts as $key => $cart)

            <tr>
                <td scope="col-2">{{$cart['name']}}</td>
                <td scope="col-2">{{number_format($cart['price'])}} VNĐ</td>
                <td style="text-align:center;" scope="col">{{$cart['size']}}</td>
                <td style="text-align:center;" scope="col">{{$cart['quantity']}}</td>
                <td scope="col-2" style="text-align:center;"><img style="width:100px; height:100px; object-fit:cover" src="{{$cart['image']}}"></td>
            </tr>
            @php
            $total += $cart['price'] * $cart['quantity']
            @endphp
            @endforeach
        </tbody>
    </table>

    <br>
    <p><b>Cùng với địa chỉ:</b></p>
    <p>
       {{$address['ward_id']}}, {{$address['district_id']}}, {{$address['province_id']}}
    </p>
    <p>
        Chi tiết: {{$address['detail']}}
    </p>
</body>

</html>