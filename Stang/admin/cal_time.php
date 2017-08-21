<?php 
 include("../include/chklogin.php");  
include("../Connections/dbconnect.php");

$total_mintslogin=0;

function case_logout($case_i){
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

  


$mdate_DAY1 = date("F");  
$mdate_DAY2= date("Y");  
 
 
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
 
 	if($row_user[AcctStopTime] !="0000-00-00 00:00:00"){
 $data_login=ConvertMinutes2Hours($row_user[timeloginM]);
//print $data_login; print "&nbsp;&nbsp;ชั่วโมง/นาที";
$total_mintslogin=$total_mintslogin+$row_user[timeloginM];
 } else 
{
		  	  $hours = floor($row_user[AcctSessionTime]/60.0/60.0);
	  $mins = floor(($row_user[AcctSessionTime] - $hours * 60.0 * 60.0)/60.0);
	  $secs = $row_user[AcctSessionTime] - ($hours * 60.0 * 60.0) - ($mins * 60.0);
//	  printf("%d:%02d:%02d", $hours, $mins, $secs);  print "&nbsp;&nbsp;ชั่วโมง/นาที/วินาที";
}
		  
  } while ($row_user = mysql_fetch_assoc($user_db)); 

 
  }
mysql_close($connect_db);  
   $data_login=ConvertMinutes2Hours($total_mintslogin);
   ?>
   <font size="1"><strong><font color="#FF0000" face="Microsoft Sans Serif">
   <?
print $data_login; print "&nbsp;ชั่วโมง/นาที";
  ?> 
</font></strong></font> 