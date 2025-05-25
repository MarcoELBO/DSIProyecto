<?php
if(
    isset($_GET['NO_CENTRO']) ||
    isset($_GET['NO_LINEA']) ||
    isset($_GET['VERIFICACION']) ||
    isset($_GET['NOMBRE']) ||
    isset($_GET['DOMICILIO']) ||
    isset($_GET['TIPO_CENTRO'])
)
{
    $NO_CENTRO = $_GET['NO_CENTRO'];
    $NO_LINEA = $_GET['NO_LINEA'];
    $VERIFICACION = $_GET['VERIFICACION'];
    $NOMBRE = $_GET['NOMBRE'];
    $DOMICILIO = $_GET['DOMICILIO'];
    $TIPO_CENTRO = $_GET['TIPO_CENTRO'];

    $SQL = "UPDATE Centros_Verificacion SET 
        NO_LINEA = '$NO_LINEA', 
        VERIFICACION ='$VERIFICACION', 
        NOMBRE ='$NOMBRE', 
        DOMICILIO ='$DOMICILIO', 
        TIPO_CENTRO ='$TIPO_CENTRO' 
        WHERE NO_CENTRO = '$NO_CENTRO'; ";

    include("Controlador.php");

    $Con = Conectar();
    $ResultSet = Ejecutar($Con, $SQL);
    $NumRows = mysqli_affected_rows($Con);
    Desconectar($Con);

    if ($NumRows == 1) {
        print ("Se actualizo el centro de verificacion con exito");
    } else {
        print ("No se pudo actualizar el centro de verificacion");
    }
}