<?php
$mysqli = new mysqli("localhost", "hu000202_ian", "Puchetti2016", "hu000202_bdsadq");
$result = $mysqli->query("SELECT * FROM visitas");
$rows = array();
while($r = mysqli_fetch_assoc($result)) {
    $rows[] = $r;
}
$contador=json_encode($rows);
$contador=json_decode($contador);
echo $contador[0]->numero;
$mysqli->close();
?>
