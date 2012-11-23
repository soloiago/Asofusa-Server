<?php
include('config.php'); 

$EMAIL = $_POST['EMAIL'];

$query = "SELECT NAME FROM ASOFUSA_USER WHERE EMAIL='$EMAIL'";
$result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());

if(mysql_num_rows($result) == "0") {
	echo "-";
} else {
	$row = mysql_fetch_row($result);
	echo $row[0];
}

mysql_close($link);
?>
