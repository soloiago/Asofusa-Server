<? 
include('config.php'); 
if (isset($_POST['submitted'])) { 
foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
$sql = "INSERT INTO `ASOFUSA` ( `NICKNAME` ,  `EMAIL` ,  `COMMENT` ,  `COMPETITION` ) VALUES(  '{$_POST['NICKNAME']}' ,  '{$_POST['EMAIL']}' ,  '{$_POST['COMMENT']}' ,  '{$_POST['COMPETITION']}') "; 
mysql_query($sql) or die(mysql_error()); 
echo "Added row.<br />"; 
echo "<a href='list.php'>Back To Listing</a>"; 
} 
?>

<form action='' method='POST'> 
<p><b>NICKNAME:</b><br /><input type='text' name='NICKNAME'/> 
<p><b>EMAIL:</b><br /><input type='text' name='EMAIL'/> 
<p><b>COMMENT:</b><br /><input type='text' name='COMMENT'/> 
<p><b>COMPETITION:</b><br /><input type='text' name='COMPETITION'/> 
<p><input type='submit' value='Add Row' /><input type='hidden' value='1' name='submitted' /> 
</form> 
