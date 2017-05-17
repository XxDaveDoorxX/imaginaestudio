<?php
require_once('../Class/data.php');

$op = (isset($_REQUEST['op'])) ? $_REQUEST['op'] : '';		// opcion
$id = (isset($_REQUEST['id'])) ? $_REQUEST['id'] : 0;	// id




$tmpdata = new Data($id,'','','','');



//print_r($_REQUEST);

switch ($op) {
	case 'Eliminar':
		$tmpdata->eliminar();
		break;

}
	//header('Location:lnoticias.php');
?>