<?php

function Conectar()
{
    $Server = "34.51.16.71";
    $User = "pp";
    $Password = "doraemon";
    $BD = "gestion";

    $Conexion = mysqli_connect($Server, $User, $Password, $BD);
    return $Conexion;
}
function Ejecutar($Conexion, $SQL)
{
    $ResultSet = mysqli_query($Conexion, $SQL) or die(mysqli_error($Conexion));
    return $ResultSet;
}
function Procesar()
{


}
function Desconectar($Conexion)
{
    $Close = mysqli_close($Conexion);
    return $Close;
}
?>