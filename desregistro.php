<?php
include('config.php');

$regId = $_POST['regId'];

$query = "DELETE from ASOFUSA_ALERT WHERE REGID='$regId'";
$result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());

?>
