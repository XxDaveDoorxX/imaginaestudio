<?php
session_name("cotizacion");
session_start();

session_unset();
include_once ('Class/Clasificador.php');
include_once ('Class/Servicio.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Google Tag Manager -->
    <script>(function (w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(), event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-TCV4SH');</script>
    <!-- End Google Tag Manager -->

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Imagina Estudio | Diseño Gráfico en Mérida, Yucatán</title>
    <meta name="keywords"
          content="Grafico En Merida,Diseño,páginas web,Web,Estudio,Imagina,Imagina Estudio,Landing Page, publicidad">
    <meta name="description" content="Imagina Estudio | Diseño Grafico En Merida Yucatan">
    <meta name="author" content="ImaginaEstudio">


    <!--Fonts Online-->
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,100,200,300,500,600,700,800,900' rel='stylesheet'
          type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'>

    <!--Main-->
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="css/ionicons.min.css" rel="stylesheet" type="text/css">
    <link href="css/main.css" rel="stylesheet" type="text/css">
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <link href="css/responsive.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" id="color" href="css/default.css">
    <link rel="stylesheet" id="color" href="css/cotizador.css">


    <!-- LayerSlider stylesheet -->
    <link rel="stylesheet" href="layerslider/css/layerslider.css" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!--[if IE]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <!--Start of Zopim Live Chat Script-->
    <script type="text/javascript">
        window.$zopim || (function (d, s) {
            var z = $zopim = function (c) {
                z._.push(c)
            }, $ = z.s =
                d.createElement(s), e = d.getElementsByTagName(s)[0];
            z.set = function (o) {
                z.set._.push(o)
            };
            z._ = [];
            z.set._ = [];
            $.async = !0;
            $.setAttribute("charset", "utf-8");
            $.src = "//v2.zopim.com/?4EDXTiLurO63VCDlMwaGTig8FFM3Anft";
            z.t = +new Date;
            $.type = "text/javascript";
            e.parentNode.insertBefore($, e)
        })(document, "script");
    </script>
    <!--End of Zopim Live Chat Script-->

</head>
<body>
<!-- Google Tag Manager (noscript) -->
<noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TCV4SH"
            height="0" width="0" style="display:none;visibility:hidden"></iframe>
</noscript>
<!-- End Google Tag Manager (noscript) -->

<script>
    (function (i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function () {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
        a = s.createElement(o),
            m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
    })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

    ga('create', 'UA-19676255-24', 'imaginaestudio.mx');
    ga('send', 'pageview');

</script>


<!-- LOADER ===========================================
<div id="loader">
  <div class="loader"> <img src="images/spin.svg" alt="" > </div>
</div>-->

<!-- Page Wrap ===========================================-->
<div id="wrap">

    <!--======= HEADER =========-->
    <header class="sticky">
        <div class="container">
            <div class="menu">

                <!--======= LOGO =========-->
                <div class="logo"><a href="."><img class="custom-logo" src="images/logo.png" alt=""></a></div>
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse"
                            data-target="#bs-example-navbar-collapse-1"><span class="sr-only">Toggle navigation</span>
                        <span class="fa fa-bars"></span></button>
                </div>

                <!--======= NAV START =========-->
                <nav class="navbar navbar-default" role="navigation">
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                            <li><a href="#servicess">Servicio</a></li>
                            <li><a href="#conocenos">Conócenos</a></li>
                            <li><a href="#portfolio">Portafolios</a></li>
                            <li><a href="#team">Nuestro Equipo</a></li>
                            <li><a href="#">Blog</a></li>
                            <li><a href="#contact">Contacto</a></li>
                            <li>&nbsp;</li>
                            <li><a href="https://www.facebook.com/imaginaestudiomx/?fref=ts" target="_blank"><img
                                            src="images/icons/facebook.png"/> </a></li>
                            <li><a href="https://twitter.com/imagina_estudio" target="_blank"><img
                                            src="images/icons/twitter.png"/> </a></li>
                            <li><a href="https://es.pinterest.com/imagina_estudio/" target="_blank"><img
                                            src="images/icons/pinterest.png"/></a></li>

                        </ul>
                    </div>
                </nav>
                <div class="clearfix"></div>
            </div>
        </div>
    </header>

    <!--======= CONTENT START =========-->
    <div class="content">
        <section id="cotizador">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-6">
                        <div class="faqs">
                            <div class="panel-group" id="accordion">

                                <?php
                                //*NIVEL PRINCIPAL**//
                                $clsftmp = new Clasificador(0);
                                $clsf = $clsftmp->listar_Hijos();
                                foreach ($clsf as $elem) {
                                    //$chld++;
                                    $clsftmp = new Clasificador($elem['id']);
                                    $clsftmp->obtener_Clasificador();
                                    $clsf = $clsftmp->listar_Hijos();

                                    $tmpserv = new Servicio(0,'','','',$elem['id']);
                                    $servicios = $tmpserv->listar_filtrado_Servicios();


                                    echo "<div class='panel panel-default'>";
                                    if (empty($clsf)) {
                                        echo "<div class='panel-heading'>";
                                        echo "<h4 class='panel-title'><a data-toggle='collapse' data-parent='#accordion' href='#".$elem['id']."' class='collapsed'>".$elem['nombre']."</a></h4>\n";
                                        echo "</div>";
                                        echo "<div id='".$elem['id']."' class='panel-collapse collapse'>";
                                        ?>
                                            <div class='panel-body'>
                                                <div id="servicios">

                                                    <?php
                                                        foreach($servicios[0] as $s) {

                                                            ?>

                                                            <div class="item-services">
                                                                <a href="javascript:;" data-toggle="popover"
                                                                   data-trigger="hover" data-placement="left"
                                                                   data-content="<?php echo $s['descripcion'] ?>">
                                                                    <div class="col-md-8"><?php echo $s['titulo'] ?></div>
                                                                    <div class="col-md-2"><?php echo $s['precio'] ?></div>
                                                                    <div class="col-md-2">
                                                                        <button class="btnServid" value="<?php echo $s['id']; ?>">Agregar <i
                                                                                    class="fa fa-plus-circle custom-plus-01"></i>
                                                                        </button>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                            <?php
                                                        }
                                                    ?>

                                                </div>
                                            </div>
                                        <?php echo "</div>";
                                    }
                                    echo "</div>\n";
                                }
                                ?>


                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6">
                        <h1 class="title-resumen-pedido">Resumen de la cotización</h1>
                        <div class="tb-cotizacion table-responsive" style="padding:20px">
                            <table id="orden" class="table table-striped">
                                <tbody>
                                <tr id="rowTotal">
                                    <td><strong>Total</strong></td>
                                    <td><span id="total">$ 0.00</span></td>
                                </tr>

                                </tbody>
                            </table>
                        </div>

                        <div class="contact-form">
                        <form id="frmpedido" name="frmpedido" action="Class/procesa_cotizacion.php" method="post">
                            <div id="direccionEntrega" style="margin-top:20px;">
                                <h3>Datos de contacto</h3>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="nombre" name="nombre"
                                               placeholder="Nombre"
                                               data-validation-engine="validate[required,custom[minSz2Nm]]"
                                               data-validation-placeholder="Escriba su nombre">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="tel" class="form-control" id="tel" name="tel"
                                               placeholder="Teléfono" maxlength="10"
                                               data-validation-engine="validate[required,custom[onlyNumberSp3]"
                                               data-validation-placeholder="Escribe los 10 d&iacute;gitos de tu n&uacute;mero">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="email" class="form-control" id="email" name="email"
                                               placeholder="Correo Electrónico"
                                               data-validation-engine="validate[required,custom[email]]"
                                               data-validation-placeholder="Escriba su e-mail">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div id="comentarios">
                                        <label>Comentarios (opcional)</label>
                                        <textarea class="form-control" name="txaComents" id="txaComents"
                                                  cols="68" rows="5"></textarea>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-8">
                                    <div class="form-group">
                                        <div class="g-recaptcha" data-sitekey="6LfMLREUAAAAALlMy1l66mbpk7rwPgzMCMWlimCf"></div>
                                    </div>
                                </div>

                                <input class="btn btn-default btn-lg btn-block custom-btn" type="submit" id="btnCotizacion" name="btnCotizacion" value="Cotizar">


                            </div>
                        </form>
                            <span id="error_captcha" style="text-align:center; color:#000000;"></span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!--======= RIGHTS =========-->
        <div class="rights">
            <div id="back-to-top"><i class="fa fa-angle-up"></i></div>
            <div class="container">
                <img src="images/logo_footer.png" style="margin: 10px"/>
            </div>
        </div>
    </div>
</div>
<script src="js/jquery-1.9.1.min.js"></script>
<script src="js/wow.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.stellar.min.js"></script>
<script src="js/jquery.sticky.js"></script>
<script src="js/jquery.isotope.min.js"></script>
<script src="js/jquery.easing.1.3.js"></script>
<script src="js/isotope.pkgd.min.js"></script>
<!--<script src="js/modernizr.js"></script>-->
<script src="js/jquery.flexslider-min.js"></script>
<script src="js/waypoints.min.js"></script>
<!--<script src="js/counter.js"></script>-->
<script src="js/owl.carousel.min.js"></script>
<script src="js/smooth-scroll.js"></script>
<script src="js/jquery.jcarousel.min.js"></script>
<script src="js/jquery.superslides.min.js"></script>
<script src="js/bootstrap-hover-dropdown.min.js"></script>
<script src="js/jquery-ui.min.js"></script>



<script src='https://www.google.com/recaptcha/api.js'></script>

<script>
    $(function () {
        $('[data-toggle="popover"]').popover();

        $('.btnServid').on('click', function (e) {

            //console.log($(this));

            $.ajax({
                data: {'btnServid': true, 'id': $(this).val()},
                url: 'Class/genera_contizacion.php',
                type: 'post',
                dataType: 'json',
                success: function (response) {
                    //console.log(response);
                    //alert(response[0].nombre);
                    $('#rowTotal').before('<tr id="itmo' + response[2] + '"><td>' + response[0] + '</td><td>$ ' + Number(response[1]).toFixed(2).replace(/./g, function (c, i, a) {
                            return i && c !== "." && ((a.length - i) % 3 === 0) ? ',' + c : c;
                        }) + ' <a id="eliminar" href="javascript:;" rel="' + response[2] + '"><i class="fa fa-minus-circle"></i></a></td></tr>');
                    $('#total').html("$ " + response[3].toFixed(2).replace(/./g, function (c, i, a) {
                            return i && c !== "." && ((a.length - i) % 3 === 0) ? ',' + c : c;
                        }));
                    $('input[type="checkbox"]').removeAttr("checked");
                    $('#itmo' + response[2]).effect("pulsate", {}, 500);

                }
            });
        });


        // *** Eliminar Orden ***
        $(document).on('click', '#eliminar', function (e) {
            var nom = "#itmo" + $(this).attr('rel');
            //alert(nom);
            $(nom).remove();
            $.ajax({
                data: {'idi': $(this).attr('rel')},
                url: 'Class/eliminar_fila.php',
                type: 'post',
                dataType: 'json',
                success: function (response) {
                    $('#total').html("$ " + response.toFixed(2).replace(/./g, function (c, i, a) {
                            return i && c !== "." && ((a.length - i) % 3 === 0) ? ',' + c : c;
                        }));
                    //console.log(response);
                    //alert(response);
                }
            });
        });

    });



</script>

</body>
</html>