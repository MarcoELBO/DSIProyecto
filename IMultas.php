<?php
$Folio = $_REQUEST['Folio'];
$Fecha = $_REQUEST['Fecha'];
$Hora = $_REQUEST['Hora'];
$Motivo = $_REQUEST['Motivo'];
$Licencia = $_REQUEST['Licencia'];
$T_Verificacion = $_REQUEST['T_Verificacion'];
$T_Circulacion = $_REQUEST['T_Circulacion'];
$Policia = $_REQUEST['Policia'];
$observaciones = $_REQUEST['Observaciones'];
$Lugar = $_REQUEST['Lugar'];


$SQL = "INSERT INTO multas (Folio, Fecha, Hora, Motivo, Licencia, T_Verificacion, T_Circulacion, Policia, Observaciones, Lugar) VALUES ('$Folio', '$Fecha', '$Hora', '$Motivo', '$Licencia', '$T_Verificacion', '$T_Circulacion', '$Policia', '$observaciones', '$Lugar')";

include("controlador.php");

$Conexion = conectar();

$ResultSet = ejecutar($Conexion, $SQL);

$Desconectar = Desconectar($Conexion);

if ($ResultSet == 1) {
    print ("Registro guardado");
} else {
    print ("Error al guardar el registro" . $Conexion->error);
}

?>