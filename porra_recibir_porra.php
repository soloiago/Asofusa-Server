<?php
include('config.php'); 

$USER = $_POST['USER'];
$RESULTADO = $_POST['RESULTADO'];
$PARTIDO_ID = $_POST['PARTIDO_ID'];
$COMPETICION = $_POST['COMPETICION'];

$query = "INSERT INTO ASOFUSA_PORRA_USER (USER, RESULTADO, PARTIDO_ID, COMPETICION) VALUES ('$USER','$RESULTADO','$PARTIDO_ID', '$COMPETICION')";
$result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());

mysql_close($link);
?>
