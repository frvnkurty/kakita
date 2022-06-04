<?php include $_SERVER['DOCUMENT_ROOT']."/juego/conexion.php";?>

<?php
$codigo = $_COOKIE["usuario"];
$sala = $_COOKIE["sala"];
?>


<?php
//SELECCIONAR y WHILE____________________________
$sql_usuarios = mysql_query("SELECT * from usuarios where sala='$sala' and codigo!='$codigo' ");
while($registro_usuarios = mysql_fetch_array($sql_usuarios)):?>

    <div class="usuario usuarios-otros  usuario-<?php echo $registro_usuarios['ropa'];?>"  style="left:<?php echo $registro_usuarios['pos_x'];?>;top: <?php echo $registro_usuarios['pos_y'];?>; ">
        <span class="vida-usuario"><?php echo $registro_usuarios['vida'];?>%</span>
        <span class="expresion expresion-<?php echo $registro_usuarios['expresion'];?>"></span>
    </div>

<?php endwhile?>