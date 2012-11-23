<?php
include('config.php');

$COMPETITION = $_POST['COMPETITION'];
$COMPETITION = utf8_encode($COMPETITION);

$query = "SELECT NICKNAME, COMMENT, DATE FROM ASOFUSA WHERE COMPETITION='$COMPETITION' ORDER BY DATE DESC";

mysql_query("SET NAMES 'utf8'");

$result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());

echo "<html><head>";
echo '<style type="text/css">';
echo '#enlace {font-size: 24px; text-align: center; margin: 6px}';
echo '#hor tr:nth-child(4n+1) {background-color: #f7c300;}'; 
echo '#hor tr:nth-child(4n+2) {background-color: #f7c300;}';
echo '#hor tr:nth-child(4n+3) {background-color: #31b6e7;}'; 
echo '#hor tr:nth-child(4n+4) {background-color: #31b6e7;}';
echo 'td.rightAlign {font-size:10px; text-align: right; border-top: 1px solid #000}';
echo 'td.nick {font-size:10px; font-weight:bold; border-top: 1px solid #000}';
echo 'td.comment {font-size:12px; padding: 2px 8px 8px 8px; border-bottom: 1px solid #000}';

echo '</style></head><body>';
echo '<p id="enlace"><a href="insertar_comentario"><input name="primerboton" type="button" value="Enviar comentario" /></a><p>';

echo '<table id="hor" width=100% style="border-collapse: collapse;">';
while ($line = mysql_fetch_array($result, MYSQL_NUM)) {
	echo '<tr><td class="nick">';
	echo "$line[0]";
	echo '<td class="rightAlign">';
	echo "$line[2]</td></tr><tr><td ";
	echo 'colspan="2" class="comment">';
	echo "$line[1]";
	echo'</td></tr>';
}
echo '</table>';
echo '</body></html>';

mysql_close($link);
?>
