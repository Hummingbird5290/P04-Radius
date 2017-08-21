<?php   
  include("../include/chklogin.php");  
 header("Content-Type: application/vnd.ms-excel");    header("Content-Disposition: attachment; filename=บัตรที่มีการใช้เติมเงินแล้ว.xls") ;
 

 header("Pragma: no-cache");
 header("Expires: 0");
 
                include("../Connections/dbconnect.php");
				include("../include/function.php");
				mysql_select_db($database_db, $connect_db);

$mounts=date("d-M-Y");
$mount=date("m");
$year_gp=date("Y");

 

?>
<html>
<head>
<title>รายงานการ์ดที่่มีการใช้งาน</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">


<body bgcolor="#FFFFFF" >

<div align="center"><strong><font size="4" face="MS Sans Serif, Tahoma, sans-serif">รายการ์ดที่มีการ 
  Active แล้ว ประจำเดือน &nbsp; 
  <?php  print $mounts ?>
  </font> </strong></div>
<br>
<center><font size="2" face="MS Sans Serif, Tahoma, sans-serif">
  <table width="1053" border="1" bordercolor="#000000">
    <tr bgcolor="#FFFFCC"> 
      <td width="19%"><div align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>ลำดับ</strong></font></div></td>
      <td width="19%"><div align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>หมายเลขการ์ด</strong></font></div></td>
      <td width="27%"><div align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>จำนวนวันที่กำหนดไว้ในระบบ</strong></font></div></td>
      <td width="14%"><div align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>วันที่เติมเงิน</strong></font></div></td>
      <td width="13%"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>กลุ่มความเร็ว</strong></font></td>
      <td width="13%"><div align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>ผู้ใช้งานที่เติม</strong></font></div></td>
      <td width="35%"><div align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>ราคา</strong></font></div></td>
      <td width="27%"><div align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>วันที่สร้างบัตร</strong></font></div></td>
      <td width="27%"><div align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>วันหมดอายุการใช้งานของผู้ใช้</strong></font></div></td>
    </tr>
    <?php

 mysql_select_db($database_db, $connect_db);
  $mount = htmlspecialchars("$mount", ENT_QUOTES);
 $year_gp = htmlspecialchars("$year_gp", ENT_QUOTES);
$pattern = '/;/i';
$replacement = NULL;
$mount= preg_replace($pattern, $replacement, $mount);
$year_gp= preg_replace($pattern, $replacement, $year_gp);

$query_user = "SELECT 
							  register.fullname,
							  card.*,
							  radcheck.Attribute,
							  radcheck.Value
                      FROM
                              card
  INNER JOIN register ON (card.UserName = register.UserName)
  INNER JOIN radcheck ON (card.UserName = radcheck.UserName)
                                          where  card.active='1' 
										   
										    and card.domain='$domian_name'   
										    and  radcheck.Attribute='Expiration'
											and  MONTH(card.time_active)='$mount'  
											and  YEAR(card.time_active)='$year_gp'     ";
$user_db = mysql_query($query_user, $connect_db) or die(mysql_error());
$row_user = mysql_fetch_assoc($user_db);
$totalRows_user= mysql_num_rows($user_db);

if($totalRows_user==0  or $totalRows_user==null) {
echo "ยังไม่มีข้อมูล หมายเลขการ์ดในระบบ";
} else {
 
do{
 ?>
    <tr bgcolor="#99FFFF"> 
      <td><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;<?php print   $row_user[No];?></font></td>
      <td><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;&nbsp;&nbsp;<?php print   $row_user[idcard];?></font></td>
      <td height="18"><div align="right"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp; 
          <?php if($row_user[type_time]=="วัน")  {  print $row_user[date_end];  }  
                       if($row_user[type_time]=="ชั่วโมง"){  $g=($row_user[date_end]/60)/60;   print $g;} 
					     if($row_user[type_time]=="นาที"){  $g=($row_user[date_end]/60);   print $g;} 
					    ?>
          &nbsp;<strong> 
          <?php  print $row_user[type_time]; ?>
          </strong> </font></div></td>
      <td><div align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
          <?php print   $row_user[time_active];?> </font></div></td>
      <td><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> <?php print   $row_user[GroupName];?> 
        </font></td>
      <td><div align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
          <?php print   $row_user[fullname];?> </font></div></td>
      <td><div align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><?php print   $row_user[cost];?></font></div></td>
      <td><div align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><?php print   $row_user[Time_build];?></font></div></td>
      <td><div align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
          <?php print   $row_user[Value];?> </font></div></td>
    </tr>
    <?php } while ($row_user = mysql_fetch_assoc($user_db)); 

 
  }
mysql_close($connect_db); ?>
  </table>
</font>
</center>
 
</body>
</html>
