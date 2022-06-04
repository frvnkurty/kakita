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

$sala = $_COOKIE["sala"];

$pos_x_rango_menor_usuario = $_POST['pos_x'] - 1000;
$pos_x_rango_mayor_usuario = $_POST['pos_x'] + 1000;
$pos_y_rango_menor_usuario = $_POST['pos_y'] - 1000;
$pos_y_rango_mayor_usuario = $_POST['pos_y'] + 1000;


//SELECCIONAR Y MOSTRAR SOLO LAS NOTAS QUE ESTEN CERCA DEL USUARIO
$sql_notita = mysql_query("SELECT * from notitas where
    sala='$sala' and
    pos_x >= '$pos_x_rango_menor_usuario' and 
    pos_x <= '$pos_x_rango_mayor_usuario' and 
    pos_y >= '$pos_y_rango_menor_usuario' and 
    pos_y <= '$pos_y_rango_mayor_usuario'
");


$sql_borrar_usuarios = "DELETE FROM usuarios WHERE vida <= '0'";
mysql_select_db($dbname);
$query = mysql_query( $sql_borrar_usuarios , $link )or die (mysql_error());

while($registro_notita = mysql_fetch_array($sql_notita)):
    $id_notita = $registro_notita['id'];
    $texto_notita = strtolower($registro_notita['texto']);
    $pos_x_rango_menor = $registro_notita['pos_x'];
    $pos_x_rango_mayor = $registro_notita['pos_x'] + 45;

    $pos_y_rango_menor = $registro_notita['pos_y'];
    $pos_y_rango_mayor = $registro_notita['pos_y'] + 45;



    //SELECCIONAR____________________________
    $sql = mysql_query("SELECT * from usuarios WHERE 
        pos_x >= '$pos_x_rango_menor' and 
        pos_x <= '$pos_x_rango_mayor' and 
        pos_y >= '$pos_y_rango_menor' and 
        pos_y <= '$pos_y_rango_mayor'
    ");

    $registro_eliminar_usuario = mysql_fetch_array($sql);
    $registro_contar_eliminar_usuario = mysql_num_rows($sql);

    $usuario_id = $registro_eliminar_usuario['id'];
    $usuario_codigo = $registro_eliminar_usuario['codigo'];
    $usuario_vida = $registro_eliminar_usuario['vida'];
    $usuario_expresion = $registro_eliminar_usuario['expresion'];

    //$pos_x_rand = redondear(rand(100,4700));
    //$pos_y_rand = redondear(rand(100,4700));

    $pos_x_rand = redondear(2450);
    $pos_y_rand = redondear(2450);

    
if( $usuario_vida > 100){
    echo '<h1 class="mensaje">Tu GANAS</h1>';
    echo '<meta http-equiv="refresh" content="0.5;url=https://demo.plasmart.cl/juego/ganar.php" />';
}

//SI LA NOTATITA ES UNA BOMBA RESTA 1 DE VIDA 
if($texto_notita == '+bomba'){
    if($usuario_vida > 0){
        $actualizar_vida = $usuario_vida  - 3;
        //ACTUALIZAR_____________________________________
        $sql = "UPDATE usuarios SET vida='$actualizar_vida', pos_x='$pos_x_rand', pos_y='$pos_y_rand', expresion='7' WHERE id='$usuario_id' " ;
        mysql_select_db($dbname);
        $query = mysql_query( $sql, $link )or die (mysql_error());

        echo '<audio id="audio" controls autoplay><source src="/juego/audio/explosion.mp3" type="audio/mpeg"></audio>';

    }else{
        $sql = "DELETE FROM usuarios WHERE id='$usuario_id'";
        mysql_select_db($dbname);
        $query = mysql_query( $sql, $link )or die (mysql_error());
    }
}


//SI LA NOTITA ES +WEED SUMA 1 DE VIDA
if($texto_notita == '+weed'){
    if($usuario_vida > 0){
        $actualizar_vida = $usuario_vida  + 3;
        //ACTUALIZAR_____________________________________
        $sql = "UPDATE usuarios SET vida='$actualizar_vida', expresion='5' WHERE id='$usuario_id' " ;
        mysql_select_db($dbname);
        $query = mysql_query( $sql, $link )or die (mysql_error());
        echo '<audio id="audio" controls autoplay><source src="/juego/audio/fumar.mp3" type="audio/mpeg"></audio>';
    }else{
        $sql = "DELETE FROM usuarios WHERE id='$usuario_id'";
        mysql_select_db($dbname);
        $query = mysql_query( $sql, $link )or die (mysql_error());
    }
}


//SI LA NOTITA ES +WEED SUMA 1 DE VIDA
if($texto_notita == '+vinito'){
    if($usuario_vida > 0 ){
        $actualizar_vida = $usuario_vida  + 3;
        //ACTUALIZAR_____________________________________
        $sql = "UPDATE usuarios SET vida='$actualizar_vida', expresion='6' WHERE id='$usuario_id' " ;
        mysql_select_db($dbname);
        $query = mysql_query( $sql, $link )or die (mysql_error());
        echo '<audio id="audio" controls autoplay><source src="/juego/audio/beber.mp3" type="audio/mpeg"></audio>';
    }else{
        $sql = "DELETE FROM usuarios WHERE id='$usuario_id'";
        mysql_select_db($dbname);
        $query = mysql_query( $sql, $link )or die (mysql_error());
    }
}


//SI LA NOTITA ES +WEED SUMA 1 DE VIDA
if($texto_notita == '+cocaine'){
    if($usuario_vida > 0){
        $actualizar_vida = $usuario_vida  + 5;
        //ACTUALIZAR_____________________________________
        $sql = "UPDATE usuarios SET vida='$actualizar_vida', expresion='3' WHERE id='$usuario_id' " ;
        mysql_select_db($dbname);
        $query = mysql_query( $sql, $link )or die (mysql_error());
        echo '<audio id="audio" controls autoplay><source src="/juego/audio/esnifar.ogg" type="audio/mpeg"></audio>';
    }else{
        $sql = "DELETE FROM usuarios WHERE id='$usuario_id'";
        mysql_select_db($dbname);
        $query = mysql_query( $sql, $link )or die (mysql_error());
    }
}


//SI LA NOTITA ES +WEED SUMA 1 DE VIDA
if($texto_notita == '+veneno'){
    if($usuario_vida > 0){
        $actualizar_vida = $usuario_vida  - 5;
        //ACTUALIZAR_____________________________________
        $sql = "UPDATE usuarios SET vida='$actualizar_vida', pos_x='$pos_x_rand', pos_y='$pos_y_rand', expresion='7' WHERE id='$usuario_id' " ;
        mysql_select_db($dbname);
        $query = mysql_query( $sql, $link )or die (mysql_error());

        echo '<audio id="audio" controls autoplay><source src="/juego/audio/beber.mp3" type="audio/mpeg"></audio>';

    }else{
        $sql = "DELETE FROM usuarios WHERE id='$usuario_id'";
        mysql_select_db($dbname);
        $query = mysql_query( $sql, $link )or die (mysql_error());
    }
}


//SI LA NOTITA ES +WEED SUMA 1 DE VIDA
if($texto_notita == '+tussy'){
    if($usuario_vida > 0){
        $actualizar_vida = $usuario_vida  + 10;
        //ACTUALIZAR_____________________________________
        $sql = "UPDATE usuarios SET vida='$actualizar_vida', expresion='8' WHERE id='$usuario_id' " ;
        mysql_select_db($dbname);
        $query = mysql_query( $sql, $link )or die (mysql_error());
        echo '<audio id="audio" controls autoplay><source src="/juego/audio/esnifar.ogg" type="audio/mpeg"></audio>';
    }else{
        $sql = "DELETE FROM usuarios WHERE id='$usuario_id'";
        mysql_select_db($dbname);
        $query = mysql_query( $sql, $link )or die (mysql_error());
    }
}



//SI SE ELMINA EL USUARIO SE DESLOGUEA
if($registro_contar_eliminar_usuario >= 1 ){
    $sql = "DELETE FROM notitas WHERE id='$id_notita'";
    mysql_select_db($dbname);
    $query = mysql_query( $sql, $link )or die (mysql_error());
}

?>

<?php
if(strpos($texto_notita, '+') !== false):?>
    <div class="notita bomba" data-id-notita="<?php echo $registro_notita['id'];?>" style="background: url(/juego/img/objetos/<?php echo $texto_notita;?>.gif); background-color:transparent;left:<?php echo $registro_notita['pos_x'];?>px;top:<?php echo $registro_notita['pos_y'];?>px;">
    </div>
<?php endif?>





<?php endwhile?>



<script>
    var audio = getElementById("audio");
    audio.play();
</script>