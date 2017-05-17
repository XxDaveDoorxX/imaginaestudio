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
		
		if (!empty($id_c)) {
			
			$stF = '../../assets/images/data/'.$tbl.'/';
			//echo $stF;
			$imgtmp = new Imagen($tbl,$stF,$_FILES['file']['tmp_name'],0,"",$_FILES['file']['name'],$id_c,0);
			$nwid = $imgtmp->insertar_imagen();
			
			if (isset($_REQUEST['iw']) && isset($_REQUEST['ih'])) {
				$iw = $_REQUEST['iw'];
				$ih = $_REQUEST['ih'];
				foreach((array)$iw as $i => $e) {
					$cpt = $i;
					if($i == 0)
						$cpt = "";
					$imgtmp->crear_img_rz($iw[$i],$ih[$i],'crop','crop'.$cpt.'_');
				}
			}
			echo $nwid;
		}
	}
}
?>