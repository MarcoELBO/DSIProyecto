<?php
    include_once("proteccion.php");
    validar_token('A', true);
$Folio = $_REQUEST['Folio'];
$SQL = "DELETE FROM multas WHERE Folio = '$Folio'";
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