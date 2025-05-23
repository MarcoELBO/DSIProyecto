<?php
$Server = "127.0.0.1";
$User = "root";
$Pws = "";
$BD = "controlvehicular31";

$Con = mysqli_connect($Server, $User, $Pws, $BD);

$SQL = "INSERT INTO  oficiales VALUES('2','2','2')";
$ResultSet = mysqli_query($Con, $SQL);
print ($ResultSet);
?>