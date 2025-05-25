<?php
if(
    isset($_GET['ID_Oficial']) ||
    isset($_GET['Nombre']) ||
    isset($_GET['Cargo'])
){
$ID_Oficial = $_GET['ID_Oficial'];
$Nombre = $_GET['Nombre'];
$Cargo = $_GET['Cargo'];

$SQL = "UPDATE Oficiales SET 
NombreO = '$Nombre', 
Cargo ='$Cargo' 
WHERE ID_Oficial = '$ID_Oficial'; ";

include("Controlador.php");

$Con = Conectar();
$ResultSet = Ejecutar($Con, $SQL);
<<<<<<< HEAD
$NumRows = mysqli_affected_rows($Con);
Desconectar($Con);

if ($NumRows== 1) {
=======
$Exit = Desconectar($conexion);
if (mysqli_num_rows($ResultSet) == 1) {
>>>>>>> 12c9d0c3e64a85cda7f2e34dd8ae8990fbe8398f
    print ("Se actualizo el propietario con exito");
} else {
    print ("No se pudo actualizar el propietario");
}
}
?>