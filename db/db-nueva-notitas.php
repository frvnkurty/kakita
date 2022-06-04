<?php include $_SERVER['DOCUMENT_ROOT']."/juego/conexion.php";?>

<?php
function redondear($z){
    $b=50;
    for ($a=$z; $a<=$z+$b; $a++){
        for($c=1; $c<=($z/$b)+1; $c++){
            $d=$c*$b;
            if($d==$a){
                return $a;
            }
        }
    }
}

$codigo= $_COOKIE["usuario"];
$sala = $_COOKIE["sala"];

$texto = $_POST['texto'];
$usuario = $_POST['usuario'];
$valor = $_POST['valor'];
$fecha = date('Y-m-d');
$hora = date('H:i:s');
$pos_x = redondear($_POST['pos_x']);
$pos_y = redondear($_POST['pos_y'] - 25);
$crear = $_POST['crear'];

$sql_usuario_datos  = mysql_query("SELECT * from usuarios WHERE codigo='$usuario'");
$registro_usuario_datos  = mysql_fetch_array($sql_usuario_datos );
$vida = $registro_usuario_datos['vida'] + $valor;
?>
<?php if($crear == 1 and $texto != ''):?>

<?php

//ACTUALIZAR_____________________________________
$sql = "UPDATE usuarios SET vida='$vida' WHERE codigo='$usuario'" ;
mysql_select_db($dbname);
$query = mysql_query( $sql, $link )or die (mysql_error());


$sql = "DELETE FROM notitas WHERE pos_x='$pos_x' and  pos_y='$pos_y'";
mysql_select_db($dbname);
$query = mysql_query( $sql, $link )or die (mysql_error());

//INSERTAR productos NUEVA
$sql_insertar = "INSERT INTO `notitas` (`texto`, `usuario`, `pos_x`, `pos_y` , `sala`) VALUES ('$texto','$usuario','$pos_x', '$pos_y', '$sala')"; 
mysql_query($sql_insertar) or die(mysql_error());
?>
<?php endif;?>


