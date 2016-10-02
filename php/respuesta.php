<?php
$id = $_POST['id'];
$conn = new mysqli("localhost", "hu000202_ian", "Puchetti2016", "hu000202_bdsadq");

$consulta = $conn->query("SELECT visitas FROM preguntas WHERE id='$id'");
$visitas=0;
while($r = $consulta->fetch_array()){
$visitas= $r[0]+1;
}
$consulta = $conn->query("UPDATE preguntas SET visitas='$visitas' WHERE id='$id'");


$result = $conn->query("SELECT respuesta FROM preguntas WHERE id='$id'");
$rows = array();
while($r = $result->fetch_array()){
    $rows[] = $r;
}
$rows=json_encode($rows);
echo $rows;
$conn->close();
?>
