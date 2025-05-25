<?php
    include_once("proteccion.php");
    validar_token('A', true);
$ID_TC = $_REQUEST['ID_TC'];
$SQL = "DELETE FROM tarjetas_circulacion WHERE ID_TC = '$ID_TC'";
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