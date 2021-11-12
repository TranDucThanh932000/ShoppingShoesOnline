<!-- Stored in resources/views/layouts/app.blade.php -->

<html>
    <head>
        

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        @yield('title')
        <!--[if lt IE 9]>
        <script src="/eshopper/js/html5shiv.js"></script>
        <script src="/eshopper/js/respond.min.js"></script>
        <![endif]-->       
        <link href="{{asset('eshopper/css/bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{asset('eshopper/css/font-awesome.min.css')}}" rel="stylesheet">
        <link href="{{asset('eshopper/css/prettyPhoto.css')}}" rel="stylesheet">
        <link href="{{asset('eshopper/css/price-range.css')}}" rel="stylesheet">
        <link href="{{asset('eshopper/css/animate.css')}}" rel="stylesheet">
        <link href="{{asset('eshopper/css/main.css')}}" rel="stylesheet">
        <link rel="shortcut icon" href="/eshopper/images/ico/favicon.ico">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{asset('eshopper/images/ico/apple-touch-icon-144-precomposed.png')}}">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{asset('eshopper/images/ico/apple-touch-icon-114-precomposed.png')}}">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{asset('eshopper/images/ico/apple-touch-icon-72-precomposed.png')}}">
        <link rel="apple-touch-icon-precomposed" href="{{asset('eshopper/images/ico/apple-touch-icon-57-precomposed.png')}}">
        
        @yield('css')
    </head>
    <body>
        <div id="app">
            @include('components/header')

            @yield('content')

            @include('components/footer')
        </div>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="{{asset('eshopper/js/jquery.js')}}"></script>
            <script src="{{asset('eshopper/js/bootstrap.min.js')}}"></script>
            <script src="{{asset('eshopper/js/jquery.scrollUp.min.js')}}"></script>
            <script src="{{asset('eshopper/js/price-range.js')}}"></script>
            <script src="{{asset('eshopper/js/jquery.prettyPhoto.js')}}"></script>
            <script src="{{asset('eshopper/js/main.js')}}"></script>
            <script defer src="{{ mix('js/app.js') }}"></script>

            <script>
                function addToCart(event){
                    event.preventDefault();
                    let urlCart = $(this).data('url');
                    let size = $('#size').find(":selected").text();
                    if(size !== ''){
                        urlCart = urlCart.substring(0,urlCart.length - 1) + size;
                    }
                    $.ajax({
                        type : "GET",
                        url : urlCart,
                        success : function(data){
                            if(data.code === 200){
                                alert('Thêm sản phẩm thành công');
                            }
                        },
                        error : function(){
                            alert('Thêm sản phẩm vào giỏ hàng thất bại');
                        }
                    })
                };
                    
                $(function () {
                    $('.add-to-cart').on('click',addToCart);
                });

                function deleteProductCart(event){
                    event.preventDefault();
                    let urlDelete = $(this).data('url');
                    let idPro = $(this).data('id');
                    $.ajax({
                    	type : "GET",
                        url : urlDelete,
                    	data : {id : idPro},
                        success : function(data){
                            if(data.code === 200){
                                $('.cart_wrapper').html(data.cart_component);
                                alert('Xóa thành công');
                            }
                        },
                        error: function(){
                            alert('Xóa lỗi');
                        }
                    });
                };

                $(function () {
                    $(document).on('click','.delete-product-cart',deleteProductCart);
                });

                function updateProductCart(event){
                    event.preventDefault();
                    let urlUpdateCart = $(this).data('url');
                    let idPro = $(this).data('id');
                    let quantity = $(this).parents('tr').find('input.quatity').val();
                    $.ajax({
                    	type : "GET",
                        url : urlUpdateCart,
                    	data : {id : idPro, quantity : quantity},
                        success : function(data){
                            if(data.code === 200){
                                $('.cart_wrapper').html(data.cart_component);
                                alert('Cập nhật thành công');
                            }
                        },
                        error: function(){
                            alert('Cập nhật lỗi');
                        }
                    });
                };

                $(function () {
                    $(document).on('click','.update-product-cart',updateProductCart);
                });
                $(function(){
                    $('.btn_buy').on('click',buy)
                });
                
                function buy(){
                    alert('Đặt hàng thành công!!!');
                }

                // function initViewer(viewer){

                //     let mainImg = document.querySelector('.main-show');                    

                //     let id = viewer.id;

                //     let imgUrl = viewer.getAttribute('src');
                //     // viewer.onclick = event => {
                //     //     event.preventDefault();
                //     //     mainImg.src = imgUrl;
                //     // }
                //     $("#" + id).hover( () => {
                //         mainImg.src = imgUrl;
                //     },
                //     () => {
                //     })
                    
                // }

                // var viewers = document.querySelectorAll('.image-viewer');
                // viewers.forEach( viewer => initViewer(viewer));

                function secondMuangay(){
                    let first = $('#province').find(":selected").val();
                    let second = $('#district').find(":selected").val();
                    let third = $('#ward').find(":selected").val();
                    let txtDetail = $('#txtDetail').val();
                    
                    if(first != "null" && second != "null" && third != "null" && txtDetail != ""){
                        alert('Mua hàng thành công!');
                    }else{
                        alert('Hãy chọn khu vực cụ thể bạn muốn nhận hàng');
                        event.preventDefault();
                    }

                }

                function firstMuangay(){
                    $('#first-muangay').css("display","none");
                    $('#form-muangay').css("display","block");
                }

                function formDangky(){
                    $('#form-muangay').css("display","block");
                }

                function close_form_muahang(){
                    event.preventDefault();
                    $('#form-muangay').css("display","none");
                    $('#first-muangay').css("display","block");
                }

                function showDetail(src){
                    let mainImg = document.querySelector('.main-show');  
                    mainImg.src = src.getAttribute('data');
                    src.style = "box-sizing: border-box;border: 2px solid orange;";
                }

                function outDetail(src){
                    src.style = "";
                }

                
            </script>
            
            @yield('js')
    </body>
</html>