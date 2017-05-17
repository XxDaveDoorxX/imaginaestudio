<?php
include_once ('inc/dbc.php');
class Muestra
{

    var $id;
    var $titulo;
    var $id_serv;

    var $tabla = "muestras";


    public function __construct($id=0, $titulo='', $id_serv=0)
    {

        $this->id = $id;
        $this->titulo = $titulo;
        $this->id_serv = $id_serv;

    }



    function insertar () {
        $conexion = new dbc();
        $result = $conexion->prepare("INSERT INTO ".$this->tabla." (titulo,id_serv) VALUES (?,?)");
        $result->bind_param("si",$this->titulo,$this->id_serv);
        $result->execute();
        $nwid = $result->insert_id;
        if ($nwid) {
            $this->id = $nwid;
        }
        $result->close();
        return $nwid;
    }


    function modificar ()
    {
        $conexion = new dbc();
        $result = $conexion->prepare("UPDATE ".$this->tabla." SET titulo = ?, id_serv = ? WHERE id = ?");
        $result->bind_param("sii",$this->titulo,$this->id_serv,$this->id);
        $result->execute();
        $result->close();

        return $this->id;
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
        $result = $conexion->prepare("SELECT id,titulo,id_serv FROM ".$this->tabla." WHERE id=?");
        $result->bind_param('i', $this->id);
        $result->execute();
        $result->bind_result($this->id,$this->titulo,$this->id_serv);
        $result->fetch();
        $result->close();
    }

    function listar ()
    {
        $conexion = new dbc();
        $result = $conexion->query("SELECT id,titulo,id_serv FROM ".$this->tabla);
        $resultados =array();
        while($row = $result->fetch_assoc()) {
            $resultados[] = $row;
        }
        $result->free();
        return $resultados;
    }

    function listar_x_id_serv()
    {
        $conexion = new dbc();
        $result = $conexion->prepare("SELECT id,titulo,id_serv FROM ".$this->tabla." WHERE id_serv = ?");
        $result->bind_param('i', $this->id_serv);
        $result->execute();
        $result->store_result();
        $resultados = array();
        while ($row = $result->fetch_assoc()) {
            $resultados[$row['id']] = $row;
        }
        $result->close();
        return $resultados;
    }


    function obtener_x_servicio ()
    {
        $conexion = new dbc();
        $result = $conexion->prepare("SELECT id,titulo,id_serv FROM ".$this->tabla." WHERE id_serv = ?");
        $result->bind_param('i',$this->id_serv);
        $result->execute();
        $result->store_result();
        $result->bind_result($this->id,$this->titulo,$this->id_serv);
        $result->fetch();
        $result->close();
    }


    function eliminar_x_servicio ()
    {
        $conexion = new dbc();
        $result = $conexion->prepare("DELETE FROM ".$this->tabla." WHERE id_serv = ?");
        $result->bind_param("i",$this->id_serv);
        $result->execute();
        $result->close();
    }

}