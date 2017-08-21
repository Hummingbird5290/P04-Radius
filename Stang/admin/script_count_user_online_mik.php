 
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<?php
 ini_set('date.timezone ', 'Asia/Bangkok');
 			include("/var/www/html/mk/Connections/conf.php");
			include_once('routeros_api.class.php'); //mikrotik api
			mysql_select_db($database_edoc) or trigger_error(mysql_error(),E_USER_ERROR);
 $query_Recordset1ccc = " Select  *  from  mikrotik_link       ";
$Recordset1ccc = mysql_query($query_Recordset1ccc, $connect_db) or die(mysql_error());
$row_Recordset1ccc = mysql_fetch_assoc($Recordset1ccc);
$d=0;
 
  do { 
$ipmk=$row_Recordset1ccc[ip_vpn];
$usermk=$row_Recordset1ccc[user];
$pmk=$row_Recordset1ccc[pass];
$gobal_ip=$row_Recordset1ccc[gobal_ip];
$status_mk_online=$row_Recordset1ccc[status];
$domain=$row_Recordset1ccc[domain];
   $API_COUNT_ONLINE = new routeros_api();
   $API_COUNT_ONLINE->debug = false;
 
 if($status_mk_online==1){
if ($API_COUNT_ONLINE->connect($ipmk,$usermk ,$pmk )) {
   $ARRAY_ONLINE = $API_COUNT_ONLINE->comm("/ip/hotspot/active/print" );
   $inum= count ( $ARRAY_ONLINE );
mysql_query("update mikrotik_link  set user_mk_online='$inum' where ip_vpn='$ipmk' ", $connect_db) or die(mysql_error());
   //COU RAM USE
   $API_COUNT_ONLINE->disconnect();
 }
 }
 
 } while ($row_Recordset1ccc = mysql_fetch_assoc($Recordset1ccc));
unset($API_COUNT_ONLINE);
unset($ARRAY_ONLINE);
?>
 
