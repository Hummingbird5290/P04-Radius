<?php  
   include("../include/chklogin.php");   
if($a=="word") { header("Content-Type: application/msword");    header("Content-Disposition: attachment; filename=report.doc");  header("Pragma: no-cache");   }
if($a=="excel") { header("Content-Type: application/vnd.ms-excel"); header("Content-Disposition: attachment; filename=report.xls"); header("Pragma: no-cache");    }
if($a !="excel"  and  $a !="word" ) {  header("Pragma: no-cache");    }


header("Expires: 0");
                include("../Connections/dbconnect.php");
				include("../include/function.php");
			 $connect_db_syslog=consyslog();
?>
<html>
<head>
<title>รายงานการใช้เว็บ</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<body bgcolor="#FFFFFF" ><be>
 
<div align="center"><strong> <font size="3" face="MS Sans Serif, Tahoma, sans-serif">รายงานการเข้าเว็บไซต&nbsp;<?php print $ip; ?> 
  &nbsp; จากลูกข่าย Server  ชื่อ<?php echo "$host"; ?> <br>วันที่ <?php echo "$date_view"; ?></font></strong></div>
<br>
<center><font size="2" face="MS Sans Serif, Tahoma, sans-serif">
  <table width="1024" border="1" align="center">
    <tr> 
      <td width="20%" bgcolor="#66FFFF"><div align="center"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">เวลา</font></strong></div></td>
      <td width="66%" bgcolor="#66FFFF"><div align="center"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">เว็บที่เรียก</font></strong></div></td>
    </tr>
    <?php
 
  $date_view2 = preg_replace("/-/i", "", $date_view);
 $tb="$date_view2";     $tb ="log_$tb";
 
  $ip = preg_replace("/ /i", "", $ip);
 $time1="$date_view $time1";
 $time2="$date_view $time2";
$query_user = "SELECT host,       facility,       priority,       level,      tag,      `datetime`,       program,          DECODE(msg,'thaigqsoft')    as msg  ,       seq    FROM   $tb   where  datetime between  '$time1'  and  '$time2'     and   DECODE(msg,'thaigqsoft')      like  '%$ip%'   and program like '%squid%'    and host='$host'     "; //
 
$user_db = mysql_query($query_user, $connect_db_syslog) or die(mysql_error());
$row_user = mysql_fetch_assoc($user_db);
$totalRows_user= mysql_num_rows($user_db);

if($totalRows_user==0  or $totalRows_user==null) {
echo "ไม่มีข้อมูลการเข้าใช้งาน ";
} else {
 
  do {   
 
 ?>
    <tr > 
      <td height="18" bgcolor="#FFCCFF"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp; 
        <? print date_to_thai($row_user[datetime]);?> </font></td>
      <td bgcolor="#FFFFCC"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> <?php echo $row_user['msg'];?></font></td>
    </tr>
    <?php } while ($row_user = mysql_fetch_assoc($user_db)); 

  }
?>
  </table>
  <br>
  <strong> </strong></font>
</center>
<?php  //print $query_user ; ?>
</body>
</html>
