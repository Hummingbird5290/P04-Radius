
<?php 
 
// $ipassress=$_GET['ipassress'];
 
$ipassress= $_GET[ipassress];
 
 $mdate=date("d-m-Y H:i:s");
 echo "YOUR IPADDRESS  $ipassress  Check Time $mdate       Min"; 
 
  if (preg_match('/10.0./', $ipassress)) { 
include("Connections/dbconnect.php");
$txt_search=date("Y-m-d H");

 
  $block_mac_sql = "SELECT UserName,CallingStationId,AcctStopTime,FramedIPAddress,CalledStationId
                                                                                                 FROM  radacct 
                                                                                                         WHERE FramedIPAddress='$ipassress'  
                                                                                                                              and    (   AcctStopTime = '0000-00-00 00:00:00'    
																															            or   AcctStopTime = ''  
																																		or   AcctStopTime = '0'  
																																		or   AcctStopTime = null  )
																																		and AcctStartTime like  '%$txt_search%'   ";
//print $block_mac_sql;
$mac_db = mysql_query($block_mac_sql, $connect_db) or die(mysql_error());
$row_setingz= mysql_fetch_assoc($mac_db);
$totalRows_mac = mysql_num_rows($mac_db);
if($totalRows_mac !='')
{   $block_mac_sql = "SELECT *   FROM  seting     ";

$mac_db = mysql_query($block_mac_sql, $connect_db) or die(mysql_error());
$row_setingz= mysql_fetch_assoc($mac_db);
$gotoweb=$row_setingz[url];
                echo "<meta http-equiv=refresh content=0;URL=$gotoweb>"; 
               header("Location: $gotoweb");
print "<br>".$totalRows_mac;
                   
													 }
mysql_close($connect_db);
} //chk ipaddress
?>

 
