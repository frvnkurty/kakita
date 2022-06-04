<?php include $_SERVER['DOCUMENT_ROOT']."/juego/conexion.php";?>

<?php
//REDONDEAR MULTIPLO DE 50
function redondear($z){
    $b=50;
    for ($a=$z; $a<=$z+$b; $a++)
    {
        for($c=1; $c<=($z/$b)+1; $c++)
        {
        $d=$c*$b;
        if($d==$a)
        return $a;
        }
    }
}


$codigo = $_COOKIE["usuario"];
$pos_x = redondear($_POST['pos_x']);
$pos_y = redondear($_POST['pos_y']);
?>

<?php  
//ACTUALIZAR_____________________________________
$sql = "UPDATE usuarios SET pos_x='$pos_x', pos_y='$pos_y' WHERE codigo='$codigo'" ;
mysql_select_db($dbname);
$query = mysql_query( $sql, $link )or die (mysql_error());
?>