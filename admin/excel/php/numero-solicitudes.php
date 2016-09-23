<?php
$mysqli = new mysqli("localhost", "root", "p", "sad");
$result = $mysqli->query("SELECT * FROM solicitudes");
echo $result->num_rows;
echo $rows;
$result->close();
$mysqli->close();
?>

