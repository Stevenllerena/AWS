<?php

header('Content-Type: text/html; charset=utf-8');

include("conexionmysql_aws.php");

$usuario = $_POST['userid'];
$contrasena = $_POST['password'];

$con=mysql_connect($host,$user,$pw) or die ("Problemas al conectar");
mysql_select_db($db,$con) or die ("Problema al conectar con la DB"); 

$q=mysql_query("SELECT * FROM admin WHERE user='$_POST[userid]'",$con);

if (isset($_POST['userid']) && !empty($_POST['userid']) && isset($_POST['password']) && !empty($_POST['password']) && (preg_match("/^[a-zA-Z0-9\-_]+$/",$usuario)) && 
(preg_match("/^[a-zA-Z0-9\-_]+$/",$contrasena)) && (mysql_num_rows($q)==0) && (mysql_num_rows($p)==0) ){


mysql_query("INSERT INTO admin(user,pw) VALUES ('$usuario','$contrasena')",$con);

mysql_query("CREATE TABLE $usuario(ID INT NOT NULL PRIMARY KEY AUTO_INCREMENT, LATITUD VARCHAR(20), LONGITUD VARCHAR(20), FECHA_HORA VARCHAR(20),  ID_VEHICULO VARCHAR(20) )",$con);

echo "<script type='text/javascript'>";
echo "window.close();";
echo "</script> ";


}

if(  ($_POST['userid']=="") || ($_POST['password']=="")  ){

    echo "<script type='text/javascript'>";
    echo "alert('No se permiten campos en blanco')"; 
    echo "</script> ";

    echo "<script type='text/javascript'>";
    echo "window.close();";
    echo "</script> ";
   
}

if(  (mysql_num_rows($q)!=0) ){

    echo "<script type='text/javascript'>";
    echo "alert('El nombre de usuario  ya existe')"; 
    echo "</script> ";

    echo "<script type='text/javascript'>";
    echo "window.close();";
    echo "</script> ";
   

}


if(!preg_match("/^[a-zA-Z0-9\-_]+$/", $usuario)){
	 

    echo "<script type='text/javascript'>";
    echo "alert('Caracteres no permitidos')"; 
    echo "</script> ";

    echo "<script type='text/javascript'>";
    echo "window.close();";
    echo "</script> ";
   

 }
 
?>




