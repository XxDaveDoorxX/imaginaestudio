<?php
require_once('imagenes.php');

class ImagenesEx {

	var $tabla;
	var $ruta;
	var $dDIR;

	function __construct ($tabla_c)
	{
		/* Relacion de Tablas y Ubicación de carpetas imagenes */
		$uDIR = $_SERVER["DOCUMENT_ROOT"]."/imaginaestudio/";
		$dDIR = "http://".$_SERVER["SERVER_NAME"]."/imaginaestudio/";
		$tbimgs = array (
			'Servicio' => array ('imagenes_servicios', $uDIR.'assets/data/imagenes_servicios/', $dDIR.'assets/data/imagenes_servicios/'),
			'Muestra' => array ('imagenes_muestra', $uDIR.'assets/data/imagenes_muestra/', $dDIR.'assets/data/imagenes_muestra/'),
            'InfoGeneral' => array ('imagenes_infog', $uDIR.'assets/data/imagenes_infog/', $dDIR.'assets/data/imagenes_infog/')
						);
		$this->tabla = $this->ruta = $this->dDIR = "";
		if (array_key_exists($tabla_c,$tbimgs)) {
			$this->tabla = $tbimgs[$tabla_c][0];
			$this->ruta = $tbimgs[$tabla_c][1];
			$this->dDIR = $tbimgs[$tabla_c][2];
		}
	}

	function subir_imagenes ($id_c, $lynd, $arch, $rzc)
	{	// $arch := $_FILES;
		if ($id_c) {
			//print_r($lynd);
			//print_r($arch);
			$nwids = array();
			$errores = array();
			if(!empty($arch)) {
				$arch = $this->arreglar_arch($arch);
				foreach($arch as $i => $e) {
					if(!$arch[$i]['error']) {
						$imgtmp = new Imagen($this->tabla,$this->ruta,$arch[$i]['tmp_name'],0,$lynd[$i],$e['name'],$id_c);
						$nwids[$i] = $imgtmp->insertar_imagen();
						if (!empty($rzc))
							foreach($rzc as $el) {
								$imgtmp->crear_img_rz($el[0],$el[1],$el[2],$el[3]);
							}
					} else {
						$errores[$i] = $arch[$i]['error'];
					}
				}
			}

			return array($nwids,$errores);
		}
	}

	function modificar_imagenes ($id_c, $id_imgs, $lynd, $arch, $rzc)
	{	// $id_imgs, $arch, $lynd := array()
		if ($id_c) {
			$ids = array();
			$errores = array();
			if(!empty($id_imgs)) {
				foreach($id_imgs as $i => $e) {
					$narch = $tname = '';
					if(!empty($arch)) {
						$arch = $this->arreglar_arch($arch);
						if(!$arch[$i]['error']) {
							$narch = $arch[$i]['name'];
							$tname = $arch[$i]['tmp_name'];
						} else {
							$errores[$i] = $arch[$i]['error'];
						}
					}
					$ids[$i] = $e;
					$imgtmp = new Imagen($this->tabla,$this->ruta,$tname,$e,$lynd[$i],$narch,$id_c);
					$imgtmp->modificar_imagen();
					if (!empty($rzc))
						foreach($rzc as $el) {
							$imgtmp->crear_img_rz($el[0],$el[1],$el[2],$el[3]);
						}
				}
			}
			return array($ids,$errores);
		}
	}

	function eliminar_imagenes ($id_imgs)
	{
		//print_r($id_imgs);
		foreach($id_imgs as $e) {
			$imgtmp = new Imagen($this->tabla,$this->ruta,'',$e,'','',0);
			$imgtmp->eliminar_imagen();
			$imgtmp->eliminar_img_rz();
		}
	}
	function eliminar_x_id_c ($id_c)
	{
		$imgtmp = new Imagen($this->tabla,$this->ruta,'',0,'','',$id_c);
		$imgtmp->eliminar_x_id_c();
		$imgtmp->eliminar_img_rz();
	}

	function obtener_imagen ($id_img)
	{
		$imgtmp = new Imagen($this->tabla,$this->ruta,'',$id_img,'','',0);
		$imgtmp->obtener_imagen();
		return $imgtmp;
	}

	function listar_imagenes ()
	{
		$imgtmp = new Imagen($this->tabla,$this->ruta,'',0,'','',0);
		return $imgtmp->listar_imagenes();
	}
	function listar_x_id_c($id_c)
	{
		$imgtmp = new Imagen($this->tabla,$this->ruta,'',0,'','',$id_c);
		return $imgtmp->listar_x_id_c();
	}
	function listar_1_x_id_c ($id_c)
	{
		$imgtmp = new Imagen($this->tabla,$this->ruta,'',0,'','',$id_c);
		return $imgtmp->listar_1_x_id_c();
	}

	function cambiar_imagenes ($id_c, $lynd, $arch, $restantes, $rzc)
	{	// $restantes = array('idx' => indices imagenes [si no estan AQUI se eliminarán], 'arch' => $_FILES, 'lynd' => leyendas)
		$imgtmp = new Imagen ($this->tabla,$this->ruta,'',0,'','',$id_c);
		$id_imgs_bd = $imgtmp->listar_solo_id_x_id_c();

		$imags_elim = array_diff($id_imgs_bd,$restantes['idx']);

		foreach ($imags_elim as $e) {
			$imgtmp = new Imagen($this->tabla,$this->ruta,'',$e,'','',0);
			$imgtmp->eliminar_imagen();
		}

		$res1 = $this->modificar_imagenes($id_c,$restantes['idx'],$restantes['lynd'],$restantes['arch'],$rzc);

		$res2 = $this->subir_imagenes($id_c,$lynd,$arch,$rzc);

		return array_merge($res1,$res2);
	}

	function arreglar_arch ($file)
	{
		$archa = array();
		if (!empty($file)) {
			if (is_array($file['name'])) {
				$cntarch = count($file['name']);
				$idxarch = array_keys($file);
				for ($i=0; $i<$cntarch; ++$i) {
					foreach ($idxarch as $idx) {
						$archa[$i][$idx] = $file[$idx][$i];
					}
				}
			} else {
				$archa = array($file);
			}
		}
		return $archa;
	}

}
?>
