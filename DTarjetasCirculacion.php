<?php
    include_once("proteccion.php");
    validar_token('A', true);
$ID_TC = $_REQUEST['ID_TC'];
include("Controlador.php");
$Conexion = Conectar();
$sql_preventivo = "UPDATE multas SET T_Circulacion = 10 WHERE T_Circulacion = '$ID_TC';";
Ejecutar($Conexion, $sql_preventivo);
$sql_preventivo = "UPDATE tarjetas_verificacion SET TC = 10 WHERE TC = '$ID_TC';";
Ejecutar($Conexion, $sql_preventivo);
$sql_preventivo = "UPDATE pagos SET Tarjeta_Asociada = 10 WHERE Tarjeta_Asociada = '$ID_TC';";
Ejecutar($Conexion, $sql_preventivo);
$SQL = "DELETE FROM tarjetas_circulacion WHERE ID_TC = '$ID_TC';";

$ResultSet = Ejecutar($Conexion, $SQL);
$FilasA = mysqli_affected_rows($Conexion);
if ($FilasA == 0) {
    print ("No se ha eliminado el registro");
} else {
    print ("Se ha eliminado correctamente el registro");
}
?>