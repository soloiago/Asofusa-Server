<?php
include('config.php');

$NICKNAME = $_POST['NICKNAME'];
$EMAIL = $_POST['EMAIL'];
$COMMENT = $_POST['COMMENT'];
$COMPETITION = $_POST['COMPETITION'];

//Corregir fallo (en la antigua versión se insertaba un espacio al principio, no sé por qué)
if ($COMPETITION[0] == " ")
   $COMPETITION = substr($COMPETITION, 1);

if($COMMENT !== '' && !isEmailBlocked($EMAIL)) {
	$query = "INSERT INTO ASOFUSA (NICKNAME, EMAIL, COMMENT, COMPETITION) VALUES ('$NICKNAME','$EMAIL','$COMMENT','$COMPETITION')";

	$result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());


	//Enviar a todos los usuarios de GCM
	$query = "SELECT REGID FROM ASOFUSA_ALERT WHERE ALERT='$COMPETITION'";
	$result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());

	while($row = mysql_fetch_array($result)){ 

		$COMPETITION = utf8_encode($COMPETITION);
		$message = array("msg" => $COMPETITION);

		$registatoin_ids = array($row[0]);

		$headers = array("Content-Type:" . "application/json", "Authorization:" . "key=" . "AIzaSyBDs4gDrwNxWUFMCkNctM4nWjZsLKhXyT4");

		$fields = array(
			    'registration_ids' => $registatoin_ids,
			    'data' => $message,
			);
	
		$data = json_encode($fields);

		print($data);

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); 
		curl_setopt($ch, CURLOPT_URL, "https://android.googleapis.com/gcm/send");
		curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

		$response = curl_exec($ch);
		curl_close($ch);
		error_log($response);

		print($response);
	} 

	$result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());
} else {
	echo "Comment null or email blocked";
}

mysql_close($link);


function isEmailBlocked($email) {
$query = "SELECT * FROM ASOFUSA_FORO_VETO WHERE EMAIL='$email'";
	$result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());
	
	echo mysql_num_rows($result);	

	if (mysql_num_rows($result) == "0") {
		return false;
	} else  {
		return true;
	}
}
?>
