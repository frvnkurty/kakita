<?php include $_SERVER['DOCUMENT_ROOT']."/juego/conexion.php";?>

<?php
$codigo = $_COOKIE["usuario"];
$sala = $_COOKIE["sala"];
$pos_x = $_POST['pos_x'];
$pos_y = $_POST['pos_y'];

if($pos_x  > 4900){
    $pos_x = 0;
}
if($pos_y  > 4900){
    $pos_y = 0;
}

//SELECCIONAR y WHILE____________________________
$sql_usuarios = mysql_query("SELECT * from usuarios where sala='$sala' and codigo='$codigo'");
while($registro_usuarios = mysql_fetch_array($sql_usuarios)):
?>

    <div id="usuario" class="usuario usuario-<?php echo $registro_usuarios['ropa'];?> <?php echo $animacion_usuario;?>" style="left:<?php echo $registro_usuarios['pos_x'];?>;top: <?php echo $registro_usuarios['pos_y'];?>; animation-iteration-count: infinite!important;animation-duration: 3s;" >
        <span class="puntero"></span>
        <span class="expresion expresion-<?php echo $registro_usuarios['expresion'];?>"></span>
    </div>

<?php endwhile?>