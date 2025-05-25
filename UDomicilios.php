<?php
if(
    isset($_GET['ID_Domicilio']) ||
    isset($_GET['CALLE']) ||
    isset($_GET['CP']) ||
    isset($_GET['COLONIA']) ||
    isset($_GET['NUM_INT']) ||
    isset($_GET['NUM_EXT']) ||
    isset($_GET['ESTADO']) ||
    isset($_GET['MUNICIPIO']) ||
    isset($_GET['REFERENCIAS']) 
)
{
    $ID_Domicilio = $_GET['ID_Domicilio'];
    $CALLE = $_GET['CALLE'];
    $CP = $_GET['CP'];
    $COLONIA = $_GET['COLONIA'];
    $NUM_INT = $_GET['NUM_INT'];
    $NUM_EXT = $_GET['NUM_EXT'];
    $ESTADO = $_GET['ESTADO'];
    $MUNICIPIO = $_GET['MUNICIPIO'];
    $REFERENCIAS = $_GET['REFERENCIAS'];

    $SQL = "UPDATE Domicilios SET 
        CALLE = '$CALLE', 
        CP ='$CP', 
        COLONIA ='$COLONIA', 
        NUM_INT ='$NUM_INT', 
        NUM_EXT ='$NUM_EXT', 
        ESTADO ='$ESTADO', 
        MUNICIPIO ='$MUNICIPIO', 
        REFERENCIAS ='$REFERENCIAS' 
        WHERE ID_Domicilio = '$ID_Domicilio'; ";

    include("Controlador.php");

    $Con = Conectar();
    $ResultSet = Ejecutar($Con, $SQL);
    $NumRows = mysqli_affected_rows($Con);
    Desconectar($Con);

    if ($NumRows == 1) {
        print ("Se actualizo el domicilio con exito");
    } else {
        print ("No se pudo actualizar el domicilio");
    }
}