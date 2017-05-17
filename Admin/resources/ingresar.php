<?php
include('../../Class/Seguridad.php');

$sec = new Seguridad();

if($sec->ingresar_usuario($_REQUEST['usuario'],$_REQUEST['password'])) {

    //print_r($_REQUEST);
    header('Location: ../home');

}else{
    header('Location:../.?id=0');
}