<?php include $_SERVER['DOCUMENT_ROOT']."/juego/conexion.php";?>
<?php
$id_notita = $_POST['id_notita'];
//BORRAR_______________________________
$sql = "DELETE FROM notitas WHERE id='$id_notita'";
mysql_select_db($dbname);
$query = mysql_query( $sql, $link )or die (mysql_error());
?>