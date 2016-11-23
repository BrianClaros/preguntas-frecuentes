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
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<title>SAD - Preguntas frecuentes</title>
<link rel="stylesheet" href="../css/bootstrap.min.css"/>
<script type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript" src="../js/bootstrap.min.js"></script>
<script src="../../js/angular.min.js"></script>
<script src="../../js/tildes.js"></script>
<script>


var app = angular.module('filter', []);
app.controller('MainController', function($scope, $http) {

$http.post("php/select.php").then(function(response) {
        $scope.preguntas = response.data;
    });

$scope.applySearch = function() {
    for(prop in $scope.userInput) {
        $scope.search[prop] = $scope.userInput[prop];
    }
};

$scope.search = {};
$scope.search.titulo = "";
$scope.userInput = "";
});



// filterBy implementation
app.filter('filterBy', function() {
    return function(array, query) {
	
        var parts = query && query.trim().split(/\s+/),
            keys = Object.keys(array[0]);
    
        if (!parts || !parts.length) return array;
    
        return array.filter(function(obj) {
            return parts.every(function(part) {
                return keys.some(function(key) {
                    return detilde(String(obj[key])).toLowerCase().indexOf(detilde(part.toLowerCase())) > -1;
                });
            });
        });
    };

});

</script>
<style>

@media (max-width: 769px){
.buscador{
width:98%;
}
}
@media (max-width: 480px){
.buscador{
width:98%;
}
}

#solis{
	border-radius:30px;
	padding-left:3px;
	padding-right:3px;
}
</style>
<script>
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
</script>

</head>
<body>



<div ng-app="filter" ng-controller="MainController">

	<nav class="navbar navbar-inverse" style="border-radius:0px;width:100%;">
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
        <li><a href="../inicio">Inicio</a></li>
        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Carga<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="../carga/masiva">Masiva</a></li>
                <li><a href="../carga/manual">Individual</a></li>
              </ul></li> 
        <li><a href="../solicitudes/">Solicitudes <span id="solis" class="btn-danger"></span></a></li>
        <li class="active"><a href=".">Modificaciones</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li id="logout"><a href="../php/logout.php">Salir</a></li>
      </ul>
    </div>
  </div>
		<div class="input-group buscador" style="margin:5px;max-width:500px;">
    			<input type="text" style="background:rgba(100,100,100,0.8);color:white;" class="form-control"  placeholder="Buscar..." ng-model="userInput.titulo" id="busca" ng-model-onblur>
			<span class="input-group-btn">
				<button id="soli" class="btn btn-secondary" type="button" ng-click="applySearch()" onclick="$('#solicitar').val($('#busca').val())">Buscar</button>
			</span>
		</div>
	</nav>
	



<div class="container">

<div id="accordion" class="panel-group">

<!-- ng-show="search.titulo" -->
<div  class="panel panel-default" ng-repeat="pregunta in preguntas | filterBy:search.titulo | limitTo: 10" style="margin-top:-3px;">


<div class="panel-heading titulo" data-toggle="collapse"  id="{{pregunta.id}}" data-parent="#accordion"  onclick="responder(this)" href="#collapse{{pregunta.id}}" style="cursor:pointer;">
      <div class="panel-title lead" ><span id="pregunta{{pregunta.id}}">
      {{pregunta.pregunta}} </span>
      </div>
    </div>
    <div id="collapse{{pregunta.id}}" class="panel-collapse collapse">
      <div class="panel-body respuestas" id="respuesta{{pregunta.id}}"></div>
      <div style="text-align:center"> 
      <button class="btn btn-warning" id="modificar{{pregunta.id}}" onclick="modificar(this)">Modificar</button> 
      <button class="btn btn-danger" id="eliminar{{pregunta.id}}" onclick="eliminar(this)">Eliminar</button></div><br><br>
  	  </div>
</div>
</div>
</div>
</div>
</div>



<script>
function responder(elemento){
$('.respuestas').html('');
$('#respuesta'+id).html('Cargando respuesta...');
var id = $(elemento).attr('id');
var datos = { id: id };
$.ajax({
	url:'php/respuesta.php',
	data: datos,
	type:'post',
	success: function (res){res=JSON.parse(res);
				$('#respuesta'+id).html(res[0].respuesta);
				},
	complete: function (res){res=JSON.parse(res);
				$('#respuesta'+id).html('Cargando respuesta...');
				}

});
}


$('#soli').click(function (){
$("#nohay").css('display','block');
});

$('input[type=text]').on('keydown', function(e) {
    if (e.which == 13) {
	$('#soli').click();
	$('input[type=text]').focus();
    }
});

$.ajax({
	url:'php/recientes.php',
	type:'post',
	success: function (res){
	res=JSON.parse(res);
	for(var i=0;i<res.length;i++){
	$(".panel-body").append('<p><a style="color:black;cursor:pointer;" id="reciente'+res[i].id+'" onclick="visitareciente(this)">'+res[i].pregunta+'</a></p>');
}
}
});


function modificar(elemento){
			var id_elemento= $(elemento).attr('id');
			var id_pregunta= id_elemento.replace("modificar","");
			abrirVentana('modificar/?id='+id_pregunta);
}

function eliminar(elemento){
			var id_elemento= $(elemento).attr('id');
			var id_pregunta= id_elemento.replace("eliminar","");
			$.ajax({
						url:'php/eliminar.php',
						type:'post',
						data: {id: id_pregunta},
						success: function (res){alert(res);location.reload();}
			});
}
var child, timer;
function checkChild() {
    if (child.closed) {
        location.reload();  
        clearInterval(timer);
    }
}

function abrirVentana(url) {
   child = window.open(url, "modificar", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=600, height=400");
    timer = setInterval(checkChild, 500);
}
</script>
</body>
</html>
