<?php
$mysqli = new mysqli("localhost", "hu000202_ian", "Puchetti2016", "hu000202_bdsadq");
$result = $mysqli->query("SELECT * FROM inscripciones");
$rows = array();
while($r = mysqli_fetch_assoc($result)) {
    $rows[] = $r;
}
echo json_encode($rows);
$mysqli->close();
?>
