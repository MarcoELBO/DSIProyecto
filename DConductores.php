<?php
    include_once("proteccion.php");
    validar_token('A', true);
$CURP = $_REQUEST['CURP'];
$sql_preventivo = "UPDATE licencias SET CONDUCTOR = 'NULOOOOOOOOOOOO' WHERE CONDUCTOR = '$CURP';";
$SQL = "DELETE FROM conductores WHERE CURP = '$CURP'";
include("Controlador.php");
$Conexion = Conectar();
$ResultSet = Ejecutar($Conexion, $sql_preventivo);
$ResultSet = Ejecutar($Conexion, $SQL);
$FilasA = mysqli_affected_rows($Conexion);
if ($FilasA == 0) {
    print ("No se ha eliminado el registro");
} else {
    print ("Se ha eliminado correctamente el registro");
}
?>