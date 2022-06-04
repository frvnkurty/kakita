<?php
error_reporting(0);

echo '<h1>Seleccione una sala</h1><br>';
echo '<a href="/juego/juego.php">Campo de batalla</a><br>';
echo '<a href="/juego/cambio-sala.php?sala='.$_COOKIE['usuario'].'">Mi sala</a><br>';

if($_GET['sala']){
   setcookie("sala", $_GET['sala']);
   echo '<meta http-equiv="refresh" content="0;url=https://demo.plasmart.cl/juego/sala.php?'.$_GET['sala'].'" />';
}else{

   include $_SERVER['DOCUMENT_ROOT']."/juego/conexion.php";

echo '<h1>Otras salas disponibles</h1><br>';
   $sql_sala = mysql_query("SELECT * from salas order by id desc limit 30");
   while($registro_sala = mysql_fetch_array($sql_sala)){
      echo '<a href="/juego/cambio-sala.php?sala='.$registro_sala['codigo_sala'].'">'.$registro_sala['codigo_sala'].'</a><br>';
   }


}


