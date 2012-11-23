<?php
include('config.php');

function puntos($porra, $real) {
	$porra = explode("-", $porra);
	$real = explode("-", $real);
	
	$puntos = 0;
	
	//Acertar resultado exacto
	if ($porra[0]==$real[0] && $porra[1]==$real[1]) {
		$puntos = 10;
	} else {
		//Acertar goles locales
		if ($porra[0]==$real[0]) {
			$puntos += 2;
		}
		//Acertar goles visitantes
		if ($porra[1]==$real[1]) {
			$puntos += 2;
		}
		//Acertar quiniela
		if (($real[0]>$real[1] && $porra[0]>$porra[1]) || ($real[0]<$real[1] && $porra[0]<$porra[1]) || ($real[0]==$real[1] && $porra[0]==$porra[1])) {
			$puntos += 3;
		}
	}

	return $puntos;
}

$COMPETICION = $_GET['COMPETICION'];

$query = "SELECT DISTINCT USER FROM ASOFUSA_PORRA_USER WHERE COMPETICION='$COMPETICION'";
$result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());

echo '<?xml version="1.0"?>';
echo '<clasificacion>';

//Recorremos todos los usarios
while ($line = mysql_fetch_array($result, MYSQL_NUM)) {
	echo '<item>';
	echo "<name>$line[0]</name>";

	//Recorremos los partidos con resultado	
	$query2 = "SELECT id, RESULTADO FROM ASOFUSA_PORRA_PARTIDOS WHERE ACTIVO=1 AND RESULTADO!='-' AND COMPETICION='$COMPETICION'";
	$result2 = mysql_query($query2) or die('Consulta fallida: ' . mysql_error());

	$puntos  = 0;
	while ($line2 = mysql_fetch_array($result2, MYSQL_NUM)) {
		
		//Vemos si el usuario ha votado esos resultados
		$query3 = "SELECT RESULTADO FROM ASOFUSA_PORRA_USER WHERE USER='$line[0]' AND PARTIDO_ID='$line2[0]'";
		$result3 = mysql_query($query3) or die('Consulta fallida: ' . mysql_error());
		while ($line3 = mysql_fetch_array($result3, MYSQL_NUM)) {
			$puntos = $puntos + puntos($line2[1], $line3[0]);
		}
	}
	echo "<puntos>".$puntos."</puntos>";
	echo'</item>';
}
echo '</clasificacion>';

mysql_close($link);
?>
