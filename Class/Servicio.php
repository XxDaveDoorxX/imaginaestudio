<?php
include_once ('inc/dbc.php');
include_once ('SubXCategoria.php');
class Servicio
{
    var $id;
    var $titulo;
    var $descripcion;
    var $precio;

    var $tabla = "servicios";

    var $relacion = "categoriasxservicio";

    var $clasificadores;


    function __construct($id = 0, $titulo = '', $descripcion = '', $precio = 0, $clasif=array('0'))
    {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->descripcion = $descripcion;
        $this->precio = $precio;
        $this->clasificadores = new SubXCategoria($this->relacion,array(0),$clasif,array($id));
    }

    function insertar(){
        $conexion = new dbc();
        $result = $conexion->prepare("INSERT INTO ".$this->tabla." (titulo,descripcion,precio) VALUES (?,?,?)");
        $result->bind_param("sss", $this->titulo, $this->descripcion, $this->precio);
        $result->execute();
        $nwid = $result->insert_id;
        if($nwid){
            $this->id = $nwid;
            $this->clasificadores->id_c = array($nwid);
        }
        $this->clasificadores->asignar_id_subCategorias();
        $result->close();
        return $nwid;
    }


    function modificar(){
        $conexion = new dbc();
        $result = $conexion->prepare("UPDATE ".$this->tabla." SET titulo = ?, descripcion = ?, precio = ?  WHERE id = ?");
        $result->bind_param("sssi",$this->titulo, $this->descripcion, $this->precio, $this->id);
        $result->execute();
        $result->close();

        $this->clasificadores->modificar_id_subCategorias();
        return $this->id;
    }


    function eliminar ()
    {
        $conexion = new dbc();
        $result = $conexion->prepare("DELETE FROM ".$this->tabla." WHERE id = ?");
        $result->bind_param("i",$this->id);
        $result->execute();
        $result->close();

        $this->clasificadores->desasignar_id_subCategorias();
    }


    function obtener ()
    {
        $conexion = new dbc();
        $result = $conexion->prepare("SELECT id,titulo,descripcion,precio FROM ".$this->tabla." WHERE id=?");
        $result->bind_param('i', $this->id);
        $result->execute();
        $result->bind_result($this->id,$this->titulo,$this->descripcion,$this->precio);
        $result->fetch();
        $result->close();

        $this->clasificadores->obtener_ids_subCategoria();
    }

    function listar ()
    {
        $conexion = new dbc();
        $result = $conexion->query("SELECT id,titulo,descripcion,precio FROM ".$this->tabla);
        $resultados =array();
        while($row = $result->fetch_assoc()) {

            $row['clasificadores'] = new SubXCategoria($this->relacion,array(0),array(0),array($row['id']));
            $row['clasificadores']->obtener_ids_subCategoria();
            $resultados[] = $row;
        }
        $result->free();

        return $resultados;
    }

    function listar_clasificador_Servicios ()
    {
        $resultados = array();
        $total = array(0);
        if(!empty($this->clasificadores->id_sc)) {
            $this->clasificadores->obtener_ids_Categoria();
            $servs = array_unique($this->clasificadores->id_c);
            $serv_lst = "id=0";
            if(!empty($servs)) {
                $serv_lst = $u = "";
                foreach($servs as $e) {
                    $serv_lst .= $u." id=".$e;
                    $u = " OR";
                }
            }
            $conexion = new dbc();
            //print_r("SELECT COUNT(id_prod) FROM ".$this->tabla." WHERE ".$serv_lst);
            $result = $conexion->query("SELECT COUNT(id) FROM ".$this->tabla." WHERE ".$serv_lst);
            $total = $result->fetch_row();
            $result->free();

            $result = $conexion->query("SELECT id,titulo,descripcion,precio FROM ".$this->tabla." WHERE ".$serv_lst);

            while($row = $result->fetch_assoc()){

                $resultados[] = $row;
            }
            $result->free();
        }

        return array($resultados, $total[0]);
    }


    function listar_filtrado_Servicios ()
    {
        $resultados = array();
        $total = array(0);
        $serv_lst = "";

        if(!empty($this->clasificadores->id_sc)) {
            $this->clasificadores->obtener_ids_Categoria();
            $servs = array_unique($this->clasificadores->id_c);
            if(!empty($servs)) {
                $u = "";
                $serv_lst = "(";
                foreach($servs as $e) {
                    $serv_lst .= $u." id=".$e;
                    $u = " OR";
                }
                $serv_lst .= ")";
            }
        }

        if (empty($serv_lst)) {
            $serv_lst = "(id=0) AND (id=-1)";
        }

        $conexion = new dbc();
        $result = $conexion->query("SELECT COUNT(id) FROM ".$this->tabla." WHERE ".$serv_lst);
        $total = $result->fetch_row();
        $result->free();

        $result = $conexion->query("SELECT id,titulo,descripcion,precio FROM ".$this->tabla." WHERE ".$serv_lst);
        while($row = $result->fetch_assoc()){
            $resultados[] = $row;
        }
        $result->free();

        return array($resultados, $total[0]);
    }
}