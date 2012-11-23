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

$USER = $_GET['USER'];
$COMPETICION = $_GET['COMPETICION'];

$query = "SELECT PARTIDO, id, FECHA, RESULTADO FROM ASOFUSA_PORRA_PARTIDOS WHERE ACTIVO=1 AND RESULTADO!='-' AND COMPETICION='$COMPETICION'";
$result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());

echo '<?xml version="1.0"?>';
echo '<partidos>';
while ($line = mysql_fetch_array($result, MYSQL_NUM)) {
	$query2 = "SELECT PARTIDO_ID, RESULTADO FROM ASOFUSA_PORRA_USER WHERE USER='$USER'";
	$result2 = mysql_query($query2) or die('Consulta fallida: ' . mysql_error());
	while ($line2 = mysql_fetch_array($result2, MYSQL_NUM)) {
		if ($line2[0] == $line[1]) { 
				echo '<item>';
				echo "<id>$line[1]</id>";
				echo "<partido>$line[0]</partido>";
				echo "<fecha>$line[2]</fecha>";
				echo "<resultadoPorra>$line2[1]</resultadoPorra>";
				echo "<resultadoReal>$line[3]</resultadoReal>";
				$puntos = puntos($line2[1], $line[3]);
				echo "<puntos>".$puntos."</puntos>";
				echo'</item>';
		}
	}
}
echo '</partidos>';

mysql_close($link);
?>
