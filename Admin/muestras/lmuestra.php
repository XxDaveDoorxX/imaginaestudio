<?php
include_once('../../Class/Seguridad.php');
$seguridad = new Seguridad();
$seguridad->candado();

require_once ('../../Class/Servicio.php');
include_once('../../Class/Muestra.php');

$id = 0;
if (isset($_REQUEST['id_serv'])) {
    $id = $_REQUEST['id_serv'];
}

$tmpserv = new Servicio($id,'','',0,array());
$tmpserv->obtener();


$tmpmuestra = new Muestra(0,'', $id);
$muestras = $tmpmuestra->listar_x_id_serv();

// ** Tabla de imagenes **//
$tabla = include('tabla_imagenes.php');
// ** ** //
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
                    <li><a href="../categorias/lcategorias.php">Categoria</a></li>
                    <li><a href="lservicios.php" class="active">Servicios</a></li>
                </ul>
            </div>
            <div class="x-content">
                <div id="main-tab">
                    <div class="x-content-title">
                        <h1>Listado de Muestras</h1>
                        <div class="pull-right">
                            <a class="btn btn-danger" href="fmuestra.php?id_serv=<?php echo $tmpserv->id ?>"><i class="fa fa-bars"></i> Agregar imagenes de muestra</a>
                        </div>
                    </div>
                    <div class="row stacked">
                        <div class="col-md-12">
                            <!-- START DATATABLE EXPORT -->
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table datatable">
                                            <thead>
                                            <tr>
                                                <th width="50">#</th>
                                                <th width="100">Titulo</th>
                                                <th width="150">Acciones</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $cont=0;
                                            foreach ($muestras as $e) {
                                                $cont++;
                                                ?>
                                                <tr id="trow_<?php echo $e['id']; ?>">
                                                    <td width="5"><?php echo $cont ?></td>
                                                    <td><?php echo $e['titulo'] ?></td>
                                                    <td>
                                                        <a class="btn btn-info btn-rounded btn-condensed" href='fmuestra.php?id=<?php echo $e['id']?>&id_serv=<?php echo $tmpserv->id ?>'><span class="fa fa-pencil"></span></a>
                                                        <button class="btn btn-danger btn-rounded btn-condensed btn-sm delte_row_data" onClick="delete_contacto('trow_<?php echo $e['id']; ?>',this);" data-id="<?php echo $e['id']; ?>" data-tbl="<?php echo $tabla; ?>" data-tbla="<?php echo $tablaarch; ?>"><span class="fa fa-times"></span></button>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>


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
<!-- END SCRIPTS -->
<script type="application/x-javascript">

    /*DELETE ROW DATABASE*/

    function delete_contacto(row, obj) {

        var box = $("#mb-remove-row");
        box.addClass("open");

        var $_this = $(obj);

        box.find(".mb-control-yes").on("click", function () {
            box.removeClass("open");
            $("#" + row).hide("slow", function () {
                alert($_this);
                //console.log($_this);
                $.ajax({
                    data:  {'op':'Eliminar', 'id':$_this.data('id'), 'tbl':$_this.data('tbl'), 'tbla':$_this.data('tbla') },
                    url: 'opmuestra.php',
                    type: 'post',
                    success: function (response) {
                        alert(response);
                    }
                });

                $(this).remove();
            });
        });

    }
</script>
</body>
</html>
