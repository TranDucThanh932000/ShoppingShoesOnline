<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #17a2b8;
            height: 100vh;
            }
        #login .container #login-row #login-column #login-box {
            margin-top: 120px;
            max-width: 600px;
            height: 320px;
            border: 1px solid #9C9C9C;
            background-color: #EAEAEA;
            }
        #login .container #login-row #login-column #login-box #login-form {
            padding: 20px;
            }
        #login .container #login-row #login-column #login-box #login-form #register-link {
            margin-top: -85px;
            }
    </style>
</head>

<body>
    <div id="login">
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12" style="height: 100%">
                        <form id="login-form" class="form" action="" method="post">
                            @csrf
                            <h3 class="text-center text-info">Đăng nhập</h3>
                            <h4 class="text-danger">{{$mess}}</h4>
                            @if($id_product != null)
                                <input style="visibility: hidden;" type="text" name="id_product" value="{{$id_product}}">
                            @endif
                            <div class="form-group">
                                <label for="email" class="text-info">Tài khoản:</label><br>
                                <input type="text" name="email" id="email" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-info">Mật khẩu:</label><br>
                                <input type="password" name="password" id="password" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="remember-me" class="text-info"><span>Ghi nhớ</span> <span>
                                <input id="remember-me" name="remember_me" type="checkbox"></span></label><br>
                                <input type="submit" name="submit" class="btn btn-info btn-md" value="Đăng nhập">
                            </div>
                        </form>
                        <div style="padding: 0px 0px 20px 20px">
                            <ul class="nav navbar-nav">
                                <li><a href="{{route('redirectGoogle')}}"><i class="bi bi-google"></i> Đăng nhập bằng Google</a></li>
                                <li><a href="{{route('register')}}"><i class="bi bi-patch-plus-fill"></i> Đăng ký tài khoản</a></li>
                                <li><a href="{{route('forgot-password')}}"><i class="bi bi-emoji-frown-fill"></i> Quên mật khẩu</a></li>
                                <li><a href="{{route('home.homepage')}}"><i class="bi bi-house-door-fill"></i> Trở về trang chủ</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</body>
</html>
