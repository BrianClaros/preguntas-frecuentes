<?php
$id = $_POST['id'];
$pregunta = $_POST['pregunta'];
$respuesta = $_POST['respuesta'];
$conn = new mysqli("localhost", "hu000202_claros", "Claros2016", "hu000202_bdsadq");
$result = $conn->query("INSERT INTO preguntas VALUES(NULL, '$pregunta', '$respuesta','0','0')");
if ($result) {
	$resulta = $conn->query("DELETE FROM solicitudes WHERE id='$id'");
	if ($resulta) {
		echo "El registro se inserto correctamente.";	
	}
}else{
	echo "Ocurrio un error al intentar cargar el registro.";
}
$conn->close();
?>
