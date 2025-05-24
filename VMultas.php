<?php

require('fpdf.php');
include("controlador.php");

$Con = conectar();
$SQL = "SELECT * FROM Multass;";
$ResultSet = ejecutar($Con, $SQL);
$Datos = mysqli_fetch_array($ResultSet);

$pdf = new FPDF('P', 'mm', array(180, 250));
$pdf->SetMargins(10, 10);
$pdf->AddPage();
$pdf->SetFont('Arial', '', 10);

// Fundamento
$pdf->MultiCell(0, 5, utf8_decode("Con fundamento en los artículos 31 fraccion XV de la Ley de Transito para el Estado de Queretaro y fraccion XVI del Reglamento de la misma ley, se emite la presente boleta de infraccion."), 0, 'J');
$pdf->Ln(3);

// Datos básicos
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, 'Boleta de Infraccion No. B-' . $Datos[0], 0, 1, 'R');

$pdf->SetFont('Arial', '', 10);
$pdf->Cell(95, 8, utf8_decode('Fecha: ') . $Datos[1], 1);
$pdf->Cell(65, 8, utf8_decode('Hora: ') . $Datos[2], 1, 1);

// Lugar
$pdf->MultiCell(0, 8, utf8_decode("Lugar de la infraccion: " . $Datos[3]), 1);
$pdf->Ln(2);

// Datos del infractor
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(0, 8, 'Datos del Infractor', 1, 1);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(95, 8, utf8_decode('Nombre: ') . $Datos[4], 1);
$pdf->Cell(65, 8, utf8_decode('Licencia: ') . $Datos[5], 1, 1);
$pdf->Cell(0, 8, utf8_decode('Direccion: ') . $Datos[6], 1, 1);
$pdf->Ln(2);

// Vehículo
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(0, 8, 'Datos del Vehiculo', 1, 1);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(50, 8, 'Placa: ' . $Datos[7], 1);
$pdf->Cell(70, 8, 'Marca: ' . $Datos[8], 1);
$pdf->Cell(40, 8, 'Modelo: ' . $Datos[9], 1, 1);
$pdf->Cell(160, 8, 'Color: ' . $Datos[10], 1, 1);
$pdf->Ln(2);

// Motivo
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(0, 8, 'Motivo de la infraccion', 1, 1);
$pdf->SetFont('Arial', '', 10);
$pdf->MultiCell(0, 8, utf8_decode($Datos[11]), 1);
$pdf->Ln(2);

// Oficial
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(0, 8, 'Datos del Oficial', 1, 1);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(95, 8, utf8_decode('Nombre: ') . $Datos[12], 1);
$pdf->Cell(65, 8, utf8_decode('Placa: ') . $Datos[13], 1, 1);
$pdf->Ln(2);

// Centro de pago
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(0, 8, 'Centro de Pago', 1, 1);
$pdf->SetFont('Arial', '', 10);
$pdf->MultiCell(0, 8, utf8_decode('Recaudanet'), 1);
$pdf->Ln(2);

// Observaciones
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(0, 8, 'Observaciones del Conductor', 1, 1);
$pdf->SetFont('Arial', '', 10);
$pdf->MultiCell(0, 8, utf8_decode($Datos[14]), 1);
$pdf->Ln(2);

// Fundamento legal
$pdf->SetFont('Arial', '', 10);
$pdf->MultiCell(0, 4, utf8_decode("Para el pago de la presente infracción y devolución de las garantías retenidas, es aplicable lo dispuesto en el artículo 179 del Reglamento de la Ley de Tránsito del Estado de Querétaro. El infractor podrá pagar en oficinas recaudadoras o centros autorizados. Tiene un plazo de 90 días naturales para pagar, con descuento del 50% si lo hace en los primeros 10 días hábiles, salvo excepciones."), 1);

// Imagen opcional
// $pdf->Image("escudo.png", 10, 420, 30);

$pdf->Output();

desconectar($Con);

?>