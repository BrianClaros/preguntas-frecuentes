<?php
$mysqli = new mysqli("localhost", "root", "SM483E", "ian");
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
