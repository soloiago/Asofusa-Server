<?php
include('config.php');

$msg = $_POST['msg'];

//Enviar a todos los usuarios de GCM
$query = "SELECT REGID FROM ASOFUSA_ALERT WHERE ALERT='GENERAL'";
$result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());

while($row = mysql_fetch_array($result)){ 

	$msg = utf8_encode($msg);
	$message = array("general" => $msg);

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

mysql_free_result($result);
mysql_close($link);
?>
