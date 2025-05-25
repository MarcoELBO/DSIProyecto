<?php
    include_once("proteccion.php");
    validar_token('A', true);
$NO_DOMICILIO = $_REQUEST['NO_DOMICILIO'];
$SQL = "DELETE FROM domicilios WHERE NO_DOMICILIO = '$NO_DOMICILIO'";
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