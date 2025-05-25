<?php
    include_once("proteccion.php");
    validar_token('A', true);
$Placa = $_REQUEST['Placa'];
$SQL = "DELETE FROM vehiculos WHERE Placa = '$Placa'";
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