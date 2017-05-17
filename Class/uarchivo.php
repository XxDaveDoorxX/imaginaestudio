<?php
require_once('inc/dbc.php');
require_once('archivo.php');
require_once('resize.php');

class uArchivo extends Archivo {
	
	var $tabla;
	
	var $id;
	var $titulo;
	var $archivo;
	var $id_c;
	
	var $ruta;
	
	function __construct($tabla, $ruta, $temporal, $idarch, $titulo, $archivo, $id_categoria)
	{
		$this->tabla = $tabla;
		
		$this->id = $idarch;
		$this->titulo = $titulo;	//String
		$this->archivo = $archivo;
		$this->id_c = $id_categoria;

		$this->ruta = $ruta;
		$this->ruta_final = $ruta.$archivo;
		$this->r_temp = $temporal;
		
	}
	
	/**** Funciones estandard ****/
	
	function insertar_uarchivo ()
	{
		$this->renombra_archivo();
		if ($this->titulo == "") $this->titulo = $this->archivo;
		
		$this->subir_archivo();
		
  		$conexion = new dbc();
		$result = $conexion->prepare("INSERT INTO ".$this->tabla." (titulo,archivo,id_c) VALUES (?,?,?)");
		//echo "INSERT INTO ".$this->tabla." (titulo,archivo,id_c) VALUES (".$this->titulo.",".$this->archivo.",".$this->id_c.")";
		$result->bind_param("ssi",$this->titulo,$this->archivo,$this->id_c);
		$result->execute();
		$nwid = $result->insert_id;
		$result->close();
		return $nwid;
	}
	
	// * Modificar * //
	function modificar_uarchivo ()
	{
		$psql = "";
		$param = array("","");
		if (!empty($this->archivo)) {
			$tmp = new uArchivo($this->tabla,$this->ruta,'',$this->id,'','',0);
			$tmp->obtener_uarchivo();
			$tmp->eliminar_archivo();
			unset($tmp);
			
			$this->renombra_archivo();
			$this->subir_archivo();
			
			if ($this->titulo == "") $this->titulo = $this->archivo;
			$psql = ", archivo = ?";
			$param = array("s",&$this->archivo);
		}
		$conexion = new dbc();
		$result = $conexion->prepare("UPDATE ".$this->tabla." SET titulo = ?".$psql.", id_c = ? WHERE id = ?");
		call_user_func_array(array($result,"bind_param"),array_filter(array("s".$param[0]."ii",&$this->titulo,$param[1],&$this->id_c,&$this->id)));
		$result->execute();
		$result->close();
	}
	function modificar_titulo_uarchivo ()
	{
		$conexion = new dbc();
		$result = $conexion->prepare("UPDATE ".$this->tabla." SET titulo = ? WHERE id = ?");
		$result->bind_param("si",$this->titulo,$this->id);
		$result->execute();
		$result->close();
	}

	// * Eliminar * //
	function eliminar_uarchivo ()
	{
		if ($this->id) {
			$this->obtener_uarchivo();
			//print_r($this);
			$this->eliminar_archivo();
			//print_r($this);
			
			$conexion = new dbc();
			$result = $conexion->prepare("DELETE FROM ".$this->tabla." WHERE id = ?");
			//echo "DELETE FROM ".$this->tabla." WHERE id = ?";
			$result->bind_param("i",$this->id);
			$result->execute();
			$result->close();
		}
	}
	
	// * Obtener * //
	function obtener_uarchivo ()
	{
		$conexion = new dbc();
		$result = $conexion->prepare("SELECT id,titulo,archivo,id_c FROM ".$this->tabla." WHERE id=?");
		$result->bind_param('i', $this->id);
		$result->execute();
		$result->bind_result($this->id,$this->titulo,$this->archivo,$this->id_c);
		$result->fetch();
		$result->close();
		$this->ruta_final=$this->ruta.$this->archivo;
	}
	
	// * Listar * //
	function listar_uarchivos ()
	{
		$conexion = new dbc();
		$result = $conexion->query("SELECT id,titulo,archivo,id_c FROM ".$this->tabla);
		//echo "SELECT id,titulo,archivo,id_c FROM ".$this->tabla;
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
		$tmp = new uArchivo($this->tabla,$this->ruta,'',0,'','',$this->id_c);
		$archivo = $tmp->listar_x_id_c();
		//print_r($imagenes);
		foreach ($archivo as $elem) {
			$tmp->archivo = $elem['archivo'];
			$tmp->ruta_final = $this->ruta.$elem['archivo'];
			$tmp->eliminar_archivo();
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
		$result = $conexion->prepare("SELECT id,titulo,archivo,id_c FROM ".$this->tabla." WHERE id_c = ?");
		//echo "SELECT id,titulo,archivo,id_c FROM ".$this->tabla." WHERE id_c = ".$this->id_c;
		$result->bind_param('i', $this->id_c);
		$result->execute();
		$result->store_result();
		//$resultarr = $result->get_result();
		$resultados = array();
		while ($row = $result->fetch_assoc()) {
			$resultados[$row['id']] = $row;
		}
		//$resultarr->free();
		$result->close();
		//print_r($resultados);
		return $resultados;
	}
	function listar_1_x_id_c()
	{
		$conexion = new dbc();
		$result = $conexion->prepare("SELECT id,titulo,archivo,id_c FROM ".$this->tabla." WHERE id_c = ? LIMIT 1");
		$result->bind_param('i', $this->id_c);
		$result->execute();
		$result->store_result();
		//$resultarr = $result->get_result();
		$row = $result->fetch_assoc();
			$resultados[$row['id']] = $row;
		//$resultarr->free();
		$result->close();
		return $resultados;
	}
	function listar_solo_id_x_id_c()
	{
		$conexion = new dbc();
		$result = $conexion->prepare("SELECT id FROM ".$this->tabla." WHERE id_c = ?");
		$result->bind_param('i', $this->id_c);
		$result->execute();
		$result->store_result();
		//$resultarr = $result->get_result();
		$resultados = array();
		while ($row = $result->fetch_assoc()) {
			$resultados[$row['id']] = $row['id'];
		}
		//$resultarr->free();
		$result->close();
		return $resultados;
	}
	
	function listar_x_id_c_2($comp)
	{
		$conexion = new dbc();
		$result = $conexion->query("SELECT ".$this->tabla.".id,".$this->tabla.".titulo,".$this->tabla.".archivo,".$this->tabla.".id_c FROM ".$comp);
		//echo "SELECT ".$this->tabla.".id,".$this->tabla.".titulo,".$this->tabla.".archivo,".$this->tabla.".id_c,".$this->tabla.".orden FROM ".$comp;
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
		$s = preg_replace ('/\W+/', '_', str_replace($from,$to,trim($nimagen['filename'])));
		$tactual = time();
		$nw_nombre = $s.$tactual.'.'.$nimagen['extension'];
		while(file_exists($this->ruta.$nw_nombre)) {
			$tactual++;
			$nw_nombre = $s.$tactual.'.'.$nimagen['extension'];
		}
		$this->archivo = $nw_nombre;
		$this->ruta_final = $this->ruta.$nw_nombre;
	}

}
?>