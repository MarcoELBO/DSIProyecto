<?php
    include_once("proteccion.php");
    validar_token('A', true);
    include("Controlador.php");
$Conexion = Conectar();
$ID_LICENCIA = $_REQUEST['NO_LICENCIA'];
    $sql_preventivo = "UPDATE multas SET LICENCIA = 530 where LICENCIA = '$ID_LICENCIA';";
    Ejecutar($Conexion, $sql_preventivo);
$SQL = "DELETE FROM licencias WHERE ID_LICENCIA = '$ID_LICENCIA'";

$ResultSet = Ejecutar($Conexion, $SQL);
$FilasA = mysqli_affected_rows($Conexion);
if ($FilasA == 0) {
    print ("No se ha eliminado el registro");
} else {
    print ("Se ha eliminado correctamente el registro");
}
?>