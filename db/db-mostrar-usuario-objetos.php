<div id="izquierda" class="boton-control" style="background:url(/juego/img/iconos/izquierda.png);"></div>
<div id="arriba" class="boton-control" style="background:url(/juego/img/iconos/arriba.png);"></div>
<div id="abajo" class="boton-control" style="background:url(/juego/img/iconos/abajo.png);"></div>
<div id="derecha" class="boton-control" style="background:url(/juego/img/iconos/derecha.png);"></div>


<div class="usuario-objetos">
    <form id="dejar-objeto" method="post">
        <input type="hidden" name="usuario"value="<?php echo $_COOKIE["usuario"];?>">
        <input type="hidden" name="texto" value="+bomba">
        <input type="hidden" name="valor" value="0">
        <input type="hidden" name="crear" value="1">
        <input type="hidden" name="pos_x" class="posx_notita" value="2450">
        <input type="hidden" name="pos_y" class="posy_notita" value="2450">
        <span class="boton boton-dejar-objeto" style="background: url(/juego/img/objetos/+bomba.gif);"></span>
    </form>

    <form id="dejar-objeto" method="post">
        <input type="hidden" name="usuario"value="<?php echo $_COOKIE["usuario"];?>">
        <input type="hidden" name="texto" value="+veneno">
        <input type="hidden" name="valor" value="0">
        <input type="hidden" name="crear" value="1">
        <input type="hidden" name="pos_x" class="posx_notita" value="2450">
        <input type="hidden" name="pos_y" class="posy_notita" value="2450">
        <span class="boton boton-dejar-objeto" style="background: url(/juego/img/objetos/+veneno.gif);"></span>
    </form>

    <form id="dejar-objeto" method="post">
        <input type="hidden" name="usuario"value="<?php echo $_COOKIE["usuario"];?>">
        <input type="hidden" name="texto" value="+weed">
        <input type="hidden" name="valor" value="-1">
        <input type="hidden" name="crear" value="1">
        <input type="hidden" name="pos_x" class="posx_notita" value="2450">
        <input type="hidden" name="pos_y" class="posy_notita" value="2450">
        <span class="boton boton-dejar-objeto" style="background: url(/juego/img/objetos/+weed.gif);"></span>
    </form>

    <form id="dejar-objeto" method="post">
        <input type="hidden" name="usuario"value="<?php echo $_COOKIE["usuario"];?>">
        <input type="hidden" name="texto" value="+vinito">
        <input type="hidden" name="valor" value="-1">
        <input type="hidden" name="crear" value="1">
        <input type="hidden" name="pos_x" class="posx_notita" value="2450">
        <input type="hidden" name="pos_y" class="posy_notita" value="2450">
        <span class="boton boton-dejar-objeto" style="background: url(/juego/img/objetos/+vinito.gif);"></span>
    </form>

    <form id="dejar-objeto" method="post">
        <input type="hidden" name="usuario"value="<?php echo $_COOKIE["usuario"];?>">
        <input type="hidden" name="texto" value="+cocaine">
        <input type="hidden" name="valor" value="-1">
        <input type="hidden" name="crear" value="1">
        <input type="hidden" class="posx_notita" name="pos_x" value="2450">
        <input type="hidden" class="posy_notita" name="pos_y" value="2450">
        <span class="boton boton-dejar-objeto" style="background: url(/juego/img/objetos/+cocaine.gif);"></span>
    </form>

    <form id="dejar-objeto" method="post">
        <input type="hidden" name="usuario"value="<?php echo $_COOKIE["usuario"];?>">
        <input type="hidden" name="texto" value="+tussy">
        <input type="hidden" name="valor" value="-1">
        <input type="hidden" name="crear" value="1">
        <input type="hidden" name="pos_x" class="posx_notita" value="2450">
        <input type="hidden" name="pos_y" class="posy_notita" value="2450">
        <span class="boton boton-dejar-objeto" style="background: url(/juego/img/objetos/+tussy.gif);"></span>
    </form>

    <form id="dejar-notita" method="post">
        <input type="hidden" name="usuario"value="<?php echo $_COOKIE["usuario"];?>">
        <input class="input-texto-nota" name="texto" placeholder="Escribe..." value="" autocomplete="off">
        <input type="hidden" name="valor" value="+1">
        <input type="hidden" name="crear" value="1">
        <input type="hidden" name="pos_x" class="posx_notita" value="2450">
        <input type="hidden" name="pos_y" class="posy_notita" value="2450">
        <span class="boton boton-dejar-notita">Enviar</span>
    </form>
</div>

<form id="movimiento-usuario" method="post" style="display:none;">
    <input type="hidden" name="usuario"value="<?php echo $_COOKIE["usuario"];?>">
    <input type="hidden" name="crear" value="1">
    <input type="hidden" name="pos_x"class="posx_usuario" value="2450">
    <input type="hidden" name="pos_y"class="posy_usuario"  value="2450">
</form>

<form id="mostrar-notitas" method="post" style="display:none;">
    <input type="hidden" name="crear" value="1">
    <input type="hidden" name="pos_x"class="posx_usuario" value="2450">
    <input type="hidden" name="pos_y"class="posy_usuario"  value="2450">
</form>

<form id="form-borrar-notitas" method="post">
    <input type="hidden" name="id_notita" id="id_notita_borrar" value="">
</form>