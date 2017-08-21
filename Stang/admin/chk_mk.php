 
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<?php
    ini_set('display_errors', 0);
   error_reporting(0); 
 $file = "/root/ping.lock";
if(is_file($file))
{
$a=1;
}
else
{
$a=2;
}
 
if($a<>2){
exit();
}
 
fopen("/root/ping.lock",w);
 
$hostname_edoc = "50.31.252.121";
$database_edoc = "radius";
$username_edoc = "tsystem";
$password_edoc = "tsystem";
$connect_dbs= mysql_connect ($hostname_edoc, $username_edoc, $password_edoc);
$bbb=date("Y-m-d H:i:s");
  mysql_query("SET character_set_results=tis620");
    mysql_query("SET character_set_client=tis620");
    mysql_query("SET character_set_connection=tis620");
    mysql_query("SET collation_connection = tis620_thai_ci");
    mysql_query("SET collation_database = tis620_thai_ci");
    mysql_query("SET  collation_server = tis620_thai_ci");
 mysql_select_db($database_edoc, $connect_dbs)  or trigger_error(mysql_error(),E_USER_ERROR);
 include_once('routeros_api.class.php'); //mikrotik api
 
 $R=date('H');
  $query_Recordset1ccc = " Select  *  from  mikrotik_link  where  ip_vpn <> '0'  order by domain    ";
$Recordset1ccc = mysql_query($query_Recordset1ccc, $connect_dbs) or die(mysql_error());
$row_Recordset1ccc = mysql_fetch_assoc($Recordset1ccc);
$API = new routeros_api();
  do { 
$ip_vpn=$row_Recordset1ccc[ip_vpn];
$usermk=$row_Recordset1ccc[user];
$pmk=$row_Recordset1ccc[pass];
$status=$row_Recordset1ccc[status];
$gobal_ip=$row_Recordset1ccc[gobal_ip];
$mkid=$row_Recordset1ccc[mk_id];
$domain=$row_Recordset1ccc[domain];
 
 
 
$API->debug = false;
if ($API->connect($ip_vpn,$usermk ,$pmk )) {
  $ARRAY = $API->comm("/ip/hotspot/active/print" );
  $inum= count ( $ARRAY );
  mysql_query("update  mikrotik_link set user_mk_online='$inum' ,status='1' where  mk_id='$mkid' ", $connect_dbs) or die(mysql_error());
  
 $ARRAY2 = $API->comm("/ip/hotspot/host/print" );
  $inum2= count ( $ARRAY2 );
    mysql_query("update  mikrotik_link set connects='$inum2' where  mk_id='$mkid' ", $connect_dbs) or die(mysql_error());
  
   print "Connect  $ip_vpn  $domain  OK \r \n"; 
   } else {
   $bbb=date("Y-m-d H:i:s");
   mysql_query(" update    mikrotik_link   set  free_mem='0' ,total_mem='0', free_hdd='0',total_hdd='0' 
  ,cpu_load='0',  board='$board',version='$version',uptime='0' ,status='0' ,connects='0' , ip_vpn='0' ,lastupdate='$bbb' where  mk_id='$mkid' ", $connect_dbs) or die(mysql_error());
   }
 
 $API->disconnect();

   } while ($row_Recordset1ccc = mysql_fetch_assoc($Recordset1ccc));    
 unset($API);	  
 
 unlink("/root/ping.lock");
 ?>
 