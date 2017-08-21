<?php  ini_set('display_errors', 1);
   error_reporting("ALL"); 
 
 
  function getos($id,$connect_db){
	$query_Recordset1 = "SELECT 	os FROM radacct  where  UserName='$id' order by RadAcctId desc ";
	$Recordset1 = mysql_query($query_Recordset1, $connect_db) or die(mysql_error());
	$row_Recordset1 = mysql_fetch_assoc($Recordset1);
	$a=$row_Recordset1[os];
 
	return $a;
 }
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
	 $rec1Arr = explode(' ', $a);   
	 
	 $rec1Arr [1]=re_name($rec1Arr [1]);
 	$date_db = "$rec1Arr[2]-$rec1Arr[1]-$rec1Arr[0]"; $date_now=date("Y-m-d");
 	$cal_date=(strtotime($date_db) - strtotime($date_now) ) / ( 60 * 60 * 24 );
	$rec1Arr[1]=re_name4($rec1Arr[1]);
	if(  $a <> '') {
	if($cal_date> 2   ){
	return "$rec1Arr[0] $rec1Arr[1] $rec1Arr[2]";
	} else {
	return '<span class="styleUdate" >'."$rec1Arr[0] $rec1Arr[1] $rec1Arr[2]".'*</span>';
	}
	} //if(  $a <> '') {
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
 }
 
 
 function re_name($mounts)
{
  if($mounts=='Jan') { $num_rows="01"; }
  if($mounts=='Feb') { $num_rows="02"; } 
  if($mounts=='Mar') { $num_rows="03"; } 
  if($mounts=='Apr') { $num_rows="04"; } 
  if($mounts=='May') { $num_rows="05"; } 
  if($mounts=='Jun') { $num_rows="06"; } 
  if($mounts=='Jul') { $num_rows="07"; } 
  if($mounts=='Aug') { $num_rows="08"; } 
  if($mounts=='Sep') { $num_rows="09"; } 
  if($mounts=='Oct') { $num_rows="10"; } 
  if($mounts=='Nov') { $num_rows="11"; } 
  if($mounts=='Dec') { $num_rows="12"; } 
    return $num_rows;
}


function re_name4($date_thai_mont)
{
 
if($date_thai_mont=="1"){ 	$date_thai_mont="ม.ค."; }
if($date_thai_mont=="2"){ 	$date_thai_mont="ก.พ."; }
if($date_thai_mont=="3"){ 	$date_thai_mont="มี.ค."; }
if($date_thai_mont=="4"){ 	$date_thai_mont="เม.ย."; }
if($date_thai_mont=="5"){ 	$date_thai_mont="พ.ค."; }
if($date_thai_mont=="6"){ 	$date_thai_mont="มิ.ย."; }
if($date_thai_mont=="7"){ 	$date_thai_mont="ก.ค."; }
if($date_thai_mont=="8"){ 	$date_thai_mont="ส.ค."; }
if($date_thai_mont=="9"){ 	$date_thai_mont="ก.ย."; }
if($date_thai_mont=="10"){ 	$date_thai_mont="ต.ค."; }
if($date_thai_mont=="11"){ 	$date_thai_mont="พ.ย."; }
if($date_thai_mont=="12"){ 	$date_thai_mont="ธ.ค."; }
    return  $date_thai_mont;
}
?><link href="../css/style.css" rel="stylesheet" type="text/css">
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
.styleUdate {color: #FF0000}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
 <table width="1192" border="0">
  <tr>
    <td> 
<?php
if($_GET[MK_ID] !=''){
$MKS="and  mk_id='$MK_ID' ";
}
//require_once('routeros_api.class.php'); //mikrotik api
function ConvertSize($bytes)
{
	$size = $bytes / 1024;

	if($size < 1024)
	{
		$size = number_format($size, 2);

		$size .= ' KB';
	}
	else
	{
		if($size / 1024 < 1024)
		{
			$size = number_format($size / 1024, 2);

			$size .= ' MB';
		}
		else if ($size / 1024 / 1024 < 1024)
		{
			$size = number_format($size / 1024 / 1024, 2);

			$size .= ' GB';
		}
	}

	return $size;
}

if($_GET['delete']==1){

 $query_Recordset1ccc = " Select  *  from  mikrotik_link  where     mk_id='$linkid' ";
$Recordset1ccc = mysql_query($query_Recordset1ccc, $connect_db) or die(mysql_error());
$row_Recordset1ccc = mysql_fetch_assoc($Recordset1ccc);
  $ipmk=$row_Recordset1ccc[ip_vpn];
$usermk=$row_Recordset1ccc[user];
$pmk=$row_Recordset1ccc[pass];

$API = new routeros_api();
 
//$API->debug = true;
$API->debug = false;
if ($API->connect($ipmk,$usermk ,$pmk )) {
 $ARRAY = $API->comm("/ip/hotspot/active/remove", array(
  ".id"=> "$id",
));
 $API->disconnect();
 $stop_time=date("Y-m-d H:i:s");
mysql_query( "update  radacct  set AcctStopTime  ='$stop_time'  , AcctTerminateCause='Admin-Reset' where   UserName='$unames'   and  
( AcctStopTime='0000-00-00 00:00:00'  or AcctStopTime=''   or AcctStopTime=NULL ) ");

  $b=date("Y-m-d H:i:s"); 
  $adminsss=$_SESSION["adminpass"];
$texts="$_SESSION[domain] ผู้ดูแลระบบ $adminsss  KICK ผู้ใช้งาน $unames $b";	
mysql_query("INSERT INTO  noute_data  (UserName,texts,date_add,admin,domain)
		      values('system', '$texts','$b'  ,'system','$domain' )") or trigger_error(mysql_error(),E_USER_ERROR);   
			  
echo  "<meta http-equiv=refresh content=0;URL=index.php?case_i=72&MK_ID=$MK_ID>";
exit();
}

} //delete id

$query_Recordset1ccc = " Select  *  from  mikrotik_link  where domain='$domian_name'  and status='1'  $MKS order  by mk_id desc";
$Recordset1ccc = mysql_query($query_Recordset1ccc, $connect_db) or die(mysql_error());
$row_Recordset1ccc = mysql_fetch_assoc($Recordset1ccc);

  do { 
  $ipmk=$row_Recordset1ccc[ip_vpn];
$usermk=$row_Recordset1ccc[user];
$pmk=$row_Recordset1ccc[pass];
$status=$row_Recordset1ccc[status];
$gobal_ip=$row_Recordset1ccc[gobal_ip];
$API = new routeros_api();

//$API->debug = true;
if($status==1){
$API->debug = false;
if ($API->connect($ipmk,$usermk ,$pmk )) {

?>
<hr style="text-align: left; border-bottom-style: solid; color: #cccccc; width: 100%;" />
<?php
  $ARRAY = $API->comm("/ip/hotspot/active/print" );
// $ARRAY = $API->comm("/ip/hotspot/hosts/print" );
   $inum= count ( $ARRAY );
   $API->disconnect();
mysql_query("update mikrotik_link  set user_mk_online='$inum' where ip_vpn='$ipmk' ", $connect_db) or die(mysql_error());
}  
}  
else {
$inum=1; 
}// if status

?>


<table width="1024" border="0">
  <tr>
    <td><p align="center"><strong>
	<font size="3" face="MS Sans Serif, Tahoma, sans-serif">
	<span class="info">Mikrotik User Online  For <?php print $row_Recordset1ccc[link_name];  ?>&nbsp;(<?php print $gobal_ip;?>,<?php print $row_Recordset1ccc[ip_vpn];?> ) </span>&nbsp;</font> <span class="styleUdate" >*หมายถึงใกล้หมดเวลาใช้งาน</span>
	
	</strong></p></td>
  </tr>
</table>
 <table width="1224" border="1" align="left"  class="imagetable">
  <tr >
    <th width="24" bgcolor="#66FFFF" class="scimenu"><div align="center"></div></th>
    <th width="103" bgcolor="#66FFFF" class="scimenu"><div align="center">User</div></th>
    <th width="66" bgcolor="#66FFFF" class="scimenu"><div align="center">GROUP</div></th>
    <th width="131" bgcolor="#66FFFF" class="scimenu"><div align="center"> Expile </div></th>
    <th width="131" bgcolor="#66FFFF" class="scimenu"><div align="center">OS</div></th>
    <th width="131" bgcolor="#66FFFF" class="scimenu"><div align="center">Mac address </div></th>
    <th width="100" bgcolor="#66FFFF" class="scimenu"><div align="center">Address</div></th>
    <th width="68" bgcolor="#66FFFF" class="scimenu"><div align="center">Uptime</div></th>
    <th width="75" bgcolor="#66FFFF" class="scimenu"><div align="center">UPLOAD</div></th>
    <th width="99" bgcolor="#66FFFF" class="scimenu"><div align="center">DOWNLOAD</div></th>
	 <th width="76" bgcolor="#66FFFF" class="scimenu"><div align="center">TO DAY</div></th>
    <th width="85" bgcolor="#66FFFF" class="scimenu"><div align="center">Link</div></th>
    <th width="53" bgcolor="#66FFFF" class="scimenu"><div align="center"></div></th>
  </tr>
  <?php  for ($i = 0; $i <= $inum+100; ) { 
      $idchkdomain=$ARRAY[$i]['user'];
  	$query_Recordset1 = "SELECT 	* FROM register  where  UserName='$idchkdomain'   ";
	$Recordset1 = mysql_query($query_Recordset1, $connect_db) or die(mysql_error());
	$row_Recordset1 = mysql_fetch_assoc($Recordset1);
  	 $DOMAIN_CHK_LIST=  $row_Recordset1[domain];
	
 if($ARRAY[$i]['user'] !=NULL  and $DOMAIN_CHK_LIST==$domain_name ){
 $cc= getuplo($ARRAY[$i]['user'],$connect_db);
 $total_today= gettoday($ARRAY[$i]['user'],$connect_db);
 $GROUPS=getgrops($ARRAY[$i]['user'],$connect_db);
  $uploads=ConvertSize($cc[1]);
    $download=ConvertSize($cc[2]);

$First= substr(ucfirst($ARRAY[$i]['user']),0,1);
if($DOMAIN_CHK_LIST == $domain_name  or $First=='T'){
 ?>
  <tr>
    <td class="txtContentBold"><div align="center"><?php print $i+1;?></div></td>
    <td class="txtContentBold"><div align="center"><a href="#search" onClick="newwindow=window.open('detail_user.php?id_edit=<?php print $ARRAY[$i]['user'];?>','detail_user','height=550,width=510,left=10,top=100,scrollbars=1');newwindow.focus();"> <?php print $ARRAY[$i]['user'];?></a></div></td>
    <td class="txtContentBold"><div align="center"><?php print $GROUPS;?></div></td>
    <td class="txtContentBold"><div align="center"><?php print getexpile($ARRAY[$i]['user'],$connect_db);?></div></td>
    <td class="txtContentBold"><div align="center"><?php print getos($ARRAY[$i]['user'],$connect_db);?></div></td>
    <td class="txtContentBold"><div align="center"><?php print $ARRAY[$i]['mac-address'];?></div></td>
    <td class="txtContentBold"><div align="center"><?php print $ARRAY[$i]['address'];?></div></td>
    <td class="txtContentBold"><div align="center"><?php print $ARRAY[$i]['uptime'];?></div></td>
    <td class="txtContentBold"><div align="right"><?php print $uploads;?>&nbsp; </div></td>
    <td class="txtContentBold"><div align="right"><?php print $download;?>&nbsp; </div></td>
    <td class="txtContentBold"><div align="right"><?php print $total_today;?>&nbsp; </div></td>
    <td class="txtContentBold"><div align="center"><?php print $ARRAY[$i]['server'];?> </div></td>
    <td class="txtContentBold"><div align="center" class="txtContentBold"><a href="index.php?case_i=72&id=<?php print $ARRAY[$i]['.id'];?>&delete=1&linkid=<?php print $row_Recordset1ccc[mk_id];?>&MK_ID=<?php print $MK_ID;?>&unames= <?php print $ARRAY[$i]['user'];?>&MK_ID=<?php print $MK_ID?>"  >KICK </a></div></td>
  </tr>
  <?php
  }
   }else {
 //  mysql_query("update mikrotik_link  set ip_vpn='0',status='0' where ip_vpn='$ipmk' ", $connect_db) or die(mysql_error());
   } // if($ARRAY[$i]['user'] !=NULL  and $DOMAIN_CHK_LIST==$domain_name ){
   
   $i++;
  
 } ?>
</table>
 <br />
<hr style="text-align: left; border-bottom-style: solid; color: #cccccc; width: 100%;" />
 <br />

 <?php  unset($ARRAY); 
  unset($API);
   } while ($row_Recordset1ccc = mysql_fetch_assoc($Recordset1ccc)); 
   ?>
   </td>
  </tr>
</table>
<?php

 
 
echo  "<meta http-equiv=refresh content=300;URL=index.php?case_i=72&MK_ID=$MK_ID>";
 
?>
 
 
 
 <hr style="text-align: left; border-bottom-style: solid; color: #cccccc; width: 100%;" />