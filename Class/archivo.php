<?php

class Archivo {
	
	var $r_temp;
	var $ruta_final;
	
	function __construct($r_temp,$ruta_fin)
	{
		$this->r_temp=$r_temp;
		$this->ruta_final=$ruta_fin;
	}
	
	function subir_archivo()
	{
		move_uploaded_file($this->r_temp,$this->ruta_final);
	}
	
	function eliminar_archivo()
	{
		if(is_file($this->ruta_final)) {
			@unlink($this->ruta_final);
		}
	}
	
	function modificar_archivo()
	{
		$this->eliminar_archivo();
		$this->subir_archivo();
	}
}
?>