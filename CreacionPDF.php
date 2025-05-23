<?php

include("Controlador.php");
$Con = Conectar();
$SQL = "SELECT * FROM LicenciaConducir";
$ResultSet = Ejecutar($Con, $SQL);
$Fila = mysqli_fetch_array($ResultSet);
$Cerrar = Desconectar($Con);

require('fpdf.php');
$pdf = new FPDF('P', 'mm', [30, 45]); // Tamaño pequeño
$pdf->AddPage();
$pdf->SetAutoPageBreak(true, 0);
//PARTE 1
$pdf->Image('logo1.png', 3, 2, 5, 5); // Imagen pequeña
$pdf->Image('LV.png', 10, 2, 1, 5); // Imagen pequeña

$pdf->SetFont('Arial', '', 2);
$pdf->SetY(2); // Posiciona el cursor vertical debajo del logo

$pdf->Cell(0, 1.3, 'Estados Unidos Mexicanos', 0, 1);
$pdf->Cell(0, 1.3, 'Poder Ejecutivo del Estado de Queretaro', 0, 1);

$pdf->SetFont('Arial', 'B', 2);
$pdf->Cell(0, 1.3, 'Secretaria de Seguridad Ciudadana', 0, 1);

$pdf->SetFont('Arial', 'B', 2);
$pdf->Cell(0, 1.3, 'Licencia para Conducir', 0, 1);

//PARTE 2
$pdf->Image('logo2.png', 17, 9, 10, 12);
$pdf->SetXY(0, 17.5);
$pdf->SetFont('Arial', '', 1.5);
$pdf->Cell(17, 1.3, 'No. de licencia', 0, 1, 'R');
$pdf->SetFont('Arial', 'B', 5);
$pdf->SetTextColor(255, 0, 0);
$pdf->SetX(0);
$pdf->Cell(17, 1.3, $Fila[0], 0, 1, 'R');
$pdf->SetFont('Arial', 'B', 2);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetX(0);
$pdf->Cell(17, 1.3, 'AUTOMOVILISTA', 0, 1, 'R');

//PARTE 3
$pdf->SetXY(18, 21.5);
$pdf->Cell(10, 1, 'Nombre', 0, 1, 'R');
$pdf->SetFont('Arial', 'B', 4);
$pdf->SetXY(18, 23);
$pdf->MultiCell(10, 1.2, $Fila[1], 0, 'R');
$pdf->SetFont('Arial', 'B', 1.5);
$pdf->SetXY(18, 26.5);
$pdf->Cell(10, 1, 'OBSERVACIONES', 0, 1, 'R');

//PARTE 4
$pdf->SetXY(2, 30);
$pdf->SetFont('Arial', 'B', 1.5);
$pdf->Cell(0, 1, 'Fecha de nacimiento', 0, 1);
$pdf->SetXY(2, 31);
$pdf->SetFont('Arial', '', 3);
$pdf->Cell(0, 1, $Fila[2], 0, 1);
$pdf->SetXY(2, 32);
$pdf->SetFont('Arial', 'B', 1.5);
$pdf->Cell(0, 1, 'Fecha de expedicion', 0, 1);
$pdf->SetXY(2, 33);
$pdf->SetFont('Arial', '', 3);
$pdf->Cell(0, 1, $Fila[3], 0, 1);
$pdf->SetXY(2, 34);
$pdf->SetFont('Arial', 'B', 1.5);
$pdf->Cell(0, 1, 'Valida hasta', 0, 1);
$pdf->SetXY(2, 35);
$pdf->SetFont('Arial', '', 3);
$pdf->Cell(0, 1, $Fila[4], 0, 1);
$pdf->SetXY(2, 36);
$pdf->SetFont('Arial', 'B', 1.5);
$pdf->Cell(0, 1, 'Antiguedad', 0, 1);
$pdf->SetXY(2, 37);
$pdf->SetFont('Arial', '', 3);
$pdf->Cell(0, 1, $Fila[5], 0, 1);

//PaRTE 5
$pdf->Image('A.png', 3, 38.5, 4, 4);
$pdf->SetXY(11, 41);
$pdf->SetFont('Arial', '', 1.5);
$pdf->Cell(0, 1, 'AUTORIZO PARA QUE LA PRESENTE SEA', 0, 1, 'C');
$pdf->SetX(11);
$pdf->Cell(0, 1, 'RECABADA COMO GARANTIA DE INFRACCION', 0, 1, 'C');
$pdf->Image('Queretaro.png', 24, 38.5, 4, 4);


//PAGINA 2
//PARTE 1
$Con = Conectar();
$SQL = "SELECT * FROM ConductorDomicilio";
$ResultSet = Ejecutar($Con, $SQL);
$Fila = mysqli_fetch_array($ResultSet);
$Cerrar = Desconectar($Con);


$pdf->AddPage();
$pdf->SetAutoPageBreak(true, 0);
$pdf->Image('Emergencias.png', 2, 2, 6, 5);
$pdf->SetFont('Arial', '', 5);
$pdf->SetTextColor(255, 255, 255);
$pdf->Image('Negro.png', 9, 2.5, 12, 4);
$pdf->SetXY(10, 4.5);
$pdf->Cell(0, 0, 'B211571223', 0, 1, 'C');
$pdf->Image('089.png', 23.1, 2.5, 5, 4);

//PARTE 2
$pdf->SetFont('Arial', 'B', 2);
$pdf->SetXY(0, 8);
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(29, 1, 'Domicilio', 0, 1, 'R');
$pdf->Cell(19, 1, $Fila[0], 0, 1, 'R');
$pdf->Cell(34.9, 1, 'SN', 0, 1, 'C');
$pdf->Cell(32, 1, $Fila[1], 0, 1, 'C');
$pdf->Cell(32.7, 1, 'C.P.' . $Fila[2], 0, 1, 'C');
$pdf->Cell(31.5, 1, $Fila[3], 0, 1, 'C');
$pdf->Image('Coches.png', 2, 13, 27, 6);

//PARTE 3
$pdf->SetFont('Arial', 'B', 2);
$pdf->SetXY(2, 19);
$pdf->Cell(0, 0, 'Restricciones', 0);
$pdf->Cell(0, 0, '      Grupo Sanguineo', 0, 1);
$pdf->SetFont('Arial', 'B', 3);
$pdf->SetXY(2, 19);
$pdf->Cell(0, 2, '9NINGUNA', 0);
$pdf->Cell(9, 2, $Fila[4], 0, 1, 'R');
$pdf->SetFont('Arial', 'B', 2);
$pdf->Cell(19, 1, 'DonadordeOrganos', 0, 1, 'R');
$pdf->SetFont('Arial', 'B', 3);
$pdf->Cell(19, 1, $Fila[5], 0, 1, 'R');
$pdf->SetFont('Arial', 'B', 2);
$pdf->Cell(19, 1, 'NumerodeEmergencias', 0, 1, 'R');
$pdf->SetFont('Arial', 'B', 3);
$pdf->Cell(19, 2, $Fila[6], 0, 1, 'R');

$pdf->Image('Firma.png', 24, 26, 4, 4);

$pdf->SetXY(0, 31);
$pdf->SetFont('Arial', 'B', 1.8);
$pdf->Cell(29, 1, 'MTRO EN GPA MIGUEL ANGEL CONTRERAZ ALVAREZ', 0, 1, 'R');
$pdf->Cell(19, 1, 'SECRETARIO DE SEGURIDAD CIUDADANA', 0, 1, 'R');
$pdf->SetXY(2, 33);
$pdf->Cell(0, 1, 'Fundamento Legal', 0, 1, 'L');
$pdf->SetFont('Arial', '', 1.5);
$pdf->SetXY(2, 34);
$pdf->MultiCell(27, 0.5, 'Ley de Transito y Transporte del Estado de Queretaro, Articulo 4, Fraccion I, II y III. Reglamento de la Ley de Transito y Transporte del Estado de Queretaro, Articulo 2, Fraccion I, II y III.', 0, 'L');
$pdf->Image('PoderEjecutivo.png', 16, 38, 6, 6);
$pdf->Image('LV.png', 21, 38.5, 1, 5);
$pdf->SetXY(0, 39.5);
$pdf->SetFont('Arial', 'B', 2);
$pdf->Cell(27.5, 1, 'SECRETARIA', 0, 1, 'R');
$pdf->Cell(18.3, 1, 'DE SEGURIDAD', 0, 1, 'R');
$pdf->Cell(17.2, 1, 'CIUDADANA', 0, 1, 'R');


$pdf->Output();

?>