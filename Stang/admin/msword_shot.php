<?php   
    include("../include/chklogin.php");   
 header("Content-Type: application/msword");    header("Content-Disposition: attachment; filename=report.doc") ;
 

 header("Pragma: no-cache");
 header("Expires: 0");
                include("../Connections/dbconnect.php");
				include("../include/function.php");
				mysql_select_db($database_db, $connect_db);

function gen_uptime($time = 0)
{
$days = (int)floor($time/86400);
$hours = (int)floor($time/3600)%24;
$minutes = (int)floor($time/60)%60;

if($days==1) { $uptime = "$days day, "; } else if($days>1) { $uptime = "$days days, "; }
if($hours==1) { $uptime .= "$hours hour"; } else if($hours>1) { $uptime .= "$hours hours"; }
if($uptime && $minutes>0 && $seconds>0) { $uptime .= ", "; } else if($uptime && $minutes>0 & $seconds==0) { $uptime .= " and "; }
($minutes>0) ? $uptime .= "$minutes minute" . ( ($minutes>1) ? "s" : NULL ) : NULL;

return $uptime;
}

$mdate_DAY1 = date("m");  
$mdate_DAY1 =$mdate_DAY1-1;
$mdate_DAY2= date("Y"); 
 

?>
<html>
<head>
<title>รายงานการเข้าใช้งานประจำเดือน</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">


<body bgcolor="#99CCFF" >

<div align="center"><?php print "<b>รายงานการเข้าใช้งานของ $name  ประจำ เดือน $mdate_DAY1   ปี $mdate_DAY2 "; ?> </div><br>
<center><font size="2" face="MS Sans Serif, Tahoma, sans-serif">
  <table width="100%" border="0">
    <tr bgcolor="#FFFFCC">
      <td><font size="2" face="MS Sans Serif, Tahoma, sans-serif">Username</font></td>
      <td><div align="center"><strong><font size="1" face="MS Sans Serif, Tahoma, sans-serif">FramedIPAddress</font></strong></div></td>
      <td><div align="center"><strong><font size="1" face="MS Sans Serif, Tahoma, sans-serif">AcctStartTime</font></strong></div></td>
      <td><div align="center"><strong><font size="1" face="MS Sans Serif, Tahoma, sans-serif">AcctStopTime</font></strong></div></td>
      <td><div align="center"><strong><font size="1" face="MS Sans Serif, Tahoma, sans-serif">Mac-Address&nbsp;Client</font></strong></div></td>
      <td><div align="center"><strong><font size="1" face="MS Sans Serif, Tahoma, sans-serif">AcctSessionTime</font></strong></div></td>
    </tr>
    <?php

 
 
$mdate_DAY = date("Y-m");  
$mount= date("m");  
$mount=$mount -1;
$year_gp= date("Y");  
mysql_select_db($database_db, $connect_db);

$query_user = "SELECT 
  radacct.FramedIPAddress,
  radacct.AcctStartTime,
  radacct.AcctStopTime,
  radacct.CalledStationId,
  radacct.CallingStationId,
  radacct.AcctSessionId,
  radacct.AcctSessionTime,
  radacct.UserName,
  register.UserName,
  register.fullname
FROM
  radacct
  INNER JOIN register ON (radacct.UserName = register.UserName)
   where      
     
    MONTH(radacct.AcctStartTime)='$mount'  
	and
	YEAR(radacct.AcctStartTime)='$year_gp'         
    ";
$user_db = mysql_query($query_user, $connect_db) or die(mysql_error());
$row_user = mysql_fetch_assoc($user_db);
$totalRows_user= mysql_num_rows($user_db);

if($totalRows_user==0  or $totalRows_user==null) {
echo "ไม่มีข้อมูลการเข้าใช้งาน ";
} else {
 
do{
 ?>
    <tr bgcolor="#99FFFF">
      <td><?php print   $row_user[fullname];?></td>
      <td height="18"><font size="1" face="MS Sans Serif, Tahoma, sans-serif">&nbsp; 
        <?php  print $row_user[FramedIPAddress]; ?>
        </font></td>
      <td><font size="1" face="MS Sans Serif, Tahoma, sans-serif"> &nbsp; 
        <?php  print $row_user[AcctStartTime]; ?>
        </font></td>
      <td><font size="1" face="MS Sans Serif, Tahoma, sans-serif"> &nbsp; 
        <?php  print $row_user[AcctStopTime]; ?>
        </font></td>
      <td><font size="1" face="MS Sans Serif, Tahoma, sans-serif"> &nbsp; 
        <?php  print $row_user[CallingStationId]; ?>
        </font></td>
      <td><font size="1" face="MS Sans Serif, Tahoma, sans-serif"> &nbsp; 
        <?php  print  gen_uptime($row_user[AcctSessionTime]);
		?>
        </font></td>
    </tr>
    <?php } while ($row_user = mysql_fetch_assoc($user_db)); 

 
  }
mysql_close($connect_db); ?>
  </table>
</font>
</center>

</body>
</html>
