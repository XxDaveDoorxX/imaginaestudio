<?php 
require_once ('inc/dbc.php');

// ** Interfaz entre Subcategoría y Categoría: UNO--UNO, UNO--MUCHOS, MUCHOS--MUCHOS **
class SubXCategoria
{
	var $tabla;
	
	var $id;
	var $id_c;
	var $id_sc;
	
	function __construct ($tabla, $id, $id_sc, $id_c)
	{
		$this->tabla = $tabla;
		
		$this->id = (array)$id;
		$this->id_sc = (array)$id_sc;
		$this->id_c = (array)$id_c;
	}
	
	function asignar_id_subCategorias ()
	{
		$conexion = new dbc();
		foreach ($this->id_sc as $elem) {
			//print_r($this);
			$result = $conexion->prepare("INSERT INTO ".$this->tabla." (id_sc,id_c) VALUES (?,?)");
			//print_r("INSERT INTO ".$this->tabla." (id_sc,id_c) VALUES ($e,$this->id_c[0])");
			$result->bind_param("ii",$elem,$this->id_c[0]);
			$result->execute();
			$result->close();
		}
	}
	
	function modificar_id_subCategorias ()
	{
		$this->desasignar_id_subCategorias();
		$this->asignar_id_subCategorias();
	}
	
	function desasignar_id_subCategorias () 	// Utilizado al eliminar Categorías
	{
		$conexion = new dbc();
		$result = $conexion->prepare("DELETE FROM ".$this->tabla." WHERE id_c = ?");
		$result->bind_param("i",$this->id_c[0]);
		$result->execute();
		$result->close();
	}
	
	function obtener_ids_subCategoria ()
	{
		$conexion = new dbc();
		$result = $conexion->prepare("SELECT id,id_sc FROM ".$this->tabla." WHERE id_c=?");
		$result->bind_param('i', $this->id_c[0]);
		$result->execute();
		$result->bind_result($id,$id_sc);
		$this->id = $this->id_sc = array();
		while($result->fetch()){
			$this->id[] = $id;
			$this->id_sc[] = $id_sc;
		}
		$result->close();
	}
	function obtener_ids_Categoria ()
	{
		$conexion = new dbc();
		$result = $conexion->prepare("SELECT id,id_c FROM ".$this->tabla." WHERE id_sc=?");
		$result->bind_param('i', $this->id_sc[0]);
		$result->execute();
		$result->bind_result($id,$id_c);
		$this->id = $this->id_c = array();
		while($result->fetch()){
			$this->id[] = $id;
			$this->id_c[] = $id_c;
		}
		$result->close();
	}
	
	function desasignar_id_Categoria () 	// Utilizado al eliminar SUBCategorías
	{
		$conexion = new dbc();
		$result = $conexion->prepare("DELETE FROM ".$this->tabla." WHERE id_sc = ?");
		$result->bind_param("i",$this->id_sc[0]);
		$result->execute();
		$result->close();
	}
	function desasignar_id_subCategoria () 	// Utilizado al eliminar Categorías
	{
		$conexion = new dbc();
		$result = $conexion->prepare("DELETE FROM ".$this->tabla." WHERE id_c = ?");
		$result->bind_param("i",$this->id_c[0]);
		$result->execute();
		$result->close();
	}

	// Listar correspondencia subcategoría - categoría (recibe nombres de tablas)
	function listar_SubXCategoria ($tblsub)
	{
		$conexion = new dbc();
		
		$result = $conexion->query("SELECT ".$this->tabla.".id,".$tblsub.".id,".$tblsub.".nombre,".$this->tabla.".id_c,".$this->tabla.".id_sc FROM ".$this->tabla.",".$tblsub." WHERE ".$tblsub.".id = ".$this->tabla.".id_sc");
		$resultados = array();
		while($row = $result->fetch_assoc()) {
			$resultados[$row['id']] = $row;
		}
		$result->free();
		return $resultados;

	}
	
	// Elimina correspondencia subcategoría - categoría
	function elimina_SubXCategoria ()
	{
		$conexion = new dbc();
		$result = $conexion->prepare("DELETE FROM ".$this->tabla." WHERE id = ?");
		$result->bind_param("i",$this->id[0]);
		$result->execute();
		$result->close();
	}
	
	/*function existe_Par ($id_sc, $id_c)
	{
		$bandera = false;
		$conexion = new ConexionBaseDatos ();
		$sql = "select * from ".$this->tabla." where id_sc=".$id_sc." and id_c=".$id_c;
		$result = $conexion->ejecutar_consulta($sql);
		if (mysqli_num_rows($result) > 0) {
			$bandera = true;
		}
		return $bandera;
	}*/
}
?>