<?php
include('config.php');

$OLDNICK = $_POST['OLDNICK']; 
$NICK = $_POST['NICK'];
$EMAIL = $_POST['EMAIL'];
$NAME = $_POST['NAME'];

$query = "SELECT * FROM ASOFUSA_USER WHERE NICK='$OLDNICK'";
$numberOfRows = mysql_num_rows($resultado);

if ($numberOfRows == 0) {
	$EMAIL = $EMAIL."-m";
	$query = "INSERT INTO ASOFUSA_USER (NICK, EMAIL, NAME) VALUES ('$NICK','$EMAIL','$NAME')";
} else {
	$query = "UPDATE ASOFUSA_USER SET NICK='$NICK', EMAIL='$EMAIL', NAME='$NAME', DATE=NOW( ) WHERE  NICK='$OLDNICK'";
}

$result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());

mysql_free_result($result);
mysql_close($link);

?>
