<?php
include_once('../Class/Seguridad.php');
$seguridad=new Seguridad();
$seguridad->candado();

require_once('../Class/data.php');


$tmpdata = new Data(0,'','','','');
$data = $tmpdata->listar();


header('Content-type: application/vnd.ms-excel');

header("Content-Disposition: attachment; filename=Registros_web_imaginaestudio_formulario_contacto.xls");

header("Pragma: no-cache");

header("Expires: 0");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Datos de contacto</title>

</head>

<body>
        <table border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
            	<th style="background-color:#f9a720; text-align:center; color:#FFF;">#</th>
                <th style="background-color:#f9a720; text-align:center; color:#FFF;">Nombre</th>
				<th style="background-color:#f9a720; text-align:center; color:#FFF;">Email</th>
                <th style="background-color:#f9a720; text-align:center; color:#FFF;">Teléfono</th>
                <th style="background-color:#f9a720; text-align:center; color:#FFF;">Comentarios</th>
            </tr>
		<?php
		$cont=0;
		foreach ($data as $e) {
			$cont++;
			
					echo'<tr>';
						echo'<td align="center">'.$cont.'</td>';
						echo'<td align="center">'.$e['nombre'].'</td>';
						echo'<td align="center">'.$e['email'].'</td>';
						echo'<td align="center">'.$e['tel'].'</td>';
						echo'<td align="center">'.$e['comentarios'].'</td>';
					echo'</tr>';
				}
        ?>
        </tr>
           </table>
			
</body>

</html>