<?php
$ID_Oficial = $_REQUEST['ID_Oficial'];
$Nombre = $_REQUEST['Nombre'];
$Cargo = $_REQUEST['Cargo'];

$SQL = "UPDATE Oficiales SET Nombre = '$Nombre', Cargo ='$Cargo' WHERE ID_Oficial = '$ID_Oficial'; ";

include("Contralor.php");

$Con = Conectar();
$ResultSet = Ejecutar($Con, $SQL);
$Exit = desconectar($conexion);
if (mysqli_num_rows($ResultSet) == 1) {
    print ("Se actualizo el propietario con exito");
} else {
    print ("No se pudo actualizar el propietario");
}
?>