<?php
$curp = $_POST['CURP'];
$nombre = $_POST['Nombre'];
$domicilio = $_POST['Domicilio'];
$folio_tc = $_POST['FolioTC'];
$no_licencia = $_POST['NoLicencia'];
$fecha_nacimiento = $_POST['FechaNacimiento'];
$tipo_sangre = $_POST['TipoSangre'];
$donador_org = $_POST['DonadorOrg'];
$numero_emergencia = $_POST['NumeroEmergencia'];

$SQL = "INSERT INTO conductores VALUES('$curp', '$nombre', '$domicilio', '$folio_tc', '$no_licencia', '$fecha_nacimiento', '$tipo_sangre', '$donador_org', '$numero_emergencia')";

include("controlador.php");

$Conexion = conectar();

$ResultSet = ejecutar($Conexion, $SQL);

$Desconectar = Desconectar($Conexion);

if ($ResultSet == 1) {
    print ("Registro guardado");
} else {
    print ("Error al guardar el registro" . $Conexion->error);
}

?>