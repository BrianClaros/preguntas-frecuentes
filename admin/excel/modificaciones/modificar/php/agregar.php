<?php
$mysqli= new mysqli("localhost", "hu000202_claros", "Claros2016", "hu000202_bdsadq");
$id=$_POST['id'];
$pregunta=$_POST['pregunta'];
$respuesta=$_POST['respuesta'];
if($result = $mysqli->query("SELECT * FROM solicitudes WHERE pregunta='$pregunta' ")) {
echo "Gracias por agrandar nuestro sistema de busquedas.";
}else{
echo "Hubo un error."
}
$result->close();
}
$mysqli->close();
?>

