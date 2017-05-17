<?php
require_once ('../../Class/imagenes.php');
require_once ('../../Class/inc/existTable.php');

//print_r ($_REQUEST);
//print_r($_FILES);
		
if (isset($_POST['tbl'])) {
	$tbl = htmlentities($_POST['tbl'], ENT_QUOTES);
	if (existTable($tbl)) {
	
		$id_c = 0;
		if (isset($_POST['id_c'])) {
			if (is_numeric($_POST['id_c']))
				$id_c = $_POST['id_c'];
		}
		
		if (!empty($id_c)) {
			$stF = '../../assets/images/data/'.$tbl.'/';
			if (isset($_POST['id_img'])) {
				if (is_numeric($_POST['id_img'])) {
					//print_r ($_POST);
					$id_img = $_POST['id_img'];
					//echo $stF;
					$imgtmp = new Imagen($tbl,$stF,"",$id_img,"","",$id_c,0);
					$imgtmp->eliminar_imagen();
				}
			}
			
			if (isset($_POST['all'])) {
				if (is_numeric($_POST['all'])) {
					//print_r ($_POST);
					//echo $stF;
					$imgtmp = new Imagen($tbl,$stF,"",0,"","",$id_c,0);
					$imgtmp->eliminar_x_id_c();
				}
			}
		}
	}
}
?>