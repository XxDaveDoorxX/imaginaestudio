<?php
// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');


$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, array(400, 233.2), true, 'UTF-8', false);

// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set margins
$pdf->SetMargins(0,0,0,true);


// set auto page breaks false
$pdf->SetAutoPageBreak(false, 0);

$img_file = K_PATH_IMAGES.'image_demo.jpg';
// add a page
$pdf->AddPage('L');



$pdf->Image($img_file, 0, 0, 0, 0, 'JPG', '','', true, 300, '', false, false, 0, false, false, true);

// Add a page

$img_file2 = K_PATH_IMAGES.'imagen2.jpg';

$pdf->AddPage('L');
$pdf->Image($img_file2, 0, 0, 0 ,0,'JPG', '','', true, 300, '', false, false, 0, false, false, true);


// Add a page

$img_file3 = K_PATH_IMAGES.'imagen3.jpg';

$pdf->AddPage('L');
$pdf->Image($img_file3, 0, 0, 0 ,0,'JPG', '','', true, 300, '', false, false, 0, false, false, true);


// Add a page

$img_file4 = K_PATH_IMAGES.'imagen4.jpg';

$pdf->AddPage('L');
$pdf->Image($img_file4, 0, 0, 0 ,0,'JPG', '','', true, 300, '', false, false, 0, false, false, true);


$pdf->Output('page.pdf', 'D');