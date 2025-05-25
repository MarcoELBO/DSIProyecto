<?php
if(
    isset($_GET['ID_Pago']) ||
    isset($_GET['Servicio']) ||
    isset($_GET['Monto']) ||
    isset($_GET['Fecha']) ||
    isset($_GET['Hora']) ||
    isset($_GET['Tarjeta_Asociada'])
)
{
    $ID_Pago = $_GET['ID_Pago'];
    $Servicio = $_GET['Servicio'];
    $Monto = $_GET['Monto'];
    $Fecha = $_GET['Fecha'];
    $Hora = $_GET['Hora'];
    $Tarjeta_Asociada = $_GET['Tarjeta_Asociada'];

    $SQL = "UPDATE pagos SET 
    Servicio = '$Servicio', 
    Monto ='$Monto', 
    Fecha ='$Fecha', 
    Hora ='$Hora', 
    Tarjeta_Asociada ='$Tarjeta_Asociada' 
    WHERE ID_Pago = '$ID_Pago'; ";

    include("Controlador.php");

    $Con = Conectar();
    $ResultSet = Ejecutar($Con, $SQL);
    $NumRows = mysqli_affected_rows($Con);
    Desconectar($Con);

    if ($NumRows== 1) {
        print ("Se actualizo el pago con exito");
    } else {
        print ("No se pudo actualizar el pago");
    }
}