<?php
    include_once("proteccion.php");
    validar_token('A', true);
$ID_Propietario = $_REQUEST['ID_Propietario'];
$SQL = "DELETE FROM propietarios WHERE ID_Propietario = '$ID_Propietario'";
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