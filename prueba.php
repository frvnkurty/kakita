<?php
include $_SERVER['DOCUMENT_ROOT']."/juego/conexion.php";

$codigo = $_COOKIE["usuario"];
$sala = $_COOKIE["sala"];

echo '<h1 class="alerta">Usuario:'.$codigo.' sala: '.$sala.'</h1>';

//ACTUALIZAR_____________________________________
$sql = "UPDATE usuarios SET pos_x='250', pos_y='250', sala='666666666666' WHERE codigo='$codigo'" ;
mysql_select_db($dbname);
$query = mysql_query( $sql, $link )or die (mysql_error());

echo $sql;

echo 'choco';

if($_COOKIE["sala"]){
    $sala = $_COOKIE["sala"];
}elseif($_GET['sala']){
    $sala = $_GET['sala'];
}else{
    $sala = $codigo;
}
echo '<h1 class="alerta">Usuario:'.$codigo.' sala: '.$sala.'</h1>';
