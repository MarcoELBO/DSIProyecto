<?php

require('fpdf.php');
include("controlador.php");

$Con = conectar();

//$Folio=$_POST['Folio'];
$SQL = "SELECT * FROM Multas WHERE Folio= 1;";
$ResultSet = ejecutar($Con, $SQL);
$DatosCuenta = mysqli_fetch_row($ResultSet);

$pdf = new FPDF('P', 'mm', array(180, 450));
$pdf->SetMargins(0, 0);
$pdf->SetAutoPageBreak(true, 1);

$pdf->AddPage();
$pdf->SetXY(10, 7);
$pdf->SetFont('Arial', '', 8);
$pdf->MultiCell(162, 5, 'Con fundamento en los articulos 31 fraccion 15 de la ley de transito para el Estado de Queretaro y fraccion 16 del Reglamento de la ley de transito para el Estado de Queretaro se solicita la presente boleta de infraccion');

$pdf->SetXY(10, 24);
$pdf->Cell(160, 20, "", 1);
$pdf->SetFont('Arial', '', 12);
$pdf->SetXY(10, 24);
$pdf->Cell(70, 10, "$DatosCuenta[1]", 1, 0, 'C');
$pdf->SetXY(80, 24);
$pdf->Cell(40, 10, "$DatosCuenta[2]", 1, 0, 'C');
$pdf->SetXY(10, 34);
$pdf->Cell(110, 10, "Aplicacion Radar", 1, 0, 'C');
$pdf->SetXY(120, 24);
$pdf->Cell(50, 20, "B-  $DatosCuenta[0]", 1, 0, 'C');

$pdf->SetXY(10, 46);
$pdf->Cell(160, 20, "", 1);
$pdf->SetXY(10, 46);
$pdf->Cell(160, 10, "Carr. Estatal 500", 1);
$pdf->SetXY(10, 56);
$pdf->Cell(160, 10, "Entronque Carr 100", 1);

$pdf->SetXY(10, 68);
$pdf->Cell(160, 40, "Informacion del multado", 1);

$pdf->SetXY(10, 110);
$pdf->Cell(160, 30, "Informacion del vehiculo", 1);

$pdf->SetXY(10, 142);
$pdf->Cell(160, 30, "Motivo de mutla", 1);


$pdf->SetXY(10, 174);
$pdf->Cell(160, 20, "Objeto retenido", 1);

$pdf->SetXY(10, 196);
$pdf->Cell(160, 10, "Datos Generales", 1);

$pdf->SetXY(10, 208);
$pdf->Cell(160, 30, "Datos Oficial", 1);

$pdf->SetXY(10, 240);
$pdf->Cell(160, 30, "Ubicacion centro de pago", 1);

$pdf->SetXY(10, 272);
$pdf->Cell(160, 20, "calificacion de la boleta de ifnraccion", 1);

$pdf->SetXY(10, 294);
$pdf->Cell(160, 20, "Observaciones del conductor", 1);

$pdf->SetFont('Arial', '', 8);
$pdf->SetXY(10, 316);
$pdf->MultiCell(160, 5, "Para el pago de la presente infracción y devolución de la(s) garantía(s) retenida(s), es aplicable lo dispuesto en el articulo 179 del Reglamento de la Ley de Tránsito para el Estado de Querétaro.
El pago de la multa se puede realizar en:
1. Oficinas recaudadoras de la Dirección de Ingresos de la Secretaría de Planeación y Finanzas del Poder Ejecutivo del Estado de Querétaro, y 
2.Centros autorizados para este fin, incluyendo medios electrónicos de pago. Las placas de circulación o documentación retenida serán devueltas en las oficinas de la Secretaria de Seguridad Ciudadana, una vez realizado el pago. 
El infractor tendró un plazo de noventa dias naturales contados a partir de la fecha de emisión de la boleta d infracción para realizar el pago, ef cual será sujeto a descuento del 50% dentro de los diez primeres dias hábiles siempre y cuando no se trate de las infracciones previstas en el articulo 179 bis def Reglamento de la Ley de îránsito para el Estado de Querétaro, vencido el plazo señalado sin que se realice el pago, deberă cubrir los demás crédito fiscales que establece el Código Fiscal del Estado de Querétaro. 
EI intractor podrá solicitar la devolución de su garantia al dia hábil siguiente al de la emisión de la beleta c Infracción. La persona que considere que existe una conducta indebida por parte del personal operativo, puede presentar un reporte al teléfono 442 309 1400, extensión 10376: realizar una denuncia por la App Denuncianet (disponible para Android e los) o acudir ante la Unidad de Asuntos Internos de la Secretaria de Seguridad Ciudadana, en dias y horas hábiles, donde se le brindará atención personalizada. La presentación de una denuncia por la conducta policial no implica por si misma un recurso o medio de defensa legal en contra de esta boleta de infracción ni genera su invalidación. 
Se hace del conocimiento del infractor que, de conformidad con el articulo 4, fracción Xll de la Ley de Procedimientos Administrativos del Estado de Querétaro, este acto administrativo es recurrible mediante recurso de revisión o juicio de nulidad, en términos de las dispociones juridicas aplicables", 1);

//$pdf->Image("escudo11.png", 10, 420, 40,25);

$pdf->Output();

desconectar($Con);

?>