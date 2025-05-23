<?php

include("Controlador.php");
$Con = Conectar();
$SQL = "SELECT * FROM CirculacionVehiculo";
$ResultSet = Ejecutar($Con, $SQL);
$Fila = mysqli_fetch_array($ResultSet);
$Cerrar = Desconectar($Con);

require('fpdf.php');
$pdf = new FPDF('L', 'mm', [85.60, 54]); // Tamaño pequeño
$pdf->AddPage();
$pdf->SetAutoPageBreak(true, 0);

//PARTE 1
$pdf->SetFont('Arial', 'B', 3);
$pdf->SetXY(3, 4);
$pdf->Cell(18, 1, 'TIPO DE SERVICIO', 0);
$pdf->Cell(18, 1, 'HOLOGRAMA', 0);
$pdf->Cell(12, 1, 'FOLIO', 0);
$pdf->Cell(12, 1, 'VIGENCIA', 0);
$pdf->Cell(12, 1, 'PLACA', 0, 1);
$pdf->SetFont('Arial', '', 4);
$pdf->SetXY(3, 6);
$pdf->Cell(36, 1, $Fila[0], 0);
$pdf->Cell(12, 1, $Fila[1], 0);
$pdf->Cell(12, 1, $Fila[2], 0);
$pdf->SetFont('Arial', 'B', 5);
$pdf->Cell(15, 1, $Fila[3], 0, 1);

$pdf->SetFont('Arial', 'B', 3);
$pdf->SetXY(3, 8);
$pdf->Cell(12, 1, 'PROPIETARIO', 0);
$pdf->SetFont('Arial', '', 4);
$pdf->Cell(12, 1, 'BAUTISTA OLVERA MARCO ELIAS', 0);

$pdf->SetFont('Arial', 'B', 3);
$pdf->SetXY(3, 12);
$pdf->Cell(25, 1, 'RFC', 0);
$pdf->Cell(25, 1, 'NUMERO DE SERIE', 0);
$pdf->Cell(25, 1, 'MODELO', 0, 1);
$pdf->SetFont('Arial', '', 4);
$pdf->SetXY(3, 14);
$pdf->Cell(25, 1, $Fila[4], 0);
$pdf->Cell(25, 1, $Fila[5], 0);
$pdf->Cell(25, 1, $Fila[6], 0);

$pdf->SetFont('Arial', 'B', 3);
$pdf->SetXY(3, 16);
$pdf->Cell(25, 1, 'LOCALIDAD', 0);
$pdf->Cell(25, 1, 'MARCA/LINEA/SUBLINEA', 0);
$pdf->Cell(25, 1, 'OPERACION', 0);
$pdf->SetFont('Arial', '', 4);
$pdf->SetXY(3, 18);
$pdf->Cell(25, 1, $Fila[7], 0);
$pdf->Cell(25, 1, $Fila[8] . '/' . $Fila[9] . '/' . $Fila[10], 0);
$pdf->Cell(25, 1, '2018/1058773', 0);

$pdf->SetFont('Arial', 'B', 3);
$pdf->SetXY(3, 22);
$pdf->Cell(25, 1, 'MUNICIPIO', 0);
$pdf->SetFont('Arial', '', 4);
$pdf->SetXY(3, 24);
$pdf->Cell(25, 1, 'QUERETARO', 0);

$pdf->SetFont('Arial', 'B', 3);
$pdf->SetXY(3, 26);
$pdf->Cell(20, 1, 'NUMERO DE CONSTANCIAS', 0);
$pdf->Cell(10, 1, 'CILINDRAJE', 0);
$pdf->Cell(5, 1, $Fila[11], 0);
$pdf->Cell(15, 1, 'CVE VEHICULAR', 0);
$pdf->Cell(15, 1, 'FECHA DE EXPEDICION', 0, 1);
$pdf->SetXY(3, 27);
$pdf->Cell(20, 1, 'DE INSCRIPCION', 0);
$pdf->Cell(10, 1, 'CAPACIDAD', 0);
$pdf->Cell(20, 1, $Fila[12], 0);
$pdf->Cell(20, 1, $Fila[13], 0);
$pdf->SetXY(23, 28);
$pdf->Cell(10, 1, 'PUERTAS', 0);
$pdf->Cell(5, 1, $Fila[14], 0);
$pdf->Cell(10, 1, 'CLASE', 0);
$pdf->Cell(5, 1, '2', 0);
$pdf->Cell(15, 1, 'OFICINA EXPEDIDORA', 0);
$pdf->Cell(1, 1, '1', 0);
$pdf->SetXY(23, 29);
$pdf->Cell(10, 1, 'ASIENTOS', 0);
$pdf->Cell(5, 1, $Fila[15], 0);
$pdf->Cell(10, 1, 'TIPO', 0);
$pdf->Cell(5, 1, '9', 0);
$pdf->Cell(10, 1, 'MOVIMIENTO', 0);
$pdf->SetXY(3, 30);
$pdf->Cell(20, 1, 'ORIGEN', 0);
$pdf->Cell(10, 1, 'COMBUSTIBLE', 0);
$pdf->Cell(5, 1, '1', 0);
$pdf->Cell(10, 1, 'USO', 0);
$pdf->Cell(5, 1, '36', 0);
$pdf->Cell(10, 1, 'ALTA DE PLACA', 0);
$pdf->SetXY(3, 32);
$pdf->SetFont('Arial', '', 4);
$pdf->Cell(20, 1, $Fila[16], 0);
$pdf->SetFont('Arial', 'B', 3);
$pdf->Cell(15, 1, 'TRANSMISION', 0);
$pdf->Cell(15, 1, 'RPA', 0);
$pdf->Cell(10, 1, 'NUMERO DE MOTOR', 0);
$pdf->SetXY(3, 34);
$pdf->Cell(20, 1, 'COLOR', 0);
$pdf->SetFont('Arial', '', 4);
$pdf->Cell(30, 1, $Fila[17], 0);
$pdf->Cell(20, 1, 'HECHO EN USA', 0);
$pdf->SetXY(3, 36);
$pdf->SetFont('Arial', '', 4);
$pdf->Cell(30, 1, $Fila[18], 0);

$pdf->Image('Q1.png', 15, 37, 20, 10);
$pdf->SetXY(38, 40);
$pdf->SetFont('Arial', 'B', 5);
$pdf->Cell(30, 2, 'PODER  EJECUTIVO  DEL', 0, 1);
$pdf->SetX(38);
$pdf->Cell(30, 2, 'ESTADO DE QUERETARO', 0, 1);
$pdf->SetFont('Arial', '', 3);
$pdf->SetX(38);
$pdf->Cell(30, 2, 'SECRETARIA DE SEGURIDAD CIUDADANA', 0, 1);

$pdf->Image('rectangulo.png', 16.8, 44, 52, 30);
$pdf->SetXY(0, 50.5);
$pdf->SetFont('Arial', '', 6);
$pdf->SetTextColor(255, 255, 255);
$pdf->Cell(85.60, 2, 'TARJETA DE CIRCULACION VEHICULAR', 0, 1, 'C');

//Vertical
$pdf->SetXY(80, 15);
$pdf->SetFont('Arial', 'B', 8);
$pdf->SetTextColor(0, 0, 0);
$pdf->MultiCell(1, 2.5, 'A1679305', 0, 'C');

$pdf->Image('QR.png', 68, 38, 15, 15);

$pdf->Image('LQ.png', 4, 40, 10, 10);

$pdf->Output();
?>