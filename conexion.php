<!--ARCHIVO DE CONEXION-->
<?php
error_reporting(0);
//DATOS DE CONEXION
$server		= "localhost";
$username	= "plasmart_admin";
$userpass	= "Plasmart2468";
$dbname		= "plasmart_juego";

//CONEXION CON LA BASE DE DATOS
$link = mysql_connect($server,$username,$userpass,$dbname) or die ("No se encuentra el servidor<br>");
$db = mysql_select_db($dbname,$link) or die ("Error de conección");
?>
<!--FIN ARCHIVO DE CONEXION-->