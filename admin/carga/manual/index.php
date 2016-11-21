<?php
session_start();
if(isset($_SESSION['user'])){
}
else{
header("Location: ../index.php");
}
?>


<html lang="es">
<head>
    <meta charset="utf-8">
    <title>SAD - Subir preguntas</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="../../../js/jquery.min.js" type="text/javascript"></script>
    <script src="../../../js/bootstrap.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="../../../css/bootstrap.min.css"/>
	    <style>
#solis{
	border-radius:30px;
	padding-left:3px;
	padding-right:3px;
}
	</style>

  <script type="text/javascript">
    $.ajax({
  url:'../../php/numero-solicitudes.php',
  type:'post',
  success:function (res){
  $("#solis").html(res);
  }
  
});

  </script>
</head>

<body>
<nav class="navbar navbar-inverse navbar-static-top">
  <div class="container-fluid">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
      </button>
      <a class="navbar-brand" href="#">Administración</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li ><a href="../../inicio">Inicio</a></li>
        <li class="dropdown active"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" >Carga<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="../masiva">Masiva</a></li>
                <li class="active"><a href="#" >Individual</a></li>
              </ul></li> 
        <li><a href="../../solicitudes/index.php">Solicitudes <span id="solis" class="btn-danger"></span></a></li>
        <li><a href="../../modificaciones">Modificaciones</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li id="logout"><a href="../../php/logout.php">Salir</a></li>
      </ul>
    </div>
  </div>
</nav>
<div class="container">
<div class="jumbotron">
<center><label><h3>Ingresar pregunta</h3></label></center>
  <form action="php/cargar.php" method="POST" id="form">
  <div class="form-group">
    <label for="pregunta">Pregunta    (Sin signos de interrogación)</label>
    <input class="form-control" type="text"  name="pregunta" id="pregunta">
  </div>
  <div class="form-group">
    <label for="respuesta">Respuesta</label>
    <textarea class="form-control" rows="4" cols="50" name="respuesta" id="respuesta"></textarea>
  </div>
  <button type="submit" class="btn btn-danger">Enviar</button>
  </form>
</div>
</div>
<script type="text/javascript">
  $("#form").submit(function () {  
    if($("#pregunta").val().length < 1 || $("#respuesta").val().length < 1 ) {  
        alert("Escriba una pregunta con su respectiva respuesta"); 
        return false; 
    } else {
        if($("#pregunta").val().length < 10 || $("#respuesta").val().length < 10 ){
          alert("Desarrolle mejor su pregunta o respuesta");
          return false;
        }else{
        return true;
        }
    }
  });
</script>
</body>
</html>
