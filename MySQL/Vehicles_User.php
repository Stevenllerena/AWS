<?php
session_start();
include("ConexionMySQL.php");


$tabla=array();
$i=0;

if ($_POST['App']=="APP")
{
$consulta=mysqli_query($conexion,"SELECT ID_VEHICULO FROM FamiliaLlerenaNavarro GROUP BY ID_VEHICULO");
    while($reg=mysql_fetch_array($consulta)){

	$tabla[$i]=$reg['ID_VEHICULO'];
	$i++;
}
}
else
{
$consulta=mysqli_query($conexion,"SELECT ID_VEHICULO FROM $_SESSION[user] GROUP BY ID_VEHICULO");
    while($reg=mysql_fetch_array($consulta)){

	$tabla[$i]=$reg;
	$i++;
}
}



echo json_encode($tabla);

mysql_free_result($consulta);
mysql_close($conexion);


?>
