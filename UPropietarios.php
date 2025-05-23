<?php
$ID_Propietario = $_REQUEST['ID_Propietario'];
$RFC = $_REQUEST['RFC'];
$Nombre = $_REQUEST['Nombre'];
$Fecha_nacimiento = $_REQUEST['Fecha_nacimiento'];


$SQL = "UPDATE Propietarios SET RFC='$RFC', Nombre ='$Nombre', Fecha_nacimiento = '$Fecha_nacimiento' WHERE ID_Propietario = '$ID_Propietario';";

include("Controlador.php");
$conexion = conectar();
$ResultSet = ejecutar($conexion, $SQL);
$Exit = desconectar($conexion);
$pep = mysqli_num_rows($ResultSet);
if ($pep == 1) {
    print ("Se actualizo el propietario con exito");
} else {
    print ("No se pudo actualizar el propietario");
}
?>