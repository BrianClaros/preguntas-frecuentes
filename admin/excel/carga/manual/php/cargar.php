<?php
$conn = new mysqli("localhost", "hu000202_claros", "Claros2016", "hu000202_bdsadq");
$pregunta=$_POST['pregunta'];
$respuesta=$_POST['respuesta'];

$preguntar= $conn->query("SELECT pregunta FROM preguntas WHERE pregunta='$pregunta'");
$rows = $preguntar->num_rows;
if($rows!=0){
	header("Location: ../../../index.php?print=false");
}else{
$insert= $conn->query("INSERT INTO preguntas VALUES(NULL, '¿$pregunta?', '$respuesta','0','0')");
}


if ($insert == true) {
	header("Location: ../../../index.php?print=true");
}