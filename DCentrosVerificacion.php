<?php
    include_once("proteccion.php");
    validar_token('A', true);
$NO_CENTRO = $_REQUEST['NO_CENTRO'];
$SQL = "DELETE FROM centros_verificacion WHERE NO_CENTRO = '$NO_CENTRO'";

include("Controlador.php");
$Conexion = Conectar();
$ResultSet = Ejecutar($Conexion, $SQL);
$FilasA = mysqli_affected_rows($Conexion);

if ($FilasA == 0) {
    print ("No se ha eliminado el registro");
} else {
    print ("Se ha eliminado correctamente el registro");
}

$Desconectar = Desconectar($Conexion);
?>