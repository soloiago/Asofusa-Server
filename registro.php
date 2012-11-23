<?php
include('config.php');

$regId = $_POST['regId'];
$numA = $_POST['numA'];

for ($i = 0; $i < $numA; $i++) {
	$A = 'A'.$i;
	$A = $_POST[$A];
	$query = "INSERT into ASOFUSA_ALERT (REGID, ALERT) VALUES ('$regId', '$A')";
	$result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());
}

?>
