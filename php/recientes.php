<?php
$conn = new mysqli("localhost", "hu000202_ian", "Puchetti2016", "hu000202_bdsadq");
$result = $conn->query("SELECT * FROM preguntas ORDER BY visitas DESC LIMIT 5");
$rows = array();
while($r = $result->fetch_array()) {
    $rows[] = $r;
}
$rows=json_encode($rows);
echo $rows;
$conn->close();
?>
