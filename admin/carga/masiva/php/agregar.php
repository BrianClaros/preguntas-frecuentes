<?php
$exito=0;
$mysqli = new mysqli("localhost", "hu000202_claros", "Claros2016", "hu000202_bdsadq");
$sheet1=json_decode($_POST['sheet1']);
$largo=count($sheet1);
$i=0;
while($i<$largo){
$pregunta=$sheet1[$i]->pregunta;
$respuesta=$sheet1[$i]->respuesta;
if($result = $mysqli->query("SELECT * FROM preguntas WHERE pregunta='$pregunta' AND respuesta='$respuesta'")) {
$rows = $result->num_rows;
if($rows!=0){
}else{
if($consulta=$mysqli->query("INSERT INTO preguntas VALUES(NULL, '$pregunta', '$respuesta', '0', '0')")){
$exito++;
}
}
$result->close();
}
$i++;
}
echo 'Se han cargado '.$exito.' preguntas';
$mysqli->close();
?>

