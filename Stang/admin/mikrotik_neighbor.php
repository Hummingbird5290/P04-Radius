 <link href="../css/style.css" rel="stylesheet" type="text/css">
  <style rel="stylesheet" type="text/css">
a {
	text-decoration: none;
}
 
</style>

<style type="text/css">

table.imagetable {
	font-family: verdana,arial,sans-serif;
	font-size:11px;
	color:#333333;
	border-width: 1px;
	border-color: #999999;
	border-collapse: collapse;
}
table.imagetable th {
	background:#b5cfd2 url('cell-blue.jpg');
	border-width: 1px;
	padding: 8px;
	border-style: solid;
	border-color: #999999;
}
table.imagetable td {
	background:#dcddc0 url('cell-grey.jpg');
	border-width: 1px;
	padding: 8px;
	border-style: solid;
	border-color: #999999;
} 
</style>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
 <table width="1073" border="0">
  <tr>
    <td> 
<?php
ini_set('date.timezone ', 'Asia/Bangkok');
    ini_set('display_errors', 1);
   error_reporting('ALL'); 
   
$query_Recordset1ccc = " Select  *  from  mikrotik_link  where domain='$domian_name'  and status='1'   order  by mk_id desc";
$Recordset1ccc = mysql_query($query_Recordset1ccc, $connect_db) or die(mysql_error());
$row_Recordset1ccc = mysql_fetch_assoc($Recordset1ccc);
$API = new routeros_api();
  do { 
  $ipmk=$row_Recordset1ccc[ip_vpn];
$usermk=$row_Recordset1ccc[user];
$pmk=$row_Recordset1ccc[pass];
$status=$row_Recordset1ccc[status];
$gobal_ip=$row_Recordset1ccc[gobal_ip];
 //$API->debug = true;
if($status==1){
$API->debug = false;
 
if ($API->connect($ipmk,$usermk ,$pmk )) {

?>
<hr style="text-align: left; border-bottom-style: solid; color: #cccccc; width: 100%;" />
<?php
  $ARRAY = $API->comm("/ip/neighbor/print" );
   $inum= count ( $ARRAY );
 
 //print_r($ARRAY);
}  
}  
else {
$inum=1; 
}// if status
//print $inum;
?>


 
 <table width="976" border="1" align="left"  class="imagetable">
  <tr >
    <th width="57" bgcolor="#66FFFF" class="scimenu"><div align="center"></div></th>
    <th width="182" bgcolor="#66FFFF" class="scimenu"><div align="center">address</div></th>
    <th width="183" bgcolor="#66FFFF" class="scimenu"><div align="center">mac-address</div></th>
    <th width="165" bgcolor="#66FFFF" class="scimenu"><div align="center"> identity </div></th>
    <th width="230" bgcolor="#66FFFF" class="scimenu"><div align="center">platform </div></th>
    <th width="177" bgcolor="#66FFFF" class="scimenu"><div align="center">version</div></th>
    <th width="126" bgcolor="#66FFFF" class="scimenu"><div align="center">age</div></th>
 
  </tr>
  <?php if($inum > 0) {
  for ($i = 0; $i <= $inum+100; ) { 
 if($ARRAY[$i]['address'] <>''){
 ?>
  <tr>
    <td class="txtContentBold"><div align="center"><?php print $i+1;?></div></td>
    <td class="txtContentBold"><div align="center"> <?php print $ARRAY[$i]['address'];?> </div></td>
    <td class="txtContentBold"><div align="center"><?php print $ARRAY[$i]['mac-address'];?></div></td>
    <td class="txtContentBold"><div align="center"><?php print $ARRAY[$i]['identity'];?></div></td>
    <td class="txtContentBold"><div align="center"><?php print $ARRAY[$i]['platform'];?></div></td>
    <td class="txtContentBold"><div align="center"><?php print $ARRAY[$i]['version'];?></div></td>
    <td class="txtContentBold"><div align="center"><?php print $ARRAY[$i]['age'];?></div></td>
 </tr>
  <?php
  } $i++;
  
 } 
 } // if inum?>
</table>
 <br />
<hr style="text-align: left; border-bottom-style: solid; color: #cccccc; width: 100%;" />
 <br />

 <?php 
 $API->disconnect();
 
 
   } while ($row_Recordset1ccc = mysql_fetch_assoc($Recordset1ccc)); 
   ?>
   </td>
  </tr>
</table>
<?php
 function getuplo($id,$connect_db){
	$query_Recordset1 = "SELECT 	* FROM radacct  where  UserName='$id' order by RadAcctId desc ";
	$Recordset1 = mysql_query($query_Recordset1, $connect_db) or die(mysql_error());
	$row_Recordset1 = mysql_fetch_assoc($Recordset1);
	$a[1]=$row_Recordset1[AcctInputOctets];
	$a[2]=$row_Recordset1[AcctOutputOctets	];
	return $a;
 }
 
 function gettoday($id,$connect_db){
    $td=date("Y-m-d");
	$query_Recordset1 = "SELECT 	sum(AcctOutputOctets) as t FROM radacct  where  UserName='$id'  and  AcctStartTime like '%$td%' ";
	$Recordset1 = mysql_query($query_Recordset1, $connect_db) or die(mysql_error());
	$row_Recordset1 = mysql_fetch_assoc($Recordset1);
	$a=$row_Recordset1[t];
	$b=bytes2English($a);
 	return $b;
 }
 
  function getexpile($id,$connect_db){
   
	$query_Recordset1 = "SELECT 	Value as  t FROM radcheck  where  UserName='$id'   and  Attribute='Expiration' ";
	$Recordset1 = mysql_query($query_Recordset1, $connect_db) or die(mysql_error());
	$row_Recordset1 = mysql_fetch_assoc($Recordset1);
	$a=$row_Recordset1[t];
	 
 	return $a;
 }
 
 function getgrops($id,$connect_db){
  
	$query_Recordset1 = "SELECT 	GroupName  as t FROM usergroup  where  UserName='$id'   ";
	$Recordset1 = mysql_query($query_Recordset1, $connect_db) or die(mysql_error());
	$row_Recordset1 = mysql_fetch_assoc($Recordset1);
	$a=$row_Recordset1[t];
	 $rec1Arr = explode('@' ,$a);
 	return $rec1Arr[0];
 }
function bytes2English($filesize)
	{
	if ($filesize<1048676)
		RETURN number_format($filesize/1024,1) . " KB";
	if ($filesize>=1048576 && $filesize<1073741824)
		RETURN number_format($filesize/1048576,1) . " MB";
	if ($filesize>=1073741824 && $filesize<1099511627776)
		RETURN number_format($filesize/1073741824,2) . " GB";
	if ($filesize>=1099511627776)
		RETURN number_format($filesize/1099511627776,2) . " TB";
	if ($filesize>=1125899906842624) //Currently, PB won't show due to PHP limitations
		RETURN number_format($filesize/1125899906842624,3) . " PB";
	}

 if($_SESSION[adminpass]=='tlog'){
 print_r($ARRAY);
 }?>
 
 <hr style="text-align: left; border-bottom-style: solid; color: #cccccc; width: 100%;" />