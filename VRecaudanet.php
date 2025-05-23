<?php

include("Controlador.php");
$Con = Conectar();
$SQL = "SELECT * FROM vehiculotcp";
$ResultSet = Ejecutar($Con, $SQL);
$Fila = mysqli_fetch_array($ResultSet);
$Cerrar = Desconectar($Con);

require('fpdf.php');

$pdf = new FPDF('P', 'mm', array(215.9, 279.4));
$pdf->AddPage();
$pdf->SetMargins(20, 15, 20); // Márgenes
$pdf->SetFont('Arial', 'B', 40);

$pdf->Rect(20, 10, 20, 25, 'F');
$pdf->Image('Imagenes/LQueretaro.png', 45, 12, 25, 20); // Imagen pequeña
$pdf->Cell(0, 15, 'RECAUDANET', 0, 1, 'R');

$pdf->SetFont('Arial', '', 12);
$pdf->SetXY(20, 35);
$pdf->Cell(0, 10, 'Poder Ejecutivo del Estado de Queretaro', 0, 1);
$pdf->Rect(20, 45, 175, 10, 'F');
$pdf->SetTextColor(255, 255, 255);
$pdf->Cell(0, 10, 'Gracias por usar recaudanet', 0, 1);

$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 11);
$pdf->Ln(2);
$pdf->Cell(0, 8, $Fila[0], 0, 1);
$pdf->Cell(0, 8, 'MODELO ' . $Fila[1] . ' COLOR: ' . $Fila[2], 0, 1);
$pdf->Cell(0, 8, $Fila[3] . ' ' . $Fila[4] . ' ' . $Fila[5] . ' PH, GASOLINA', 0, 1);
$pdf->Cell(0, 8, 'Transaccion: ' . $Fila[6], 0, 1);
$pdf->Cell(0, 8, 'Fecha limite para el pago: ' . $Fila[7], 0, 1);
$pdf->Cell(0, 8, 'Importe: $' . $Fila[8], 0, 1);
$pdf->SetXY(108, 81);
$pdf->Cell(0, 8, 'Tipo de instrumento de pago: Pago referendado', 0, 1);
$pdf->SetX(108);
$pdf->Cell(0, 8, 'Fecha actual: ' . $Fila[7], 0, 1);
$pdf->SetX(108);
$pdf->Cell(0, 8, 'Hora: ' . $Fila[9], 0, 1);

$pdf->Ln(5);
$pdf->SetFont('Arial', 'I', 9);
$pdf->MultiCell(0, 6, utf8_decode('Nota: El nombre y/o razón social que saldrá en el recibo de pago y/o CFDI será el registrado en el padrón vehicular, el cual una vez pagado no podrá ser modificado.'));

$pdf->Ln(5);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(0, 8, 'BANCOS Y ESTABLECIMIENTOS DONDE PUEDES EFECTUAR TUS PAGOS', 0, 1, 'C');
$pdf->Image('Imagenes/CB.png', 43, 145, 130, 30);

$pdf->Rect(20, 135, 175, 100, '');
$pdf->Rect(20, 135, 175, 5, 'F');

// Salida del archivo PDF
$pdf->Output('I', 'recaudanet_formato_carta.pdf');
?>