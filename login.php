<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Typerite</title>

    <link rel="stylesheet" href="template/css/base.css">
    <link rel="stylesheet" href="template/css/vendor.css">
    <link rel="stylesheet" href="template/css/main.css">

    <link rel="apple-touch-icon" sizes="180x180" href="template/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="template/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="template/favicon-16x16.png">
    <link rel="manifest" href="template/site.webmanifest">

    <style>
        body{
            height:100vh;
            width:100vw;
            display: flex;
            align-items: center;
            Justify-content:center;
        }
        .row{
            box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;  
        }
        .login-image{
            position: absolute;
            width:calc(100% - 40px);
            height:100%;
            object-fit:cover;
        }   
    </style>
</head>
<body>

    <div class="row">
        <div class="column large-6 tab-full" style="position:relative;">
            <img src="template/images/login.jpg" draggable="false" class="login-image">
        </div>
        <div class="column large-6 tab-full">
            <h3>Login</h3>
            <form>
                <div>
                    <label for="sampleInput">Email</label>
                    <input class="full-width emailInput" type="email" id="sampleInput">
                </div>
                <div>
                    <label for="sampleInput">Password</label>
                    <input class="full-width passwordInput" type="email" id="sampleInput">
                </div>
                <button type="button" class="btn--primary full-width login-btn">Login</button>
            </form>
        </div>
    </div>

    <script src="template/js/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.17/sweetalert2.min.js" integrity="sha512-Kyb4n9EVHqUml4QZsvtNk6NDNGO3+Ta1757DSJqpxe7uJlHX1dgpQ6Sk77OGoYA4zl7QXcOK1AlWf8P61lSLfQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
    <script src="template/js/authentication.js"></script>
</body>
</html>