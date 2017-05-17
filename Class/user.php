<?php
require_once ('inc/dbc.php');

class User
{
    var $id;
    var $name;
    var $password;

    var $tabla = "users";


    function __construct($id = 0, $name = "", $password="")
    {
        $this->name = $name;
        $this->password = $password;
    }


    function list_user ()
    {
        $conexion = new dbc();
        $result = $conexion->query("SELECT id,name,password FROM ".$this->tabla);
        $resultados =array();
        while($row = $result->fetch_assoc()) {
            $resultados[] = $row;
        }
        $result->free();

        return $resultados;
    }

    function get_user ()
    {
        $conexion = new dbc();
        $result = $conexion->prepare("SELECT id,name,password FROM ".$this->tabla." WHERE id=?");
        $result->bind_param('i',$this->id);
        $result->execute();
        $result->bind_result($this->id,$this->name,$this->password);
        $result->fetch();
        $result->close();
    }


    function login()
    {
        $conexion = new dbc();
        $result = $conexion->prepare("SELECT id FROM ".$this->tabla." WHERE name=? AND password=MD5(?)");
        $result->bind_param('ss',$this->name,$this->password);
        $result->execute();
        $result->bind_result($this->id);
        $result->fetch();
        $result->close();

    }

}