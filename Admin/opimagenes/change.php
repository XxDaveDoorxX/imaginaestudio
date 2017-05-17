<?php
require_once ('../../Class/imagenes.php');
require_once ('../../Class/inc/existTable.php');

//print_r($_REQUEST);
//print_r($_FILES);
		
if (isset($_REQUEST['tbl'])) {
	$tbl = htmlentities($_REQUEST['tbl'], ENT_QUOTES);
	if (existTable($tbl)) {
	
		$id_c = 0;
		if (isset($_REQUEST['id_c'])) {
			if (is_numeric($_REQUEST['id_c']))
				$id_c = $_REQUEST['id_c'];
		}
		
		if (!empty($id_c)) {
			
			if (isset($_REQUEST['id_img'])) {
				if (is_numeric($_REQUEST['id_img'])) {
					$id_img = $_REQUEST['id_img'];
					if (isset($_REQUEST['chg_ly'])) {
						$chg_ly = htmlentities($_REQUEST['chg_ly'], ENT_QUOTES);
						//print_r ($_REQUEST);

						$imgtmp = new Imagen($tbl,"","",$id_img,$chg_ly,"",$id_c,0);
						$imgtmp->modificar_lynd_imagen();
					}
					
					if (isset($_REQUEST['chg_ord'])) {
						$chg_ord = htmlentities($_REQUEST['chg_ord'], ENT_QUOTES);

						$imgtmp = new Imagen($tbl,"","",$id_img,"","",$id_c,$chg_ord);
						$imgtmp->modificar_orden_imagen();
					}
				}
			}
		}
	}
}
?>