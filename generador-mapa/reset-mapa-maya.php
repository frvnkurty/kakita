<?php
error_reporting(0);
if(!$_COOKIE["usuario"]){
    setcookie("usuario", rand(1111111,9999999));
}
setcookie("sala", 0);


include $_SERVER['DOCUMENT_ROOT']."/juego/conexion.php";
?>

<style>
span {
    position: absolute;
    width: 10px;
    height: 10px;
    background-color: black;
}
</style>

<?php
//BORRAR TODAS LAS_______________________________
$sql = "DELETE FROM notitas";
mysql_select_db($dbname);
$query = mysql_query( $sql, $link )or die (mysql_error());




/*PROGRAMAR COLISION DE OBJETOS /// EN PROCESO*/
function redondear($z){
    $b=200;
    for ($a=$z; $a<=$z+$b; $a++){
        for($c=1; $c<=($z/$b)+1; $c++){
            $d=$c*$b;
            if($d==$a){
                return $a;
            }
        }
    }
}

for($i=200;$i <= 4800; $i+=200){

    for($j=200;$j <= 4800; $j+=200){

        $pos_x = redondear($i);
        $pos_y = redondear($j);

        
            //SELECCIONAR____________________________
            $sql = mysql_query("DELETE * from notitas where pos_x='$pos_x' and pos_y='$pos_y' ");
            $registro = mysql_fetch_array($sql);

            //INSERTAR_______________________________________
            $sql = "INSERT INTO `notitas`(`pos_x`, `pos_y`, `texto`) VALUES ('$pos_x', '$pos_y', '+bomba')"; 
            mysql_query($sql) or die(mysql_error());

            $pos_x = $pos_x / 10;
            $pos_y = $pos_y / 10;

            echo '<span style="left:'.$pos_x.';top:'.$pos_y.';"></span>';
        
    }
    
}








/*PROGRAMAR COLISION DE OBJETOS /// EN PROCESO*/
function redondear2($z){
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






for($i=0;$i <= 100; $i++){
    $pos_x = redondear2(rand(200,4800));
    $pos_y = redondear2(rand(200,4800));


    //SELECCIONAR____________________________
    $sql = mysql_query("DELETE * from notitas where pos_x='$pos_x' and pos_y='$pos_y' ");
    $registro = mysql_fetch_array($sql);


    $entrada = array("+weed", "+tussy", "+cocaine", "+coca", "+vinito");
    $claves_aleatorias = $entrada[rand(0,4)];


    //INSERTAR_______________________________________
    $sql = "INSERT INTO `notitas`(`pos_x`, `pos_y`, `texto`) VALUES ('$pos_x', '$pos_y', '$claves_aleatorias')"; 
    mysql_query($sql) or die(mysql_error());

    $pos_x = $pos_x / 10;
    $pos_y = $pos_y / 10;


    echo '<span style="left:'.$pos_x.';top:'.$pos_y.';background-color:red!important;" >'.$claves_aleatorias.'</span>';

}



?>