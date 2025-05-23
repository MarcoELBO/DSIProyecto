<?php
$Existe = file_exists("archivoA.txt");
print $Existe;

$Manejador = fopen("archivoZ.txt", "r");
$Manejador2 = fopen("archivoB.txt", "w");



while (feof($Manejador) == false) {
    $Linea = fgets($Manejador);
    fwrite($Manejador2, $Linea);
    print $Linea;
}


fclose($Manejador);
fclose($Manejador2);
?>