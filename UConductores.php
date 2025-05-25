<?php
if(
    isset($_GET['CURP']) ||
    isset($_GET['NOMBRE']) ||
    isset($_GET['DOMICILIO']) ||
    isset($_GET['FOLIO_TC']) ||
    isset($_GET['NO_LICENCIA']) ||
    isset($_GET['FECHA_NACIMIENTO']) ||
    isset($_GET['TIPO_SANGRE']) ||
    isset($_GET['DONADOR_ORG']) ||
    isset($_GET['NUMERO_EMERGENCIA'])
){
    $CURP = $_GET['CURP'];
    $NOMBRE = $_GET['NOMBRE'];
    $DOMICILIO = $_GET['DOMICILIO'];
    $FOLIO_TC = $_GET['FOLIO_TC'];
    $NO_LICENCIA = $_GET['NO_LICENCIA'];
    $FECHA_NACIMIENTO = $_GET['FECHA_NACIMIENTO'];
    $TIPO_SANGRE = $_GET['TIPO_SANGRE'];
    $DONADOR_ORG = $_GET['DONADOR_ORG'];
    $NUMERO_EMERGENCIA = $_GET['NUMERO_EMERGENCIA'];

    $SQL = "UPDATE conductores SET 
        NOMBRE = '$NOMBRE', 
        DOMICILIO ='$DOMICILIO',
        FOLIO_TC ='$FOLIO_TC',
        NO_LICENCIA ='$NO_LICENCIA',
        FECHA_NACIMIENTO ='$FECHA_NACIMIENTO',
        TIPO_SANGRE ='$TIPO_SANGRE',
        DONADOR_ORG ='$DONADOR_ORG',
        NUMERO_EMERGENCIA ='$NUMERO_EMERGENCIA'
        WHERE CURP = '$CURP'; ";

    include("Controlador.php");

    $Con = Conectar();
    $ResultSet = Ejecutar($Con, $SQL);
    $NumRows = mysqli_affected_rows($Con);
    Desconectar($Con);

    if ($NumRows== 1) {
        print ("Se actualizo el conductor con exito");
    } else {
        print ("No se pudo actualizar el conductor");
    }

}