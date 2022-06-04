<?php
$usuario = $_COOKIE ["usuario"];

error_reporting(0);
//DATOS DE CONEXION
$server     = "localhost";
$username   = "plasmart_admin";
$userpass   = "Plasmart2468";
$dbname     = "plasmart_juego";

//CONEXION CON LA BASE DE DATOS
$link = mysql_connect($server,$username,$userpass,$dbname) or die ("No se encuentra el servidor<br>");
$db = mysql_select_db($dbname,$link) or die ("Error de conección");


//BORRAR_______________________________
$sql = "DELETE FROM usuarios";
mysql_select_db($dbname);
$query = mysql_query( $sql, $link )or die (mysql_error());

unset ($_COOKIE ["usuario"]);

?>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

</head>

<audio id="audio" controls autoplay style="visibility: hidden;"><source src="/juego/audio/ganar.mp3" type="audio/mpeg"></audio>


<style>
html{
background-color: black;
color: white;
}
.boton {
    background-color: red;
    color: white;
    border-radius: 10px;
    display: inline-block;
    width: 40%;
    margin: 0;
    border-radius: 20px;
    padding: 0;
    text-align: center;
    font-size: 18px;
    display: inline-block;
    text-decoration: none;
}
.inicio {
    text-align: center;
    max-width: 350px;
    margin: 0 auto;
    background-color: #292929;
    padding: 10px;
    border-radius: 6px;
}
.inicio .boton{
    text-align: center;
    font-size: 30px;
    width: 100%;
}
</style>




<div class="inicio">
    <h1>ERES EL GANADOR</h1>
    <h3>Juega una vez más</h3>
    <img src="/juego/img/objetos/+vinito.gif" width="24%">
    <img src="/juego/img/objetos/+cocaine.gif" width="24%">
    <img src="/juego/img/objetos/+weed.gif" width="24%">
    <img src="/juego/img/objetos/+tussy.gif" width="24%">
    <br>
    <hr>
    <br>
    <a class="boton" href="/juego">Volver a jugar</a>
</div>


<script>
    var audio = getElementById("audio");
    audio.play();
</script>