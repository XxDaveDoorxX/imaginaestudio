<?php

require_once('../../Class/Clasificador.php');

if(isset($_POST['act'])) {
    $act = $_POST['act'];

    $id = 0;
    if(isset($_POST['id'])) {
        $id = $_POST['id'];
    }

    $slct = 0;
    if(isset($_POST['slct'])) {
        $slct = $_POST['slct'];
    }

    $clstmp = new Clasificador($id);
    $clstmp->obtener_Clasificador();
    $clasificadores = $clstmp->listar_Hijos();

    $asc = $clstmp->listar_Ascendencia();

    if (count($clasificadores) && count($asc) < 3) {


        echo"<tr><td><span>Catg. hija de ".$clstmp->nombre."</span></td>\n<td>";
        echo "<select  class='form-control' name='categ[]' id='slccateg".$id."' onchange='carga_hijos(this)'>\n";
        echo "<option value=''> Seleccionar Clasificaci&oacute;n </option>\n";
        foreach ($clasificadores as $idx => $elem) {
            if ($act != $idx) {
                $slected = "";
                if ($slct == $idx)
                    $slected = "selected='selected'";
                echo "<option ".$slected."value='".$idx."'>".$elem['nombre']."</option>\n";
            }
        }
        echo "</select>\n";
        echo "</td></tr>\n";
    }
}

?>