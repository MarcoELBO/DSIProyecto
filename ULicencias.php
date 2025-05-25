<?php
if(
    isset($_GET['ID_LICENCIA']) ||
    isset($_GET['CONDUCTOR']) ||
    isset($_GET['FECHA_EXPEDICION']) ||
    isset($_GET['FECHA_VALIDACION']) ||
    isset($_GET['ANTIGUEDAD']) ||
    isset($_GET['OBSERVACIONES']) ||
    isset($_GET['FIRMA']) ||
    isset($_GET['DOMICILIO']) ||
    isset($_GET['FUNDAMENTO_LEGAL']) ||
    isset($_GET['FOTO']) 
)
{
    $ID_LICENCIA = $_GET['ID_LICENCIA'];
    $CONDUCTOR = $_GET['CONDUCTOR'];
    $FECHA_EXPEDICION = $_GET['FECHA_EXPEDICION'];
    $FECHA_VALIDACION = $_GET['FECHA_VALIDACION'];
    $ANTIGUEDAD = $_GET['ANTIGUEDAD'];
    $OBSERVACIONES = $_GET['OBSERVACIONES'];
    $FIRMA = $_GET['FIRMA'];
    $DOMICILIO = $_GET['DOMICILIO'];
    $FUNDAMENTO_LEGAL = $_GET['FUNDAMENTO_LEGAL'];
    $FOTO = $_GET['FOTO'];

    $SQL = "UPDATE licencias SET 
        CONDUCTOR = '$CONDUCTOR', 
        FECHA_EXPEDICION ='$FECHA_EXPEDICION', 
        FECHA_VALIDACION ='$FECHA_VALIDACION', 
        ANTIGUEDAD ='$ANTIGUEDAD', 
        OBSERVACIONES ='$OBSERVACIONES', 
        FIRMA ='$FIRMA', 
        DOMICILIO ='$DOMICILIO', 
        FUNDAMENTO_LEGAL ='$FUNDAMENTO_LEGAL', 
        FOTO ='$FOTO' 
        WHERE ID_LICENCIA = '$ID_LICENCIA'; ";

    include("Controlador.php");

    $Con = Conectar();
    $ResultSet = Ejecutar($Con, $SQL);
    $NumRows = mysqli_affected_rows($Con);
    Desconectar($Con);

    if ($NumRows == 1) {
        print ("Se actualizo la licencia con exito");
    } else {
        print ("No se pudo actualizar la licencia");
    }
}