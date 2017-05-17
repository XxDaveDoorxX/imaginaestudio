<?php
require_once ('inc/dbc.php');

date_default_timezone_set('America/Mexico_City');

Class Data {

    var $id;
    var $nombre;
    var $email;
    var $tel;
    var $comentarios;
    var $dates;
    var $sitio;

    var $tabla="data";


    function __construct($id=0, $nombre='', $email='', $tel='', $comentarios='', $dates='', $sitio ='')
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->email = $email;
        $this->tel = $tel;
        $this->comentarios = $comentarios;
        $this->dates = $dates;
        $this->sitio = $sitio;

    }


    function insertar(){
        $conexion = new dbc();
        $fecha = date("Y-m-d");
        $result = $conexion->prepare("INSERT INTO ".$this->tabla." (nombre,email,tel,comentarios,dates,sitio) VALUES (?,?,?,?,?,?)");
        $result->bind_param("ssssss",$this->nombre,$this->email,$this->tel,$this->comentarios,$fecha,$this->sitio);
        $result->execute();
        $nwid = $result->insert_id;
        if ($nwid) {
            $this->id = $nwid;
        }
        $result->close();
        return $nwid;
    }


    function eliminar ()
    {
        $conexion = new dbc();
        $result = $conexion->prepare("DELETE FROM ".$this->tabla." WHERE id = ?");
        $result->bind_param("i",$this->id);
        $result->execute();
        $result->close();
    }


    function obtener ()
    {
        $conexion = new dbc();
        $result = $conexion->prepare("SELECT id,nombre,email,tel,comentarios,dates,sitio FROM ".$this->tabla." WHERE id = ?");
        $result->bind_param('i', $this->id);
        $result->execute();
        $result->bind_result($this->id,$this->nombre,$this->email,$this->tel,$this->comentarios,$this->dates,$this->sitio);
        $result->fetch();
        $result->close();

    }

    function listar ()
    {
        $conexion = new dbc();
        $result = $conexion->query("SELECT id,nombre,email,tel,comentarios,dates,sitio FROM ".$this->tabla." ORDER BY dates DESC");
        $resultados =array();
        while($row = $result->fetch_assoc()) {
            $resultados[$row['id']] = $row;
        }
        $result->free();
        return $resultados;
    }

}