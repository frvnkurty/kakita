<?php include $_SERVER['DOCUMENT_ROOT']."/juego/conexion.php";?>

<?php
$sala = $_COOKIE["sala"];

//SELECCIONAR y WHILE____________________________
$sql_mapa_notitas = mysql_query("SELECT * from notitas where sala='$sala' ");
while($registro_mapa_notitas = mysql_fetch_array($sql_mapa_notitas)):
$pos_x = $registro_mapa_notitas['pos_x'];
$pos_y = $registro_mapa_notitas['pos_y'];
$texto = $registro_mapa_notitas['texto'];
?>

    <?php
    if($texto == '+weed'){
        $color_notita = '#06ff001a';
    }elseif($texto == '+bomba'){
        $color_notita = '#0000001a';
    }elseif($texto == '+tussy'){
        $color_notita = '#FF33FB';
    }elseif($texto == '+cocaine'){
        $color_notita = 'gray';
    }elseif($texto == '+veneno'){
        $color_notita = 'gray';
    }
    ;
    
    ?>
    <span class="notitas-posicion"  style="left:<?php echo ($pos_x / 100);?>px;top: <?php echo ($pos_y / 100);?>px;background-color:<?php echo $color_notita;?>!important" > </span>

<?php endwhile?>