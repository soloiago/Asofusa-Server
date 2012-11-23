<? 
include('config.php'); 
if (isset($_GET['id']) ) { 
$id = (int) $_GET['id']; 
if (isset($_POST['submitted'])) { 
foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
$sql = "UPDATE `ASOFUSA` SET  `NICKNAME` =  '{$_POST['NICKNAME']}' ,  `EMAIL` =  '{$_POST['EMAIL']}' ,  `COMMENT` =  '{$_POST['COMMENT']}' ,  `COMPETITION` =  '{$_POST['COMPETITION']}' ,  `DATE` =  '{$_POST['DATE']}'   WHERE `id` = '$id' "; 
mysql_query($sql) or die(mysql_error()); 
echo (mysql_affected_rows()) ? "Edited row.<br />" : "Nothing changed. <br />"; 
echo "<a href='list.php'>Back To Listing</a>"; 
} 
$row = mysql_fetch_array ( mysql_query("SELECT * FROM `ASOFUSA` WHERE `id` = '$id' ")); 
?>

<form action='' method='POST'> 
<p><b>NICKNAME:</b><br /><input type='text' name='NICKNAME' value='<?= stripslashes($row['NICKNAME']) ?>' /> 
<p><b>EMAIL:</b><br /><input type='text' name='EMAIL' value='<?= stripslashes($row['EMAIL']) ?>' /> 
<p><b>COMMENT:</b><br /><input type='text' name='COMMENT' value='<?= stripslashes($row['COMMENT']) ?>' /> 
<p><b>COMPETITION:</b><br /><input type='text' name='COMPETITION' value='<?= stripslashes($row['COMPETITION']) ?>' /> 
<p><b>DATE:</b><br /><input type='text' name='DATE' value='<?= stripslashes($row['DATE']) ?>' /> 
<p><input type='submit' value='Edit Row' /><input type='hidden' value='1' name='submitted' /> 
</form> 
<? } ?> 
