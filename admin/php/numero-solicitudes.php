<?php
$mysqli = new mysqli("localhost", "hu000202_ian", "Puchetti2016", "hu000202_bdsadq");
$result = $mysqli->query("SELECT * FROM solicitudes");
echo $result->num_rows;
echo $rows;
$result->close();
$mysqli->close();
?>

