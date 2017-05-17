<?php
class Captcha
{
	var $alto_imagen=45;
	var $ancho_imagen=98;
	var $caracteres="123456789abcdefghijklmnopqrstuvwxyz";
	var $cadena="";
	var $longitud;
	
	function Captcha($longitud=0)
	{
		$this->longitud=$longitud;
		if(!isset($_SESSION)) {
			session_name("users");
			session_start();
		}
		if(isset($_SESSION['captcha'])) {
			$this->cadena=$_SESSION['captcha'];
		} else {
			$this->genera_cadena();
			$_SESSION['captcha']=$this->cadena;
		}
	}
	
	
	function genera_cadena()
	{
		$longitudcadena=strlen($this->caracteres);
		
		if($this->longitud==0)
			$this->longitud=4;
		
		for($i=1;$i<=$this->longitud; $i++) {
			$this->cadena=$this->cadena.$this->caracteres[rand(0,$longitudcadena - 1)];
		}
	}
	
	
	function genera_imagen()
	{
		$this->cadena='';
		$this->genera_cadena();
		
		//echo "\n***** \n";
		//echo $this->cadena;
		//echo "\n***** \n";
		
		$_SESSION['captcha']=$this->cadena;
		$imagen=imagecreatetruecolor($this->ancho_imagen,$this->alto_imagen);
		$imagen_fondo=imagecreatefrompng('fondo_captcha.png');
		imagesettile($imagen,$imagen_fondo);
		imagefilledrectangle($imagen,0,0,$this->ancho_imagen,$this->alto_imagen,IMG_COLOR_TILED);
		$color_texto=imagecolorallocate($imagen,0,0,0);
		
		//$cad = ;
		for ($i=0; $i<$this->longitud; ++$i) {
			$color_texto=imagecolorallocate($imagen,rand(0,0),rand(0,0),rand(0,0));
			imagestring($imagen,5,18+16*$i+rand(0,3),3+rand(0,6),$this->cadena{$i},$color_texto);
		}
		
		header("content-type: image/png");
		imagepng($imagen);
		
		imagedestroy($imagen);
		imagedestroy($imagen_fondo);
	}
	
	
	
	
	function valida_captcha($cadena_validar)
	{
		$bandera=false;
		if(strtoupper($cadena_validar)==strtoupper($this->cadena))
			$bandera=true;
		return $bandera;
	}
	
	

}
?>