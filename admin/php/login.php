<?php
if($_REQUEST['user'] == 'admin' && $_REQUEST['pass']=='admin'){
session_start();
$_SESSION['user']=$_REQUEST['user'];
$_SESSION['pass']=$_REQUEST['pass'];
header("Location: ../inicio/");
}else{
header("Location: ../index.php");
}
?>
