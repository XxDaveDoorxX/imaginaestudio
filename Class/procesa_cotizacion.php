<?php
header('Content-type: text/html; charset=utf-8');

session_name("cotizacion");
session_start();
require_once('init.php');
include_once('Servicio.php');
include_once('InfoGeneral.php');
include_once('Muestra.php');
include_once('imagenes.php');
include_once('../tcpdf/tcpdf.php');
$msg = "";

$codigo = (isset($_POST['g-recaptcha-response'])) ? $_POST['g-recaptcha-response'] : '';

$response = $recaptcha->verify($codigo);

function transponer($array)
{
    array_unshift($array, null);
    return call_user_func_array('array_map', $array);
}

if ($response->isSuccess()) {

    if (isset($_POST['btnCotizacion'])) {

        if (isset($_SESSION['ordenes']) && isset($_SESSION['total'])) {

            if (count($_SESSION['ordenes']) > 0 && isset($_SESSION['total']) > 0) {

                $ordenes_trans = transponer($_SESSION['ordenes']);
                $aux_o = $ordenes_trans[3];

                //print_r($_SESSION['ordenes']);
                //echo "\n";
                //print_r($aux_o);

                //$orden= "";


                $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, array(400, 233.2), true, 'UTF-8', false);

                // remove default header/footer
                $pdf->setPrintHeader(false);
                $pdf->setPrintFooter(false);


                // set margins
                $pdf->SetMargins(0, 0, 0, true);


                // set auto page breaks false
                $pdf->SetAutoPageBreak(false, 0);

                $img_file_default1 = '../images/default_page_cotizador/imagen1.jpg';

                // add a page
                $pdf->AddPage('L');
                $pdf->Image($img_file_default1, 0, 0, 0, 0, 'JPG', '', '', true, 300, '', false, false, 0, false, false, true);


                $img_file_default2 = '../images/default_page_cotizador/imagen2.jpg';

                // add a page
                $pdf->AddPage('L');
                $pdf->Image($img_file_default2, 0, 0, 0, 0, 'JPG', '', '', true, 300, '', false, false, 0, false, false, true);


                $img_file_default3 = '../images/default_page_cotizador/imagen3.jpg';

                // add a page
                $pdf->AddPage('L');
                $pdf->Image($img_file_default3, 0, 0, 0, 0, 'JPG', '', '', true, 300, '', false, false, 0, false, false, true);

                $img_file_default4 = '../images/default_page_cotizador/imagen4.jpg';

                // add a page
                $pdf->AddPage('L');
                $pdf->Image($img_file_default4, 0, 0, 0, 0, 'JPG', '', '', true, 300, '', false, false, 0, false, false, true);



                foreach ($aux_o as $e) {

                    $tmpimg = new Imagen("imagenes_servicios", "", "", 0, "", "", $e, 0);
                    $imags = $tmpimg->listar_x_id_c();

                    $tmpinfogeneral = new InfoGeneral(0,'',$e);
                    $infogeneral = $tmpinfogeneral->listar_x_id_serv();

                    $tmpmuestra = new Muestra(0,'',$e);
                    $muestras = $tmpmuestra->listar_x_id_serv();

                    foreach ($infogeneral as $in) {
                        $tmpimgin = new Imagen("imagenes_infog","","",0,"","",$in['id'],0);
                        $imagsin = $tmpimgin->listar_x_id_c();

                        if(!empty($imagsin)){
                            foreach ($imagsin as $gn){
                                $img_file_g = "../assets/images/data/imagenes_infog/".$gn['arch_img'];
                                $pdf->AddPage('L');
                                $pdf->Image($img_file_g, 0, 0, 0, 0, 'JPG', '', '', true, 300, '', false, false, 0, false, false, true);
                            }
                        }
                    }

                    foreach ($muestras as $ms){
                        $tmpimgmu = new Imagen("imagenes_muestra","","",0,"","",$ms['id'],0);
                        $imagsmu = $tmpimgmu->listar_x_id_c();

                        if(!empty($imagsmu)){
                            foreach ($imagsmu as $gm){
                                $img_file_m = "../assets/images/data/imagenes_muestra/".$gm['arch_img'];
                                $pdf->AddPage('L');
                                $pdf->Image($img_file_m, 0, 0, 0, 0, 'JPG', '', '', true, 300, '', false, false, 0, false, false, true);
                            }
                        }
                    }

                    foreach ($imags as $i){
                        // INFO DE SERVICIO
                        $img_file = "../assets/images/data/imagenes_servicios/".$i['arch_img'];
                        $pdf->AddPage('L');
                        $pdf->Image($img_file, 0, 0, 0, 0, 'JPG', '', '', true, 300, '', false, false, 0, false, false, true);
                    }

                }


               $img_file_default5 = '../images/default_page_cotizador/imagen5.jpg';
                // add a page
                $pdf->AddPage('L');
                $pdf->Image($img_file_default5, 0, 0, 0, 0, 'JPG', '', '', true, 300, '', false, false, 0, false, false, true);

                $pdf->Output('cotizacion.pdf', 'D');

                //print_r($_SESSION['ordenes']);

                //$total = number_format($_SESSION['total'], 2, ".", ",");

            }
        }
    }
}