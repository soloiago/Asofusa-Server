<?php
include('config.php'); 

$fechaHoy =date('Y-m-d', strtotime('now'));
$fechaFin =date('Y-m-d', strtotime('now +6 day'));


$USER = $_GET['USER'];
$COMPETICION = $_GET['COMPETICION'];

$query = "SELECT PARTIDO, id, FECHA FROM ASOFUSA_PORRA_PARTIDOS WHERE ACTIVO=1 AND RESULTADO='-' AND COMPETICION='$COMPETICION' AND FECHA>'$fechaHoy' AND FECHA<'$fechaFin'";
$result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());


//Devolvemos partidos activos sin porra hecha & partidos activos con porra hecha pero sin resultado fijo (RESULTADO=='-')
echo '<?xml version="1.0"?>';
echo '<partidos>';
while ($line = mysql_fetch_array($result, MYSQL_NUM)) {
	$query2 = "SELECT RESULTADO FROM ASOFUSA_PORRA_USER WHERE USER='$USER' AND PARTIDO_ID=$line[1]";
	$result2 = mysql_query($query2) or die('Consulta fallida: ' . mysql_error());

	if (mysql_num_rows($result2) != 0) {
		$row = mysql_fetch_row($result2);
		echo '<item>';
		echo "<id>$line[1]</id>";
		echo "<partido>$line[0]</partido>";
		echo "<fecha>$line[2]</fecha>";
		echo "<votado>1</votado>";
		echo "<resultadoPorra>$row[0]</resultadoPorra>";
		echo'</item>';
	} else {
		echo '<item>';
		echo "<id>$line[1]</id>";
		echo "<partido>$line[0]</partido>";
		echo "<fecha>$line[2]</fecha>";
		echo "<votado>0</votado>";
		echo'</item>';
	}

	
}
echo '</partidos>';

mysql_close($link);
?>
