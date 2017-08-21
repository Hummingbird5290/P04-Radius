<?php   
    include("../include/chklogin.php");   
include("../Connections/dbconnect.php");

 
   ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Mysql Status</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
</head>

<body background="http://www.sci.nu.ac.th/websci/bg.jpg">
<?php  
//function แปลง unix time เป็นเวลาธรรมดา
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
 
 
 
 

 
// ดึงค่า มาแสดง 
$row = mysql_fetch_array(mysql_query("SHOW STATUS LIKE '%uptime%'"));
$uptime=gen_uptime($row['Value']);

 $row = mysql_fetch_array(mysql_query("SHOW STATUS LIKE '%Connections%'"));
$Connections= $row['Value'];
 
$query_type =  "SHOW STATUS   ";// where Variable_name  IN     (     'Qcache_free_blocks' ,	'Qcache_free_memory' ,	'Qcache_hits' 	, 'Qcache_inserts' 	, 'Qcache_lowmem_prunes'  ,'Qcache_not_cached' 	, 'Qcache_queries_in_cache' ,'Qcache_total_blocks' ,	'Questions' 	, 'Threads_cached'  ,'Threads_connected' ,	'Threads_created' ,'Threads_running' ,'Connections'     )   ";
 $type_db = mysql_query($query_type, $connect_db) or die(mysql_error());
$row = mysql_fetch_assoc($type_db);

$query_PROCESSLIST =  " SHOW PROCESSLIST   ";
$PROCESSLIST_db = mysql_query($query_PROCESSLIST, $connect_db) or die(mysql_error());
 $totalPROCESSLIST_db= mysql_num_rows($PROCESSLIST_db);
 

?>
<div align="center"> <font size="3" face="MS Sans Serif, Tahoma, sans-serif"> 
  <br>
  <?
if (!mysql_ping($connect_db)) {
    echo 'Lost connection, exiting after query #1';
    exit;
}

?> 
</font></div>
<br>
<table width="800" border="0" align="center">
  <tr bgcolor="#FFFFFF"> 
    <td colspan="3"><div align="center"> 
        <table width="100%" border="0">
          <tr bgcolor="#FFFFCC"> 
            <td width="225"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>รายงานสถานะ 
              ฐานช้อมูล MySQL </strong></font></td>
            <td width="609"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong><?php printf   (    mysql_get_server_info()); ?></strong></font></td>
          </tr>
          <tr bgcolor="#FFCCCC"> 
            <td><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>Uptime 
              </strong></font></td>
            <td><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong><?php echo "$uptime"; ?></strong></font></td>
          </tr>
          <tr bordercolor="#FFFFCC" bgcolor="#FFFFCC"> 
            <td><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>Connections 
              </strong></font></td>
            <td><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong> 
              <?php   $Connections=number_format($Connections);  echo "$Connections"; ?>
              </strong></font></td>
          </tr>
          <tr bgcolor="#FFCCCC"> 
            <td><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>PROCESSLIST 
              </strong></font></td>
            <td><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong><?php echo "$totalPROCESSLIST_db"; ?></strong></font></td>
          </tr>
          <tr bgcolor="#FFFFCC"> 
            <td><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> <strong>MySQL 
              host info: </strong></font></td>
            <td><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
              <?php $GHost=mysql_get_host_info();   echo "$GHost";  ?>
              </font></td>
          </tr>
        </table>
         </div></td>
  </tr>

  <tr> 
    <td bgcolor="#FFCCCC"><div align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>รายการ</strong></font></div></td>
    <td bgcolor="#FFFFCC"><div align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>จำนวน</strong></font></div></td>
    <td bgcolor="#FFFFCC"><div align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"></font></div></td>
  </tr>  <?php   do {   if ($row['Value'] > 200 ) {   // แสดงตัวเลขที่มากกว่า 200  เพื่อลด  จำนวนข้อมูลรายงานลง?>
  <tr> 
    <td width="348" bgcolor="#FFCCCC"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
      <b> &nbsp; 
      <?php  print  $row['Variable_name'];   ?>
      </b> </font></td>
    <td width="127" bgcolor="#FFFFCC"><div align="right"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
        <?php  $vl=number_format($row['Value']); print  $vl;  ?>
        &nbsp;&nbsp;</font></div></td>
    <td width="361" bgcolor="#FFFFCC"><div align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
        </font></div></td>
  </tr>
  <?php 
 }   // if
  } while ($row = mysql_fetch_assoc($type_db));
  ?>
</table>

<?php
$query_type =  " SHOW PROCESSLIST     ";
 $type_db = mysql_query($query_type, $connect_db) or die(mysql_error());
$row = mysql_fetch_assoc($type_db);
 $totalRows_type= mysql_num_rows($type_db);
?>
<table width="800" border="0" align="center">
  <tr bgcolor="#FFCCFF"> 
    <td colspan="9"><div align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>รายงานสถานะ 
        ฐานช้อมูล MySQL PROCESSLIST = <?php echo " $totalRows_type"; ?> PROCESSLIST</strong></font></div></td>
  </tr>
  <tr> 
    <td bgcolor="#FFCCCC"><div align="center"><font size="1" face="MS Sans Serif, Tahoma, sans-serif"><strong>ลำดับ</strong></font></div></td>
    <td bgcolor="#FFCCCC"><div align="center"><font size="1" face="MS Sans Serif, Tahoma, sans-serif"><strong>ID</strong></font></div></td>
    <td bgcolor="#FFCCCC"><div align="center"><font size="1" face="MS Sans Serif, Tahoma, sans-serif"><strong>ผู้ใช้</strong></font></div></td>
   <!--  <td bgcolor="#FFFFCC"><div align="center"><font size="1" face="MS Sans Serif, Tahoma, sans-serif"><strong>โฮสต์</strong></font></div></td> -->
    <td bgcolor="#FFFFCC"><div align="center"><font size="1" face="MS Sans Serif, Tahoma, sans-serif"><strong>ฐานข้อมูล</strong></font></div></td>
 <!--    <td bgcolor="#FFFFCC"><div align="center"><font size="1" face="MS Sans Serif, Tahoma, sans-serif"><strong>คำสั่ง</strong></font></div></td> -->
    <td bgcolor="#FFFFCC"><div align="center"><font size="1" face="MS Sans Serif, Tahoma, sans-serif"><strong>เวลา</strong></font></div></td>
    <td bgcolor="#FFFFCC"><div align="center"><font size="1" face="MS Sans Serif, Tahoma, sans-serif"><strong>สถานะ</strong></font></div></td>
    <td bgcolor="#FFFFCC"><div align="center"><font size="1" face="MS Sans Serif, Tahoma, sans-serif"><strong>คำค้น 
        SQL</strong></font></div></td>
  </tr>
  <?php   $i=1;do {     if ( $row['Time'] > 0) {    //  ใส่ if  เพื่อไม่ให้แสดงค่าตัวเลขน้อย ๆ มา?>
  <tr> 
    <td width="102" bgcolor="#FFCCCC"><div align="center"><font size="1" face="MS Sans Serif, Tahoma, sans-serif"> 
        <b> 
        <?php  print  $i;   ?>
        </b> </font></div></td>
    <td width="89" bgcolor="#FFCCCC"><div align="right"><font size="1" face="MS Sans Serif, Tahoma, sans-serif"> 
        <b> 
        <?php  print  $row['Id'];   ?>
        &nbsp;&nbsp; </b> </font></div></td>
    <td width="101" bgcolor="#FFCCCC"><font size="1" face="MS Sans Serif, Tahoma, sans-serif"> 
      <b> &nbsp; 
      <?php  print  $row['User'];   ?>
      </b> </font></td>
<!--     <td width="65" bgcolor="#FFFFCC"><font size="1" face="MS Sans Serif, Tahoma, sans-serif"><?php print  $row['Host'];  ?>       </font></td> -->
    <td width="141" bgcolor="#FFFFCC"><font size="1" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;<?php print  $row['db'];  ?></font></td>
  <!--   <td width="45" bgcolor="#FFFFCC"><font size="1" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;<?php print  $row['command'];  ?></font></td> -->
    <td width="125" bgcolor="#FFFFCC"><div align="right"><font size="1" face="MS Sans Serif, Tahoma, sans-serif">&nbsp; 
        <?php  $Time_p=gen_uptime($row['Time']);  print  $Time_p;  ?>
        &nbsp; </font></div></td>
    <td width="71" bgcolor="#FFFFCC"><font size="1" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;<?php print  $row['State'];  ?></font></td>
    <td width="141" bgcolor="#FFFFCC"><font size="1" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;<?php print  $row['Info'];  ?></font></td>
  </tr>
  <?php  } ?>
  <?php  $i++;
  } while ($row = mysql_fetch_assoc($type_db));
  ?>
</table>
 
</body>
</html>
