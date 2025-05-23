<?php
$ID_DOMICILIO = $_GET['ID_DOMICILIO'];
$CALLE = $_GET['CALLE'];
$CP = $_GET['CP'];
$COLONIA = $_GET['COLONIA'];
$NUM_INT = $_GET['NUM_INT'];
$NUM_EXT = $_GET['NUM_EXT'];
$ESTADO = $_GET['ESTADO'];
$MUNICIPIO = $_GET['MUNICIPIO'];
$REFERENCIAS = $_GET['REFERENCIAS'];

/*
print ("Id Domicilio = " . $ID_DOMICILIO . "<br>");
print ("Calle = " . $CALLE . "<br>");
print ("Codigo postal = " . $CP . "<br>");
print ("Colonia = " . $COLONIA . "<br>");
print ("Numero Interno =" . $NUM_INT . "<br>");
print ("Numero Externo =" . $NUM_EXT . "<br>");
print ("Estado = " . $ESTADO . "<br>");
print ("Municipio = " . $MUNICIPIO . "<br>");
print ("Referencias = " . $REFERENCIAS . "<br>");
*/
$SQL = "INSERT INTO domicilios VALUES ('$ID_DOMICILIO', '$CALLE', '$CP', '$COLONIA', '$NUM_INT', '$NUM_EXT', '$ESTADO', '$MUNICIPIO', '$REFERENCIAS')";

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