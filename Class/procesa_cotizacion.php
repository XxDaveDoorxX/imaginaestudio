<?php
header('Content-type: text/html; charset=utf-8');
session_name("milanesa_orden");
session_start();
require_once('init.php');
$msg = "";

$codigo = (isset($_POST['g-recaptcha-response'])) ? $_POST['g-recaptcha-response'] : '';

$response = $recaptcha->verify($codigo);

function transponer($array) {
    array_unshift($array, null);
    return call_user_func_array('array_map', $array);
}
if($response->isSuccess()) {

    if (isset($_POST['btnCotizacion'])) {

        if(isset($_SESSION['ordenes']) && isset($_SESSION['total'])) {

            if (count($_SESSION['ordenes']) > 0 && isset($_SESSION['total']) > 0) {

                $ordenes_trans = transponer($_SESSION['ordenes']);
                $aux_o = $ordenes_trans[3];
                print_r($_SESSION['ordenes']);
                echo "\n";
                print_r($aux_o);
            }
        }

    }
}