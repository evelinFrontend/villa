<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="views/assets/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="views/assets/css/bootstrap-grip.min.css"> -->
    <link rel="stylesheet" href="views/assets/css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="views/assets/css/login.css">
</head>

<body>
    <div class="content-main">
        <div class="row content-login">
            <div class="login-form col-6 d-flex justify-content-center flex-column">
                <h4 class="text-center mb-4 title">Inicia sesion</h4>
                <form>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nombre de usuario:</label>
                        <input type="text" class="form-control" id="login" aria-describedby="emailHelp"
                            placeholder="Maria123#">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Contraseña:</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                    </div>
                    <button type="submit" class="btn btn-darkgreen text-white btn-block" id="submitLogin">Ingresar</button>
                </form>
            </div>
            <div class="login-img col-6 d-flex justify-content-center align-item-center">
                <img class="w-100" src="views/assets/img/logo.jpeg" alt="" srcset="">
            </div>
        </div>
    </div>
    <script src="views/assets/js/jquery.min.js"></script>
    <script src="views/assets/js/bootstrap.min.js"></script>
    <script src="views/assets/js/login.js"></script>
</body>

</html>