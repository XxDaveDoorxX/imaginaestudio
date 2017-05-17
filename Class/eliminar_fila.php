<?php
session_name("cotizacion");
session_start();

function searchForId($id, $array) {
    foreach ($array as $k => $e) {
        if ($e[1] == $id) {
            return $k;
        }
    }
    return null;
}

if(isset($_SESSION['ordenes']) && isset($_SESSION['total'])) {
    if(isset($_POST['idi'])){
        $idi = $_POST['idi'];
        $idx = searchForId($idi, $_SESSION['ordenes']);
        $_SESSION['total'] -= $_SESSION['ordenes'][$idx][0];
        unset($_SESSION['ordenes'][$idx]);
        echo json_encode($_SESSION['total']);
    }
}
