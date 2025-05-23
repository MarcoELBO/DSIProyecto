<?php
$CURP = $_POST['CURP'];
$Nombre = $_POST['Nombre'];
$Domicilio = $_POST['Domicilio'];
$Folio_TC = $_POST['FolioTC'];
$NoLicencia = $_POST['NoLicencia'];

/*
print ("CURP = " . $CURP . "<br>");
print ("Nombre = " . $Nombre . "<br>");
print ("Domicilio = " . $Domicilio . "<br>");
print ("Folio TC = " . $Folio_TC . "<br>");
print ("NoLicencia = " . $NoLicencia . "<br>");
*/

$SQL = "INSERT INTO CONDUCTORES VALUES('$CURP', '$Nombre', '$Domicilio', '$Folio_TC', '$NoLicencia')";

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
?>