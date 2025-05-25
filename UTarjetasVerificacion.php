<?php
if(
    isset($_GET['FOLIO_VERIFICACION']) ||
    isset($_GET['VEHICULO']) ||
    isset($_GET['DOMICILIO']) ||
    isset($_GET['TC']) ||
    isset($_GET['CENTRO_VERIFICACION']) ||
    isset($_GET['TECNICO_VERIFICACION']) ||
    isset($_GET['FECHA_EXPEDICION']) ||
    isset($_GET['HORA_ENTRADA']) ||
    isset($_GET['HORA_SALIDA']) ||
    isset($_GET['MOTIVO_VERIFICACION']) ||
    isset($_GET['SEMESTRE']) ||
    isset($_GET['FOLIO_PREVIO']) ||
    isset($_GET['VIGENCIA'])
)
{
    $FOLIO_VERIFICACION = $_GET['FOLIO_VERIFICACION'];
    $VEHICULO = $_GET['VEHICULO'];
    $DOMICILIO = $_GET['DOMICILIO'];
    $TC = $_GET['TC'];
    $CENTRO_VERIFICACION = $_GET['CENTRO_VERIFICACION'];
    $TECNICO_VERIFICACION = $_GET['TECNICO_VERIFICACION'];
    $FECHA_EXPEDICION = $_GET['FECHA_EXPEDICION'];
    $HORA_ENTRADA = $_GET['HORA_ENTRADA'];
    $HORA_SALIDA = $_GET['HORA_SALIDA'];
    $MOTIVO_VERIFICACION = $_GET['MOTIVO_VERIFICACION'];
    $SEMESTRE = $_GET['SEMESTRE'];
    $FOLIO_PREVIO = $_GET['FOLIO_PREVIO'];
    $VIGENCIA = $_GET['VIGENCIA'];

    $SQL = "UPDATE tarjetas_verificacion SET 
        VEHICULO = '$VEHICULO', 
        DOMICILIO ='$DOMICILIO', 
        TC ='$TC', 
        CENTRO_VERIFICACION ='$CENTRO_VERIFICACION', 
        TECNICO_VERIFICACION ='$TECNICO_VERIFICACION', 
        FECHA_EXPEDICION ='$FECHA_EXPEDICION', 
        HORA_ENTRADA ='$HORA_ENTRADA', 
        HORA_SALIDA ='$HORA_SALIDA', 
        MOTIVO_VERIFICACION ='$MOTIVO_VERIFICACION', 
        SEMESTRE ='$SEMESTRE', 
        FOLIO_PREVIO ='$FOLIO_PREVIO', 
        VIGENCIA ='$VIGENCIA' 
        WHERE FOLIO_VERIFICACION = '$FOLIO_VERIFICACION'; ";

    include("Controlador.php");

    $Con = Conectar();
    $ResultSet = Ejecutar($Con, $SQL);
    $NumRows = mysqli_affected_rows($Con);
    Desconectar($Con);

    if ($NumRows== 1) {
        print ("Se actualizo la tarjeta de verificacion con exito");
    } else {
        print ("No se pudo actualizar la tarjeta de verificacion");
    }
}