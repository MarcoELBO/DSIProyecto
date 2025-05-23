<?php
$Folio_Verificacion = $_GET['Folio_Verificacion'];
$Vehiculo = $_GET['Vehiculo'];
$Domicilio = $_GET['Domicilio'];
$TC = $_GET['TC'];
$Centro_Verificacion = $_GET['Centro_Verificacion'];
$TECNICO_VERIFICACION = $_GET['TECNICO_VERIFICACION'];
$FECHA_EXPEDICION = $_GET['FECHA_EXPEDICION'];
$HORA_ENTRADA = $_GET['HORA_ENTRADA'];
$HORA_SALIDA = $_GET['HORA_SALIDA'];
$MOTIVO_VERIFICACION = $_GET['MOTIVO_VERIFICACION'];
$SEMESTRE = $_GET['SEMESTRE'];
$FOLIO_PREVIO = $_GET['FOLIO_PREVIO'];
$VIGENCIA = $_GET['VIGENCIA'];

/*
print ("Folio de verificación = " . $Folio_Verificacion . "<br>");
print ("Vehiculo = " . $Vehiculo . "<br>");
print ("Domicilio = " . $Domicilio . "<br>");
print ("Tarjeta de circulación = " . $TC . "<br>");
print ("Tecnico verificado = " . $TECNICO_VERIFICACION . "<br>");
print ("Fecha de expedicion = " . $FECHA_EXPEDICION . "<br>");
print ("Hora de entrada = " . $HORA_ENTRADA . "<br>");
print ("Hora de salida = " . $HORA_SALIDA . "<br>");
print ("Motivo de verificacion = " . $MOTIVO_VERIFICACION . "<br>");
print ("Semestre = " . $SEMESTRE . "<br>");
print ("Folio previo = " . $FOLIO_PREVIO . "<br>");
print ("Vigencia = " . $VIGENCIA . "<br>");
*/

$SQL = "INSERT INTO TARJETAS_VERIFICACION (Folio_Verificacion, Vehiculo, Domicilio, TC, Centro_Verificacion, TECNICO_VERIFICACION, FECHA_EXPEDICION, HORA_ENTRADA, HORA_SALIDA, MOTIVO_VERIFICACION, SEMESTRE, FOLIO_PREVIO, VIGENCIA) VALUES ('$Folio_Verificacion', '$Vehiculo', '$Domicilio', '$TC', '$Centro_Verificacion', '$TECNICO_VERIFICACION', '$FECHA_EXPEDICION', '$HORA_ENTRADA', '$HORA_SALIDA', '$MOTIVO_VERIFICACION', '$SEMESTRE', '$FOLIO_PREVIO', '$VIGENCIA')";

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