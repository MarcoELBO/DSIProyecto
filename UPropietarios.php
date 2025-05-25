<?php

    include_once("proteccion.php");
    validar_token('A', true);
if(isset($_GET['ID_Propietario']) ||
    isset($_GET['RFC']) ||
    isset($_GET['Nombre']) ||
    isset($_GET['Fecha_nacimiento']))
{
$ID_Propietario = $_REQUEST['ID_Propietario'];
$RFC = $_REQUEST['RFC'];
$Nombre = $_REQUEST['Nombre'];
$Fecha_nacimiento = $_REQUEST['Fecha_nacimiento'];


$SQL = "UPDATE propietarios SET 
RFC='$RFC', 
Nombre ='$Nombre', 
Fecha_nacimiento = '$Fecha_nacimiento' 
WHERE ID_Propietario = '$ID_Propietario';";

include("Controlador.php");
$con = conectar();
$ResultSet = ejecutar($con, $SQL);
$NumRows = mysqli_affected_rows($con);
Desconectar($con);
if ($NumRows == 1) {
    print ("Se actualizo el propietario con exito");
} else {
    print ("No se pudo actualizar el propietario");
}
}
?>