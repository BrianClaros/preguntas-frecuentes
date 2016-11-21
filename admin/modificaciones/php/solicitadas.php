<?php
$conn = new mysqli("localhost", "hu000202_claros", "Claros2016", "hu000202_bdsadq");
$result = $conn->query("SELECT * FROM solicitudes");
$rows = array();
while($r = $result->fetch_array()) {
    $rows[] = $r;
}
$rows=json_encode($rows);
echo $rows;
$conn->close();
?>
