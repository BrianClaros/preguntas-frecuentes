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
    <script src="../js/jquery.min.js" type="text/javascript"></script>
    <script src="../js/bootstrap.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="../../css/bootstrap.min.css"/>
	    <style>
      * {
        word-wrap: break-word;
      }
    hr {
    display: block;
    margin-top: 0em;
    margin-bottom: 0em;
    margin-left: auto;
    margin-right: auto;
    border-style: inset;
    border-width: 1px;
}
#solis{
	border-radius:30px;
	padding-left:3px;
	padding-right:3px;
}
	</style>

  <script type="text/javascript">

function numsol(){
  $.ajax({
  url:'../php/numero-solicitudes.php',
  type:'post',
  success:function (res){
  $("#solis").html(res);
  }
  
  });
}
numsol();
function eliminar(id){
  var datos = { 'id': id };
  $.ajax({
    url:'php/eliminar.php',
    data: datos,
    type:'post',
    success: function (res){
    
    }
  });
  numsol();
  obtener();
}
function despeditar(id){
  var pregunta=$('#preguntas'+id).html();
  $('#editar'+id).attr('disabled',true);
  $('#responder'+id).attr('disabled',true);
$('#preguntas'+id).html("<div class='input-group'><input type='text' class='form-control' id='preguntamodif' value='"+pregunta+"'><span class='input-group-btn'><button class='btn btn-danger' onclick=editar("+id+")>Ok</button></span></div>");
}

function editar(id){
  var pregun=$('#preguntamodif').val();
  var datos = { 'id': id , 'pregunta': pregun };
  $.ajax({
    url:'php/editar.php',
    data: datos,
    type:'post',
    success: function (res){
        numsol();
        obtener();
    }
  });
}

function despresponder(id){
  $('#responder'+id).attr('disabled',true);
  $('#editar'+id).attr('disabled',true);
$('#row'+id).append("</br></br><div id=\"responder"+id+"\" class='col-md-9 col-xs-7 h5'><div class='input-group'><textarea rows='4' cols='50' type='text' class='form-control' id='respuesta'></textarea><span class='input-group-btn'><button class='btn btn-danger' onclick=responder("+id+")>Ok</button></span></div></div>");
}


function responder(id){

  if($('#respuesta').val().length > 10){
    var datos = {'id':id,'pregunta' : $('#preguntas'+id).html() , 'respuesta' : $('#respuesta').val() };
    $.ajax({
      url:'php/responder.php',
      data: datos,
      type:'post',
      success: function (res){
          alert(res);
          eliminar(id);
          obtener();
      }
    });
  }else{
    alert('Desarrolle mejor su respuesta');
    obtener();
  }
}




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
        <li  class="active"><a href="../inicio">Inicio</a></li>
        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Carga<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="../carga/masiva/">Masiva</a></li>
                <li><a href="../carga/manual/">Individual</a></li>
              </ul></li> 
        <li><a href="../solicitudes" >Solicitudes<span id="solis" class="btn-danger"></span></a></li>
        <li><a href="../modificaciones">Modificaciones</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li id="logout"><a href="../php/logout.php">Salir</a></li>
      </ul>
    </div>
  </div>
</nav>
<div class="container">
  <div style="background:#ddd;padding:30px;">
	<h2>Bienvenido a la administración de Preguntas Frecuentes </h2>
	</div>
	  <div style="background:#eee;padding:15px;">
	<h2 class="lead">En el menu superior escoja la opción que desea realizar.</h2>
	  </div>



</div>

<script type="text/javascript">

function obtener(){
    var preguntas="";
    $.ajax({
      url:'php/solicitadas.php',
      type:'GET',
      success: function (res){
      res=JSON.parse(res);
        
        $.each(res, function(i, field){
          preguntas+="<div id='row"+field.id+"' class='row'>";
          preguntas+="<div id='preguntas"+field.id+"' class='col-md-9 col-xs-7 h5' >";
          preguntas+=field.pregunta;
          preguntas+="</div>";
          preguntas+="<div id='acciones"+field.id+"' class='col-md-3 col-xs-5'>";
          preguntas+="<button class='btn btn-info' onclick='eliminar("+field.id+")'>Eliminar</button>";
          preguntas+="<button id=\"editar"+field.id+"\" class=\"btn btn-info\" onclick=\"despeditar("+field.id+")\">Editar</button>";
          preguntas+="<button id='responder"+field.id+"' class='btn btn-info' onclick='despresponder("+field.id+")'>Responder</button>";   
          preguntas+="</div>";
          preguntas+="</div>";
          preguntas+="<hr>";
        });
        
        $("#div").html(preguntas);
      }
    });
}
obtener();
</script>
</body>
</html>

    
    </div>
    <div id="acciones" class="col-md-3">
    </div>
