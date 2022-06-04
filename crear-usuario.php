<?php
error_reporting(0);
if(!$_COOKIE["usuario"]){
    setcookie("usuario", rand(1111111,9999999));
}
setcookie("sala", 0);


include $_SERVER['DOCUMENT_ROOT']."/juego/conexion.php";


$codigo = $_COOKIE["usuario"];
$sala = 0;


function redondear_juego($z){
    $b=50;
    for ($a=$z; $a<=$z+$b; $a++)
    {
        for($c=1; $c<=($z/$b)+1; $c++)
        {
        $d=$c*$b;
        if($d==$a)
        return $a;
        }
    }
}


//BORRAR_______________________________
$sql_borrar_usuario = "DELETE FROM usuarios WHERE codigo='$codigo'";
mysql_select_db($dbname);
$query = mysql_query( $sql_borrar_usuario, $link )or die (mysql_error());

$sala = 0;
//$pos_x = 2450;
//$pos_y = 2450;
$pos_x = redondear_juego(rand(0, 4900));
$pos_y = redondear_juego(rand(0, 4900));
$fecha = date('Y-m-d');
$hora = date('H:i:s');
$ropa = rand(0, 9);


//INSERTAR_______________________________________
$sql = "INSERT INTO `usuarios`(`codigo`, `sala`, `pos_x`, `pos_y`, `fecha`, `hora`, `ropa`, `vida`) VALUES ('$codigo', '$sala', '$pos_x', '$pos_y', '$fecha', '$hora', '$ropa', '3')"; 
mysql_query($sql) or die(mysql_error());

//INSERTAR_______________________________________
$sql = "INSERT INTO `salas`(`codigo_sala`, `codigo_usuario`, `ancho`, `alto`, `estilo`) VALUES ('$codigo', '$codigo', '3000', '3000', '1')"; 
mysql_query($sql) or die(mysql_error());


//CONTAR FILAS____________________________________
$sql = mysql_query("SELECT * from usuarios where codigo='$codigo'");
$registro_contar_usuarios = mysql_num_rows($sql);
$registro_usuarios = mysql_fetch_array($sql);


if($registro_contar_usuarios){
    $usuario_creado=1;
    $notificacion = 'Listo';
}else{
    $notificacion = 'Error!';
}

?>

<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

<script src="/juego/js/jquery-1.12.4.js"></script>
<script src="/juego/js/jquery-ui.js"></script>

<link href="/juego/css/juego.css?vol=<?php echo rand(1111111,9999999);?>" rel="stylesheet" type="text/css">
<link href="/juego/css/animate.css" rel="stylesheet" type="text/css">
</head>




<style>
html{color: white;}
</style>

<div class="inicio">
        <form id="informacion-personaje">

            <h1>Creando Usuario<br><?php echo $codigo;?><br><?php echo $notificacion;?></h1>


            <div class="mostrar-personaje">
                <img src="/juego/img/personajes/<?php echo $registro_usuarios['ropa'];?>.png" width="150px" height="150px">
                <img id="img_to_flip" src="/juego/img/personajes/expresiones/0.gif" width="150px" height="150px">
            </div>

            <a class="boton" href="/juego/juego.php">Listo</a>
        </form>

        <small>
        <h3>Daños de los objetos</h3>
        -Bombas - 1 puntos<br>
        -Veneno - 3 puntos<br>
        -Weed + 3 punto<br>
        -Azucar + 5 punto<br>
        -Nesquik + 5 punto<br>
        -Vino + 3 punto
        </small>
    </div>



<meta http-equiv="refresh" content="2;url=https://demo.plasmart.cl/juego/juego.php" />