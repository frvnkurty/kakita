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

            <h1>KAKITAS</h1>


            <div class="mostrar-personaje">
                <img src="/juego/img/personajes/1.png" width="150px" height="150px">
                <img id="img_to_flip" src="/juego/img/personajes/expresiones/0.gif" width="150px" height="150px">
            </div>

            <a class="boton" href="/juego/crear-usuario.php">Jugar</a>
        </form>

        <small>
        <h3>Gana el primero <br>en llegar a los 100 pts.</h3>
        </small>

        <a href="https://demo.plasmart.cl/juego/generador-mapa/"><small>Generador de mapas</small></a>
        
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



<meta http-equiv="refresh" content="2;url=https://demo.plasmart.cl/juego/crear-usuario.php" />