<?php
$mysqli = new mysqli("localhost", "root", "p", "sad");
$pregunta=$_POST['solicitud'];
$correo=$_POST['correo'];
if($result = $mysqli->query("SELECT * FROM solicitudes WHERE pregunta='$pregunta' ")) {
$rows = $result->num_rows;
if($rows!=0){
}else{
$consulta= $mysqli->query("INSERT INTO solicitudes VALUES(NULL, '$pregunta', '$correo')");
echo "Gracias por agrandar nuestro sistema de busquedas.";
}
$result->close();
}
$mysqli->close();
?>

