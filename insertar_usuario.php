<?php
include('config.php'); 

$EMAIL = $_POST['EMAIL'];
$NAME = $_POST['NAME'];

$query = "SELECT NAME, EMAIL FROM ASOFUSA_USER WHERE EMAIL='$EMAIL'";
$result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());

if (mysql_num_rows($result) == "0") {
	if(userExists($NAME)) {
		echo "Consulta fallida: Duplicate entry";
	} else {
		$query = "INSERT INTO ASOFUSA_USER (EMAIL, NAME) VALUES ('$EMAIL','$NAME')";
		$result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());
	}
} else {
	//Ya hay un usuario con ese EMAIL
	$row = mysql_fetch_row($result);
	if($row[0] != $NAME) {
		if(userExists($NAME)) {
			echo "Consulta fallida: Duplicate entry";
		} else {
			//Recuperamos el Name antiguo para actualizar las porras hechas
			$query = "SELECT NAME FROM ASOFUSA_USER WHERE EMAIL='$EMAIL'";
			$result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());
			$row = mysql_fetch_row($result);
			$oldName = $row[0];

			$query = "UPDATE ASOFUSA_USER SET NAME='$NAME' WHERE EMAIL='$EMAIL'";
			$result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());

			$query = "UPDATE ASOFUSA_PORRA_USER SET USER='$NAME' WHERE USER='$oldName'";
			$result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());
		}
	}
}

function userExists($name) {
	$query = "SELECT * FROM ASOFUSA_USER WHERE NAME='$name'";
	$result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());

	echo mysql_num_rows($result);	

	if (mysql_num_rows($result) == "0") {
		return false;
	} else  {
		return true;
	}
}

?>
