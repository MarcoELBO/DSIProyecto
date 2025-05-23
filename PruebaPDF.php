<?php
require('fpdf.php');

$pdf = new FPDF('P', 'mm', 'A4'); //Constructor
$pdf->AddPage('P', 'A4', 0);//Agregar pagina
$pdf->SetFont('Arial', 'B', 16);//DEFIINICION DE FUENTE
$pdf->Cell(40, 10, '¡Hola, Mundo!');
$pdf->SetXY(80, 80);
$pdf->Cell(40, 10, '¡Hola, Mundo!');
$pdf->Image('logo.png', 50, 50, 20, 20);//Agregar imagen
$pdf->Output();
?>