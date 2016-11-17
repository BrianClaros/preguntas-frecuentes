<?php
$id= $_POST[id];
$conn = new mysqli("localhost", "hu000202_claros", "Claros2016", "hu000202_bdsadq");
$result = $conn->query("SELECT pregunta, respuesta FROM preguntas WHERE id = $id LIMIT 1");
$rows = array();
while($r = $result->fetch_array()) {
    $rows[] = $r;
}
$rows=json_encode($rows);
echo $rows;
$conn->close();
?>
