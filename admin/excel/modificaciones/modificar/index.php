<?php
session_start();
if(isset($_SESSION['user'])){
if($_SESSION['puesto']=='adm'){
header("Location: ../admin/");
}
}
else{
header("Location: ../");
}
?>
<html lang="es">
  <head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" href="../../../icon.png">
	<title>Nucleo</title>
	<link rel="stylesheet" href="../../../css/bootstrap.min.css"/>
	<link href="../../../css/signin.css" rel="stylesheet"/>
	<script type="text/javascript" src="../../../js/jquery.min.js"></script>
	<script type="text/javascript" src="../../../js/bootstrap.js"></script>
<style>
.navbar-static-top{
margin-top:-40px;
}
</style>
<script>
var $_GET = {};

document.location.search.replace(/\??(?:([^=]+)=([^&]*)&?)/g, function () {
    function decode(s) {
        return decodeURIComponent(s.split("+").join(" "));
    }

    $_GET[decode(arguments[1])] = decode(arguments[2]);
});
</script>

  </head>

  <body>
  
    <div class="container">
  		<div class="lead">Pregunta</div>
		<textarea type="text" id="pregunta" class="form-control"></textarea><br>
		<div class="lead">Respuesta</div>
		<textarea type="text" id="respuesta" class="form-control"></textarea><br>
  		<div style="text-align:center;"><button class="btn btn-warning" id="modificar">Modificar</btn></div>
  		
    </div>
  </body>
<script>
$("#pregunta").val($_GET["pregunta"]);
$("#respuesta").val($_GET["respuesta"]);

$("#modificar").click(function (){
	
	var datos= {
				id:$_GET["id"],
				pregunta:$("#pregunta").val(),
				respuesta:$("#respuesta").val()
	};
	$.ajax({
		url:'php/modificar.php',
		type:'post',
		data: datos,
		success: function (res){
		alert(res);
		window.location.href = '.';
		}
	});
	
	
});
</script>
</html>
