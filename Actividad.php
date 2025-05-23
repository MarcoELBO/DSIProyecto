<?php
$Existe = file_exists("archivoZZ.txt");

if ($Existe) {
    print "El archivo original existe\n";
    $Manejador2 = fopen("archivoZZ.txt", "r");
    if ($Manejador2) {
        $ManejadorCopia = fopen("archivoCopia.txt", "w");
        if ($ManejadorCopia) {
            while (($Linea = fgets($Manejador2)) !== false) {
                fwrite($ManejadorCopia, $Linea);
            }
            fclose($ManejadorCopia);
            print "Copia creada en archivoCopia.txt\n";
        } else {
            print "No se pudo crear el archivo de copia\n";
        }
        fclose($Manejador2);
    } else {
        print "No se pudo abrir el archivo original para lectura\n";
    }
} else {
    print "El archivo original no existe\n";
    $Manejador = fopen("archivoZZ.txt", "w");
    fwrite($Manejador, "Hola mundo\n");
    print "Archivo original creado\n";
    fclose($Manejador);
}
?>