<script>
//AUDIO
$('.play-audio').click( function(){        
    var bool = $("#audio").prop("muted");
    $("#audio").prop("muted",!bool);
});


//PREVENIR EVENTO ENTER EN FORMULARIO
$(document).on("keydown", "form", function(event) { 
    return event.key != "Enter";
});

/**/
//PREVENIR EVENTOS SCROLL CON LAS TECLAS DE FLECHAS
window.addEventListener("keydown", function(e) {
    if(["ArrowUp","ArrowDown","ArrowLeft","ArrowRight"].indexOf(e.code) > -1) {
        e.preventDefault();
    }
}, false);


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
}

tamVentana();

    
function detectarpos() {
    posx = $('#usuario').css('left');
    posy = $('#usuario').css('top');
    posx_num = parseInt(posx.substring( posx.length -2, 0) );
    posy_num = parseInt(posy.substring( posy.length -2, 0) );

    //$('#usuario').html(posx_num+','+posy_num);

    if(posx_num < 0 ){$('#usuario').css('left', ' 0px'); clearInterval(movimiento); }
    if(posx_num > 4900 ){$('#usuario').css('left', ' 4900px'); clearInterval(movimiento); }
    if(posy_num < 100 ){$('#usuario').css('top', ' 100px'); clearInterval(movimiento); }
    if(posy_num > 4900 ){$('#usuario').css('top', ' 4900px'); clearInterval(movimiento); }
}


//ACTUALIZAR ELEMENTOS DEL PLANO PROPIO
movimientob = setInterval(function() {
    $("#usuario").load('/juego/db/db-mostrar-movimiento-usuario-propio-cara.php');
}, 200);

//ACTUALIZAR ELEMENTOS DEL PLANO DE OTROS USUARIOS
movimientoc = setInterval(function() {
    $(".plano-usuarios").load('/juego/db/db-mostrar-movimiento-otros-usuarios.php');

}, 200);


//ACTUALIZAR ELEMENTOS DEL PLANO DE OBJETOS
movimiento0 = setInterval(function() {
    $.ajax({
        type: "POST",
        url: "/juego/db/db-mostrar-notitas.php",
        data: $("#mostrar-notitas").serialize(),
        success: function(result){
        $('.objetos').html(result);
    }});

}, 200);


//ACTUALIZAR ELEMENTOS DEL MAPA
movimiento1 = setInterval(function() {

    //Actualizar posicion de objetos en el mapa
    $(".mapa-otros-usuarios").load('/juego/db/db-mostrar-mapa-movimiento-otros-usuarios.php');
    $(".mapa-notitas").load('/juego/db/db-mostrar-mapa-notitas.php');

    //Acualizar posicion del usuario en el mapa
    $('.usuario-posicion').css('left', (posx_num / 100));
    $('.usuario-posicion').css('top', (posy_num / 100));

    $(".mostrar-vidas").load('/juego/db/db-mostrar-vida.php');
    $(".notitas-recientes").load('/juego/db/db-mostrar-notitas-recientes.php');
    
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

}, 200);



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
}, 200);


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


//ACCIONES DEL PERSONAJE
$(function() {


//MOVER USUARIO AL PRESIONAR TECLAS
$(document).keydown(function(e) {
    if (e.which == '37') { //izquierda
        detectarpos();

        posx_num_prueba =  Math.ceil(posx_num / 50) * 50;
        posicion_nueva = posx_num_prueba - 50;
        if(posicion_nueva > 4900){
            posicion_nueva = 0;
        }
        if(posicion_nueva < 0){
            posicion_nueva = 4900;
        }
        $('#usuario').css('left', posicion_nueva+'px');
    }
});

$(document).keydown(function(e) {
    if (e.which == '39') { //derecha
        detectarpos();
        posx_num_prueba =  Math.ceil(posx_num / 50) * 50;
        posicion_nueva = posx_num_prueba + 50;
        if(posicion_nueva > 4900){
            posicion_nueva = 0;
        }
        if(posicion_nueva < 0){
            posicion_nueva = 4900;
        }
        $('#usuario').css('left', posicion_nueva+'px');
    }
});

$(document).keydown(function(e) {
    if (e.which == '38') { //arriba
        detectarpos();
        posy_num_prueba =  Math.ceil(posy_num / 50) * 50;
        posicion_nueva = posy_num_prueba - 50;
        if(posicion_nueva > 4900){
            posicion_nueva = 100;
        }
        if(posicion_nueva < 100){
            posicion_nueva = 4900;
        }
        $('#usuario').css('top', posicion_nueva+'px');
    }
});

$(document).keydown(function(e) {
    if (e.which == '40') { //abajo
        detectarpos();
        posy_num_prueba =  Math.ceil(posy_num / 50) * 50;
        posicion_nueva = posy_num_prueba + 50;
        if(posicion_nueva > 4900){
            posicion_nueva = 100;
        }
        if(posicion_nueva < 100){
            posicion_nueva = 4900;
        }
        $('#usuario').css('top', posicion_nueva+'px');
    }
});




//MOVER USUARIO AL PRESIONAR FLECHAS CON EL PC
$('#izquierda').on('mousedown', function(){
    detectarpos();
    movimiento1_pc = setTimeout(function() {
        posx_num_prueba =  Math.ceil(posx_num / 50) * 50;
        posicion_nueva = posx_num_prueba - 50;
        if(posicion_nueva > 4900){
            posicion_nueva = 0;
        }
        if(posicion_nueva < 0){
            posicion_nueva = 4900;
        }
        $('#usuario').css('left', posicion_nueva+'px');
    }, 100);
});
$('#izquierda').on('mouseup', function () {
    clearTimeout(movimiento1_pc); 
});


$('#derecha').mousedown(function(){
    detectarpos();
    movimiento2_pc = setTimeout(function() {
        posx_num_prueba =  Math.ceil(posx_num / 50) * 50;
        posicion_nueva = posx_num_prueba + 50;
        if(posicion_nueva > 4900){
            posicion_nueva = 0;
        }
        if(posicion_nueva < 0){
            posicion_nueva = 4900;
        }
        $('#usuario').css('left', posicion_nueva+'px');
    }, 100);
});
$('#derecha').mouseup(function () {
    clearTimeout(movimiento2_pc); 
});


$('#arriba').mousedown(function(){
    detectarpos();
    movimiento3_pc = setTimeout(function() {
        posy_num_prueba =  Math.ceil(posy_num / 50) * 50;
        posicion_nueva = posy_num_prueba - 50;
        if(posicion_nueva > 4900){
            posicion_nueva = 100;
        }
        if(posicion_nueva < 100){
            posicion_nueva = 4900;
        }
        $('#usuario').css('top', posicion_nueva+'px');
    }, 100);
});
$('#arriba').mouseup(function () {
    clearTimeout(movimiento3_pc); 
});


$('#abajo').mousedown(function(){
    detectarpos();
    movimiento4_pc = setTimeout(function() {
        posy_num_prueba =  Math.ceil(posy_num / 50) * 50;
        posicion_nueva = posy_num_prueba + 50;
        if(posicion_nueva > 4900){
            posicion_nueva = 100;
        }
        if(posicion_nueva < 100){
            posicion_nueva = 4900;
        }
        $('#usuario').css('top', posicion_nueva+'px');
    }, 100);
});
$('#abajo').mouseup(function () {
    clearTimeout(movimiento4_pc); 
});

});


//MOVER USUARIO AL PRESIONAR TECLAS CON EL TELEFONO
window.onload = function() {

    //preload mouse down image here via Image()
    $('#izquierda').on('touchstart', function(){
        detectarpos();
        movimiento1_touch = setInterval(function() {
            posx_num_prueba =  Math.ceil(posx_num / 50) * 50;
            posicion_nueva = posx_num_prueba - 50;
            if(posicion_nueva > 4900){
                posicion_nueva = 0;
            }
            if(posicion_nueva < 0){
                posicion_nueva = 4900;
            }
            $('#usuario').css('left', posicion_nueva+'px');
        }, 100);
        clearInterval(movimiento2_touch); 
        clearInterval(movimiento3_touch); 
        clearInterval(movimiento4_touch); 
    });
    $('#izquierda').on('touchend', function(){
        clearInterval(movimiento1_touch); 
    });

    //preload mouse down image here via Image()
    $('#derecha').on('touchstart', function(){
        detectarpos();
        movimiento2_touch = setInterval(function() {
            posx_num_prueba =  Math.ceil(posx_num / 50) * 50;
            posicion_nueva = posx_num_prueba + 50;
            if(posicion_nueva > 4900){
                posicion_nueva = 0;
            }
            if(posicion_nueva < 0){
                posicion_nueva = 4900;
            }
            $('#usuario').css('left', posicion_nueva+'px');
        }, 100);
        clearInterval(movimiento1_touch); 
        clearInterval(movimiento3_touch); 
        clearInterval(movimiento4_touch); 

    });
    $('#derecha').on('touchend', function(){
        clearInterval(movimiento2_touch); 
    });

    //preload mouse down image here via Image()
    $('#abajo').on('touchstart', function(){
        detectarpos();
        movimiento3_touch = setInterval(function() {
            posy_num_prueba =  Math.ceil(posy_num / 50) * 50;
            posicion_nueva = posy_num_prueba + 50;
            if(posicion_nueva > 4900){
                posicion_nueva = 100;
            }
            if(posicion_nueva < 100){
                posicion_nueva = 4900;
            }
            $('#usuario').css('top', posicion_nueva+'px');
        }, 100); 
        clearInterval(movimiento1_touch); 
        clearInterval(movimiento2_touch); 
        clearInterval(movimiento4_touch);

    });
    $('#abajo').on('touchend', function(){

        clearInterval(movimiento3_touch);  
    });

    //preload mouse down image here via Image()
    $('#arriba').on('touchstart', function(){
        detectarpos();
        movimiento4_touch = setInterval(function() {
            posy_num_prueba =  Math.ceil(posy_num / 50) * 50;
            posicion_nueva = posy_num_prueba - 50;
            if(posicion_nueva > 4900){
                posicion_nueva = 100;
            }
            if(posicion_nueva < 100){
                posicion_nueva = 4900;
            }
            $('#usuario').css('top', posicion_nueva+'px');
        }, 100); 

        clearInterval(movimiento1_touch); 
        clearInterval(movimiento2_touch); 
        clearInterval(movimiento3_touch); 
    });
    $('#arriba').on('touchend', function(){

        clearInterval(movimiento4_touch); 
    });
}
</script>