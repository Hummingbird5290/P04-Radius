<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
</head>

<body>
<?php
include("Connections/dbconnect.php");
 mysql_select_db($database_edoc, $connect_db)  or trigger_error(mysql_error(),E_USER_ERROR);
 
 $md=date('Y-m-d  h:i:s');
$query_user = "select  *   from server_status where   hostname='$hostname'   and  service='$service'   ";
$type_db = mysql_query($query_user, $connect_db) or die(mysql_error());
$row_user = mysql_fetch_assoc($type_db);
$totalRows_user= mysql_num_rows($type_db); 
if($totalRows_user >0) {
mysql_query("UPDATE   server_status     SET   status= '$status'   ,time_up='$md' where   hostname='$hostname'   and  service='$service'    ")or trigger_error(mysql_error(),E_USER_ERROR); 
} else
{
mysql_query("INSERT INTO  server_status     (hostname,status,service)
		      values('$hostname','$status','$service')") or die(mysql_error());  
}
?>
</body>
</html>
