<?php include $_SERVER['DOCUMENT_ROOT']."/juego/conexion.php";?>

<style>
.notitas-recientes {
    top: 10%!important;
    position: absolute;
    right: 1%;
    background-color: transparent;
    width: 20%;
    height: 30%;
    z-index: 999999999;
    overflow: scroll;
    overflow-x: hidden;
}
.notitas-recientes span {
	display: block;
	width: 80%;
	padding:  10px 10%;
	background-color: #ffffffa1;
	margin-bottom: 5px;
	border-radius: 10px;
	font-weight: bold;
	text-overflow: clip;
	overflow: hidden;
	font-size: 12px;
	word-break: break-word;
}

.notitas-recientes::-webkit-scrollbar-track {
   background-color: #ffffff00;
   box-shadow: inset 2px 0px 5px #dedede8f;
   cursor: grab!important;
   border-radius: 10px;
}
.notitas-recientes::-webkit-scrollbar {
    width: 8px;
    background-color: #ffffff00;
    border-radius: 10px;
}
.notitas-recientes::-webkit-scrollbar-thumb {
   background-color: #8916c9;
   border-radius: 14px;
   cursor: grab!important;
}
</style>

<?php
$sql = mysql_query("SELECT * from notitas order by id desc limit 10");
while($registro = mysql_fetch_array($sql)){
	if(strpos($registro['texto'], '+')!== false){


	}else{
		if($registro['ropa'] == 0){$color = 'brown';}
		if($registro['ropa'] == 1){$color = 'yellow';}
		if($registro['ropa'] == 2){$color = 'green';}
		if($registro['ropa'] == 3){$color = 'cyan';}
		if($registro['ropa'] == 4){$color = 'blue';}
		if($registro['ropa'] == 5){$color = 'red';}
		if($registro['ropa'] == 6){$color = '#d313a3';}
		if($registro['ropa'] == 7){$color = 'purple';}
		if($registro['ropa'] == 8){$color = 'orange';}
		if($registro['ropa'] == 9){$color = 'black';}

		echo '<span title="'.$registro['codigo'].'" style="color:'.$color.'!important;">'.$registro['texto'].'</span>';
	}

}
?>
