<?php
#Abrir el archivo
$NomA = "Texto.txt";
$Manejador = fopen($NomA, "W");
#Leer o escribir el archivo
fwrite($Manejador, "Texto");
#Cerrar el archivo
$Cerrar = fclose($Manejador);
?>