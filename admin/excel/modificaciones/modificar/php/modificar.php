<?php
$mysqli= new mysqli("localhost", "hu000202_claros", "Claros2016", "hu000202_bdsadq");
$mysqli->set_charset("utf8");
$id=$_POST["id"];
$pregunta=$_POST["pregunta"];
$respuesta=$_POST["respuesta"];
$result = $mysqli->query("UPDATE preguntas SET pregunta='$pregunta', respuesta='$respuesta' WHERE id='$id' LIMIT 1"));
echo "Modificado.";
$result->close();
$mysqli->close();
?>

