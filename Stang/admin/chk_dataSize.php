<?php
 include("config.php");
 include("$PATH_INSTALL/Connections/dbconnect.php");
  include("$PATH_INSTALL/include/function.php");   
  mysql_select_db($database_edoc); //  or trigger_error(mysql_error(),E_USER_ERROR);
  

$query_Recordset1 = "SELECT table_schema as DBnames, sum( data_length + index_length ) / 1024 / 1024/1024 as Ssize
FROM information_schema.TABLES  where table_schema in ('$database_syslog' )  GROUP BY table_schema ";
$Recordset1 = mysql_query($query_Recordset1, $connect_db) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$syslog=$row_Recordset1['Ssize'];
$syslog= round($syslog, 3);
$query_Recordset1 = "UPDATE datasize SET    Size =  '$syslog  GB' WHERE   DBNAME  ='syslog'   ";
$Recordset1 = mysql_query($query_Recordset1, $connect_db) or die(mysql_error());

 echo "$query_Recordset1  <br>\r\n";

$query_Recordset1 = "SELECT table_schema as DBnames, sum( data_length + index_length ) / 1024 / 1024  as Ssize
FROM information_schema.TABLES  where table_schema in ('$database_edoc' )  GROUP BY table_schema ";
$Recordset1 = mysql_query($query_Recordset1, $connect_db) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$syslog=$row_Recordset1['Ssize'];
$syslog= round($syslog, 3);
$query_Recordset1 = "UPDATE datasize SET    Size =  '$syslog MB'  WHERE   DBNAME  ='radius'   ";
$Recordset1 = mysql_query($query_Recordset1, $connect_db) or die(mysql_error());
 echo "$query_Recordset1";
  ?>