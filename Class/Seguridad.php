<?php
include_once('user.php');

class Seguridad
{
    var $user;
    var $inactivo = 1800;		// Segundos

    function Seguridad()
    {
        $this->user = new User();
    }

    function ingresar_usuario ($usuario, $password)
    {
        $this->user->name = $usuario;
        $this->user->password = $password;
        $this->user->login();
        $auth = false;
        if ($this->user->id != 0) {
            session_name("sadmin");
            session_start();
            session_regenerate_id();
            $_SESSION['id'] = $this->user->id;
            $_SESSION['username'] = $this->user->name;
            $_SESSION['timeout'] = time() + $this->inactivo;
            $auth = true;
        }
        return $auth;
    }


    function candado()
    {
        session_name("sadmin");
        session_start();
        session_regenerate_id();
        if(!(isset($_SESSION['id'])) || (time() > $_SESSION['timeout'])) {
            session_unset();
            session_destroy();
            header('Location: ../Admin/.');
        }
        $_SESSION['timeout'] = time() + $this->inactivo;
    }

    function candado_index()
    {
        session_name("sadmin");
        session_start();
        if(!(isset($_SESSION['id_usuario'])) || (time() > $_SESSION['timeout'])) {
            session_unset();
            session_destroy();
            header('Location: Login/login.php');
        }
        $_SESSION['timeout'] = time() + $this->inactivo;
    }


}
