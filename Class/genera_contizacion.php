<?php
session_name("cotizacion");
session_start();

include_once ('Servicio.php');
//print_r($_POST);

if (isset($_POST['btnServid'])) {
    if (isset($_POST['id'])) {
        $id = $_POST['id'];

        $servicios = new Servicio($id, '', '');
        $servicios->obtener();

        if (!isset($_SESSION['ordenes'])) {
            $idxOrd = 1;
        } else {
            $aux = end($_SESSION['ordenes']);
            $idxOrd = $aux[1] + 1;
        }

        $pedido = array($servicios->titulo, $servicios->precio, $idxOrd);

        $_SESSION['ordenes'][] = array($servicios->precio, $idxOrd, $servicios->titulo, 4);
        $total = 0;
        foreach ($_SESSION['ordenes'] as $e) {
            $total += $e[0];
        }
        $_SESSION['total'] = $total;

        $pedido[] = $total;
        $pedidojson = json_encode($pedido);
        echo $pedidojson;

    }
}