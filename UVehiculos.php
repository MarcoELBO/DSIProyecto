<?php
if(
    isset($_GET['Placa']) ||
    isset($_GET['Marca']) ||
    isset($_GET['SUBMARCA']) ||
    isset($_GET['LINEA']) ||
    isset($_GET['Color']) ||
    isset($_GET['Modelo']) ||
    isset($_GET['Numero_Serie']) ||
    isset($_GET['Puertas']) ||
    isset($_GET['Asientos']) ||
    isset($_GET['Cilindraje']) ||
    isset($_GET['Combustible']) ||
    isset($_GET['Capacidad']) ||
    isset($_GET['TRASMISION']) ||
    isset($_GET['ORIGEN']) 
){
    $Placa = $_GET['Placa'];
    $Marca = $_GET['Marca'];
    $SUBMARCA = $_GET['SUBMARCA'];
    $LINEA = $_GET['LINEA'];
    $Color = $_GET['Color'];
    $Modelo = $_GET['Modelo'];
    $Numero_Serie = $_GET['Numero_Serie'];
    $Puertas = $_GET['Puertas'];
    $Asientos = $_GET['Asientos'];
    $Cilindraje = $_GET['Cilindraje'];
    $Combustible = $_GET['Combustible'];
    $capacidad = $_GET['capacidad'];
    $TRASMISION = $_GET['TRASMISION'];
    $ORIGEN = $_GET['ORIGEN'];

    include("Controlador.php");

    $SQL = "UPDATE vehiculos SET 
        Marca='$Marca', 
        SUBMARCA='$SUBMARCA', 
        LINEA='$LINEA', 
        Color='$Color', 
        Modelo='$Modelo', 
        Numero_Serie='$Numero_Serie', 
        Puertas='$Puertas', 
        Asientos='$Asientos', 
        Cilindraje='$Cilindraje', 
        Combustible='$Combustible', 
        capacidad='$capacidad', 
        TRASMISION='$TRASMISION', 
        ORIGEN='$ORIGEN' 
        WHERE Placa='$Placa';";

    $Con = Conectar();
    $ResultSet = Ejecutar($Con, $SQL);
    $NumRows = mysqli_affected_rows($Con);
    Desconectar($Con);

    if ($NumRows == 1) {
        print ("Se actualizo el vehiculo con exito");
    } else {
        print ("No se pudo actualizar el vehiculo");
    }
}