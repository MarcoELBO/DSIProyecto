<?php
//Recuperar datos
$ID_Oficial = $_REQUEST['ID_Oficial'];
//Crear instruccion
$SQL = "DELETE FROM oficiales WHERE ID_Oficial = '$ID_Oficial'";

//Enviar la consulta al SMDB

include("Controlador.php");
$Conexion = Conectar();
$ResultSet = Ejecutar($Conexion, $SQL);
$FilasA = mysqli_affected_rows($Conexion);

if ($FilasA == 0) {
    print ("No se ha eliminado el registro");
} else {
    print ("Se ha eliminado correctamente el registro");
}

$Desconectar = Desconectar($Conexion);
?>