<?php

require_once ('../../Class/Clasificador.php');

// Verificar TODOS los campos usables del formulario
$op = (isset($_REQUEST['op'])) ? $_REQUEST['op'] : '';		// opcioón

$id = (isset($_REQUEST['id'])) ? $_REQUEST['id'] : 0;	// id

$nombre = (isset($_REQUEST['nombre'])) ? $_REQUEST['nombre'] : '';

$descripcion = (isset($_REQUEST['descripcion'])) ? $_REQUEST['descripcion'] : '';

$ascendencia = (isset($_REQUEST['categ'])) ? $_REQUEST['categ'] : array('');


$clsftmp = new Clasificador($id,$nombre,'',$ascendencia);


switch ($op) {

	case 'Agregar':

		if (count($ascendencia) < 3)
			$clsftmp->insertar_Clasificador();
		break;
	case 'Modificar':
		if (count($ascendencia) < 3)
			$clsftmp->modificar_Clasificador();
		break;

	case 'Eliminar':
		$clsftmp->eliminar_Clasificador();
		break;
}

header('Location:lcategorias.php');

?>