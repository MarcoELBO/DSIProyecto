<?php
    include_once("proteccion.php");
    validar_token('A', true);
$FOLIO_VERIFICACION = $_REQUEST['FOLIO_VERIFICACION'];
$SQL = "DELETE FROM tarjetas_verificacion WHERE FOLIO_VERIFICACION = '$FOLIO_VERIFICACION'";
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