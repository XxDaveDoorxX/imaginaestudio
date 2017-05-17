<?php
require_once ('../../Class/InfoGeneral.php');

$op = (isset($_REQUEST['op'])) ? htmlentities($_REQUEST['op'], ENT_QUOTES) : '';		// opcion
$id = (isset($_REQUEST['id'])) ? htmlentities($_REQUEST['id'], ENT_QUOTES) : 0;	// id
$titulo = (isset($_REQUEST['titulo'])) ? htmlentities($_REQUEST['titulo'], ENT_QUOTES) : '';
$id_serv = (isset($_REQUEST['id_serv'])) ? htmlentities($_REQUEST['id_serv'], ENT_QUOTES) : 0;	// id

/*IMAGENES*/
$tbl = (isset($_REQUEST['tbl'])) ? $_REQUEST['tbl'] : '';	// tabla imagen

$tmpinfogeneral= new InfoGeneral($id,$titulo,$id_serv);

switch ($op) {
    case 'Agregar':
        $id = $tmpinfogeneral->insertar();
        echo $id;
        break;

    case 'Modificar':
        $tmpinfogeneral->modificar();
        break;

    case 'Eliminar':
        $tmpinfogeneral->eliminar();
        require_once ('../../Class/imagenes.php');
        $stF = '../../assets/images/data/'.$tbl.'/';
        $imgtmp = new Imagen($tbl,$stF,"",0,"","",$id,0);
        $imgtmp->eliminar_x_id_c();
        break;
}