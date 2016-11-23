<?php
$mysqli = new mysqli("localhost", "hu000202_claros", "Claros2016", "hu000202_bdsadq");
$sheet1=json_decode($_POST['sheet1']);
$largo=count($sheet1);
$i=0;
while($i<$largo){
$pregunta=addslashes($sheet1[$i]->pregunta);
$respuesta=addslashes($sheet1[$i]->respuesta);
if($result = $mysqli->query("SELECT * FROM preguntas WHERE pregunta='$pregunta' AND respuesta='$respuesta'")) {
$rows = $result->num_rows;
if($rows!=0){
}else{
$consulta= $mysqli->query("INSERT INTO preguntas VALUES(NULL, '$pregunta', '$respuesta', '0', '0')");
}
$result->close();
}
$i++;
}
$mysqli->close();
?>

