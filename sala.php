<?php
$codigo = $_COOKIE["usuario"];

if($_GET['sala']){
    $sala = $_GET['sala'];
}else{
    $sala = $codigo;
}

setcookie("sala", $sala);

$_COOKIE["sala"] = $sala;

include $_SERVER['DOCUMENT_ROOT']."/juego/conexion.php";

if(!isset($_COOKIE["sala"])){
    echo '<h1 class="alerta">No existe la cookie sala</h1>';
}else{
    $sala = $_COOKIE["sala"];
}

//ACTUALIZAR_____________________________________
$sql = "UPDATE usuarios SET pos_x='250', pos_y='250', sala='$sala' WHERE codigo='$codigo'" ;
mysql_select_db($dbname);
$query = mysql_query( $sql, $link )or die (mysql_error());


//ACTUALIZAR_____________________________________
$sql = "UPDATE usuarios SET pos_x='250', pos_y='250', sala='$sala' WHERE codigo='$codigo'" ;
mysql_select_db($dbname);
$query = mysql_query( $sql, $link )or die (mysql_error());

//INFORMACION DE LA SALA
$sql_informacion_sala = mysql_query("SELECT * from salas where codigo_sala='$sala'");
$registro_informacion_sala = mysql_fetch_array($sql_informacion_sala);
$registro_contar_sala = mysql_num_rows($sql_informacion_sala);

$codigo_sala = $registro_informacion_sala['codigo_sala'];
$sala_ancho = $registro_informacion_sala['ancho'];
$sala_alto = $registro_informacion_sala['alto'];
$sala_estilo = $registro_informacion_sala['estilo'];

if($registro_contar_sala < 1){
    //INSERTAR_______________________________________
    $sql = "INSERT INTO `salas`(`codigo_sala`, `codigo_usuario`, `ancho`, `alto`, `estilo`) VALUES ('$codigo_sala', '$codigo_usuario', '3000', '3000', '1')"; 
    mysql_query($sql) or die(mysql_error());
}

//INFORMACION DEL USUARIO
$sql_usuario = mysql_query("SELECT * from usuarios where codigo='$codigo'");
$registro_usuario = mysql_fetch_array($sql_usuario);
$registro_contar_usuarios = mysql_num_rows($sql_usuario);
$usuario_codigo = $registro_usuario['codigo'];
$usuario_nombre = $registro_usuario['nombre'];
$usuario_ropa = $registro_usuario['ropa'];
$usuario_pos_x = $registro_usuario['pos_x'];
$usuario_pos_y = $registro_usuario['pos_y'];
$usuario_sala = $registro_usuario['sala'];
?>




<?php if($registro_contar_usuarios < 1):?>
    <meta http-equiv="refresh" content="0;url=https://demo.plasmart.cl/juego/" />

<?php else:?>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

    <script src="/juego/js/jquery-1.12.4.js"></script>
    <script src="/juego/js/jquery-ui.js"></script>

    <link href="/juego/css/juego.css?vol=<?php echo rand(1111111,9999999);?>" rel="stylesheet" type="text/css">
    <link href="/juego/css/animate.css" rel="stylesheet" type="text/css">
</head>


<audio id="audio" controls autoplay style="visibility: hidden;"><source src="/juego/audio/musica.mp3" type="audio/mpeg"></audio>

    <div class="opciones">
        <?php echo $sala;?>
        <?php include $_SERVER['DOCUMENT_ROOT']."/juego/db/db-mostrar-usuario-objetos.php";?>
    </div>

    <span class="actualizar">
        <a href="/juego/sala.php?sala=<?php echo $sala;?>" style="background: url(/juego/img/iconos/actualizar.png);" ></a>
        <a href="/juego/salir.php" style="background: url(/juego/img/iconos/salir.png);" ></a>
        <a href="/juego/cambio-sala.php" style="background: url(/juego/img/iconos/mundo.png);" ></a>
        <a class="play-audio" style="background: url(/juego/img/iconos/audio.png);" ></a>
        <div class="mostrar-vidas"></div>
    </span>

    <div class="notitas-recientes"></div>

    <span class="mapa">
        <span class="paralelo"></span>
        <span class="meridiano"></span>
        <span class="usuario-posicion"></span>

        <div class="mapa-otros-usuarios">
            <?php include $_SERVER['DOCUMENT_ROOT']."/juego/db/db-mostrar-mapa-movimiento-otros-usuarios.php";?>
        </div>

        <div class="mapa-notitas">
            <?php include $_SERVER['DOCUMENT_ROOT']."/juego/db/db-mostrar-mapa-notitas.php";?>
        </div>
    </span>

    <div id="sala" class="sala">
        <div class="piso">
            
            <div class="plano-usuarios">
                <?php include $_SERVER['DOCUMENT_ROOT']."/juego/db/db-mostrar-movimiento-otros-usuarios.php";?>
            </div>

            <div class="plano-propio">
                <?php include $_SERVER['DOCUMENT_ROOT']."/juego/db/db-mostrar-movimiento-usuario-propio.php";?>
            </div>

            <span class="paralelo"></span><span class="meridiano"></span>
            
            <div class="notita" style="left: 2488px;top: 2480px;background-color: #794321;color: black;">0</div>


            <div class="objetos">
            </div>
        </div>
    </div>

<?php include $_SERVER['DOCUMENT_ROOT']."/juego/js/script.php";?>

<?php endif;?>

<style>
/*ESTILO SALA*/
span.mapa {
    position: absolute;
    right: 0;
    top: 0;
    width: 34px!important;
    height: 35px!important;
    background-color: #6a3a1c;
    border: 5px solid black;
    margin: 1%;
    border-radius: 10px;
    z-index: 9; 
}
.piso{
    background: url(https://demo.plasmart.cl/juego/img/salas/<?php echo $sala_estilo;?>.jpg) #ff0000ad!important;
    width: <?php echo $sala_ancho;?>!important;
    height: <?php echo $sala_alto;?>!important;
}
</style>