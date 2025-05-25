<?php
//$ID_DOMICILIO = $_POST['ID_DOMICILIO'];
$CALLE = $_POST['CALLE'];
$CP = $_POST['CP'];
$COLONIA = $_POST['COLONIA'];
$NUM_INT = $_POST['NUM_INT'];
$NUM_EXT = $_POST['NUM_EXT'];
$ESTADO = $_POST['ESTADO'];
$MUNICIPIO = $_POST['MUNICIPIO'];
$REFERENCIAS = $_POST['REFERENCIAS'];

$SQL = "INSERT INTO domicilios VALUES (NULL ,'$CALLE', '$CP', '$COLONIA', '$NUM_INT', '$NUM_EXT', '$ESTADO', '$MUNICIPIO', '$REFERENCIAS')";

include("Controlador.php");

$Conexion = Conectar();

$ResultSet = Ejecutar($Conexion, $SQL);

$Desconectar = Desconectar($Conexion);

if ($ResultSet == 1) {
    print ("Registro guardado");
} else {
    print ("Error al guardar el registro" . $Conexion->error);
}

?>