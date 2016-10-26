<?php
$id = $_POST['id'];
$pregunta=$_POST['pregunta'];
$conn = new mysqli("localhost", "hu000202_claros", "Claros2016", "hu000202_bdsadq");
$result = $conn->query("UPDATE solicitudes SET pregunta='$pregunta' WHERE id='$id'");


$conn->close();
?>
