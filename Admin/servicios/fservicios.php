<?php
include_once('../../Class/Seguridad.php');
$seguridad = new Seguridad();
$seguridad->candado();

require_once ('../../Class/Servicio.php');
include_once('../../Class/Clasificador.php');

$id = 0;
$op = 'Agregar';
if (isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];
    $op = 'Modificar';
}

$tmpserv = new Servicio($id,'','',0,array());
$tmpserv->obtener();


$clasifs = array(0);
if($id)
    $clasifs = $tmpserv->clasificadores->id_sc;



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
    <link rel="stylesheet" type="text/css" href="../assets/css/parsley/parsley.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/bwizard/bwizard.min.css">
    <link rel="stylesheet" type="text/css" id="fakeLoader" href="../assets/css/pleasewait/fakeLoader.css">
    <!-- EOF CSS INCLUDE -->
    <!-- START STYLE -->
    <link rel="stylesheet" type="text/css" id="form-none-panel" href="../assets/css/form-none-panel.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/summernote/summernote.css">
    <!-- END STYLE -->
    <script type="text/javascript" src="../assets/js/plugins/jquery/jquery.min.js"></script>
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
                        <h1>Formulario de Servicios</h1>
                        <div class="pull-right">
                            <a class="btn btn-danger" href="fcategorias.php"><span class="fa fa-bars"></span> Agregar Servicio</a>
                        </div>
                    </div>
                    <div class="row stacked">
                        <div class="col-md-12">
                            <!-- START WIZARD WITH VALIDATION -->
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <h3>Formulario servicios</h3>
                                    <!-- begin form-wizard -->
                                    <form action="javascript:;" method="POST" data-parsley-validate="true" name="form-wizard" class="form-input-flat">
                                        <input type="hidden" id="hdntblf1" name="tbl" value="<?php echo $tabla; ?>" />
                                        <!-- begin #wizard -->
                                        <div id="wizard">
                                            <ol>
                                                <li>
                                                    Información del servicio
                                                    <small>Escriba la información</small>
                                                </li>
                                                <li>
                                                    Imagen
                                                    <small>Arrastre o eliga la imagen</small>
                                                </li>
                                                <li>
                                                    Completo
                                                    <small>Confirmar </small>
                                                </li>
                                            </ol>
                                            <!-- begin wizard step-1 -->
                                            <div class="wizard-step-1">
                                                <fieldset>
                                                    <!-- begin row -->
                                                    <div class="row">
                                                        <!-- begin col-6 -->
                                                        <div class="col-md-12">
                                                            <h3 class="form-header form-header-lg m-b-10">Escriba la información del servicio</h3>
                                                            <div class="height-xs">

                                                                <div class="form-group">
                                                                    <label>Titulo del servicio</label>
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                                        <input data-parsley-id="2967" name="titulo" id="titulo" class="form-control input-lg" data-parsley-group="wizard-step-1" value="<?php echo $tmpserv->titulo  ?>" required type="text"><ul id="parsley-id-2967" class="parsley-errors-list"></ul>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Precio</label>
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                                        <input data-parsley-id="2967" name="precio" id="precio" class="form-control input-lg" data-parsley-group="wizard-step-1" value="<?php echo $tmpserv->precio  ?>" required type="text"><ul id="parsley-id-2967" class="parsley-errors-list"></ul>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Descripción</label>
                                                                    <textarea  name="descripcion" id="summernote" class="summernote"><?php echo $tmpserv->descripcion ?></textarea>
                                                                </div>

                                                                <div class="m-b-20">
                                                                    <a href="javascript:;" id="lnkaddslc" style="text-decoration:none;font-size:14px;">Agregar categor&iacute;a</a>
                                                                    <div>
                                                                        <div class="form-group">
                                                                            <label class="control-label col-sm-3">Categorías <span class="text-danger">*</span></label>
                                                                            <div id="cclsf"></div>
                                                                            <script type="text/javascript">
                                                                                var cclsf = $('#cclsf');
                                                                                var cnt = 0;
                                                                                $(document).ready(function(){

                                                                                    init();
                                                                                    $('#lnkaddslc').click(function(e) {
                                                                                        gpo=cr_gposlct();
                                                                                        cr_slct(gpo,0,'');
                                                                                    });
                                                                                    $(document).on('click','a.lnkdelslc',function(e){
                                                                                        $(this).parent().remove();
                                                                                    });
                                                                                    $(document).on('change','select.slcclsf',function(e){
                                                                                        //alert("algo cambio...");
                                                                                        var prntdiv = $(this).parent();
                                                                                        //alert ("Ant: "+prntdiv.attr('id'));
                                                                                        prntdiv.find('>div').remove();
                                                                                        var v = $(this).val();
                                                                                        //alert (v);
                                                                                        var ndivslc = $('<div style="paddig:5px;"></div>').attr('id','chs'+v);
                                                                                        prntdiv.append(ndivslc);
                                                                                        mod_slct(prntdiv,v,'');
                                                                                    });

                                                                                });

                                                                                function cr_opts (prnt,slc,opt) {
                                                                                    //alert("algo");
                                                                                    $.ajax({
                                                                                        type: 'POST',
                                                                                        url: 'cargaclasificadores.php',
                                                                                        dataType: 'json',
                                                                                        data: 'id='+slc,
                                                                                        async: false,
                                                                                        success: function(data) {
                                                                                            //alert(data);
                                                                                            if (data){
                                                                                                var selec = $('<select id="select-required" data-parsley-required="true"></select>').attr('class','slcclsf');
                                                                                                var vopt = $('<option></option>').val('').html('Seleccionar Categor&iacute;a');
                                                                                                selec.append(vopt);
                                                                                                $.each(data,function(i,e){
                                                                                                    var vopt = $('<option></option>').val(e.id).text(e.nombre);
                                                                                                    //alert(vopt);
                                                                                                    selec.append(vopt);
                                                                                                });
                                                                                                selec.val(opt);
                                                                                                prnt.append(selec);
                                                                                                var slcclsf = $('<div></div>').attr('id','chs'+opt);
                                                                                                prnt.append(slcclsf);
                                                                                            }
                                                                                        }
                                                                                    });
                                                                                }

                                                                                function mod_slct (prntdiv,slc,opt) {
                                                                                    prnt=prntdiv.find('#chs'+slc);
                                                                                    cr_opts(prnt,slc,opt);
                                                                                    if (slc){
                                                                                        prntdiv.parents('div[id*="gpoclsf"]').children('input:hidden').val(slc);
                                                                                    } else {
                                                                                        pid=prntdiv.attr('id').replace(/chs/,'');
                                                                                        prntdiv.parents('div[id*="gpoclsf"]').children('input:hidden').val(pid);
                                                                                    }

                                                                                }

                                                                                function cr_slct (gpo,slc,opt) {
                                                                                    prnt=$('#gpoclsf'+gpo).find('#chs'+slc);
                                                                                    cr_opts(prnt,slc,opt);
                                                                                    if (opt)
                                                                                        $('#gpoclsf'+gpo).find('#iclasif'+gpo).val(opt);
                                                                                }

                                                                                function cr_gposlct () {
                                                                                    var n = cnt++;
                                                                                    var gpoclsf = $('<div></div>').attr('id','gpoclsf'+n).css({'border':'1px dotted #aaa','margin':'8px', 'padding':'2px'});
                                                                                    cclsf.append(gpoclsf);
                                                                                    var slcclsf = $('<div ></div>').attr('id','chs0');
                                                                                    gpoclsf.append(slcclsf);
                                                                                    var clasif = $('<input/>').attr({id:'iclasif'+n, name:'clasif[]',type:'hidden'});
                                                                                    gpoclsf.append(clasif);
                                                                                    var lnkdel = $('<a></a>').attr({href:'javascript:;',class:'lnkdelslc'}).text('Borrar');
                                                                                    gpoclsf.append(lnkdel);
                                                                                    return n;
                                                                                }

                                                                                function init () {
                                                                                    <?php
                                                                                    if (empty($clasifs)){
                                                                                        $clasifs= array(0);

                                                                                    }
                                                                                    foreach ($clasifs as $e) {
                                                                                        $asctmp = '0/';
                                                                                        if ($e) {
                                                                                            $clsftmp = new Clasificador($e);
                                                                                            $clsftmp->obtener_Clasificador();
                                                                                            $asctmp = $clsftmp->ruta;

                                                                                            //print_r($clsftmp);
                                                                                        }

                                                                                        $asctmp = explode('/',$asctmp.$e);
                                                                                        $asctmp = array_filter($asctmp,'strlen');

                                                                                        $sz = count($asctmp);
                                                                                        $asc[$e] = array();
                                                                                        for ($i=0; $i<$sz-1; ++$i) {
                                                                                            $asc[$e][] = array(current($asctmp), next($asctmp));
                                                                                        }
                                                                                    }

                                                                                    echo "var asc = ".json_encode($asc).";\n";
                                                                                    ?>
                                                                                    $.each(asc,function(i0,e0) {
                                                                                        var gpo=cr_gposlct();
                                                                                        var u=0;
                                                                                        $.each(e0,function (i1,e1) {
                                                                                            if (e1[1] != 0) {
                                                                                                cr_slct(gpo,e1[0],e1[1]);
                                                                                                u=e1[1];
                                                                                            }
                                                                                        });
                                                                                        cr_slct(gpo,u,'');
                                                                                    });
                                                                                }
                                                                            </script>
                                                                        </div>

                                                                    </div>
                                                                    <!-- end col-6 -->
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <!-- end col-6 -->
                                                    </div>
                                                    <!-- end row -->
                                                </fieldset>
                                    </form>
                                </div>
                                <!-- end wizard step-1 -->
                                <!-- begin wizard step-2 -->
                                <div class="wizard-step-2">
                                    <fieldset>
                                        <!-- begin row -->
                                        <div class="row">
                                            <!-- begin col-6 -->
                                            <div class="col-md-12">
                                                <h3 class="form-header form-header-lg m-b-10">Suba su Imagen</h3>
                                                <br/>
                                                <span>El tamaño de las imagenes debe ser de 1420px de ancho por 960px de alto.</span><br/>
                                                <div class="row">
                                                    <div class="col-md-12 ">
                                                        <div><button class="btn btn-info" id="btnaddimg" >Agregar im&aacute;genes</button></div>
                                                        <form action="../opimagenes/upload.php" id="frmdzone" class="dropzone">
                                                            <input type="hidden" id="hdntbl" name="tbl" value="<?php echo $tabla; ?>" />
                                                            <input type="hidden" id="hdnid_c" name="id_c" value="0" />
                                                            <input type="hidden" id="hdniw" name="iw[]" value="100" />
                                                            <input type="hidden" id="hdnih" name="ih[]" value="75" />
                                                            <input type="hidden" id="hdniwx" name="iw[]" value="370" />
                                                            <input type="hidden" id="hdnihx" name="ih[]" value="269" />

                                                            <div class="dz-message"></div>
                                                            <div class="dropzone-previews" id="divdzone"> </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                <!-- end row -->
                                    </fieldset>
                                </div>
                                <!-- end wizard step-2 -->

                                <!-- begin wizard step-5 -->
                                <div class="wizard-step-5 text-center">
                                    <h2>
                                        <?php
                                        $st="Agregado";
                                        if (isset($_REQUEST['id'])) {
                                            $id = $_REQUEST['id'];
                                            $st = 'Modificado';
                                        }


                                        echo 'Servicio '.$st;

                                        ?>
                                    </h2>
                                    <!--<p class="m-b-20">Completo</p>-->
                                    <p><a href="lservicios" class="btn btn-success btn-lg">Finalizar</a></p>
                                </div>
                                <!-- end wizard step-5 -->
                            </div>
                            <!-- end #wizard -->

                        </div>
                    </div>
                    <!-- END WIZARD WITH VALIDATION -->
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
<!--<script type="text/javascript" src="../assets/js/plugins/jquery/jquery.min.js"></script>-->
<script type="text/javascript" src="../assets/js/plugins/jquery/jquery-ui.min.js"></script>
<script type="text/javascript" src="../assets/js/plugins/bootstrap/bootstrap.min.js"></script>
<!-- END PLUGINS -->

<!-- THIS PAGE PLUGINS -->
<script type='text/javascript' src="../assets/js/plugins/bwizard/parsley.js"></script>
<script type="text/javascript" src="../assets/js/plugins/bootstrap/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="../assets/js/plugins/bootstrap/bootstrap-select.js"></script>
<script type='text/javascript' src="../assets/js/plugins/bwizard/bwizard.js"></script>
<script type='text/javascript' src="../assets/js/plugins/icheck/icheck.min.js"></script>
<script type="text/javascript" src="../assets/js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>
<script type="text/javascript" src="../assets/js/plugins/dropzone/dropzone.min.js"></script>
<script type="text/javascript" src="../assets/js/plugins/jquery-validation/jquery.validate.js"></script>
<script type="text/javascript" src="../assets/js/plugins/summernote/summernote.js"></script>

<!-- END PAGE PLUGINS -->

<!-- START TEMPLATE -->

<script type="text/javascript" src="../assets/js/plugins.js"></script>
<script type="text/javascript" src="../assets/js/actions.js"></script>
<!-- END TEMPLATE -->


<script src="../assets/js/plugins/pleasewait/fakeLoader.min.js"></script>
<script>
    $(document).ready(function(){


        $(".fakeloader").fakeLoader({
            timeToHide:1200,
            bgColor:"#e5e5e5",
            spinner:"spinner1"
        });

        /*Summernote editor*/

        $('.summernote').summernote({
            callbacks: {
                onPaste: function (e) {
                    var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
                    e.preventDefault();
                    document.execCommand('insertText', false, bufferText);
                }
            },
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'superscript', 'subscript', 'strikethrough', 'clear']],
                ['fontsize', ['fontsize']], // Still buggy
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['insert', ['link', 'picture', 'video', 'hr']],
                ['view', ['fullscreen', 'codeview']]
            ]
        });

    });


</script>

<script>
    /****/
    /*
     /* DROPZONE
     /*
     /****/

    var $contd;
    var $id = <?php echo $id; ?>;
    $(document).ready(function(){
        $('#hdnid_c').val($id);
        // ** Dopzone  sortable **
        $contd = $("#divdzone");
        $contd.sortable({
            revert: 300,
            tolerance: "pointer",
            start: function (event, ui) {
                $(ui.item).data("startindex", ui.item.index());
            },
            update: function (event, ui) {
                var itm = $(ui.item);
                //console.log(itm);
                var ord = $(this).sortable("toArray");
                //alert(ord);
                $(ord).each(function(index, element) {
                    $.ajax({
                        data:  {'tbl':$('#hdntbl').val(), 'id_c':$('#hdnid_c').val(), 'id_img':element, 'chg_ord':index+1 },
                        url:   '../opimagenes/change.php',
                        type:  'post',
                    });
                });
            }/*,
             remove: function (event, ui) {
             alert("Removido");
             }*/
        });

        Dropzone.options.frmdzone = {
            maxFilesize: 8,
            thumbnailWidth: 200,
            thumbnailHeight: 200,
            clickable: "#btnaddimg",
            previewsContainer: "#divdzone",

            init: function() {

                var tthis = this;
                $.ajax({
                    data:  {'tbl':$('#hdntbl').val(), 'id_c':$('#hdnid_c').val() },
                    url:   '../opimagenes/get.php',
                    type:  'post',
                    success:  function (response) {
                        //alert(response);

                        var images = JSON.parse(response);
                        $(images).each(function(index, element) {
                            console.log(element);
                            $.each(element,function (i,v) {
                                //alert(v.lynd_img);
                                //alert (i + " " + v);
                                //alert(i+" ->>  ../../components/"+$('#hdntbl').val()+"/"+v.arch_img);
                                var mockFile = { serverId: v.id_img, name: v.arch_img, size: v.sz, lynd: v.lynd_img };
                                tthis.emit("addedfile", mockFile);
                                tthis.emit("thumbnail", mockFile, "../../assets/images/data/"+$('#hdntbl').val()+"/"+v.arch_img);
                            });
                        });
                    }
                });

                this.on("addedfile", function(file) {
                    var btnelim = $("<button id='btneliminar' mane='elimi'>Eliminar</button>");
                    var txtnomb = $("<input type='text' id='txtnombre' name='nomi' placeholder='Nombre de imagen' style='width:125px;' />");


                    var _this = this;
                    var $prv = $(file.previewElement);
                    //console.log(file);

                    if(file.serverId) {
                        $prv.attr("id",file.serverId);
                        //alert(file.name + " - "+file.serverId);
                    }
                    if(file.lynd) {
                        txtnomb.val(file.lynd);
                    }
                    $prv.append($("<div/>").append(btnelim)).append($("<div/>").append(txtnomb));

                    btnelim.on("click", function (e) {
                        e.preventDefault();
                        e.stopPropagation();

                        _this.removeFile(file);
                        //$(this).parent("div").remove();
                        $contd.sortable('refresh');
                        //$contd.trigger('update');
                        var ord = $contd.sortable("toArray");
                        $(ord).each(function(index, element) {
                            $.ajax({
                                data:  {'tbl':$('#hdntbl').val(), 'id_c':$('#hdnid_c').val(), 'id_img':element, 'chg_ord':index+1 },
                                url:   '../opimagenes/change.php',
                                type:  'post',
                            });
                        });
                        //alert(ord);
                        //alert($prv.attr('id'));

                        // If you want to the delete the file on the server as well,
                        // you can do the AJAX request here.
                        borrar_i($prv.attr('id'));
                    });

                    $(txtnomb).on("keypress", function(e) {
                        var charCode = e.charCode || e.keyCode || e.which;
                        if (charCode  == 13) {
                            e.preventDefault();
                            $(this).blur();
                            return false;
                        }
                    });
                    txtnomb.on("change", function (e) {
                        //alert("Modificando!!!");
                        $.ajax({
                            data:  {'tbl':$('#hdntbl').val(), 'id_c':$('#hdnid_c').val(), 'id_img':$prv.attr('id'), 'chg_ly':$(this).val() },
                            url:   '../opimagenes/change.php',
                            type:  'post',
                            success:  function (response) {
                                //alert("Modificado con éxito... "+response);
                            }
                        });
                    });
                });

                this.on("success", function(file, response) {
                    file.serverId = response;
                    var $prv = $(file.previewElement);
                    $prv.attr("id",response);
                    $.ajax({
                        data:  {'tbl':$('#hdntbl').val(), 'id_c':$('#hdnid_c').val(), 'id_img':file.serverId, 'chg_ord':$prv.index()+1 },
                        url:   '../opimagenes/change.php',
                        type:  'post',
                    });
                    //alert("Actualización del orden  con éxito... "+response);
                });
            }
        }

        function borrar_i(idx) {
            $.ajax({
                data:  {'tbl':$('#hdntbl').val(), 'id_c':$('#hdnid_c').val(), 'id_img':idx},
                url:   '../opimagenes/delete.php',
                type:  'post',
                success:  function (response) {
                    //alert("Borrar... "+response);
                }
            });
        }

        /****/
        /*
         /* STEPS
         /*
         /****/

        $("#wizard").bwizard({
            validating: function(e, a) {
                //console.log(a);
                //console.log(e);
                console.log($('form[name="form-wizard"]').parsley().validate("wizard-step-1"));
                if ($('form[name="form-wizard"]').parsley().validate("wizard-step-1")) {


                    //alert("id producto: "+$id);

                    clasif = $('.slcclsf').filter(function(i, e) {
                        console.log(i);
                        console.log(e);
                        return $(e).val() !== "";
                    });
                    console.log(clasif);
                    if ($id != 0) {
                        $.ajax({
                            data:  {'op':'Modificar', 'id':$id, 'titulo':$('#titulo').val(), 'precio':$('#precio').val(), 'descripcion':$('#summernote').val(), 'clasificador':$(clasif).last().val()},
                            url:   'opservicios.php',
                            type:  'post',
                            success:  function (response) {
                                //alert("Modif:\n\n"+response);
                                //$id = response;
                            }
                        });
                    } else {
                        $.ajax({
                            data:  {'op':'Agregar', 'titulo':$('#titulo').val(), 'precio':$('#precio').val(), 'descripcion':$('#summernote').val(), 'clasificador':$(clasif).last().val()},
                            url:   'opservicios.php',
                            type:  'post',
                            success:  function (response) {
                                //alert("Insert:\n\n"+response);
                                $id = response;
                                $('#hdnid_c').val($id);
                            }
                        });
                    }
                }

                return (0 == a.index && a.nextIndex >= 0 || a.nextIndex > 0)
                && !1 === $('form[name="form-wizard"]').parsley().validate("wizard-step-1") ? !1 : void 0;
            }

        });

    });
</script>
</body>
</html>
