<?php 
 include("../include/chklogin.php");  
include("../Connections/dbconnect.php");

$total_mintslogin=0;

function case_logout($case_i){
$a=='';
                                                           if($case_i== 'User-Request')  {  $a="ผู้ใช้ออกจากระบบเอง"; }
													 	  if($case_i== 'Idle-Timeout')  {  $a="ระบบดีดออกเนืองจากไม่มีการใช้งาน"; }										   
													   if($case_i== 'Lost-Carrier')  {  $a="สัญญาณหลุด"; }		
													      if($a== '')  {  $a="$case_i"; }	
     return $a;					
											 	}
 
function ConvertMinutes2Hours($Minutes)
{
    if ($Minutes < 0)
    {
        $Min = Abs($Minutes);
    }
    else
    {
        $Min = $Minutes;
    }
    $iHours = Floor($Min / 60);
    $Minutes = ($Min - ($iHours * 60)) / 100;
    $tHours = $iHours + $Minutes;
    if ($Minutes < 0)
    {
        $tHours = $tHours * (-1);
    }
    $aHours = explode(".", $tHours);
    $iHours = $aHours[0];
    if (empty($aHours[1]))
    {
        $aHours[1] = "00";
    }
    $Minutes = $aHours[1];
    if (strlen($Minutes) < 2)
    {
        $Minutes = $Minutes ."0";
    }
    $tHours = $iHours .":". $Minutes;
    return $tHours;
}

  
function getservername($macaddrss_server,$connect_db)
{
	$query_Recordset1 = "SELECT   *   FROM   server      where   macaddress='$macaddrss_server'  ";
	$Recordset1 = mysql_query($query_Recordset1, $connect_db) or die(mysql_error());
	$row_Recordset1 = mysql_fetch_assoc($Recordset1);
	$A="VLAN&nbsp;".$row_Recordset1[server_name];
	/*   if($macaddrss_server=='00-0C-29-2A-E8-68')  { $A="VLAN 1714";}
	 if($macaddrss_server=='00-0C-29-2A-E8-72')  { $A="VLAN 1715";}
	 if($macaddrss_server=='00-0C-29-2A-E8-7C')  { $A="VLAN 1716";}
	 if($macaddrss_server=='00-0C-29-2A-E8-86')  { $A="VLAN 1717";}
	 */
	return $A;
}


$mdate_DAY1 = date("F");  
$mdate_DAY2= date("Y");  
 
?>
<html>
<head>
<title>รายงานการเข้าใช้งาน</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<link href="../css/style.css" rel="stylesheet" type="text/css">
<style type="text/css">
.styled-button-2 {
	-webkit-box-shadow:rgba(0,0,0,0.2) 0 1px 0 0;
	-moz-box-shadow:rgba(0,0,0,0.2) 0 1px 0 0;
	box-shadow:rgba(0,0,0,0.2) 0 1px 0 0;
	border-bottom-color:#333;
	border:1px solid #61c4ea;
	background-color:#7cceee;
	border-radius:5px;
	-moz-border-radius:5px;
	-webkit-border-radius:5px;
	color:#333;
	font-family:'Verdana',Arial,sans-serif;
	font-size:14px;
	text-shadow:#b2e2f5 0 1px 0;
	padding:5px
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
<body bgcolor="#CCCCCC" >

<div align="center"> <font size="3" face="Microsoft Sans Serif"><strong>รายงานการเข้าใช้งานของ <?php print  $id_edit; ?> </strong></font><br>
ประจำ เดือน  <?php print $mdate_DAY1; ?>   ปี  <?php print $mdate_DAY2; ?> <br> 
ชื่อ login &nbsp;  <?php print  $id_edit; ?> </b>   </div>
<br>
<center><font size="2" face="MS Sans Serif, Tahoma, sans-serif">
  <table width="1024" border="0"   class="imagetable">
    <tr bgcolor="#FFFFCC" class="scimenu"> 
      <th width="12%"><div align="center"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">หมายเลขไอพีเครื่อง</font></strong></div></th>
      <th width="13%"><div align="center"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">เวลาเริ่มใช้</font></strong></div></th>
      <th width="12%"><div align="center"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">เวลาเลิกใช้</font></strong></div></th>
        <th width="9%"><div align="center"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">MIK LINK </font></strong></div></th>
      <th width="17%"><div align="center"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">Mac-Address&nbsp;Client</font></strong></div></th>
      <th width="18%"><div align="center"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">ประเภทการออกจากระบบ</font></strong></div></th>
      <th width="19%"><div align="center"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">รวามเวลาที่ใช้</font></strong></div></th>
    </tr>
    <?php

include("../include/function.php");
 
$mdate_DAY = date("Y-m");  
$mount= date("m");  
$year_gp= date("Y");  
mysql_select_db($database_db, $connect_db);

$query_user = "SELECT 
  radacct.FramedIPAddress,
  radacct.AcctStartTime,
  radacct.AcctStopTime,
  radacct.updates,
  radacct.CalledStationId,
  radacct.CallingStationId,
    radacct.AcctSessionId,
  radacct.AcctSessionTime,
  radacct.AcctTerminateCause,
   radacct.UserName,
  register.UserName,
  register.fullname ,
   
   TIMESTAMPDIFF ( MINUTE ,  radacct.AcctStartTime ,radacct.AcctStopTime)  AS timeloginM
FROM
  radacct
  INNER JOIN register ON (radacct.UserName = register.UserName)
   where    radacct.UserName='$id_edit'   
  
 
	and
	YEAR(radacct.AcctStartTime)='$year_gp'         
	
	
   
    ";  
	//and    MONTH(radacct.AcctStartTime)='$mount'  
$user_db = mysql_query($query_user, $connect_db) or die(mysql_error());
$row_user = mysql_fetch_assoc($user_db);
$totalRows_user= mysql_num_rows($user_db);

 



if($totalRows_user==0  or $totalRows_user==null) {
echo "ไม่มีข้อมูลการเข้าใช้งาน ";
} else {
 $ii=1;
do{
$cli=$ii%2;
		if($cli=="0")  {$cli="#AAD2FF" ;  } else {    $cli="#FFFFFF" ;   }
		 $ii++;
 ?>
    <tr bgcolor="<?php print $cli; ?>" class="ข้อความในตาราง"> 
      <td height="15"><div align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp; 
        <?php  print $row_user[FramedIPAddress]; ?>
      </font></div></td>
      <td height="15"><div align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> &nbsp; 
        <?php  print $row_user[AcctStartTime]; ?>
      </font></div></td>
      <td height="15"><div align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> &nbsp; 
        <?php  print $row_user[AcctStopTime]; ?>
      </font></div></td>
      <td height="15"><div align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><? print   $row_user[CalledStationId];?></font></div></td>
      <td height="15"><div align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> &nbsp; 
        <?php  print $row_user[CallingStationId]; ?>
      </font></div></td>
      <td height="15"><div align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">
        &nbsp;
        <?php  print    case_logout($row_user[AcctTerminateCause]); ?>
      </font></div></td>
      <td height="15"><div align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
        &nbsp; 
        <?php  
 	if($row_user[AcctStopTime] !="0000-00-00 00:00:00"){
 $data_login=ConvertMinutes2Hours($row_user[timeloginM]);
print $data_login; print "&nbsp;&nbsp;ชั่วโมง/นาที";
$total_mintslogin=$total_mintslogin+$row_user[timeloginM];
 } else 
{
		  	  $hours = floor($row_user[AcctSessionTime]/60.0/60.0);
	  $mins = floor(($row_user[AcctSessionTime] - $hours * 60.0 * 60.0)/60.0);
	  $secs = $row_user[AcctSessionTime] - ($hours * 60.0 * 60.0) - ($mins * 60.0);
	  printf("%d:%02d:%02d", $hours, $mins, $secs);  print "&nbsp;&nbsp;ชั่วโมง/นาที/วินาที";
}
		  
		  		?>
        &nbsp; </font></div></td>
    </tr>
    <?php } while ($row_user = mysql_fetch_assoc($user_db)); 

 
  }
mysql_close($connect_db); ?>
  </table>
</font>
  <p><font size="3"><strong><font color="#FF0000" face="Microsoft Sans Serif">รวมเวลาที่ใช้ทั้งหมด&nbsp;
  <?php
   $data_login=ConvertMinutes2Hours($total_mintslogin);
print $data_login; print "&nbsp;&nbsp;ชั่วโมง/นาที";
  ?></font></strong></font> </p>
</center>

</body>
</html>
