<?php
error_reporting(0);
if(!$_COOKIE["usuario"]){
    setcookie("usuario", rand(1111111,9999999));
}
setcookie("sala", 0);


include $_SERVER['DOCUMENT_ROOT']."/juego/conexion.php";


//BORRAR_______________________________
$sql_borrar_usuario = "DELETE FROM usuarios WHERE codigo=0";
mysql_select_db($dbname);
$query = mysql_query( $sql_borrar_usuario, $link )or die (mysql_error());

//BORRAR_______________________________
$sql_borrar_salas = "DELETE FROM salas WHERE codigo_sala=0";
mysql_select_db($dbname);
$query = mysql_query( $sql_borrar_salas, $link )or die (mysql_error());

$codigo = $_COOKIE["usuario"];
$sala = 0;



//CONTAR FILAS____________________________________
$sql = mysql_query("SELECT * from usuarios where codigo='$codigo'");
$registro_contar_usuarios = mysql_num_rows($sql);

if($registro_contar_usuarios == 0){

    $sala = 0;
    $pos_x = 4950;
    $pos_y = 4950;
    //$pos_x = rand(1000, 9000);
    //$pos_y = rand(1000, 9000);
    $fecha = date('Y-m-d');
    $hora = date('H:i:s');
    $ropa = rand(0, 9);


    //INSERTAR_______________________________________
    $sql = "INSERT INTO `usuarios`(`codigo`, `sala`, `pos_x`, `pos_y`, `fecha`, `hora`, `ropa`, `vida`) VALUES ('$codigo', '$sala', '$pos_x', '$pos_y', '$fecha', '$hora', '$ropa', '3')"; 
    mysql_query($sql) or die(mysql_error());

    //INSERTAR_______________________________________
    $sql = "INSERT INTO `salas`(`codigo_sala`, `codigo_usuario`, `ancho`, `alto`, `estilo`) VALUES ('$codigo', '$codigo', '3000', '3000', '1')"; 
    mysql_query($sql) or die(mysql_error());

    $usuario_creado=0;


    //BUSCAR DATOS DEL USUARIO
    $sql = mysql_query("SELECT * from usuarios where codigo='$codigo'");
    $registro_usuario = mysql_fetch_array($sql);


}else{
    $usuario_creado=1;
}

?>

<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

<script src="/juego/js/jquery-1.12.4.js"></script>
<script src="/juego/js/jquery-ui.js"></script>

<link href="/juego/css/juego.css?vol=<?php echo rand(1111111,9999999);?>" rel="stylesheet" type="text/css">
<link href="/juego/css/animate.css" rel="stylesheet" type="text/css">
</head>


<audio id="audio" controls autoplay style="visibility: hidden;"><source src="/juego/audio/musica.mp3" type="audio/mpeg"></audio>


<style>

.instrucciones{color: white;}
.usuarios-otros { background-color:#ff00003d!important;}

/*Ropas*/

.usuario-1 {
background: url(https://demo.plasmart.cl/juego/img/personajes/1.png) #ff0000ad!important;
background-size: 100% 100%!important;
background-repeat: no-repeat!important;
}
.usuario-2 {
background: url(https://demo.plasmart.cl/juego/img/personajes/2.png) #ff0000ad!important;
background-size: 100% 100%!important;
background-repeat: no-repeat!important;
}
.usuario-3 {
background: url(https://demo.plasmart.cl/juego/img/personajes/3.png) #ff0000ad!important;
background-size: 100% 100%!important;
background-repeat: no-repeat!important;
}
.usuario-4 {
background: url(https://demo.plasmart.cl/juego/img/personajes/4.png) #ff0000ad!important;
background-size: 100% 100%!important;
background-repeat: no-repeat!important;
}
.usuario-5 {
background: url(https://demo.plasmart.cl/juego/img/personajes/5.png) #ff0000ad!important;
background-size: 100% 100%!important;
background-repeat: no-repeat!important;
}
.usuario-6 {
background: url(https://demo.plasmart.cl/juego/img/personajes/6.png) #ff0000ad!important;
background-size: 100% 100%!important;
background-repeat: no-repeat!important;
}
.usuario-7 {
background: url(https://demo.plasmart.cl/juego/img/personajes/7.png) #ff0000ad!important;
background-size: 100% 100%!important;
background-repeat: no-repeat!important;
}
.usuario-8 {
background: url(https://demo.plasmart.cl/juego/img/personajes/8.png) #ff0000ad!important;
background-size: 100% 100%!important;
background-repeat: no-repeat!important;
}
.usuario-9 {
background: url(https://demo.plasmart.cl/juego/img/personajes/9.png) #ff0000ad!important;
background-size: 100% 100%!important;
background-repeat: no-repeat!important;
}
.usuario-0 {
background: url(https://demo.plasmart.cl/juego/img/personajes/0.png) #ff0000ad!important;
background-size: 100% 100%!important;
background-repeat: no-repeat!important;
}



span.expresion {
    display: block;
    position: absolute;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-size: 100% 100%!important;
    background-repeat: no-repeat!important;
}

span.expresion.expresion-0 {
    background: url(/juego/img/personajes/expresiones/0.gif);
}
span.expresion.expresion-1 {
    background: url(/juego/img/personajes/expresiones/1.gif);
}
span.expresion.expresion-2 {
    background: url(/juego/img/personajes/expresiones/2.gif);
}
span.expresion.expresion-3 {
    background: url(/juego/img/personajes/expresiones/3.gif);
}
span.expresion.expresion-4 {
    background: url(/juego/img/personajes/expresiones/4.gif);
}
span.expresion.expresion-5 {
    background: url(/juego/img/personajes/expresiones/5.gif);
}
span.expresion.expresion-6 {
    background: url(/juego/img/personajes/expresiones/6.gif);
}
span.expresion.expresion-7 {
    background: url(/juego/img/personajes/expresiones/7.gif);
}
span.expresion.expresion-8 {
    background: url(/juego/img/personajes/expresiones/8.gif);
}
.explosion {
    transform: scale(3)!important;
    background-color: yellow;
    opacity: 0!important;
    transition:0.3s!important;
}
.notita {
    opacity: 1;
}

</style>


<?php if($usuario_creado == 0):?>

    <div class="inicio">
        <form id="informacion-personaje">

            <h1 class="instrucciones">CODE: <?php echo $registro_usuario['codigo'];?></h1>


            <div class="mostrar-personaje">
                <img src="/juego/img/personajes/<?php echo $registro_usuario['ropa'];?>.png" width="150px" height="150px">
                <img id="img_to_flip" src="/juego/img/personajes/expresiones/0.gif" width="150px" height="150px">
            </div>

            <a class="boton" href="/juego">Jugar</a>
        </form>

        <small class="instrucciones">
        <h3>El objetivo es no morir</h3>
        -Debes poner bombas para matar a tus oponentes<br>
        -Puedes consumir para aumentar tu vida<br>
        -Si consumes demasiado también mueres<br>
        -Si mueres debes pagar con penitencia
        </small>
    </div>



<script>
(function() {     // function expression closure to contain variables
    var i = 0;
    var pics = [ "/juego/img/personajes/expresiones/0.gif", "/juego/img/personajes/expresiones/1.gif", "/juego/img/personajes/expresiones/2.gif", "/juego/img/personajes/expresiones/3.gif", "/juego/img/personajes/expresiones/4.gif", "/juego/img/personajes/expresiones/5.gif", "/juego/img/personajes/expresiones/6.gif", "/juego/img/personajes/expresiones/7.gif", "/juego/img/personajes/expresiones/8.gif" ];
    var el = document.getElementById('img_to_flip');  // el doesn't change
    function toggle() {
        el.src = pics[i];           // set the image
        i = (i + 1) % pics.length;  // update the counter
    }
    setInterval(toggle, 1000);
})();             // invoke the function expression
</script>

<?php else:?>


    <div id="izquierda" class="boton-control" style="background:url(/juego/img/iconos/izquierda.png);"></div>
    <div id="arriba" class="boton-control" style="background:url(/juego/img/iconos/arriba.png);"></div>
    <div id="abajo" class="boton-control" style="background:url(/juego/img/iconos/abajo.png);"></div>
    <div id="derecha" class="boton-control" style="background:url(/juego/img/iconos/derecha.png);"></div>

    <div class="opciones">

        <form id="dejar-objeto" method="post">
            <input type="hidden" value="<?php echo $_COOKIE["usuario"];?>" name="usuario">
            <input type="hidden" name="texto" value="+bomba">
            <input type="hidden" name="crear" value="1">
            <input type="hidden" class="posx_notita" name="pos_x" value="5000">
            <input type="hidden" class="posy_notita"  name="pos_y" value="5000">
            <input type="hidden" name="sala" value="0">
            <span class="boton boton-dejar-objeto" style="background: url(/juego/img/objetos/+bomba.gif);"></span>
        </form>

        <form id="dejar-objeto" method="post">
            <input type="hidden" value="<?php echo $_COOKIE["usuario"];?>" name="usuario">
            <input type="hidden" name="texto" value="+coca">
            <input type="hidden" name="crear" value="1">
            <input type="hidden" class="posx_notita" name="pos_x" value="5000">
            <input type="hidden" class="posy_notita"  name="pos_y" value="5000">
            <input type="hidden" name="sala" value="0">
            <span class="boton boton-dejar-objeto" style="background: url(/juego/img/objetos/+coca.gif);"></span>
        </form>


        <form id="dejar-objeto" method="post">
            <input type="hidden" value="<?php echo $_COOKIE["usuario"];?>" name="usuario">
            <input type="hidden" name="texto" value="+weed">
            <input type="hidden" name="crear" value="1">
            <input type="hidden" class="posx_notita" name="pos_x" value="5000">
            <input type="hidden" class="posy_notita"  name="pos_y" value="5000">
            <input type="hidden" name="sala" value="0">
            <span class="boton boton-dejar-objeto" style="background: url(/juego/img/objetos/+weed.gif);"></span>
        </form>

        <form id="dejar-objeto" method="post">
            <input type="hidden" value="<?php echo $_COOKIE["usuario"];?>" name="usuario">
            <input type="hidden" name="texto" value="+vinito">
            <input type="hidden" name="crear" value="1">
            <input type="hidden" class="posx_notita" name="pos_x" value="5000">
            <input type="hidden" class="posy_notita"  name="pos_y" value="5000">
            <input type="hidden" name="sala" value="0">
            <span class="boton boton-dejar-objeto" style="background: url(/juego/img/objetos/+vinito.gif);"></span>
        </form>

        <form id="dejar-objeto" method="post">
            <input type="hidden" value="<?php echo $_COOKIE["usuario"];?>" name="usuario">
            <input type="hidden" name="texto" value="+cocaine">
            <input type="hidden" name="crear" value="1">
            <input type="hidden" class="posx_notita" name="pos_x" value="5000">
            <input type="hidden" class="posy_notita"  name="pos_y" value="5000">
            <input type="hidden" name="sala" value="0">
            <span class="boton boton-dejar-objeto" style="background: url(/juego/img/objetos/+cocaine.gif);"></span>
        </form>

        <form id="dejar-objeto" method="post">
            <input type="hidden" value="<?php echo $_COOKIE["usuario"];?>" name="usuario">
            <input type="hidden" name="texto" value="+tussy">
            <input type="hidden" name="crear" value="1">
            <input type="hidden" class="posx_notita" name="pos_x" value="5000">
            <input type="hidden" class="posy_notita"  name="pos_y" value="5000">
            <input type="hidden" name="sala" value="0">
            <span class="boton boton-dejar-objeto" style="background: url(/juego/img/objetos/+tussy.gif);"></span>
        </form>




        <form id="dejar-notita" method="post">
            <input type="hidden" value="<?php echo $_COOKIE["usuario"];?>" name="usuario">
            <input class="input-texto-nota" name="texto" placeholder="Escribe..." value="" autocomplete="off">
            <input type="hidden" name="crear" value="1">
            <input type="hidden" class="posx_notita" name="pos_x" value="5000">
            <input type="hidden" class="posy_notita"  name="pos_y" value="5000">
            <input type="hidden" name="sala" value="0">
            <span class="boton boton-dejar-notita">Enviar</span>
        </form>

        <form id="movimiento-usuario" method="post">
            <input type="hidden" value="<?php echo $_COOKIE["usuario"];?>" name="usuario">
            <input type="hidden" name="crear" value="1">
            <input type="hidden" class="posx_usuario" name="pos_x" value="5000">
            <input type="hidden" class="posy_usuario"  name="pos_y" value="5000">
            <input type="hidden" name="sala" value="0">
        </form>

        <form id="mostrar-notitas" method="post">
            <input type="hidden" name="crear" value="1">
            <input type="hidden" class="posx_usuario" name="pos_x" value="5000">
            <input type="hidden" class="posy_usuario"  name="pos_y" value="5000">
        </form>



        <form id="form-borrar-notitas" method="post">
            <input type="hidden" id="id_notita_borrar" name="id_notita" value="">
        </form>


    </div>

    <span class="actualizar">
        <a href="/juego" style="background: url(/juego/img/iconos/actualizar.png);" ></a>
        <a href="/juego/logout.php" style="background: url(/juego/img/iconos/logout.png);" ></a>
        <!--a href="/juego/" style="background: url(/juego/img/iconos/mundo.png);" ></a-->
        <a href="/juego/sala.php?sala=<?php echo $codigo;?>" style="background: url(/juego/img/iconos/casa.png);" ></a>
        <a class="play-audio" style="background: url(/juego/img/iconos/audio.png);" ></a>
        <div class="mostrar-vidas"></div>
    </span>


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
            
            <div class="plano-usuarios">
                <?php include $_SERVER['DOCUMENT_ROOT']."/juego/db/db-mostrar-movimiento-otros-usuarios.php";?>
            </div>



            <div class="plano-propio">
                <?php include $_SERVER['DOCUMENT_ROOT']."/juego/db/db-mostrar-movimiento-usuario-propio.php";?>
            </div>

            
            <span class="paralelo"></span><span class="meridiano"></span>
            
            <div class="notita" style="left: 4988px;top: 4980px;background-color: #794321;color: black;">0</div>


            <div class="objetos">
                <?php include $_SERVER['DOCUMENT_ROOT']."/juego/db/db-mostrar-notitas.php";?>
                
            </div>
        </div>
    </div>


<script>
$(document).on("keydown", "form", function(event) { 
    return event.key != "Enter";
});



//TAMAÑO DEL MONITOR
function tamVentana() {
    winx = 0;
    winy = 0;

    if (typeof window.innerWidth != 'undefined'){
        winx = window.innerWidth;
        winy = window.innerHeight;
    }else if (typeof document.documentElement != 'undefined'
      && typeof document.documentElement.clientWidth !=
      'undefined' && document.documentElement.clientWidth != 0){
        winx = document.documentElement.clientWidth;
        winy = document.documentElement.clientHeight;

    }else{
        winx = document.getElementsByTagName('html')[0].clientWidth;
        winy = document.getElementsByTagName('html')[0].clientHeight;    
    }

    //alert(winx+' '+winy);
    //return winx,winy;
}

tamVentana();

    
function detectarpos() {
    posx = $('#usuario').css('left');
    posy = $('#usuario').css('top');
    posx_num = parseInt(posx.substring( posx.length -2, 0) );
    posy_num = parseInt(posy.substring( posy.length -2, 0) );

    //$('#usuario').html(posx_num+','+posy_num);

    if(posx_num < 0 ){$('#usuario').css('left', ' 0px'); clearInterval(movimiento); }
    if(posx_num > 9950 ){$('#usuario').css('left', ' 9950px'); clearInterval(movimiento); }
    if(posy_num < 100 ){$('#usuario').css('top', ' 100px'); clearInterval(movimiento); }
    if(posy_num > 10000 ){$('#usuario').css('top', ' 10000px'); clearInterval(movimiento); }
}


/*
//ACTUALIZAR ELEMENTOS DEL PLANO PROPIO
movimiento0 = setInterval(function() {
    $(".plano-propio").load('/juego/db/db-mostrar-movimiento-usuario-propio.php');
}, 10000);
*/

//ACTUALIZAR ELEMENTOS DEL PLANO DE OTROS USUARIOS
movimiento0 = setInterval(function() {
    $(".plano-usuarios").load('/juego/db/db-mostrar-movimiento-otros-usuarios.php');

}, 50);


//ACTUALIZAR ELEMENTOS DEL PLANO DE OBJETOS
movimiento0 = setInterval(function() {
    //$(".objetos").load('/juego/db/db-mostrar-notitas.php');
    $.ajax({
        type: "POST",
        url: "/juego/db/db-mostrar-notitas.php",
        data: $("#mostrar-notitas").serialize(),
        success: function(result){
        $('.objetos').html(result);
    }});

}, 500);


//ACTUALIZAR ELEMENTOS DEL MAPA
movimiento1 = setInterval(function() {

    //Actualizar posicion de objetos en el mapa
    $(".mapa-otros-usuarios").load('/juego/db/db-mostrar-mapa-movimiento-otros-usuarios.php');
    $(".mapa-notitas").load('/juego/db/db-mostrar-mapa-notitas.php');

    //Acualizar posicion del usuario en el mapa
    $('.usuario-posicion').css('left', (posx_num / 100));
    $('.usuario-posicion').css('top', (posy_num / 100));

    $(".mostrar-vidas").load('/juego/db/db-mostrar-vida.php');
    
}, 1000);


//ACTUALIZAR FORMULARIOS Y SCROLL
movimiento2 = setInterval(function() {
    detectarpos();
    $('#sala').scrollLeft(posx_num - (winx / 2) +10 );
    $('#sala').scrollTop(posy_num - (winy / 2) + 150 );

    $('.posx_notita').val(posx_num);
    $('.posy_notita').val(posy_num - 80);

    $('.posx_usuario').val(posx_num);
    $('.posy_usuario').val(posy_num);

}, 10);



actualizar = setInterval(function() {

    $.ajax({
        type: "POST",
        url: "/juego/db/db-actualizar-movimiento-usuario-propio.php",
        data: $("#movimiento-usuario").serialize(),
        success: function(result){
        
    }});

    $('.notita').mousedown( function(){

        $(this).addClass('explosion');

        id_notita = $(this).data('id-notita');
        $('#id_notita_borrar').val(id_notita);
        $(this).css('background-color', 'green');
        $.ajax({
            type: "POST",
            url: "/juego/db/db-borrar-notitas.php",
            data: $("#form-borrar-notitas").serialize(),
            success: function(result){
            $(this).remove();
        }});        
    });

}, 100);



//ENVIAR FORMULARIO DEJAR NOTITA CON AJAX
$('.boton-dejar-notita').click( function(){        
    $.ajax({
        type: "POST",
        url: "/juego/db/db-nueva-notitas.php",
        data: $("#dejar-notita").serialize(),
        success: function(result){
        $('.objetos').html(result);
        $('.input-texto-nota').val('');
    }});        
});


//ENVIAR FORMULARIO DEJAR OBJETO CON AJAX
$('.boton-dejar-objeto').click( function(){

    formulario = $(this).parent();

    $.ajax({
        type: "POST",
        url: "/juego/db/db-nueva-notitas.php",
        data: formulario.serialize(),
        success: function(result){
        $('.objetos').html(result);
    }});        
});


//AUDIO
$('.play-audio').click( function(){        
    var bool = $("#audio").prop("muted");
    $("#audio").prop("muted",!bool);
});



//ACCIONES DEL PERSONAJE
$(function() {



/*

//DETECTAR POSICION DE TODOS LOS OBJETOS
var contenidos_left=new Array();
var contenidos_top=new Array();
//Aquí ya te devuelve un array
var seleccion=document.querySelectorAll(".notita");
//Aquí recorres el array
for(item of seleccion){
    //Aquí guardas el contenido del elemento en un array
    contenidos_left.push(item.style.left );
    contenidos_top.push(item.style.top );
}
//alert(contenidos_left);
//alert(contenidos_top);


//DETECTAR SI LA POSICION DEL USUARIO ES IGUAL A LA DE UN OBJETO
var indice = contenidos_left.includes($('#usuario').css('left'));
var indice2 = contenidos_top.includes($('#usuario').css('top'));  



indice = false;
indice2 = false;

if(indice == true && indice2 == true){
    //alert('Posicion prohibida');
    //alert(indice);
    $('#usuario').css('left', '-=50px');
    $('#usuario').css('top', '-=50px');
    
}else{

}

*/



//MOVER USUARIO AL PRESIONAR TECLAS
    $(document).keydown(function(e) {
        if (e.which == '37') { //izquierda
            detectarpos();

            posx_num_prueba =  Math.ceil(posx_num / 50) * 50;
            posicion_nueva = posx_num_prueba - 50;
            if(posicion_nueva > 9950){
                posicion_nueva = 0;
            }
            if(posicion_nueva < 0){
                posicion_nueva = 9950;
            }
            $('#usuario').css('left', posicion_nueva+'px');
        }
    });

    $(document).keydown(function(e) {
        if (e.which == '39') { //derecha
            detectarpos();
            posx_num_prueba =  Math.ceil(posx_num / 50) * 50;
            posicion_nueva = posx_num_prueba + 50;
            if(posicion_nueva > 9950){
                posicion_nueva = 0;
            }
            if(posicion_nueva < 0){
                posicion_nueva = 9950;
            }
            $('#usuario').css('left', posicion_nueva+'px');
        }
    });

    $(document).keydown(function(e) {
        if (e.which == '38') { //arriba
            detectarpos();
            posy_num_prueba =  Math.ceil(posy_num / 50) * 50;
            posicion_nueva = posy_num_prueba - 50;
            if(posicion_nueva > 9950){
                posicion_nueva = 100;
            }
            if(posicion_nueva < 100){
                posicion_nueva = 9950;
            }
            $('#usuario').css('top', posicion_nueva+'px');
        }
    });

    $(document).keydown(function(e) {
        if (e.which == '40') { //abajo
            detectarpos();
            posy_num_prueba =  Math.ceil(posy_num / 50) * 50;
            posicion_nueva = posy_num_prueba + 50;
            if(posicion_nueva > 9950){
                posicion_nueva = 100;
            }
            if(posicion_nueva < 100){
                posicion_nueva = 9950;
            }
            $('#usuario').css('top', posicion_nueva+'px');
        }
    });

    //DEJAR NOTA A PRESIONAR ESPACIO
    $(document).keydown(function(e) {
        if (e.which == '32') { //down arrow key
            //alert('presionaste backspace');
            $.ajax({
                type: "POST",
                url: "/juego/db/db-nueva-notitas.php",
                data: $("#dejar-objeto").serialize(),
                success: function(result){
                $('.objetos').html(result);
            }});    
        }
    });



//MOVER USUARIO AL PRESIONAR FLECHAS CON EL PC
    $('#izquierda').mousedown(function(){
        detectarpos();
        
        movimiento = setInterval(function() {
            posx_num_prueba =  Math.ceil(posx_num / 50) * 50;
            posicion_nueva = posx_num_prueba - 50;
            if(posicion_nueva > 9950){
                posicion_nueva = 0;
            }
            if(posicion_nueva < 0){
                posicion_nueva = 9950;
            }
            $('#usuario').css('left', posicion_nueva+'px');
        }, 50);
        
    });
    $('#izquierda').mouseup(function () {
        clearInterval(movimiento); 
    });


    $('#derecha').mousedown(function(){
        detectarpos();
        movimiento = setInterval(function() {
            posx_num_prueba =  Math.ceil(posx_num / 50) * 50;
            posicion_nueva = posx_num_prueba + 50;
            if(posicion_nueva > 9950){
                posicion_nueva = 0;
            }
            if(posicion_nueva < 0){
                posicion_nueva = 9950;
            }
            $('#usuario').css('left', posicion_nueva+'px');
        }, 50);
    });
    $('#derecha').mouseup(function () {
        clearInterval(movimiento); 
    });


    $('#arriba').mousedown(function(){
        detectarpos();
        movimiento = setInterval(function() {
            posy_num_prueba =  Math.ceil(posy_num / 50) * 50;
            posicion_nueva = posy_num_prueba - 50;
            if(posicion_nueva > 9950){
                posicion_nueva = 100;
            }
            if(posicion_nueva < 100){
                posicion_nueva = 9950;
            }
            $('#usuario').css('top', posicion_nueva+'px');
        }, 50);
    });
    $('#arriba').mouseup(function () {
        clearInterval(movimiento); 
    });


    $('#abajo').mousedown(function(){
        detectarpos();
        movimiento = setInterval(function() {
            posy_num_prueba =  Math.ceil(posy_num / 50) * 50;
            posicion_nueva = posy_num_prueba + 50;
            if(posicion_nueva > 9950){
                posicion_nueva = 100;
            }
            if(posicion_nueva < 100){
                posicion_nueva = 9950;
            }
            $('#usuario').css('top', posicion_nueva+'px');
        }, 50);
    });
    $('#abajo').mouseup(function () {
        clearInterval(movimiento); 
    });

});





//MOVER USUARIO AL PRESIONAR TECLAS CON EL TELEFONO
window.onload = function() {
    //preload mouse down image here via Image()
    $('#izquierda').on('touchstart', function(){
        detectarpos();
        movimiento = setInterval(function() {
            posx_num_prueba =  Math.ceil(posx_num / 50) * 50;
            posicion_nueva = posx_num_prueba - 50;
            if(posicion_nueva > 9950){
                posicion_nueva = 0;
            }
            if(posicion_nueva < 0){
                posicion_nueva = 9950;
            }
            $('#usuario').css('left', posicion_nueva+'px');
        }, 50);
    });
    $('#izquierda').on('touchend', function(){
        clearInterval(movimiento); 
    });

    //preload mouse down image here via Image()
    $('#derecha').on('touchstart', function(){
        detectarpos();
        movimiento = setInterval(function() {
            posx_num_prueba =  Math.ceil(posx_num / 50) * 50;
            posicion_nueva = posx_num_prueba + 50;
            if(posicion_nueva > 9950){
                posicion_nueva = 0;
            }
            if(posicion_nueva < 0){
                posicion_nueva = 9950;
            }
            $('#usuario').css('left', posicion_nueva+'px');
        }, 50); 
    });
    $('#derecha').on('touchend', function(){
        clearInterval(movimiento); 
    });

    //preload mouse down image here via Image()
    $('#abajo').on('touchstart', function(){
        detectarpos();
        movimiento = setInterval(function() {
            posy_num_prueba =  Math.ceil(posy_num / 50) * 50;
            posicion_nueva = posy_num_prueba + 50;
            if(posicion_nueva > 9950){
                posicion_nueva = 100;
            }
            if(posicion_nueva < 100){
                posicion_nueva = 9950;
            }
            $('#usuario').css('top', posicion_nueva+'px');
        }, 50); 
    });
    $('#abajo').on('touchend', function(){
        clearInterval(movimiento); 
    });

    //preload mouse down image here via Image()
    $('#arriba').on('touchstart', function(){
        detectarpos();
        movimiento = setInterval(function() {
            posy_num_prueba =  Math.ceil(posy_num / 50) * 50;
            posicion_nueva = posy_num_prueba - 50;
            if(posicion_nueva > 9950){
                posicion_nueva = 100;
            }
            if(posicion_nueva < 100){
                posicion_nueva = 9950;
            }
            $('#usuario').css('top', posicion_nueva+'px');
        }, 50); 
    });
    $('#arriba').on('touchend', function(){
        clearInterval(movimiento); 
    });
}
</script>




<?php endif;?>