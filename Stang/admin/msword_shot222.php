<?php   
  include("../include/chklogin.php");   
 header("Content-Type: application/msword");    header("Content-Disposition: attachment; filename=report.doc") ;
 

 header("Pragma: no-cache");
 header("Expires: 0");
                include("../Connections/dbconnect.php");
				include("../include/function.php");
				mysql_select_db($database_db, $connect_db);

 

$mdate_DAY1 = date("F");  
$mdate_DAY2= date("Y"); 
 

?>
<html>
<head>
<title>รายงานการเข้าใช้งานประจำเดือน</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">


<body bgcolor="#99CCFF" >


  
    <?php

 
 
$mdate_DAY = date("Y-m");  
$mount= date("m")-1;  
$year_gp= date("Y");  
mysql_select_db($database_db, $connect_db);

if($mount==1) {  $mount_text="มกราคม";  }
if($mount==2) {  $mount_text="กุมภาพันธ์";  }
if($mount==3) {  $mount_text="มีนาคม";  }
if($mount==4) {  $mount_text="เมษายน";  }
if($mount==5) {  $mount_text="พฤษภาคม";  }
if($mount==6) {  $mount_text="มิถุนายน";  }
if($mount==7) {  $mount_text="กรกฎาคม";  }
if($mount==8) {  $mount_text="สิงหาคม";  }
if($mount==9) {  $mount_text="กันยายน";  }
if($mount==10) {  $mount_text="ตุลาคม";  }
if($mount==11) {  $mount_text="พฤศจิกายน";  }
if($mount==12) {  $mount_text="ธันวาคม";  }

  $query_user = "SELECT * FROM  card   where          MONTH(time_active)='$mount'   and 	YEAR(time_active)='$year_gp'   ";
$user_db = mysql_query($query_user, $connect_db) or die(mysql_error());
$row_user = mysql_fetch_assoc($user_db);
$totalRows_user= mysql_num_rows($user_db);
$i_counts=0;
if($totalRows_user==0  or $totalRows_user==null) {
echo "ไม่มีข้อมูลการเข้าใช้งาน ";
}  else {  ?> 
<div align="center"><?php print "<b>รายงานการขายบัตร ประจำ เดือน $mount_text   ปี $year_gp "; ?> </div><br>
<center><font size="2" face="MS Sans Serif, Tahoma, sans-serif">
 <table width="66%" border="0">
    <tr bgcolor="#FFFFCC">
      <td width="6%"><strong><font size="1" face="MS Sans Serif, Tahoma, sans-serif">ลำดับ</font></strong></td>
      <td width="31%"><div align="center"><strong><font size="1" face="MS Sans Serif, Tahoma, sans-serif">หมายเลขบัตร</font></strong></div></td>
      <td width="20%"><div align="center"><strong><font size="1" face="MS Sans Serif, Tahoma, sans-serif">จำนวนเวลา</font></strong></div></td>
      <td width="43%"><div align="center"><strong><font size="1" face="MS Sans Serif, Tahoma, sans-serif">ราคา</font></strong></div></td>
    </tr>
    <?php  do { ?>
    <tr bgcolor="#99FFFF">
      <td><?php print   $i_counts;?></td>
      <td height="18"><font size="1" face="MS Sans Serif, Tahoma, sans-serif">&nbsp; 
        <?php  print $row_user[idcard]; ?>
        </font></td>
      <td><font size="1" face="MS Sans Serif, Tahoma, sans-serif"> &nbsp; 
        <?php    if($row_user[type_time]=="วัน")              {  print $row_user[date_end];  }  
		                if($row_user[type_time]=="ชั่วโมง")       {  $g=($row_user[date_end]/60)/60;   print $g;} 
						   if($row_user[type_time]=="นาที")       {  $g=($row_user[date_end]/60);   print $g;} 
                           ?>&nbsp;<?php print $row_user[type_time]; ?>
        </font></td>
      <td><font size="1" face="MS Sans Serif, Tahoma, sans-serif"> &nbsp; 
        <?php  print $row_user[cost]; ?>
        </font></td>
    </tr>
    <?php
	$i_counts++;
	} while ($row_user = mysql_fetch_assoc($user_db)); 

 
  }
mysql_close($connect_db); ?>
  </table>
</font>
</center>

</body>
</html>
