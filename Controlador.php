<?php

function Conectar()
{
    $Server = "localhost";
    $User = "root";
    $Password = "";
    $BD = "controlvehicular31";

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