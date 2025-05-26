<?php
    include_once("proteccion.php");
    validar_token('A', true);
include("Controlador.php");
$Conexion = Conectar();

$NO_DOMICILIO = $_REQUEST['ID_DOMICILIO'];
$sql_preventivo = "UPDATE tarjetas_verificacion SET DOMICILIO = 100 WHERE DOMICILIO = '$NO_DOMICILIO';";
Ejecutar($Conexion, $sql_preventivo);
$sql_preventivo = "UPDATE conductores SET DOMICILIO = 100 WHERE DOMICILIO = '$NO_DOMICILIO';";
Ejecutar($Conexion, $sql_preventivo);
$sql_preventivo = "UPDATE centros_verificacion SET DOMICILIO = 100 WHERE DOMICILIO = '$NO_DOMICILIO';";
Ejecutar($Conexion, $sql_preventivo);
$sql_preventivo = "UPDATE tarjetas_circulacion SET Domicilio = 100 WHERE Domicilio = '$NO_DOMICILIO';";
Ejecutar($Conexion, $sql_preventivo);
$sql_preventivo = "UPDATE licencias SET  DOMICILIO  = 100 WHERE  DOMICILIO  = '$NO_DOMICILIO';";
Ejecutar($Conexion, $sql_preventivo);
$SQL = "DELETE FROM domicilios WHERE ID_DOMICILIO = '$NO_DOMICILIO'";

$ResultSet = Ejecutar($Conexion, $SQL);
$FilasA = mysqli_affected_rows($Conexion);
if ($FilasA == 0) {
    print ("No se ha eliminado el registro");
} else {
    print ("Se ha eliminado correctamente el registro");
}
?>