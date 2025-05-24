<?php
include("controlador.php");
$Con = conectar();
$SQL = "SELECT * FROM licenciaconducir";
$ResultSet = ejecutar($Con, $SQL);
$xml = new DOMDocument('1.0', 'UTF-8');
$xml->formatOutput = true;

$root = $xml->createElement("Conductores");
$xml->appendChild($root);

while ($fila = mysqli_fetch_assoc($ResultSet)) {
    $conductor = $xml->createElement("Conductor");

    foreach ($fila as $clave => $valor) {
        $elemento = $xml->createElement($clave, htmlspecialchars($valor));
        $conductor->appendChild($elemento);
    }

    $root->appendChild($conductor);
}

$SQL = "SELECT * FROM conductordomicilio";
$ResultSet = ejecutar($Con, $SQL);

while ($fila = mysqli_fetch_assoc($ResultSet)) {
    $conductor = $xml->createElement("Conductor");

    foreach ($fila as $clave => $valor) {
        $elemento = $xml->createElement($clave, htmlspecialchars($valor));
        $conductor->appendChild($elemento);
    }

    $root->appendChild($conductor);
}

$xml->save("Licencia.xml");
$Desconectar = Desconectar($Con);

echo "Archivo Licencia.xml generado correctamente.";
?>