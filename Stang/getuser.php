<?
header("Content-type: text/xml;  charset=TIS-620");
?>

<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">

</head><?php
$q=$_GET["q"];

include("Connections/dbconnect.php");
if (!$connect_db)
 {
 die('Could not connect: ' . mysql_error());
 }
    mysql_query("SET character_set_results=tis620");
    mysql_query("SET character_set_client=tis620");
    mysql_query("SET character_set_connection=tis620");
    mysql_query("collation_connection = tis620_thai_ci");
    mysql_query("collation_database = tis620_thai_ci");
    mysql_query("collation_server = tis620_thai_ci");
	
mysql_select_db("tlog_huzzun", $connect_db);

$sql="SELECT UserName  FROM radcheck  WHERE UserName =  '$q'   ";

$db_query = mysql_query($sql, $connect_db) or die(mysql_error());
$num_rows=mysql_num_rows($db_query); /* นับ Reccord ที่พบ */
//$chk_q=0;
 //if( !preg_match('/^[a-z][a-z]*$/i',$q))
// {   
//   	          $chk_q=1;
//}
$chk_q=0;
$result = mysql_query($sql);
if( $num_rows  !=  0    or   $chk_q==1 )   {  
print '<font color="#FF0000" size="2" face="MS Sans Serif, Tahoma, sans-serif">มีการใช้งานในระบบแล้ว /Is used in the system already </font> <br>
<input name="notreg" type="hidden" value="1">';}   
if( $num_rows  ==  0   and  $chk_q==0  )	   { 
print '<font color="#0000FF" size="2" face="MS Sans Serif, Tahoma, sans-serif">สามารถใช้งานได้ / Can be used</font><br>
<input name="notreg" type="hidden" value="0">';}   


mysql_close($connect_db);
?>