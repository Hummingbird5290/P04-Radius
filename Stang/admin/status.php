<?php  
  include("../include/chklogin.php");  
  include("../Connections/dbconnect.php");
  
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


$row = mysql_fetch_array(mysql_query("SHOW STATUS LIKE '%uptime%'"));
$uptime=gen_uptime($row['Value']);

  ?>
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
</head>

<body>
 
<table width="100%" border="0">
  <tr> 
    <td width="30%" bgcolor="#99FFFF"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>ปัจจุบันใช้ 
      Database </strong></font></td>
    <td width="21%" bgcolor="#FFFFCC"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;<?php echo "$hostname_edoc"; ?> 
      <strong>&nbsp;</strong></font></td>
    <td width="22%" bgcolor="#99FFFF"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>ชื่อฐานข้อมูล</strong></font></td>
    <td width="27%" bgcolor="#FFFFCC"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;<?php echo "$database_edoc"; ?></font></td>
  </tr>
  <tr> 
    <td bgcolor="#99FFFF"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>ปริมาณฐานข้อมูลในปัจจุบัน</strong></font></td>
    <td bgcolor="#FFFFCC"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;</font></td>
    <td bgcolor="#99FFFF"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;</font></td>
    <td bgcolor="#FFFFCC"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;</font></td>
  </tr>
  <tr> 
    <?php 
	$connect_db_syslog=consyslog();
 
$query_Recordset1 = "show tables   ; ";
$Recordset1 = mysql_query($query_Recordset1, $connect_db_syslog) or die(mysql_error());
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
$totalRows_Recordset1=$totalRows_Recordset1-1;
 mysql_select_db($database_edoc); //  or trigger_error(mysql_error(),E_USER_ERROR);
?>
    <td bgcolor="#99FFFF"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>เก็บ 
      Log ทั้งหมดขณะนี้ </strong></font></td>
    <td colspan="2" bgcolor="#FF99FF"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><?php echo "$totalRows_Recordset1"; ?>&nbsp;วัน</font></td>
    <td bgcolor="#FF99FF"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;</font></td>
  </tr>
  <tr bgcolor="#66CCFF"> 
    <td><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>รายการ</strong></font></td>
    <td colspan="2"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>สถานะ</strong></font></td>
    <td><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>ตรวจสอบล่าสุดเวลา</strong></font></td>
  </tr>
  <tr> 
    <td bgcolor="#99FFFF"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>UP 
      Time</strong></font></td>
    <td colspan="2" bgcolor="#FFFFCC"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><?php echo "$uptime"; ?></font></td>
    <td><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;</font></td>
  </tr>
  <?php 
$query_Recordset1 = "SELECT  *   FROM   datasize ";
$Recordset1 = mysql_query($query_Recordset1, $connect_db) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
   do { ?>
  <tr> 
    <td bgcolor="#99FFFF"> <font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
      <?php   print $row_Recordset1['DBNAME']; ?>
      </font></td>
    <td colspan="2" bgcolor="#FFFFCC"> <font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
      <?php  print    $DB_size=$row_Recordset1['Size'];  ?>
      </font></td>
    <td><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;</font></td>
  </tr>
  <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
  <tr> 
    <td bgcolor="#99FFFF"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">Server 
      Name</font></strong></td>
    <td bgcolor="#FFFFCC"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>Service</strong></font></td>
    <td><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;</font></td>
    <td><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;</font></td>
  </tr>
  <tr> 
    <?php  
	
 
  $query_Recordset1 = "SELECT   *   FROM   server_status order by  hostname ,service ";
$Recordset1 = mysql_query($query_Recordset1, $connect_db) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
 
  do { ?>
    <td bgcolor="#99FFFF"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
      <?php echo $row_Recordset1['hostname']; ?></font></td>
    <td bgcolor="#FFFFCC"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><?php echo $row_Recordset1['service']; ?></font></td>
    <td><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><?php echo $row_Recordset1['status']; ?></font></td>
    <td><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;<?php echo $row_Recordset1['time_up']; ?></font></td>
  </tr>
  <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
</table>

</body>
 
</html>
