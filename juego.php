<?php
error_reporting(0);

unset($_COOKIE['sala']);
unset($_COOKIE['sala']);

setcookie("sala", 0);

$_COOKIE["sala"] = 0;

include $_SERVER['DOCUMENT_ROOT']."/juego/conexion.php";

$codigo = $_COOKIE["usuario"];

if(!isset($_COOKIE["sala"])){
    echo '<h1 class="alerta">No existe la cookie sala</h1>';
}else{
    $sala = $_COOKIE["sala"];
}


//CONTAR FILAS____________________________________
$sql = mysql_query("SELECT * from usuarios where codigo='$codigo' and sala='$sala'");
$registro_contar_usuarios = mysql_num_rows($sql);

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
        <a href="/juego/juego.php" style="background: url(/juego/img/iconos/actualizar.png);" ></a>
        <a href="/juego/salir.php" style="background: url(/juego/img/iconos/salir.png);" ></a>
        <a href="/juego/cambio-sala.php" style="background: url(/juego/img/iconos/casa.png);" ></a>
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

            <span class="paralelo"></span>
            <span class="meridiano"></span>
            <div class="notita" style="left: 2488px;top: 2480px;background-color: #794321;color: black;">0</div>
            
            <div class="plano-usuarios">
                <?php include $_SERVER['DOCUMENT_ROOT']."/juego/db/db-mostrar-movimiento-otros-usuarios.php";?>
            </div>

            <div class="plano-propio">
                <?php include $_SERVER['DOCUMENT_ROOT']."/juego/db/db-mostrar-movimiento-usuario-propio.php";?>
            </div>

            <div class="objetos"></div>

        </div>
    </div>

<?php include $_SERVER['DOCUMENT_ROOT']."/juego/js/script.php";?>

<?php endif;?>