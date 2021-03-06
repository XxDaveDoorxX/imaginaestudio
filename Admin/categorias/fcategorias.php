<?php
include_once('../../Class/Seguridad.php');
$seguridad = new Seguridad();
$seguridad->candado();

include_once('../../Class/Clasificador.php');

$op = 'Agregar';
if(isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];
    $op = 'Modificar';
} else {
    $id = 0;
}

$id = 0;
if(isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];
}

$clstmp = new Clasificador($id);
$clstmp->obtener_Clasificador();

//print_r($clstmp);
//echo "\n".$id."\n";

if ($id) {
    $asctmp = $clstmp->ruta;
} else {
    $asctmp = '0/';
    if (isset($_REQUEST['asc'])) {
        if ($_REQUEST['asc'] != "")
            $asctmp = $_REQUEST['asc'];

    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- META SECTION -->
    <title>Imagina Estudio | Dashboard</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>

    <link rel="icon" href="favicon.ico" type="image/x-icon"/>
    <!-- END META SECTION -->

    <!-- CSS INCLUDE -->
    <link rel="stylesheet" type="text/css" id="theme" href="../assets/css/theme-default.css"/>
    <!-- EOF CSS INCLUDE -->
</head>
<body class="x-dashboard">
<!-- START PAGE CONTAINER -->
<div class="page-container">
    <!-- PAGE CONTENT -->
    <div class="page-content">
        <!-- PAGE CONTENT WRAPPER -->
        <div class="page-content-wrap">

            <div class="x-hnavigation">
                <div class="x-hnavigation-logo">
                    <a href=".">Imagina Estudio</a>
                </div>
                <div class="x-features">
                    <div class="x-features-nav-open">
                        <span class="fa fa-bars"></span>
                    </div>
                    <div class="pull-right">
                        <div class="x-features-profile">
                            <img src="../assets/images/users/avatar.jpg">
                            <ul class="xn-drop-left animated zoomIn">
                                <li><a href="javascript:;" class="mb-control" data-box="#mb-signout"><span
                                            class="fa fa-sign-out"></span> Cerrar Sesión</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="x-content-tabs">
                <ul>
                    <li><a href="../home.php" class="icon"><span class="fa fa-desktop"></span></a></li>
                    <li><a href="lcategorias.php" class="active">Categoria</a></li>
                    <li><a href="../servicios/lservicios.php">Servicios</a></li>
                </ul>
            </div>
            <div class="x-content">
                <div id="main-tab">
                    <div class="x-content-title">
                        <h1>Formulario de categorias</h1>
                    </div>
                    <div class="row stacked">
                        <div class="col-md-12">
                            <!-- START DATATABLE EXPORT -->
                            <div class="panel panel-default">
                                <div class="panel-body">

                                    <form class="form-horizontal" id="frmclsf" action="opcategoria.php" method="post">
                                        <input type="hidden" name="id" id="txtid" value="<?php echo $clstmp->id; ?>" />
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h3 class="panel-title"> <strong>Formulario</strong> Categorías</h3>
                                            </div>
                                            <div class="panel-body">

                                                <div class="form-group">
                                                    <label class="col-md-3 col-xs-12 control-label">Nombre de la Categoría</label>
                                                    <div class="col-md-6 col-xs-12">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                            <input type="text" name="nombre" class="form-control" id="txtnombre" value="<?php if ($id) { echo $clstmp->nombre; } ?>" onblur="listaasc();"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 col-xs-12 control-label">Categoria</label>
                                                    <div class="col-md-6 col-xs-12">
                                                        <div class="col-sm-12">
                                                            <div id="lstcategorias"></div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-md-3 col-xs-12 control-label">Categoria Existente</label>
                                                    <div class="col-md-6 col-xs-12">
                                                        <table>
                                                            <tbody id="selectcat" >
                                                            </tbody>
                                                        </table>
                                                        <?php include_once ('script_cate.php'); ?>
                                                    </div>
                                                </div>


                                            </div>
                                            <div class="panel-footer">
                                                <input class="btn btn-default" name="op" id="btncancelar" value="Cancelar" onclick="window.location='lcategorias.php?id=<?php array_pop($asctmp); $tmp = end($asctmp); echo $tmp; ?>'">
                                                <input type="submit" name="op" class="btn btn-primary pull-right" value="<?php echo $op; ?>"/>
                                            </div>
                                        </div>
                                    </form>



                                </div>
                            </div>
                            <!-- END DATATABLE EXPORT -->
                        </div>
                    </div>
                </div>
            </div>
            <!--<div class="x-content-footer">
                Copyright © 2016 Imagina Estudio. All rights reserved
            </div>-->
        </div>
        <!-- END PAGE CONTENT WRAPPER -->
    </div>
    <!-- END PAGE CONTENT -->
</div>
<!-- END PAGE CONTAINER -->
<div class="x-content-footer custom-footer">
    Copyright © 2016 Imagina Estudio. All rights reserved
</div>

<!-- MESSAGE BOX-->
<div class="message-box animated fadeIn" data-sound="alert" id="mb-remove-row">
    <div class="mb-container">
        <div class="mb-middle">
            <div class="mb-title"><span class="fa fa-times"></span> Eliminar <strong>Datos</strong> ?</div>
            <div class="mb-content">
                <p>¿Seguro que quieres eliminar esta fila?</p>
                <p>Presione Sí, si Seguro.</p>
            </div>
            <div class="mb-footer">
                <div class="pull-left">
                    <button class="btn btn-success btn-lg mb-control-yes">Si</button>
                    <button class="btn btn-default btn-lg mb-control-close">No</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END MESSAGE BOX-->

<!-- MESSAGE BOX-->
<div class="message-box animated fadeIn" data-sound="alert" id="mb-signout">
    <div class="mb-container">
        <div class="mb-middle">
            <div class="mb-title"><span class="fa fa-sign-out"></span> Log <strong>Out</strong> ?</div>
            <div class="mb-content">
                <p>¿ Seguro que quieres cerrar sesión ?</p>
                <p>Pulse No si desea continuar con el trabajo . Pulse Sí para cerrar la sesión de usuario actual.</p>
            </div>
            <div class="mb-footer">
                <div class="pull-right">
                    <a href="../resources/logout.php" class="btn btn-success btn-lg">Yes</a>
                    <button class="btn btn-default btn-lg mb-control-close">No</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END MESSAGE BOX-->

<!-- START PRELOADS -->
<audio id="audio-alert" src="../assets/audio/alert.mp3" preload="auto"></audio>
<audio id="audio-fail" src="../assets/audio/fail.mp3" preload="auto"></audio>
<!-- END PRELOADS -->

<!-- START SCRIPTS -->
<!-- START PLUGINS -->
<script type="text/javascript" src="../assets/js/plugins/jquery/jquery.min.js"></script>
<script type="text/javascript" src="../assets/js/plugins/jquery/jquery-ui.min.js"></script>
<script type="text/javascript" src="../assets/js/plugins/bootstrap/bootstrap.min.js"></script>
<!-- END PLUGINS -->

<!-- START THIS PAGE PLUGINS-->
<script type='text/javascript' src='../assets/js/plugins/icheck/icheck.min.js'></script>
<script type="text/javascript" src="../assets/js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>
<script type="text/javascript" src="../assets/js/plugins/scrolltotop/scrolltopcontrol.js"></script>

<script type="text/javascript" src="../assets/js/plugins/morris/raphael-min.js"></script>
<script type="text/javascript" src="../assets/js/plugins/morris/morris.min.js"></script>
<script type="text/javascript" src="../assets/js/plugins/rickshaw/d3.v3.js"></script>
<script type="text/javascript" src="../assets/js/plugins/rickshaw/rickshaw.min.js"></script>
<script type='text/javascript' src='../assets/js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js'></script>
<script type='text/javascript' src='../assets/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js'></script>
<script type='text/javascript' src='../assets/js/plugins/bootstrap/bootstrap-datepicker.js'></script>
<script type="text/javascript" src="../assets/js/plugins/owl/owl.carousel.min.js"></script>

<script type="text/javascript" src="../assets/js/plugins/moment.min.js"></script>
<script type="text/javascript" src="../assets/js/plugins/daterangepicker/daterangepicker.js"></script>


<script type="text/javascript" src="../assets/js/plugins/datatables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="../assets/js/plugins/tableexport/tableExport.js"></script>
<script type="text/javascript" src="../assets/js/plugins/tableexport/jquery.base64.js"></script>
<script type="text/javascript" src="../assets/js/plugins/tableexport/html2canvas.js"></script>
<script type="text/javascript" src="../assets/js/plugins/tableexport/jspdf/libs/sprintf.js"></script>
<script type="text/javascript" src="../assets/js/plugins/tableexport/jspdf/jspdf.js"></script>
<script type="text/javascript" src="../assets/js/plugins/tableexport/jspdf/libs/base64.js"></script>

<!-- END THIS PAGE PLUGINS-->

<!-- START TEMPLATE -->
<script type="text/javascript" src="../assets/js/plugins.js"></script>
<script type="text/javascript" src="../assets/js/actions.js"></script>
<script type="text/javascript" src="../assets/js/demo_dashboard_x.js"></script>
<!-- END TEMPLATE -->
</body>
</html>
