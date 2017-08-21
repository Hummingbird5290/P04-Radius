<?php
$hostname_edoc = "127.0.0.1";
$database_edoc = "radius";   
$username_edoc = "thaigqsoft";
$password_edoc = "logserver";
$connect_db= mysql_connect ($hostname_edoc, $username_edoc, $password_edoc);
 mysql_query("SET character_set_results=tis620");
    mysql_query("SET character_set_client=tis620");
    mysql_query("SET character_set_connection=tis620");
    mysql_query("SET collation_connection = tis620_thai_ci");
    mysql_query("SET collation_database = tis620_thai_ci");
    mysql_query("SET  collation_server = tis620_thai_ci");

 mysql_select_db($database_edoc, $connect_db)  or trigger_error(mysql_error(),E_USER_ERROR);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
</head>

<body>
<?php
  $query_Recordset1 = "SELECT   *   FROM  card2      ";
$Recordset1 = mysql_query($query_Recordset1, $connect_db) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

  do {
  $idcard=$row_Recordset1[idcard];
   $date_end=$row_Recordset1[date_end];
    $type_time=$row_Recordset1[type_time];
	 $UserName=$row_Recordset1[UserName];
	  $active=$row_Recordset1[active];
	   $time_active=$row_Recordset1[time_active];
	    $GroupName=$row_Recordset1[GroupName];
		 $time_death=$row_Recordset1[time_death];
		  $cost=$row_Recordset1[cost];
		   $H_end=$row_Recordset1[H_end];
		    $Time_build=$row_Recordset1[Time_build];
			 $domain=$row_Recordset1[domain];
   	 
  
mysql_query("INSERT INTO  card     (idcard ,date_end,type_time,UserName	,active,time_active	,GroupName,	time_death,cost,H_end	,Time_build	,domain	,truenoney )
		                                                                          values('$idcard','$date_end','$type_time','$UserName','0','$time_active','15M','$time_death','$cost','$H_end','$Time_build','$domain','$truenoney' )") or die(mysql_error());
   } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); 
   
   ?>
</body>
</html>
