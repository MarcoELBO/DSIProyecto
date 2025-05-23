<?php
$Folio = $_REQUEST['Folio'];
$Fecha = $_REQUEST['Fecha'];
$Hora = $_REQUEST['Hora'];
$Motivo = $_REQUEST['Motivo'];
$Licencia = $_REQUEST['Licencia'];
$T_Verificacion = $_REQUEST['T_Verificacion'];
$T_Circulacion = $_REQUEST['T_Circulacion'];
$Policia = $_REQUEST['Policia'];

/*
print ("Folio = " . $Folio . "<br>");
print ("Fecha = " . $Fecha . "<br>");
print ("Hora = " . $Hora . "<br>");
print ("Motivo = " . $Motivo . "<br>");
print ("Licencia = " . $Licencia . "<br>");
print ("Tipo de verificacion = " . $T_Verificacion . "<br>");
print ("Tipo de circulacion" . $T_Circulacion . "<br>");
print ("Policia = " . $Policia . "<br>");
*/

$SQL = "INSERT INTO MULTAS (Folio, Fecha, Hora, Motivo, Licencia, T_Verificacion, T_Circulacion, Policia) VALUES ('$Folio', '$Fecha', '$Hora', '$Motivo', '$Licencia', '$T_Verificacion', '$T_Circulacion', '$Policia')";

include("Controlador.php");

$Conexion = Conectar();

$ResultSet = Ejecutar($Conexion, $SQL);

$Desconectar = Desconectar($Conexion);

if ($ResultSet == 1) {
    print ("Registro guardado");
} else {
    print ("Error al guardar el registro" . $Conexion->error);
}

?>