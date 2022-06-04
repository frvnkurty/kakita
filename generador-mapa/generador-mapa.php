<?php
error_reporting(0);
if(!$_COOKIE["usuario"]){
    setcookie("usuario", rand(1111111,9999999));
}
setcookie("sala", 0);


include $_SERVER['DOCUMENT_ROOT']."/juego/conexion.php";


//SELECCIONAR____________________________
$sql = mysql_query("DELETE * from notitas");
$registro = mysql_fetch_array($sql);


?>
