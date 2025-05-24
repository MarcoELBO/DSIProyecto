<?php
$Nombre = $_REQUEST['Nombre'];
$Cargo = $_REQUEST['Cargo'];


$SQL = "INSERT INTO oficiales VALUES(NULL,'$Nombre','$Cargo')";

include("controlador.php");

$Conexion = conectar();

$ResultSet = ejecutar($Conexion, $SQL);

$Desconectar = Desconectar($Conexion);

if ($ResultSet == 1) {
    print ("Registro guardado");
} else {
    print ("Error al guardar el registro" . $Conexion->error);
}
?>