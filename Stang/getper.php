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

$sql="SELECT per  FROM register  WHERE per =  '$q'   ";

$db_query = mysql_query($sql, $connect_db) or die(mysql_error());
$num_rows2=mysql_num_rows($db_query); /* นับ Reccord ที่พบ */

$chk_q=0;
 if( !preg_match('/^[0-9][0-9]*$/',$q))
 {   
 
   	          $chk_q=1;
		   
		 	   
}

$result = mysql_query($sql);
if( $num_rows2  !=  0   or   $chk_q==1   )   {  print '<font color="#FF0000" size="2" face="MS Sans Serif, Tahoma, sans-serif">ไม่สามารถใช้งานได้ /Can not be used</font>';}   
if( $num_rows2 ==  0   and  $chk_q==0    )	                    { print '<font color="#0000FF" size="2" face="MS Sans Serif, Tahoma, sans-serif">สามารถใช้งานได้ / Can be used</font>';}


mysql_close($connect_db);
?>