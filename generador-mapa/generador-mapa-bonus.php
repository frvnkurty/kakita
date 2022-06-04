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




for($i=0;$i <= 1500; $i++){
    $pos_x = redondear2(rand(0,4900));
    $pos_y = redondear2(rand(0,4900));


    //SELECCIONAR____________________________
    $sql = mysql_query("DELETE * from notitas where pos_x='$pos_x' and pos_y='$pos_y' ");
    $registro = mysql_fetch_array($sql);


    $entrada = array("+weed", "+tussy", "+cocaine", "+weed", "+vinito");
    $claves_aleatorias = $entrada[rand(0,4)];


    //INSERTAR_______________________________________
    $sql = "INSERT INTO `notitas`(`pos_x`, `pos_y`, `texto`) VALUES ('$pos_x', '$pos_y', '$claves_aleatorias')"; 
    mysql_query($sql) or die(mysql_error());

    $pos_x = $pos_x / 10;
    $pos_y = $pos_y / 10;

    if($claves_aleatorias == '+weed'){
       echo '<span style="left:'.$pos_x.';top:'.$pos_y.';background-color:green!important;"  title="'.$claves_aleatorias.'"></span>'; 
    }elseif($claves_aleatorias == '+tussy'){
       echo '<span style="left:'.$pos_x.';top:'.$pos_y.';background-color:purple!important;"  title="'.$claves_aleatorias.'"></span>'; 
    }elseif($claves_aleatorias == '+cocaine'){
       echo '<span style="left:'.$pos_x.';top:'.$pos_y.';background-color:gray!important;"  title="'.$claves_aleatorias.'"></span>'; 
    }else{
        echo '<span style="left:'.$pos_x.';top:'.$pos_y.';background-color:red!important;"  title="'.$claves_aleatorias.'"></span>'; 
    }
    

}



?>


<meta http-equiv="refresh" content="4;url=https://demo.plasmart.cl/juego/" />