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

 if($delete==1){
   if($_SESSION["adminpass"]=='demo'){ 
      echo                  "<script type=text/javascript>";
		    echo                  "alert('ผู้ใช้ ทดสอบระบบ  ดีด คนเล่นออก ไม่ได้ จ๊ะ :P ')";
	        echo                  "</script>";  
echo "<meta http-equiv=refresh content=0;URL=index.php?case_i=72>";
exit();
}

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
			  
echo  "<meta http-equiv=refresh content=0;URL=index.php?case_i=72>";
exit();
}

} //delete id

$query_Recordset1ccc = " Select  *  from  mikrotik_link  where   status='1'  $MKS order  by mk_id desc";
$Recordset1ccc = mysql_query($query_Recordset1ccc, $connect_db) or die(mysql_error());
$row_Recordset1ccc = mysql_fetch_assoc($Recordset1ccc);
$DS=1;
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
	<span class="info">Mikrotik User Online  For <?php print $row_Recordset1ccc[link_name];  ?>&nbsp;(<?php print $gobal_ip;?>) </span>
	</font>
	</strong></p></td>
  </tr>
</table>
 <table width="1166" border="1" align="left"  class="imagetable">
  <tr >
    <th width="24" bgcolor="#66FFFF" class="scimenu"><div align="center"></div></th>
    <th width="103" bgcolor="#66FFFF" class="scimenu"><div align="center">User</div></th>
    <th width="66" bgcolor="#66FFFF" class="scimenu"><div align="center">GROUP</div></th>
    <th width="131" bgcolor="#66FFFF" class="scimenu"><div align="center"> Expile </div></th>
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
 if($ARRAY[$i]['user'] !=NULL){
 $cc= getuplo($ARRAY[$i]['user'],$connect_db);
 $total_today= gettoday($ARRAY[$i]['user'],$connect_db);
 $GROUPS=getgrops($ARRAY[$i]['user'],$connect_db);
  $uploads=ConvertSize($cc[1]);
    $download=ConvertSize($cc[2]);
	//ไปอัพเดทว่า ผู้ใช้นี้ ออนไลน์ ที่ใหน
	
 ?>
  <tr>
    <td class="txtContentBold"><div align="center"><?php print $DS;?></div></td>
    <td class="txtContentBold"><div align="center"><a href="#search" onClick="newwindow=window.open('detail_user.php?id_edit=<?php print $ARRAY[$i]['user'];?>','detail_user','height=500,width=510,left=10,top=100,scrollbars=1');newwindow.focus();"> <?php print $ARRAY[$i]['user'];?></a></div></td>
    <td class="txtContentBold"><div align="center"><?php print $GROUPS;?></div></td>
    <td class="txtContentBold"><div align="center"><?php print getexpile($ARRAY[$i]['user'],$connect_db);?></div></td>
    <td class="txtContentBold"><div align="center"><?php print $ARRAY[$i]['mac-address'];?></div></td>
    <td class="txtContentBold"><div align="center"><?php print $ARRAY[$i]['address'];?></div></td>
    <td class="txtContentBold"><div align="center"><?php print $ARRAY[$i]['uptime'];?></div></td>
    <td class="txtContentBold"><div align="right"><?php print $uploads;?>&nbsp; </div></td>
    <td class="txtContentBold"><div align="right"><?php print $download;?>&nbsp; </div></td>
    <td class="txtContentBold"><div align="right"><?php print $total_today;?>&nbsp; </div></td>
    <td class="txtContentBold"><div align="center"><?php print $ARRAY[$i]['server'];?> </div></td>
    <td class="txtContentBold"><div align="center" class="txtContentBold"><a href="index.php?case_i=72&id=<?php print $ARRAY[$i]['.id'];?>&delete=1&linkid=<?php print $row_Recordset1ccc[mk_id];?>&MK_ID=<?php print $MK_ID;?>&unames= <?php print $ARRAY[$i]['user'];?>"  >KICK </a></div></td>
  </tr>
  <?php  $DS++; }$i++;

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