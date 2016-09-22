<?php
$conn = new mysqli("localhost", "root", "p", "sad");
$result = $conn->query("SELECT id, pregunta FROM preguntas");
$rows = array();
while($r = $result->fetch_array()) {
    $rows[] = $r;
}
$rows=json_encode($rows);
echo $rows;
$conn->close();
?>
