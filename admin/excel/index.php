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
    <script src="js/xlsx.js" type="text/javascript"></script>
    <script src="js/jquery.js" type="text/javascript"></script>
    <script src="../js/bootstrap.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="../css/bootstrap.min.css"/>
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
        <li class="active"><a href=".">Inicio</a></li>
        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Carga<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="../carga/masiva">Masiva</a></li>
                <li><a href="../carga/manual">Individual</a></li>
              </ul></li> 
        <li><a href="#">Solicitudes</a></li>
        <li><a href="#">Modificaciones</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li id="logout"><a href="../php/logout.php">Salir</a></li>
      </ul>
    </div>
  </div>
</nav>
<div class="jumbotron" style="margin-top:-20px;">
      <div class="container">
        <h1>Subir preguntas</h1>
        <p>Este es un sistema automatizado para subir las preguntas frecuentes mediante un archivo excel.</p>
        <p>Dicho archivo deberá estar distribuído en dos columnas: pregunta y respuesta. Por lo que cada fila deberá contener la pregunta con su respuesta. Por ejemplo:</p>
<table class="table table-hover table-bordered" style="background:white">
	<thead>
	<th>pregunta</th>
	<th>respuesta</th>
	</thead>
	<tbody>
	<tr>
	<td>Cómo inscribirse a ...</td>
	<td>Para inscribirse visite ...</td>
	<tr>
	<tr>
	<td>Cómo saber si ...</td>
	<td>Para saber si ...</td>
	<tr>
	<tr>
	<td>Cómo renunciar a ...</td>
	<td>Para renunciar a ...</td>
	<tr>
	</tbody>
	</table>
	
<p><a href="#" onclick="$('#archivo').click()" id="boton" class="btn btn-primary btn-lg" role="button">Subir excel</a></p>
<input type="file" id="archivo" style="display:none;">
      </div>
    </div>
<div id="mostrar"></div>
<div class="cargando" style="top:0px;left:0px;width:100%;height:100%;position:fixed;background:rgba(100,100,100,0.8);"></div>
<img src="img/spinner.gif" class="cargando" style="top:0px;left:0px;width:100%;height:100%;position:fixed;opacity:0.3;">
</body>
<script>
$(".cargando").hide();
function to_json(workbook) {
	var result = {};
	workbook.SheetNames.forEach(function(sheetName) {
		var roa = XLSX.utils.sheet_to_row_object_array(workbook.Sheets[sheetName]);
		if(roa.length > 0){
			result[sheetName] = roa;
		}
	});
	return result;
}
var exporte, mostrar;
function handleFile(e) {
  var files = e.target.files;
  var i,f;
  for (i = 0, f = files[i]; i != files.length; ++i) {
    var reader = new FileReader();
    var name = f.name;
    reader.onload = function(e) {
            $(".cargando").show();
      var data = e.target.result;
      var workbook = XLSX.read(data, {type: 'binary'});
      exporte= to_json(workbook);
      mostrar={'sheet1' : JSON.stringify(exporte.Sheet1)};
      //document.getElementById("mostrar").innerHTML= mostrar.sheet1;
      $.ajax({
        data:mostrar,
        type:'post',
        url:'php/agregar.php',
        success:function(res){
          alert('Preguntas cargadas correctamente.');
          $(".cargando").hide();
        }
      });
    };
    reader.readAsBinaryString(f);
  }
  $("#archivo").val("");
}
document.getElementById('archivo').addEventListener('change', handleFile, false);
</script>
</html>
