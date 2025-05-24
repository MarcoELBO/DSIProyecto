<?php
$Username = $_POST['Username'];
$Password = $_POST['Password'];

$SQL = "SELECT * FROM Usuario WHERE Username = '$Username';";

include("Controlador.php");

$Conexion = Conectar();
$ResultSet = Ejecutar($Conexion, $SQL);
$Fila = mysqli_fetch_row($ResultSet);
$N = mysqli_num_rows($ResultSet);

if ($N == 0) {
    print ("Usuario no existe<br>");
} else {
    print ("Usuario existe<br>");
    if ($Fila[1] == $Password) {
        print ("Contraseña correcta<br>");
        $ResetIntentosSQL = "UPDATE Usuario SET Intentos = 0 WHERE Username = '$Username';";
        Ejecutar($Conexion, $ResetIntentosSQL);

        if ($Fila[2] == "A") {
            header("Location: MenuA.html");
            exit();
        } else {
            header("Location: MenuU.html");
            exit();
        }
        if ($Fila[3] == 1) {
            print ("Eres Activo<br>");
        } else {
            print ("Eres Inactivo<br>");
        }
        if ($Fila[4] == 0) {
            print ("No estas bloqueado<br>");
        } else {
            print ("Estas bloqueado<br>");
        }
    } else {
        print ("Contraseña incorrecta<br>");
        $Intentos = $Fila[5] + 1;
        if ($Intentos >= 3) {

            $BloquearSQL = "UPDATE Usuario SET Intentos = $Intentos, Bloqueo = 1 WHERE Username = '$Username';";
            Ejecutar($Conexion, $BloquearSQL);
            print ("Usuario bloqueado por demasiados intentos fallidos<br>");
        } else {

            $ActualizarIntentosSQL = "UPDATE Usuario SET Intentos = $Intentos WHERE Username = '$Username';";
            Ejecutar($Conexion, $ActualizarIntentosSQL);
            print ("Intentos fallidos: $Intentos<br>");
        }
    }
}
Desconectar($Conexion);
?>