<?php
include_once ('tcpdf/tcpdf.php');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, array(400, 233.2), true, 'UTF-8', false);

// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);


// set margins
$pdf->SetMargins(0,0,0,true);


// set auto page breaks false
$pdf->SetAutoPageBreak(false, 0);

$img_file_default1 ='images/default_page_cotizador/imagen1.jpg';

// add a page
$pdf->AddPage('L');
$pdf->Image($img_file_default1, 0, 0, 0, 0, 'JPG', '','', true, 300, '', false, false, 0, false, false, true);


$img_file_default2 ='images/default_page_cotizador/imagen2.jpg';

// add a page
$pdf->AddPage('L');
$pdf->Image($img_file_default2, 0, 0, 0, 0, 'JPG', '','', true, 300, '', false, false, 0, false, false, true);


$img_file_default3 ='images/default_page_cotizador/imagen3.jpg';

// add a page
$pdf->AddPage('L');
$pdf->Image($img_file_default3, 0, 0, 0, 0, 'JPG', '','', true, 300, '', false, false, 0, false, false, true);

$img_file_default4 ='images/default_page_cotizador/imagen4.jpg';

// add a page
$pdf->AddPage('L');
$pdf->Image($img_file_default4, 0, 0, 0, 0, 'JPG', '','', true, 300, '', false, false, 0, false, false, true);


$pdf->Output('page.pdf', 'D');