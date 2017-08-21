<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
</head>

<body>
<?php
 function write($path, $content, $mode="w+"){  
    if (file_exists($path) && !is_writeable($path)){ return false; }  
    if ($fp = fopen($path, $mode)){  
        fwrite($fp, $content);  
        fclose($fp);  
    }  
    else { return false; }  
    return true;  
}  
$hostname_edoc = "192.168.10.100";
$database_edoc = "dns";
$username_edoc = "thaigqsoft";
$password_edoc = "pb,iyd0vp,kd,kp";

$connect_db= mysql_pconnect($hostname_edoc, $username_edoc, $password_edoc) or trigger_error(mysql_error(),E_USER_ERROR); 
 $tb="getip";
if(!$connect_db) {
echo "........................... Mysql ... ";
exit();
}	

    mysql_query("SET character_set_results=tis620");
    mysql_query("SET character_set_client=tis620");
    mysql_query("SET character_set_connection=tis620");
    mysql_query("collation_connection = tis620_thai_ci");
    mysql_query("collation_database = tis620_thai_ci");
    mysql_query("collation_server = tis620_thai_ci");
 
 mysql_select_db($database_edoc, $connect_db)  or trigger_error(mysql_error(),E_USER_ERROR);
$hostname=$_GET["hostname"];
$userid=$_GET["userid"];
$passid=$_GET["passid"];
$detail=$_GET["detail"];
$ipx=$_GET["ip"];
$type=$_GET["types"];
if($type==''){  $type=$_GET["type"];}
$serviceC=$_GET["serviceC"];

$ip=$_SERVER['REMOTE_ADDR'];
$add_date = date("Y:m:d  H:i:s");





  $sql="INSERT INTO  $tb  (ip_client,time_get,hostname,type)     values('$ip','$add_date','$hostname','$type')";


mysql_query($sql, $connect_db) or trigger_error(mysql_error(),E_USER_ERROR); 
$DATE=date("Y-m-d");
 $query_Recordset1 = "SELECT   *   FROM $tb  where time_get  like  '%$DATE%' group by ip_client   ";
$Recordset1 = mysql_query($query_Recordset1, $connect_db) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$squidip=NULL;
  do { 
  $squidip.=$row_Recordset1[ip_client]."\r\n";
  } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); 
// ......... ....................  w+   
write("/var/www/html/mk/squid","$squidip","w+");  
 
?>
</body>
</html>



