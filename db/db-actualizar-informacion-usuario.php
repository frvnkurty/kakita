<?php include $_SERVER['DOCUMENT_ROOT']."/juego/conexion.php";?>

<?php
$codigo = $_COOKIE["usuario"];
$nombre = $_POST['nombre'];
$ropa = $_POST['ropa'];
?>

<?php  
//ACTUALIZAR_____________________________________
$sql = "UPDATE usuarios SET ropa='$ropa', nombre='$nombre' WHERE codigo='$codigo'" ;
mysql_select_db($dbname);
$query = mysql_query( $sql, $link )or die (mysql_error());


echo '<img src="/juego/img/personajes/'.$ropa.'.png"  width="150px" height="200px">';

echo $nombre;

?>

