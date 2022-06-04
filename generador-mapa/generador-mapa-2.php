<?php
error_reporting(0);
if(!$_COOKIE["usuario"]){
    setcookie("usuario", rand(1111111,9999999));
}
setcookie("sala", 0);


include $_SERVER['DOCUMENT_ROOT']."/juego/conexion.php";




//BORRAR TODAS LAS_______________________________
$sql = "DELETE FROM notitas";
mysql_select_db($dbname);
$query = mysql_query( $sql, $link )or die (mysql_error());


/*PROGRAMAR COLISION DE OBJETOS /// EN PROCESO*/
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

for($i=0;$i <= 10000; $i+=10){

    $pos_x = redondear($i+50);
    $pos_y = redondear($pos_x);


    //SELECCIONAR____________________________
    $sql = mysql_query("DELETE * from notitas where pos_x='$pos_x' and pos_y='$pos_y' ");
    $registro = mysql_fetch_array($sql);

    //INSERTAR_______________________________________
    $sql = "INSERT INTO `notitas`(`pos_x`, `pos_y`, `texto`) VALUES ('$pos_x', '$pos_y', '+bomba')"; 
    mysql_query($sql) or die(mysql_error());
}


for($i=0;$i <= 10000; $i+=10){

    $pos_x = redondear($i+50);
    $pos_y = redondear($pos_x / 2);


    //SELECCIONAR____________________________
    $sql = mysql_query("DELETE * from notitas where pos_x='$pos_x' and pos_y='$pos_y' ");
    $registro = mysql_fetch_array($sql);

    //INSERTAR_______________________________________
    $sql = "INSERT INTO `notitas`(`pos_x`, `pos_y`, `texto`) VALUES ('$pos_x', '$pos_y', '+bomba')"; 
    mysql_query($sql) or die(mysql_error());
}

for($i=0;$i <= 10000; $i+=10){

    $pos_x = redondear($i+50);
    $pos_y = redondear($pos_x * 2);


    //SELECCIONAR____________________________
    $sql = mysql_query("DELETE * from notitas where pos_x='$pos_x' and pos_y='$pos_y' ");
    $registro = mysql_fetch_array($sql);

    //INSERTAR_______________________________________
    $sql = "INSERT INTO `notitas`(`pos_x`, `pos_y`, `texto`) VALUES ('$pos_x', '$pos_y', '+bomba')"; 
    mysql_query($sql) or die(mysql_error());
}



for($i=0;$i <= 10000; $i+=10){

    $pos_y = redondear($i+50);
    $pos_x = redondear($pos_y * 2);


    //SELECCIONAR____________________________
    $sql = mysql_query("DELETE * from notitas where pos_x='$pos_x' and pos_y='$pos_y' ");
    $registro = mysql_fetch_array($sql);

    //INSERTAR_______________________________________
    $sql = "INSERT INTO `notitas`(`pos_x`, `pos_y`, `texto`) VALUES ('$pos_x', '$pos_y', '+bomba')"; 
    mysql_query($sql) or die(mysql_error());
}







for($i=0;$i <= 100; $i++){
    $pos_x = redondear(rand(0,9900));
    $pos_y = redondear(rand(0,9900));
    //SELECCIONAR____________________________
    $sql = mysql_query("DELETE * from notitas where pos_x='$pos_x' and pos_y='$pos_y' ");
    $registro = mysql_fetch_array($sql);

    //INSERTAR_______________________________________
    $sql = "INSERT INTO `notitas`(`pos_x`, `pos_y`, `texto`) VALUES ('$pos_x', '$pos_y', '+weed')"; 
    mysql_query($sql) or die(mysql_error());
}


for($i=0;$i <= 20; $i++){
    $pos_x = redondear(rand(0,9900));
    $pos_y = redondear(rand(0,9900));
    //SELECCIONAR____________________________
    $sql = mysql_query("DELETE * from notitas where pos_x='$pos_x' and pos_y='$pos_y' ");
    $registro = mysql_fetch_array($sql);

    //INSERTAR_______________________________________
    $sql = "INSERT INTO `notitas`(`pos_x`, `pos_y`, `texto`) VALUES ('$pos_x', '$pos_y', '+cocaine')"; 
    mysql_query($sql) or die(mysql_error());
}


for($i=0;$i <= 20; $i++){
    $pos_x = redondear(rand(0,9900));
    $pos_y = redondear(rand(0,9900));


    //SELECCIONAR____________________________
    $sql = mysql_query("DELETE * from notitas where pos_x='$pos_x' and pos_y='$pos_y' ");
    $registro = mysql_fetch_array($sql);

    //INSERTAR_______________________________________
    $sql = "INSERT INTO `notitas`(`pos_x`, `pos_y`, `texto`) VALUES ('$pos_x', '$pos_y', '+tussy')"; 
    mysql_query($sql) or die(mysql_error());
}


for($i=0;$i <= 20; $i++){
    $pos_x = redondear(rand(0,9900));
    $pos_y = redondear(rand(0,9900));


    //SELECCIONAR____________________________
    $sql = mysql_query("DELETE * from notitas where pos_x='$pos_x' and pos_y='$pos_y' ");
    $registro = mysql_fetch_array($sql);

    //INSERTAR_______________________________________
    $sql = "INSERT INTO `notitas`(`pos_x`, `pos_y`, `texto`) VALUES ('$pos_x', '$pos_y', '+coca')"; 
    mysql_query($sql) or die(mysql_error());
}

for($i=0;$i <= 20; $i++){
    $pos_x = redondear(rand(0,9900));
    $pos_y = redondear(rand(0,9900));


    //SELECCIONAR____________________________
    $sql = mysql_query("DELETE * from notitas where pos_x='$pos_x' and pos_y='$pos_y' ");
    $registro = mysql_fetch_array($sql);

    //INSERTAR_______________________________________
    $sql = "INSERT INTO `notitas`(`pos_x`, `pos_y`, `texto`) VALUES ('$pos_x', '$pos_y', '+vinito')"; 
    mysql_query($sql) or die(mysql_error());
}

?>