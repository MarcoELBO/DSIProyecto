<?php
    include_once("proteccion.php");
    validar_token('A', true);
//Recuperar datos
$ID_Oficial = $_REQUEST['ID_Oficial'];
include("Controlador.php");
$Conexion = Conectar();
//Crear instruccion
$sql_preventivo = "UPDATE multas SET Policia = 9 where Policia = '$ID_Oficial';";
Ejecutar($Conexion, $sql_preventivo);
$SQL = "DELETE FROM oficiales WHERE ID_Oficial = '$ID_Oficial'";

//Enviar la consulta al SMDB


$ResultSet = Ejecutar($Conexion, $SQL);
$FilasA = mysqli_affected_rows($Conexion);

if ($FilasA == 0) {
    print ("No se ha eliminado el registro");
} else {
    print ("Se ha eliminado correctamente el registro");
}

$Desconectar = Desconectar($Conexion);
?>