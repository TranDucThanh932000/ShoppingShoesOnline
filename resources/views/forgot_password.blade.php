<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
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
                        <form id="login-form" class="form" action="{{route('laravel-send-email')}}" method="post">
                            @csrf
                            <h3 class="text-center text-info">Lấy lại mật khẩu</h3>
                            <h5 class="text-info">Mật khẩu mới sẽ được gửi tới Email của bạn</h5>
                            <h5 class="text-danger txt-email">{{$mess}}</h5>
                            <div class="form-group">
                                <label for="email" class="text-info">Email:</label><br>
                                <input type="email" name="email" id="email" class="form-control" onchange="checkEmail()" required>
                            </div>
                            <div class="form-group">
                                <div style="text-align:center;">
                                    <input type="submit" name="submit" onclick="checkSubmit()" class="btn btn-info btn-md" value="Xác nhận">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>

        function validateEmail(email) {
            const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(String(email).toLowerCase());
        }


        function checkEmail() {
            let email = $('#email');
            let txtEmail = email.val();
            if(validateEmail(txtEmail)){
                $.ajax({
                    type: "GET",
                    url: '/check-email/'+ txtEmail,
                    success: data => {
                        if (data.code !== 200) {
                            email.css('border-color', 'green');
                            $('.txt-email').text('');
                        } else {
                            email.css('border-color', 'red');
                            $('.txt-email').text('Email này không tồn tại');
                        }
                    },
                    error: function() {

                    }
                });
            }else{
                email.css('border-color', 'red');
                $('.txt-email').text('Chưa đúng định dạng email');
            }
        }

        function checkSubmit(){
            let txt = $('.txt-email').text();
            let txtTrim = $('#email').val().split(" ").join("");
            if(txtTrim == ''){
                event.preventDefault();
            }else{
                if(txt != ''){
                    event.preventDefault();
                }
            }
        }
    </script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</body>

</html>