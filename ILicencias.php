<?php
$id_licencia = $_REQUEST['id_licencia'];
$conductor = $_REQUEST['conductor'];
$Fecha_expedicion = $_REQUEST['fecha_expedicion'];
$Fecha_validacion = $_REQUEST['fecha_validacion'];
$antiguedad = $_REQUEST['antiguedad'];
$observaciones = $_REQUEST['observaciones'];
$firma = $_REQUEST['firma'];
$Domicilio = $_REQUEST['domicilio'];
$fundamento_legal = $_REQUEST['fundamento_legal'];
$foto = $_REQUEST['foto'];
/*
print ("id_licencia = " . $id_licencia . "<br>");
print ("Conductor = " . $conductor . "<br>");
print ("Fecha_expedicion = " . $Fecha_expedicion . "<br>");
print ("Fecha_validacion = " . $Fecha_validacion . "<br>");
print ("antiguedad = " . $antiguedad . "<br>");
print ("observaciones = " . $observaciones . "<br>");
print ("firma = " . $firma . "<br>");
print ("Domicilio = " . $Domicilio . "<br>");
print ("Fundamento Legal = " . $fundamento_legal . "<br>");
print ("Foto = " . $foto . "<br>");
*/
$SQL = "INSERT INTO licencias VALUES ('$id_licencia', '$conductor', '$Fecha_expedicion', '$Fecha_validacion', '$antiguedad', '$observaciones', '$firma', '$Domicilio', '$fundamento_legal', '$foto')";

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