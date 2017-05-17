<?php
require_once ('../../Class/Servicio.php');

$op = (isset($_REQUEST['op'])) ? htmlentities($_REQUEST['op'], ENT_QUOTES) : '';		// opcion
$id = (isset($_REQUEST['id'])) ? htmlentities($_REQUEST['id'], ENT_QUOTES) : 0;	// id
$titulo = (isset($_REQUEST['titulo'])) ? $_REQUEST['titulo'] : '';
$precio = (isset($_REQUEST['precio'])) ? $_REQUEST['precio'] : '';
$descripcion = (isset($_REQUEST['descripcion'])) ? $_REQUEST['descripcion'] : '';
$clasif = (isset($_REQUEST['clasificador'])) ? $_REQUEST['clasificador'] : '';

print_r($_REQUEST);

/*IMAGENES*/
$tbl = (isset($_REQUEST['tbl'])) ? htmlentities($_REQUEST['tbl'], ENT_QUOTES) : '';	// tabla imagen


$tmpserv = new Servicio($id,$titulo,$descripcion,$precio,$clasif);



//print_r($_REQUEST);

switch ($op) {
    case 'Agregar':
        $id = $tmpserv->insertar();
        echo $id;
        break;

    case 'Modificar':
        $id = $tmpserv->modificar();
        echo $id;
        break;

    case 'Eliminar':
        $tmpserv->eliminar();
        require_once ('../../Class/imagenes.php');
        $stF = '../../assets/images/data/'.$tbl.'/';
        $imgtmp = new Imagen($tbl,$stF,"",0,"","",$id,0);
        $imgtmp->eliminar_x_id_c();
        break;

    case 'Publicar':
        $tmpnot->publicar_noticia(1);
        break;

    case 'Despublicar':
        $tmpnot->publicar_noticia(0);
        break;

}
//header('Location:lnoticias.php');
?>