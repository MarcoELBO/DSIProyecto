<?php
    include_once("proteccion.php");
    validar_token('A', true);
$ID_Propietario = $_REQUEST['ID_Propietario'];
include("Controlador.php");
$Conexion = Conectar();

$sql_preventivo = "UPDATE tarjetas_circulacion SET Propietario =8  WHERE Propietario ='$ID_Propietario';";

Ejecutar($Conexion, $sql_preventivo);
$SQL = "DELETE FROM propietarios WHERE ID_Propietario = '$ID_Propietario'";

$ResultSet = Ejecutar($Conexion, $SQL);
$FilasA = mysqli_affected_rows($Conexion);
if ($FilasA == 0) {
    print ("No se ha eliminado el registro");
} else {
    print ("Se ha eliminado correctamente el registro");
}
?>