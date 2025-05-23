<?php
$NO_CENTRO = $_POST['NO_CENTRO'];
$NO_LINEA = $_POST['NO_LINEA'];
$VERIFICACION = $_POST['VERIFICACION'];
$NOMBRE = $_POST['NOMBRE'];
$DOMICILIO = $_POST['DOMICILIO'];
$TIPO_CENTRO = $_POST['TIPO_CENTRO'];

/*
print ("No Centro = " . $NO_CENTRO . "<br>");
print ("No Linea = " . $NO_LINEA . "<br>");
print ("VERIFICACION = " . $VERIFICACION . "<br>");
print ("NOMBRE = " . $NOMBRE . "<br>");
print ("DOMICILIO = " . $DOMICILIO . "<br>");
print ("Tipo de centro = " . $TIPO_CENTRO . "<br>");




$Server = "127.0.0.1";
$User = "root";
$Pws = "";
$BD = "controlvehicular31";

$Con = mysqli_connect($Server, $User, $Pws, $BD);
*/

$SQL = "INSERT INTO CENTROS_VERIFICACION(NO_CENTRO, NO_LINEA, VERIFICACION, NOMBRE, DOMICILIO, TIPO_CENTRO) VALUES ('$NO_CENTRO', '$NO_LINEA', '$VERIFICACION', '$NOMBRE', '$DOMICILIO', '$TIPO_CENTRO')";

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