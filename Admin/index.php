<?php
session_name("sadmin");
session_start();

if(isset($_SESSION['id'])){
    $nombre_user = $_SESSION['username'];
    header('Location: home');
}else{
    $nombre_user = "";
}

?>

<!DOCTYPE html>
<html lang="en" class="body-full-height">
<head>
    <!-- META SECTION -->
    <title>Imagina Estudiorr - Login</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="icon" href="favicon.ico" type="image/x-icon" />
    <!-- END META SECTION -->

    <!-- CSS INCLUDE -->
    <link rel="stylesheet" type="text/css" id="theme" href="assets/css/theme-default.css"/>
    <!-- EOF CSS INCLUDE -->
</head>
<body>

<div class="login-container lightmode">

    <div class="login-box animated fadeInDown">
        <!--<div class="login-logo"></div>-->
        <div class="login-body">
            <div class="login-title" style="text-align: center;"><strong>Inicio</strong> de sesión</div>
            <form action="resources/ingresar.php" class="form-horizontal" method="post">
                <div class="form-group">
                    <div class="col-md-12">
                        <input type="text" class="form-control" name="usuario" placeholder="Usuario"/>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <input type="password" class="form-control" name="password" placeholder="Contraseña"/>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <button class="btn btn-info btn-block">Acceder</button>
                    </div>
                </div>
                <div class="col-md-12">
                    <p style="color:#F7F7F7; text-align:center;">
                        <?php

                        if(isset($_REQUEST['id'])){

                            echo'El usuario y/o contrase&ntilde;a son incorrectos';
                        }

                        ?>
                    </p>
                </div>
            </form>
        </div>
        <div class="login-footer">
            <div class="pull-left">
                &copy; 2016 Mayanecotours
            </div>
            <div class="pull-right">
                <a href="#">Aviso de privacidad</a> |
                <a href="#">Contactanos</a>
            </div>
        </div>
    </div>

</div>

</body>
</html>