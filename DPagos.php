<?php
$ID_Pago = $_REQUEST['ID_Pago'];
$SQL = "DELETE FROM pagos WHERE ID_Pago = '$ID_Pago'";
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