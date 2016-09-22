<?php
$mysqli = new mysqli("localhost", "root", "SM483E", "ian");
$result = $mysqli->query("SELECT * FROM inscripciones");
$rows = array();
while($r = mysqli_fetch_assoc($result)) {
    $rows[] = $r;
}
echo json_encode($rows);
$mysqli->close();
?>
