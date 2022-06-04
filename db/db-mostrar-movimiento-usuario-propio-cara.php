<?php include $_SERVER['DOCUMENT_ROOT']."/juego/conexion.php";?>

<?php
$codigo = $_COOKIE["usuario"];
$sala = $_COOKIE["sala"];

//SELECCIONAR y WHILE____________________________
$sql_usuarios = mysql_query("SELECT * from usuarios where sala='$sala' and codigo='$codigo'");
$registro_usuarios = mysql_fetch_array($sql_usuarios);
?>
<span class="puntero"></span>
<span class="vida-usuario"><?php echo $registro_usuarios['vida'];?>%</span>
<span class="expresion expresion-<?php echo $registro_usuarios['expresion'];?>"></span>

<?php
//SELECCIONAR____________________________
$sql_detectar_usuario_muerto = mysql_query("SELECT * from usuarios where codigo ='$codigo'");
$registro_detectar_usuario_muerto = mysql_num_rows($sql_detectar_usuario_muerto);

if($registro_detectar_usuario_muerto < 1){
    echo '<h1 class="alerta">Haz Muerto</h1>';
    echo '<meta http-equiv="refresh" content="0;url=https://demo.plasmart.cl/juego/salir.php" />';
}
?>