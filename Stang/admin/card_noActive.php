
<?php include("../include/chklogin.php");

header("Content-Type: application/vnd.ms-excel");    header("Content-Disposition: attachment; filename=บัตรที่ยังไม่มีการใช้เติมเงิน.xls") ;


header("Pragma: no-cache");
header("Expires: 0");
include("../Connections/dbconnect.php");
include("../include/function.php");
mysql_select_db($database_db, $connect_db);





?>
<html>
<head>
<title>รายงานการ์ดที่ยังไม่มีการใช้งาน</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">


<body bgcolor="#FFFFFF">

	<div align="center">
		<font size="4" face="MS Sans Serif, Tahoma, sans-serif"><strong>รายงานการ์ดที่ยังไม่มีการใช้งาน
		</strong> </font>
	</div>
	<br>
	<center>
		<font size="2" face="MS Sans Serif, Tahoma, sans-serif">
			<table width="84%" border="1" bordercolor="#000000">
				<tr bgcolor="#FFFFCC">
					<td width="19%"><div align="center">
							<font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>ลำดับ</strong>
							</font>
						</div></td>
					<td width="23%"><div align="center">
							<font size="2"><strong><font
									face="MS Sans Serif, Tahoma, sans-serif">หมายเลขการ์ด</font> </strong>
							</font>
						</div></td>
					<td width="14%"><div align="center">
							<font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>กลุ่ม</strong>
							</font>
						</div></td>
					<td width="34%"><div align="center">
							<font size="2"><strong><font
									face="MS Sans Serif, Tahoma, sans-serif">จำนวนวันที่กำหนดไว้ในระบบ</font>
							</strong> </font>
						</div></td>
					<td width="18%"><font size="2"
						face="MS Sans Serif, Tahoma, sans-serif"><strong>วันหมดอายุ(ชั่วโมง)</strong>
					</font></td>
					<td width="18%"><div align="center">
							<font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>วันหมดอายุ</strong>
							</font>
						</div></td>
					<td width="27%"><div align="center">
							<font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>วันที่สร้างบัตร</strong>
							</font>
						</div></td>
					<td width="11%"><div align="center">
							<font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>ราคา</strong>
							</font>
						</div></td>
				</tr>
				<?php

				mysql_select_db($database_db, $connect_db);

				$query_user = "SELECT * FROM card    where      active='0'   and domain='$domain_name'  ";
				$user_db = mysql_query($query_user, $connect_db) or die(mysql_error());
				$row_user = mysql_fetch_assoc($user_db);
				$totalRows_user= mysql_num_rows($user_db);

				if($totalRows_user==0  or $totalRows_user==null) {
					echo "ยังไม่มีข้อมูล หมายเลขการ์ดในระบบ ";
				} else {

					do{
						?>
				<tr bgcolor="#99FFFF">
					<td><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;<?php print   $row_user[No];?>
					</font></td>
					<td><div align="center">
							<font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;&nbsp;&nbsp;<?php print   $row_user[idcard];?>&nbsp;&nbsp;</font>
						</div></td>
					<td><div align="center">
							<font size="2" face="MS Sans Serif, Tahoma, sans-serif"><?php print   $row_user[GroupName];?>
							</font>
						</div></td>
					<td height="18"><div align="right">
							<font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp; <?php  
							if($row_user[type_time]=="วัน")  {  print $row_user[date_end];  }  
							if($row_user[type_time]=="ชั่วโมง"){  $g=($row_user[date_end]/60)/60;   print $g;} 
							if($row_user[type_time]=="นาที"){  $g=($row_user[date_end]/60);   print $g;} ?>
								&nbsp;<strong> <?php  print $row_user[type_time]; ?>
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong> </font>
						</div></td>
					<td><div align="center">
							<font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>
							<?php if($row_user[type_time]=="วัน") {  print $row_user[H_end]; } else  { echo "ประเภทชั่วโมง จะไม่ใช้ส่วนนี้ "; } ?>
							</strong> </font>
						</div></td>
					<td><div align="center">
							<font size="2" face="MS Sans Serif, Tahoma, sans-serif"><?php print   $row_user[time_death];?>
							</font>
						</div></td>
					<td><div align="center">
							<font size="2" face="MS Sans Serif, Tahoma, sans-serif"><?php print   $row_user[Time_build];?>
							</font>
						</div></td>
					<td><div align="center">
							<font size="2" face="MS Sans Serif, Tahoma, sans-serif"><?php print   $row_user[cost];?>
							</font>
						</div></td>
				</tr>
				<?php } while ($row_user = mysql_fetch_assoc($user_db)); 

 
  }
mysql_close($connect_db); ?>
			</table> </font>
	</center>

</body>
</html>
