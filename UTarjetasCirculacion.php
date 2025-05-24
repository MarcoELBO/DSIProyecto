<?php
if(
    isset($_GET['ID_TC']) ||
    isset($_GET['Vehiculo']) ||
    isset($_GET['Propietario']) ||
    isset($_GET['Tipo_Servicio']) ||
    isset($_GET['Domicilio']) ||
    isset($_GET['VIGENCIA']) ||
    isset($_GET['Fecha_expedicion'])
)
{
    $ID_TC = $_GET['ID_TC'];
    $Vehiculo = $_GET['Vehiculo'];
    $Propietario = $_GET['Propietario'];
    $Tipo_Servicio = $_GET['Tipo_Servicio'];
    $Domicilio = $_GET['Domicilio'];
    $VIGENCIA = $_GET['VIGENCIA'];
    $Fecha_expedicion = $_GET['Fecha_expedicion'];

    $SQL = "UPDATE Tarjetas_Circulacion SET 
        Vehiculo = '$Vehiculo', 
        Propietario ='$Propietario', 
        Tipo_Servicio ='$Tipo_Servicio', 
        Domicilio ='$Domicilio', 
        VIGENCIA ='$VIGENCIA', 
        Fecha_expedicion ='$Fecha_expedicion' 
        WHERE ID_TC = '$ID_TC'; ";

    include("Controlador.php");

    $Con = Conectar();
    $ResultSet = Ejecutar($Con, $SQL);
    $NumRows = mysqli_affected_rows($Con);
    Desconectar($Con);

    if ($NumRows == 1) {
        print ("Se actualizo la tarjeta de circulacion con exito");
    } else {
        print ("No se pudo actualizar la tarjeta de circulacion");
    }
}