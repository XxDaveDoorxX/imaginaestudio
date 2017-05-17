<?php
require_once ('inc/dbc.php');
require_once ('SubXCategoria.php');

// ** Subcategoría de Productos [Productos => Clasificadores] **
class Clasificador {		
	
	var $id;
	var $nombre;
	var $descripcion;
	var $ruta;
	
	var $tabla = 'categorias';
	var $relacion = 'categoriasxservicio';
	

	
	function __construct ($id=0, $nom='Raiz', $desc='', $ascend=array('0'))
	{
		$this->id = $id;
		$this->nombre = $nom;
		$this->descripcion = $desc;
		$this->ruta = $this->preparar_Ruta($ascend);

		
	}
	
	function insertar_Clasificador ()
	{
		//if (empty($this->ruta)){
			
		//}
		//print_r ($this);
		$conexion = new dbc();
		$result = $conexion->prepare("INSERT INTO ".$this->tabla." (nombre,descripcion,ruta) VALUES (?,?,?)");
		$result->bind_param("sss",$this->nombre,$this->descripcion,$this->ruta);
		$result->execute();
		$nwid = $result->insert_id;
		if ($nwid) {
			$this->id = $nwid;
		}
		$result->close();

		
		return $nwid;
	}
	
	function modificar_Clasificador ()
	{
		$new = clone $this;
		$this->obtener_Clasificador();
		
		$conexion = new dbc();
		
		
		$result1 = $conexion->prepare("update ".$this->tabla." set ruta = replace(ruta,?,?) WHERE ruta LIKE concat(?,'/%')");
		$dir = $this->ruta.$this->id;
		$result1->bind_param("sss",$this->ruta,$new->ruta,$dir);
		$result1->execute();
		$result1->close();
	
		$result2 = $conexion->prepare("update ".$this->tabla." set nombre = ?, descripcion = ?, ruta = ? WHERE id = ?");
		$result2->bind_param("sssi",$new->nombre, $new->descripcion, $new->ruta, $this->id);
		$result2->execute();
		$result2->close();

	
		
	}
	
	function eliminar_Clasificador ()
	{
		$this->obtener_Clasificador();
		$conexion = new dbc();
		// Borrar de la tabla de relaciones
		
		$result = $conexion->prepare("select id from ".$this->tabla." WHERE ruta LIKE concat(?,'/%')");
		$dir = $this->ruta.$this->id;
		$result->bind_param("s", $dir);
		$result->execute();
		$result->bind_result();
		while ($row = $result->fetch_assoc()) {
			$sxctmp = new SubXCategoria($this->relacion,array(0),array($row['id']),array(0));
			$sxctmp->desasignar_id_Categoria();
		}
		//$result->free();
		$result->close();
		
		
		
		$sxctmp = new SubXCategoria($this->relacion,array(0),array($this->id),array(0));
		$sxctmp->desasignar_id_Categoria();
		
		// Borrar de esta tabla
		$result1 = $conexion->prepare("delete from ".$this->tabla." WHERE ruta LIKE concat(?,'/%')");
		$dir = $this->ruta.$this->id;
		$result1->bind_param("s",$dir);
		$result1->execute();
		$result1->close();
	
		$result2 = $conexion->prepare("delete from ".$this->tabla." WHERE id = ?");
		$result2->bind_param("i",$this->id);
		$result2->execute();
		$result2->close();
	
	}
	
	function obtener_Clasificador ()
	{
		if ($this->id) {
			
			$conexion = new dbc();
			$result = $conexion->prepare("SELECT id,nombre,descripcion,ruta FROM ".$this->tabla." WHERE id=?");
			$result->bind_param('i', $this->id);
			$result->execute();
			$result->bind_result($this->id,$this->nombre,$this->descripcion,$this->ruta);
			$result->fetch();
			$result->close();
		}
	}	
	
	function listar_Clasificadores ()
	{
		$conexion = new dbc();

		$result = $conexion->query("SELECT id,nombre,descripcion,ruta FROM ".$this->tabla);
		$resultados = array();
		while($row = $result->fetch_assoc()) {
			
			$resultados[$row['id']] = $row;
		}
		$result->free();
		
		return $resultados;
		
		
	}
	
	// *****************************
	// ***** Funciones propias *****
	// *****************************
	
	function preparar_Ruta ($descendts) {
		//print_r($descendts);
		$ruta = "";
		if ($descendts[0] != '0') {
			$ruta = "0/";
			foreach ((array)$descendts as $elem) {
				if ($elem != "")
					$ruta .= $elem."/";
			}
		}
		return $ruta;
	}
	
	function listar_Ascendencia ()
	{
		$rutab = $this->ruta.$this->id."/";
		
		$conexion = new dbc();
		
		$result = $conexion->query("SELECT id,nombre,descripcion,ruta FROM ".$this->tabla." WHERE '".$rutab."' LIKE concat(ruta,id,'%') order by ruta asc");
		$resultados = array();
		$resultados[0] = array('id' => '0','nombre' => 'Raiz','descripcion' => '','ruta' => '');
		while($row = $result->fetch_assoc()) {
			if ($row['id'] != $this->id) {
			
				$resultados[$row['id']] = $row;
			}
		}
		$result->free();
		
		
		return $resultados;
		
	}
	
	function listar_Descendencia ()
	{
		$rutab = $this->ruta.$this->id."/";
		
		$conexion = new dbc();
		
		$result = $conexion->query("select id,nombre,descripcion,ruta from ".$this->tabla." WHERE ruta LIKE '".$rutab."%' order by ruta asc");
		$resultados = array();
		while($row = $result->fetch_assoc()) {
			
			$resultados[$row['id']] = $row;
		}
		$result->free();
		
		
		return $resultados;
	}
	
	function listar_Hijos ()
	{
		$rutab = $this->ruta.$this->id."/";
		
		$conexion = new dbc();
		
		$result = $conexion->query("select id,nombre,descripcion,ruta from ".$this->tabla." WHERE ruta LIKE '".$rutab."'ORDER BY id ASC");
		//echo "select id,nombre,descripcion,ruta from ".$this->tabla." WHERE ruta LIKE '".$rutab."'";
		$resultados = array();
		while($row = $result->fetch_assoc()) {
			
			$resultados[$row['id']] = $row;
		}
		$result->free();
		
		
		return $resultados;
	}
	
}
?>