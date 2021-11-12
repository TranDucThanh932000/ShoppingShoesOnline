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
                        <form id="login-form" class="form" action="" method="post">
                            @csrf
                            <h3 class="text-center text-info">Đăng ký</h3>
                            <h4 class="text-danger txt-username"></h4>
                            <h4 class="text-danger txt-email"></h4>
                            <h4 class="text-danger txt-password"></h4>
                            <div class="form-group">
                                <label for="username" class="text-info">Họ và tên:</label><br>
                                <input type="text" name="username" id="username" min="2" max="30" class="form-control" onchange="checkName()" required>
                            </div>
                            <div class="form-group">
                                <label for="email" class="text-info">Email:</label><br>
                                <input type="email" name="email" id="email" class="form-control" onchange="checkEmail()" required>
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-info">Mật khẩu:</label><br>
                                <input type="password" name="password" id="password" min="3" max="20" onchange="checkMinMax()" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="rePassword" class="text-info">Nhập lại mật khẩu:</label><br>
                                <input type="password" name="rePassword" id="rePassword" min="3" max="20" onchange="validatePassword()" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <div style="text-align:center;">
                                    <input type="submit" name="submit" onclick="checkSubmit()" class="btn btn-info btn-md" value="Đăng ký">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>

        function checkSubmit(){
            let txtName = $('.txt-username').text();
            let txtEmail = $('.txt-email').text();
            let txtPassword = $('.txt-password').text();
            let valName = $('#username').val().split(" ").join("");
            let valEmail = $('#email').val().split(" ").join("");
            let valPassword = $('#password').val().split(" ").join("");
            let valRePassword = $('#rePassword').val().split(" ").join("");

            if( valName == '' || valEmail == '' || valPassword == '' || valRePassword == ''){
                event.preventDefault();
            }else{
                if(txtName != '' || txtEmail != '' || txtPassword != ''){
                    event.preventDefault();
                }
            }
        }

        function checkMinMax(){
            let password = $('#password').val();
            if(password.length >= 3 && password.length <= 20){
                $('#password').css('border-color', '#ced4da');
                $('.txt-password').text('');
                if($('#rePassword').val() != ""){
                    validatePassword();
                }
            }else{
                $('#password').css('border-color', 'red');
                $('.txt-password').text('Mật khẩu phải có ít nhất 3 ký tự và nhỏ hơn 20 ký tự');
            }
        }

        function validatePassword() {
            let password = $('#password').val();
            if(password.length >= 3 && password.length <= 20){
                let repassword = $('#rePassword').val();

                if (password != repassword) {
                    $('#password').css('border-color', 'red');
                    $('#rePassword').css('border-color', 'red');
                    $('.txt-password').text('Mật khẩu không khớp');
                }else{
                    $('#password').css('border-color', 'green');
                    $('#rePassword').css('border-color', 'green');
                    $('.txt-password').text('');
                }
            }else{
                $('#password').css('border-color', 'red');
                $('.txt-password').text('Mật khẩu phải có ít nhất 3 ký tự và nhỏ hơn 20 ký tự');
            }

        }


        function validateEmail(email) {
            const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(String(email).toLowerCase());
        }

        function checkName(){
            let username = $('#username').val();
            if(username.length < 2){
                $('#username').css('border-color', 'red');
                $('.txt-username').text('Họ và tên phải nhiều hơn 1 ký tự');
            }else{
                $('#username').css('border-color', 'green');
                $('.txt-username').text('');
            }
        }


        function checkEmail() {
            let email = $('#email');
            let txtEmail = email.val();
            if(validateEmail(txtEmail)){
                $.ajax({
                    type: "GET",
                    url: '/check-email/'+ txtEmail,
                    success: data => {
                        if (data.code === 200) {
                            email.css('border-color', 'green');
                            $('.txt-email').text('');
                        } else {
                            email.css('border-color', 'red');
                            $('.txt-email').text('Email này đã tồn tại');
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
    </script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</body>

</html>