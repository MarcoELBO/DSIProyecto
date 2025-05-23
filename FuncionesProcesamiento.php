<?php
//Conectar a la base de datos
$Servidor = "localhost";
$User = "root";
$Password = "";
$BD = "controlvehicular31";

$Conexion = mysqli_connect($Servidor, $User, $Password, $BD);

//Ejecutar una consulta
$SQL = "SELECT * FROM oficiales";
$ResultSet = mysqli_query($Conexion, $SQL);


//Procedimiento
$Campos = mysqli_field_count($Conexion);
print ("Numero de campos: " . $Campos);

//Cerrar la conexion
mysqli_close($Conexion);
?>