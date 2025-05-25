<?php
require('fpdf.php');
include("Controlador.php");
// --- 1. Obtención y Validación de Parámetros ---
$id_multa = isset($_REQUEST["id"]) ? $_REQUEST["id"] : '';
$Con = Conectar();
//$SQL = "SELECT * FROM verificacion;";
//$ResultSet = Ejecutar($Con, $SQL);
//$DATOS = mysqli_fetch_array($ResultSet);
Desconectar($Con);

// Crear documento PDF tamaño carta (215.9 x 279.4 mm)
$pdf = new FPDF('L', 'mm', array(210, 110));
$pdf->AddPage();
$pdf->SetMargins(2, 15, 2);
$pdf->SetAutoPageBreak(true, 0);
$pdf->SetFont('Arial', 'B', 10);

$pdf->Image('Imagenes/Q2.png', 6, 6, 20, 8); // Logo
$pdf->Image('Imagenes/Q3.png', 30, 6, 20, 8); // Logo

$pdf->SetXY(0, 2);
$pdf->Cell(0, 10, 'PROGRAMA ESTATAL DE VERIFICACION VEHICULAR', 0, 1, 'C');
$pdf->SetXY(0, 8);
$pdf->Cell(0, 10, 'PODER EJECUTIVO DEL ESTADO DE QUERETARO', 0, 1, 'C');

$pdf->Image('Imagenes/B.png', 155, 14, 45, 10); // Logo


$pdf->Ln(10);
$pdf->SetFont('Arial', 'B', 10);

$pdf->SetXY(2, 25);
// Datos del vehículo
$pdf->Cell(0, 6, 'DATOS DEL VEHICULO', 0, 1);

$pdf->SetXY(2, 32);
$pdf->SetFont('Arial', 'B', 6);
$pdf->Cell(30, 2, 'PARTICULAR', 0);
$pdf->Cell(30, 2, 'dato', 0);
$pdf->Cell(30, 2, 'dato', 0);
$pdf->Cell(20, 2, 'dato', 0);
$pdf->Cell(35, 2, 'dato', 0);
$pdf->Cell(30, 2, 'Vigencia: ' . 'dato', 0);
$pdf->Rect(3, 35, 135, 0.5, 'F');

$pdf->SetFont('Arial', '', 6);
$pdf->SetXY(2, 37);
$pdf->Cell(30, 2, 'TIPO SERVICIO', 0);
$pdf->Cell(30, 2, 'MARCA', 0);
$pdf->Cell(30, 2, 'SUBMARCA', 0);
$pdf->Cell(20, 2, 'MODELO', 0);
$pdf->Cell(25, 2, 'PLACA', 0);

$pdf->Image('Imagenes/QR.png', 145, 40, 20, 20); // Logo

$pdf->SetXY(2, 40);
$pdf->SetFont('Arial', 'B', 6);
$pdf->Cell(35, 8, 'dato', 0);
$pdf->Cell(35, 8, 'dato', 0);
$pdf->Cell(30, 8, 'Gasolina', 0);
$pdf->Cell(35, 8, 'dato', 0);
$pdf->Rect(3, 46, 135, 0.5, 'F');

$pdf->SetXY(2, 45);
$pdf->SetFont('Arial', '', 6);
$pdf->Cell(35, 8, 'NUMERO DE SERIE', 0);
$pdf->Cell(35, 8, 'CLASE', 0);
$pdf->Cell(30, 8, 'TIPO DE COMBUSTIBLE', 0);
$pdf->Cell(35, 8, 'IDENTIFICACION VEHICULAR', 0);
$pdf->Rect(3, 57, 135, 0.5, 'F');

$pdf->SetXY(2, 51);
$pdf->SetFont('Arial', 'B', 6);
$pdf->Cell(35, 8, 'dato', 0);
$pdf->Cell(35, 8, 'dato', 0);
$pdf->Cell(30, 8, 'dato', 0);
$pdf->Cell(35, 8, 'dato', 0);
$pdf->Rect(3, 46, 130, 0.5, 'F');

$pdf->SetXY(2, 56);
$pdf->SetFont('Arial', '', 6);
$pdf->Cell(35, 8, 'NUMERO DE CILINDROS', 0);
$pdf->Cell(35, 8, 'TIPO CARROCERIA', 0);
$pdf->Cell(30, 8, 'ENTIDAD FEDERATIVA', 0);
$pdf->Cell(35, 8, 'MUNICIPIO', 0);

$pdf->SetXY(2, 65);
$pdf->Cell(35, 5, 'No. DE CENTRO', 0, 0);
$pdf->Cell(35, 5, 'dato', 0, 1);
$pdf->Cell(35, 5, 'TECNICO VERIFICADOR', 0, 0);
$pdf->Cell(35, 5, 'dato', 0, 1);
$pdf->Cell(35, 5, 'FECHA DE EXPEDICION', 0, 0);
$pdf->Cell(35, 5, 'dato', 0, 1);
$pdf->Cell(35, 5, 'HORA DE ENTRADA', 0, 0);
$pdf->Cell(35, 5, 'dato', 0, 1);
$pdf->Cell(35, 5, 'HORA DE SALIDA', 0, 0);
$pdf->Cell(35, 5, 'MOTIVO DE VERIFICACION', 0, 0);
$pdf->Cell(35, 5, 'dato', 0, 1);
$pdf->Cell(35, 5, 'FOLIO DE CERTIFICADO', 0, 0);
$pdf->Cell(35, 5, 'dato', 0, 1);
$pdf->Cell(35, 5, 'SEMESTRE', 0, 0);
$pdf->Cell(35, 5, 'dato', 0, 1);

$pdf->Image('Imagenes/LQ.png', 140, 70, 30, 30); // Logo

$pdf->Output('I', 'verificacion_vehicular_queretaro.pdf');
?>