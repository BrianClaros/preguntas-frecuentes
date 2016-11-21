<?php
$id = $_POST['id'];
$conn = new mysqli("localhost", "hu000202_claros", "Claros2016", "hu000202_bdsadq");
$result = $conn->query("DELETE FROM preguntas WHERE id='$id' LIMIT 1");
if ($result) {
	echo "Se elimino correctamente.";
}else{
	echo "Ocurrio un error al intentar eliminar el registro.";
}
$conn->close();
?>
