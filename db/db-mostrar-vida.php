<?php include $_SERVER['DOCUMENT_ROOT']."/juego/conexion.php";?>

<?php
$codigo= $_COOKIE["usuario"];
$sala = $_COOKIE["sala"];
//SELECCIONAR____________________________
$sql_usuario_vida = mysql_query("SELECT * from usuarios where codigo='$codigo' and sala='$sala'");
$registro_usuario_vida = mysql_fetch_array($sql_usuario_vida);
?>

<div class="vida-usuario">
    <span><?php echo $registro_usuario_vida['vida'];?>%</span>

    <?php
    //SELECCIONAR y WHILE____________________________
    $sql_vida_otros_usuario  = mysql_query("SELECT * from usuarios where codigo!='$codigo' and sala='$sala' order by vida desc");
    while($registro_vida_otros_usuario = mysql_fetch_array($sql_vida_otros_usuario )):
        $vida = $registro_vida_otros_usuario['vida'];
        $ropa = $registro_vida_otros_usuario['ropa'];
    ?>
        <span class="enemigos color-<?php echo $ropa;?>" style="background-color:<?php echo $color_vida;?>"><?php echo $vida;?>%</span>
    <?php endwhile?>
</div>



