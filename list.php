<? 
include('config.php'); 
echo "<table border=1 width=100%>"; 
echo "<tr>"; 
echo "<td><b>Id</b></td>"; 
echo "<td><b>NICKNAME</b></td>"; 
echo "<td><b>EMAIL</b></td>"; 
echo "<td><b>COMMENT</b></td>"; 
echo "<td width=12%><b>COMPETITION</b></td>"; 
echo "<td width=8%><b>DATE</b></td>"; 
echo "</tr>"; 
$result = mysql_query("SELECT * FROM `ASOFUSA` ORDER by DATE DESC") or trigger_error(mysql_error()); 
while($row = mysql_fetch_array($result)){ 
foreach($row AS $key => $value) { $row[$key] = stripslashes($value); } 
echo "<tr>";  
echo "<td valign='top'>" . nl2br( $row['id']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['NICKNAME']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['EMAIL']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['COMMENT']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['COMPETITION']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['DATE']) . "</td>";  
echo "<td valign='top'><a href=edit.php?id={$row['id']}>Edit</a></td><td><a href=delete.php?id={$row['id']}>Delete</a></td> "; 
echo "</tr>"; 
} 
echo "</table>"; 
echo "<a href=new.php>New Row</a>"; 
?>
