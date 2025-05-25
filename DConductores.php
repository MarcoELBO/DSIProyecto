<?php
    include_once("proteccion.php");
    validar_token('A', true);
$CURP = $_REQUEST['CURP'];
$SQL = "DELETE FROM conductores WHERE CURP = '$CURP'";
include("Controlador.php");
$Conexion = Conectar();
$ResultSet = Ejecutar($Conexion, $SQL);
$FilasA = mysqli_affected_rows($Conexion);
if ($FilasA == 0) {
    print ("No se ha eliminado el registro");
} else {
    print ("Se ha eliminado correctamente el registro");
}
?>