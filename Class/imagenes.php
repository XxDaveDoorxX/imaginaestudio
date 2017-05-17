<?php
require_once('inc/dbc.php');
require_once('archivo.php');
require_once('resize.php');

class Imagen extends Archivo {

	var $tabla;

	var $id;
	var $leyenda;
	var $archivo;
	var $id_c;

	var $orden;

	var $ruta;

	function __construct($tabla, $ruta, $temporal, $idimagen, $leyenda, $archivo, $id_categoria, $orden)
	{
		$this->tabla = $tabla;

		$this->id = $idimagen;
		$this->leyenda = $leyenda;	//String
		$this->archivo = $archivo;
		$this->id_c = $id_categoria;
		$this->orden = $orden;

		$this->ruta = $ruta;
		$this->ruta_final = $ruta.$archivo;
		$this->r_temp = $temporal;

	}

	/**** Funciones estandard ****/

	function insertar_imagen ()
	{
		$this->renombra_archivo();
		if ($this->leyenda == "") $this->leyenda = $this->archivo;

		$this->subir_archivo();

  		$conexion = new dbc();
		$result = $conexion->prepare("INSERT INTO ".$this->tabla." (lynd_img,arch_img,id_c,orden) VALUES (?,?,?,?)");
		$result->bind_param("ssii",$this->leyenda,$this->archivo,$this->id_c,$this->orden);
		$result->execute();
		$nwid = $result->insert_id;
		$result->close();
		return $nwid;
	}

	// * Modificar * //
	function modificar_imagen ()
	{
		$psql = "";
		$param = array("","");
		if (!empty($this->archivo)) {
			$tmp = new Imagen($this->tabla,$this->ruta,'',$this->id,'','',0,0);
			$tmp->obtener_imagen();
			$tmp->eliminar_archivo();
			$tmp->eliminar_img_rz();
			unset($tmp);

			$this->renombra_archivo();
			$this->subir_archivo();

			if ($this->leyenda == "") $this->leyenda = $this->archivo;
			$psql = ", arch_img = ?";
			$param = array("s",&$this->archivo);
		}
		$conexion = new dbc();
		$result = $conexion->prepare("UPDATE ".$this->tabla." SET lynd_img = ?".$psql.", id_c = ?, orden = ? WHERE id_img = ?");
		call_user_func_array(array($result,"bind_param"),array_filter(array("s".$param[0]."iii",&$this->leyenda,$param[1],&$this->id_c,$this->orden,&$this->id)));
		$result->execute();
		$result->close();
	}
	function modificar_lynd_imagen ()
	{
		$conexion = new dbc();
		$result = $conexion->prepare("UPDATE ".$this->tabla." SET lynd_img = ? WHERE id_img = ?");
		$result->bind_param("si",$this->leyenda,$this->id);
		$result->execute();
		$result->close();
	}
	function modificar_orden_imagen ()
	{
		$conexion = new dbc();
		$result = $conexion->prepare("UPDATE ".$this->tabla." SET orden = ? WHERE id_img = ?");
		$result->bind_param("ii",$this->orden,$this->id);
		$result->execute();
		$result->close();
	}

	// * Eliminar * //
	function eliminar_imagen ()
	{
		if ($this->id) {
			$this->obtener_imagen();
			//print_r($this);
			$this->eliminar_archivo();
			//print_r($this);
			$this->eliminar_img_rz();

			$conexion = new dbc();
			$result = $conexion->prepare("DELETE FROM ".$this->tabla." WHERE id_img = ?");
			//echo "DELETE FROM ".$this->tabla." WHERE id_img = ?";
			$result->bind_param("i",$this->id);
			$result->execute();
			$result->close();
		}
	}

	// * Obtener * //
	function obtener_imagen ()
	{
		$conexion = new dbc();
		$result = $conexion->prepare("SELECT id_img,lynd_img,arch_img,id_c,orden FROM ".$this->tabla." WHERE id_img=?");
		$result->bind_param('i', $this->id);
		$result->execute();
		$result->bind_result($this->id,$this->leyenda,$this->archivo,$this->id_c,$this->orden);
		$result->fetch();
		$result->close();
		$this->ruta_final=$this->ruta.$this->archivo;
	}

	// * Listar * //
	function listar_imagenes ()
	{
		$conexion = new dbc();
		$result = $conexion->query("SELECT id_img,lynd_img,arch_img,id_c,orden FROM ".$this->tabla);
		//echo "SELECT id_img,lynd_img,arch_img,id_c FROM ".$this->tabla;
		$resultados =array();
		while($row = $result->fetch_assoc()) {
			$resultados[] = $row;
		}
		$result->free();

		return $resultados;
	}

	/**** Por índice en una categoría ****/

	function eliminar_x_id_c ()
	{
		$tmp = new Imagen($this->tabla,$this->ruta,'',0,'','',$this->id_c,0);
		$imagenes = $tmp->listar_x_id_c();

		foreach ($imagenes as $elem) {
			$tmp->id = $elem['id_img'];
			$tmp->archivo = $elem['arch_img'];
			$tmp->ruta_final = $this->ruta.$elem['arch_img'];
			$tmp->eliminar_archivo();
			$tmp->eliminar_img_rz();
		}

		$conexion = new dbc();
		$result = $conexion->prepare("DELETE FROM ".$this->tabla." WHERE id_c = ?");
		$result->bind_param("i",$this->id_c);
		$result->execute();
		$result->close();
	}

	function listar_x_id_c()
	{
		$conexion = new dbc();
		$result = $conexion->prepare("SELECT id_img,lynd_img,arch_img,id_c,orden FROM ".$this->tabla." WHERE id_c = ? ORDER BY orden");
		//echo "SELECT id_img,lynd_img,arch_img,id_c,orden FROM ".$this->tabla." WHERE id_c = ".$this->id_c." ORDER BY orden";
		$result->bind_param('i', $this->id_c);
		$result->execute();
		$result->store_result();
		//$resultarr = $result->get_result();
		$resultados = array();
		while ($row = $result->fetch_assoc()) {
			$resultados[$row['id_img']] = $row;
		}
		//$resultarr->free();
		$result->close();
		//print_r($resultados);
		return $resultados;
	}


	function listar_1_x_id_c()
	{
		$conexion = new dbc();
		$result = $conexion->prepare("SELECT id_img,lynd_img,arch_img,id_c,orden FROM ".$this->tabla." WHERE id_c = ? ORDER BY orden LIMIT 1");
		$result->bind_param('i', $this->id_c);
		$result->execute();
		$result->store_result();
		//$resultarr = $result->get_result();
		$row = $result->fetch_assoc();
			$resultados[$row['id_img']] = $row;
		//$resultarr->free();
		$result->close();
		return $resultados;
	}
	function listar_solo_id_x_id_c()
	{
		$conexion = new dbc();
		$result = $conexion->prepare("SELECT id_img FROM ".$this->tabla." WHERE id_c = ? ORDER BY orden");
		$result->bind_param('i', $this->id_c);
		$result->execute();
		$result->store_result();
		//$resultarr = $result->get_result();
		$resultados = array();
		while ($row = $result->fetch_assoc()) {
			$resultados[$row['id_img']] = $row['id_img'];
		}
		//$resultarr->free();
		$result->close();
		return $resultados;
	}

	function listar_x_id_c_2($comp)
	{
		$conexion = new dbc();
		$result = $conexion->query("SELECT ".$this->tabla.".id_img,".$this->tabla.".lynd_img,".$this->tabla.".arch_img,".$this->tabla.".id_c,".$this->tabla.".orden FROM ".$comp);
		//echo "SELECT ".$this->tabla.".id_img,".$this->tabla.".lynd_img,".$this->tabla.".arch_img,".$this->tabla.".id_c,".$this->tabla.".orden FROM ".$comp;
		$resultados =array();
		while($row = $result->fetch_assoc()) {
			$resultados[] = $row;
		}
		$result->free();

		return $resultados;
	}

	/**** Otras Rutinas ****/

	function renombra_archivo()
	{
		$nimagen = pathinfo($this->archivo);
		$from = explode(',', "À,Á,Â,Ã,Ä,Å,Æ,Ç,È,É,Ê,Ë,Ì,Í,Î,Ï,Ð,Ñ,Ò,Ó,Ô,Õ,Ö,Ø,Ù,Ú,Û,Ü,Ý,ß,à,á,â,ã,ä,å,æ,ç,è,é,ê,ë,ì,í,î,ï,ð,ñ,ò,ó,ô,õ,ö,ø,ù,ú,û,ü,ý,ÿ,Š,š,Ÿ,Ž,ž");
		$to = explode(',',  "A,A,A,A,A,A,AE,C,E,E,E,E,I,I,I,I,D,N,O,O,O,O,O,O,U,U,U,U,Y,ss,a,a,a,a,a,a,ae,c,e,e,e,e,i,i,i,i,d,n,o,o,o,o,o,o,u,u,u,u,y,y,S,s,Y,Z,z");
		$s = preg_replace("/[^A-Za-z0-9 ]/", '_', str_replace($from,$to,trim($nimagen['filename'])));
		$tactual = time();
		$nw_nombre = $s.$tactual.'.'.$nimagen['extension'];
		while(file_exists($this->ruta.$nw_nombre)) {
			$tactual++;
			$nw_nombre = $s.$tactual.'.'.$nimagen['extension'];
		}
		$this->archivo = $nw_nombre;
		$this->ruta_final = $this->ruta.$nw_nombre;
	}

	/*** empieza resize ***/

	function crear_img_rz ($ancho=200,$alto=100,$tipo='auto',$pref='thumb_')
	{
		if (!empty($this->archivo)) {
			$redimencion = new resize($this->ruta.$this->archivo);
			$redimencion->resizeImage($ancho,$alto,$tipo);
			$redimencion->saveImage($this->ruta.$pref.$this->archivo,100);
		}
	}

	function eliminar_img_rz()
	{
		if ($this->id) {
			$matches = glob($this->ruta."*".$this->archivo);
			if (is_array ($matches) ) {
				foreach ($matches as $a) {
					@unlink($a);
				}
			}
		}
	}

}
?>
