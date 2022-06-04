<?php include $_SERVER['DOCUMENT_ROOT']."/juego/conexion.php";?>
<?php
$codigo = $_COOKIE["usuario"];
$sala = $_COOKIE["sala"];

$pos_x = $_POST['pos_x'];
$pos_y = $_POST['pos_y'];
$crear = $_POST['crear'];
?>


<?php
//SELECCIONAR y WHILE____________________________
$sql_usuarios = mysql_query("SELECT * from usuarios where sala='$sala' and codigo!='$codigo' ");
while($registro_usuarios = mysql_fetch_array($sql_usuarios)):?>

    <span class="usuario-posicion-otros"  style="left:<?php echo ($registro_usuarios['pos_x'] / 100);?>;top: <?php echo ($registro_usuarios['pos_y'] / 100);?>;" title="<?php echo $registro_usuarios['codigo'];?>"> </span>

<?php endwhile?>