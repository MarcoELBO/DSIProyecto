<?php
    include_once("proteccion.php");
    validar_token('A', true);
$ID_LICENCIA = $_REQUEST['ID_LICENCIA'];
$SQL = "DELETE FROM licencias WHERE ID_LICENCIA = '$ID_LICENCIA'";
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