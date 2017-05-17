<?php
require_once ('../../Class/imagenes.php');
require_once ('../../Class/inc/existTable.php');

//print_r ($_REQUEST);
//print_r($_FILES);
		
if (isset($_REQUEST['tbl'])) {
	$tbl = htmlentities($_REQUEST['tbl'], ENT_QUOTES);
	if (existTable($tbl)) {
	
		$id_c = 0;
		if (isset($_REQUEST['id_c'])) {
			if (is_numeric($_REQUEST['id_c']))
				$id_c = $_REQUEST['id_c'];
		}
		
		//if (!empty($id_c)) {
			//echo ("Aquí!!!");
			$stF = '../../assets/images/data/'.$tbl.'/';
			$imgtmp = new Imagen($tbl,"","",0,"","",$id_c,0);
			$lstimg = $imgtmp->listar_x_id_c();
			//print_r($lstimg);
			$lstimgr = array();
			foreach($lstimg as $i => $e) {
				$lstimg[$i]['sz'] = filesize($stF.$e['arch_img']);
				$lstimgr[$e['orden']] = $lstimg[$i];
			}
			echo json_encode($lstimgr);
		//}
	}
}
?>