<?php
$conductor = $_REQUEST['conductor'];
$Fecha_expedicion = $_REQUEST['fecha_expedicion'];
$Fecha_validacion = $_REQUEST['fecha_validacion'];
$antiguedad = $_REQUEST['antiguedad'];
$observaciones = $_REQUEST['observaciones'];
$firma = $_REQUEST['firma'];
$Domicilio = $_REQUEST['domicilio'];
$fundamento_legal = $_REQUEST['fundamento_legal'];
$foto = $_REQUEST['foto'];

$SQL = "INSERT INTO licencias VALUES (NULL, '$conductor', '$Fecha_expedicion', '$Fecha_validacion', '$antiguedad', '$observaciones', '$firma', '$Domicilio', '$fundamento_legal', '$foto')";

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