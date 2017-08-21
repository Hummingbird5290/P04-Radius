
<?php
include_once("../include/chklogin.php");

?>

<meta	http-equiv="Content-Type" content="text/html; charset=windows-874">
<link	href="../css/style.css" rel="stylesheet" type="text/css">

<table width="100%" border="0" align="left" class="imagetable">
	<?php if($_SESSION["adminpass"]=='tlog'){ ?>
	
	<tr>
		<th align="left" valign="top" bgcolor="#66CCFF"  ><div align="left"> 
		<font size="4" face="MS Sans Serif, Tahoma, sans-serif"> <img src="../images/users.png" alt="" width="22" height="22" /> 
		ผู้ดูแลระบบสูงสุด		</font> </div></th>
	</tr>
	<?php
$query_Recordset_mk_online = " Select  count(user_mk_online) as t,sum(user_mk_online) as y ,sum(connects) as r  from  mikrotik_link  where   status='1' and ip_vpn <>'0'       ";
$Recordset1 = mysql_query($query_Recordset_mk_online, $connect_dbs) or die(mysql_error());
$row_Recordset_online_mk = mysql_fetch_assoc($Recordset1);
?>
			<tr>
		<td align="left" valign="top">
		<font size="2"  face="MS Sans Serif, Tahoma, sans-serif"> <a href="index.php?case_i=78">ALL  ONLINE </a>
		&nbsp;[<?php print $row_Recordset_online_mk[y] ;?>],[<?php print $row_Recordset_online_mk[r] ;?>]</font></td>
	</tr>
				<tr>
		<td align="left" valign="top">
		<font size="2"  face="MS Sans Serif, Tahoma, sans-serif"> <a href="index.php?case_i=81">Mikrotik_online </a>  </font></td>
	</tr>
	
		<tr>
		<td align="left" valign="top">
		<font size="2"  face="MS Sans Serif, Tahoma, sans-serif"><a href="index.php?case_i=79">รายการเติมเงินจากบัตรทรูที่ยังไม่ได้ตัดยอด</a></font></td>
	</tr>
			<tr>
		<td align="left" valign="top">
		<font size="2"  face="MS Sans Serif, Tahoma, sans-serif"><a href="index.php?case_i=76">Admin online</a></font></td>
	</tr>

	
			<tr>
		<td align="left" valign="top"><font size="2"
			face="MS Sans Serif, Tahoma, sans-serif"><a
				href="index.php?case_i=84">Profiles</a> </font></td>
	</tr>
			<tr>
		<td align="left" valign="top"><font size="2"
			face="MS Sans Serif, Tahoma, sans-serif"><a
				href="index.php?case_i=85">ปรับเวลาผู้ที่เติมบัตรก่อนหมดเวลา</a> </font></td>
	</tr>
	<?php } ?>
	<tr>
		<th align="left" valign="top" bgcolor="#66CCFF"  ><div align="left"> 
		<font size="4" face="MS Sans Serif, Tahoma, sans-serif"> <img src="../images/users.png" alt="" width="22" height="22" /> 
		จัดการสมาชิก		</font> </div></th>
	</tr>
	<?php /* if($domain_name=='huzzun'){ ?>
	<tr>
	<td><a href="List_user_online_now.php" target="_blank"><font size="2" 	face="MS Sans Serif, Tahoma, sans-serif">
<?php 	 
$hostname_edoc5 = "192.168.10.100";
$database_edoc5 = "radius";
$username_edoc5 = "thaigqsoft";
$password_edoc5 = "tlogsystem";
$connect_dbs= mysql_connect ($hostname_edoc5, $username_edoc5, $password_edoc5);
mysql_select_db($database_edoc5,$connect_dbs);  //  or trigger_error(mysql_error(),E_USER_ERROR);
    mysql_query("SET character_set_results=tis620");
    mysql_query("SET character_set_client=tis620");
    mysql_query("SET character_set_connection=tis620");
    mysql_query("SET collation_connection = tis620_thai_ci");
    mysql_query("SET collation_database = tis620_thai_ci");
    mysql_query("SET  collation_server = tis620_thai_ci");
$days= date("d");
$days2= date("d")-1;
$mount = date("m");
$year_gp= date("Y");

$todays=date("Y-m-d");
$to22=date("d");  $to22=$to22-1;
$todays2=date("Y-m");
$todays2 .="-$to22";

$query_Recordset1 = "
SELECT 
		radacct.UserName,
       radacct.AcctStartTime,
       radacct.FramedIPAddress,
       register.fullname,
	    register.room ,
		radacct.UserName,
		 radacct.CalledStationId,
		 register.per  ,
		  register.site
 FROM radacct
     INNER JOIN register ON (radacct.UserName = register.UserName) 
	 where 
    AcctStopTime='0000-00-00 00:00:00' 
	and register.domain='$domain_name'
	   ";
$Recordset1 = mysql_query($query_Recordset1, $connect_dbs) or die(mysql_error());?>
ผู้ที่ออนไลน์-ขณะนี้<?php print ' [ '.$totalRows_online= mysql_num_rows($Recordset1).'<img src="../images/login_user.gif" width="17"
	height="17" > คน ]'; ?></font></a></td>
	</tr>
	<?php }  */
	
 
$query_Recordset_mk_online = " Select  count(user_mk_online) as t,sum(user_mk_online) as y ,sum(connects) as r  from  mikrotik_link  where   status='1' and ip_vpn <>'0'   and domain='$domain_name' ";
$Recordset1 = mysql_query($query_Recordset_mk_online, $connect_dbs) or die(mysql_error());
$row_Recordset_online_mk = mysql_fetch_assoc($Recordset1);

	?>
	<?php if($_SESSION["adminpass"]=='admin'  or $_SESSION["adminpass"]=='tlog' ){ ?>
		<tr>
		<td align="left" valign="top">
		<font size="2"  face="MS Sans Serif, Tahoma, sans-serif"><a href="SMS/main.php" target="_blank" alt=''> ส่ง SMS</a></font></td>
	</tr>
	<?php }?>
	<tr>
		<td align="left" valign="top">
		<font size="2"  face="MS Sans Serif, Tahoma, sans-serif"><a href="index.php?case_i=72" alt='จำนวนคนออนไลน์,เครื่องที่คอนเน็คเข้ามา'>Mikrotik User online[ <?php print $row_Recordset_online_mk[y]  ;?>],[ <?php print $row_Recordset_online_mk[r]  ;?>]</a></font></td>
	</tr>
		<tr>
		<td align="left" valign="top">  <font size="2"
			face="MS Sans Serif, Tahoma, sans-serif"><a
				href="index.php?case_i=20" target="_parent">Mikrotik Link zone [ <?php print $row_Recordset_online_mk[t] ;?>]</a>  </font> 		</td>
	</tr>
 
	<tr>
		<td align="left" valign="top"><font size="2"
			face="MS Sans Serif, Tahoma, sans-serif"><a href="index.php?case_i=1">รายการผู้สมัครเข้าใช้งาน
					&nbsp; [<?php print $totalRows_online_reg;?> คน]</a> </font></td>
	</tr>
 

	<tr>
		<td align="left" valign="top"><font size="2"
			face="MS Sans Serif, Tahoma, sans-serif"><a href="index.php?case_i=2">รายการสมาชิกในระบบ&nbsp;
					[<?php print $totalRows_online_acctive;?> คน]</a> </font></td>
	</tr>
	<tr>
		<td align="left" valign="top"><font size="2"
			face="MS Sans Serif, Tahoma, sans-serif"><a href="index.php?case_i=7">สมาชิกที่ลบทิ้ง</a>
		</font></td>
	</tr>
	<tr>
		<td align="left" valign="top"><font size="2"
			face="MS Sans Serif, Tahoma, sans-serif"><a
				href="index.php?case_i=18">เพิ่มผู้ใช้</a> </font></td>
	</tr>
	<?php if($domain_name=='bether'){ ?>
	<tr>
		<td align="left" valign="top"><font size="2"
			face="MS Sans Serif, Tahoma, sans-serif"> <a
				href="index.php?case_i=53">Authen By Mac address</a> </font></td>
	</tr>
<?php } ?>
    <tr>
		<td valign="top"><font size="2" 	face="MS Sans Serif, Tahoma, sans-serif"><a href="index.php?case_i=31">เพิ่มผู้ใช้จาก Excel</a> </font></td>
	</tr>  
	
	<tr>
		<td align="left" valign="top"><font size="2"
			face="MS Sans Serif, Tahoma, sans-serif"><a href="index.php?case_i=6"
				target="_parent">Unlock User</a> </font></td>
	</tr>
 
	<tr>
		<td align="left" valign="top"><font size="2" 	face="MS Sans Serif, Tahoma, sans-serif"><a 	href="index.php?case_i=55" target="_parent">ลบผู้ใช้ที่ไม่ได้ Login เป็นเวลานาน</a> </font></td>
	</tr>
 
	<tr>
		<td align="left" valign="top"><font size="2"
			face="MS Sans Serif, Tahoma, sans-serif"><a 	href="index.php?case_i=61" target="_parent">ส่ง Email ถึงสมาชิก</a>
		</font></td>
	</tr>
	
		<tr>
		<td align="left" valign="top"><font size="2"
			face="MS Sans Serif, Tahoma, sans-serif"><a href="http://www.thaigqsoft.info/forget_pass.php?domain_name=<?php print $domain_name;?>" target="_blank">ส่ง SMS บอกรหัสผ่านสมาชิก</a>
		</font></td>
	</tr>
	<tr>
		<th align="left" valign="top" bgcolor="#66CCFF"  >
		 
		<font size="4" face="MS Sans Serif, Tahoma, sans-serif"><img src="./images/veryhot_post.gif" alt="" width="22" height="22" /> 
			บัตรเติมเวลา		</font> </div>	 </th>
	</tr>
 
<tr>
		<td align="left" valign="top"><font size="2"
			face="MS Sans Serif, Tahoma, sans-serif"> <a 	href="/active.php?domain_name=<?php print $domain_name;?>" target="_blank">เติมเวลาให้ลูกค้า (บัตรที่สร้างเอง)</a> </font></td>
  </tr>
  <tr>
		<td align="left" valign="top"><font size="2"
			face="MS Sans Serif, Tahoma, sans-serif"> 
			<a href="/card_true_acctive.php?domain_name=<?php print $domain_name;?>" target="_blank">เติมเวลาให้ลูกค้า (บัตรทรูมันนี่)</a> </font></td>
  </tr>
	<tr>
		<td align="left" valign="top"><font size="2"
			face="MS Sans Serif, Tahoma, sans-serif"> <a 	href="index.php?case_i=73" target="_parent">บัตรทรู</a> </font></td>
	</tr>
 
	<tr>
		<td align="left" valign="top"><font size="2"
			face="MS Sans Serif, Tahoma, sans-serif"> <a 	href="index.php?case_i=35" target="_parent">สร้างบัตรเติมเวลาอินเตอร์เน็ต</a> </font></td>
	</tr>
	<tr>
		<td align="left" valign="top"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> <a 	href="index.php?case_i=38" target="_parent">บัตรเติมเวลาที่ไม่มีการใช้งาน</a>
		</font></td>
	</tr>
	<tr>
		<td align="left" valign="top"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> <a href="index.php?case_i=39" target="_parent">บัตรเติมเวลาที่มีการใช้งานแล้ว</a>
		</font></td>
	</tr>
	
	 	<tr>
		<td align="left" valign="top"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> <a href="index.php?case_i=82" target="_parent">รายงานการขายบัตร ที่สร้างเอง</a>
		</font></td>
	</tr>
		 	<tr>
		<td align="left" valign="top"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> <a href="index.php?case_i=83" target="_parent">รายงานการขายบัตร true money</a>
		</font></td>
	</tr>
		<tr>
		<td align="left" valign="top"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> <a href="index.php?case_i=74" target="_parent">ตั้งค่าบัญชี Truemoney</a>
		</font></td>
	</tr>
<?php  /*	<tr>
		<td align="left" valign="top"><font size="2"
			face="MS Sans Serif, Tahoma, sans-serif"> <a 	href="index.php?case_i=47" target="_parent">สรุปบัตรสมาชิกแยกตามกลุ่มความเร็ว</a>
		</font></td>
	</tr>
*/
?>

 
	<tr>
		<th align="left" valign="top" bgcolor="#66CCFF" >
 	<font size="4" face="MS Sans Serif, Tahoma, sans-serif"><img src="./images/report.png" alt="" width="22" height="22" /> 
			รายงาน Log		</font> </div>		</th>
 </tr>
	 
 
	<?php /*
	<tr>
		<td align="left" valign="top"><font size="2"
			face="MS Sans Serif, Tahoma, sans-serif"><a href="index.php?case_i=3">IP
					ที่โหลดบิต</a> </font></td>
	</tr>
	*/ ?>
	<tr>
		<td align="left" valign="top"><font size="2"
			face="MS Sans Serif, Tahoma, sans-serif">
		<?php //	<a href="index.php?case_i=21">รายงาน Log System</a> ?>
		<a href="list_syslog.php" target="_blank">รายงาน Log System </a> </font></td>
	</tr>
<?php	/*
	<tr>
		<td align="left" valign="top"><font size="2"
			face="MS Sans Serif, Tahoma, sans-serif"><a
				href="index.php?case_i=48">รายงาน Log Mail System</a> </font></td>
	</tr>
	*/
	?>
 
	<?php /*
	<tr>
		<td align="left" valign="top"><font size="2"
			face="MS Sans Serif, Tahoma, sans-serif"><a
				href="index.php?case_i=54">รายงาน Log อุปกรณ์ใน Network</a> </font>
		</td>
	</tr>
	*/?>
	<tr>
		<td align="left" valign="top"><font size="2"
			face="MS Sans Serif, Tahoma, sans-serif"><a
				href="index.php?case_i=37">รายการ&nbsp;Mac สมาชิกที่ Login</a> </font>		</td>
	</tr>

 
<!--	<tr>
		<td align="left" valign="top"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> <a 	href="list_proxy.php" target="_blank">รายงานการเข้าเว็บ</a></font>			</td>
	</tr>-->
	<tr>
		<th align="left" valign="top" bgcolor="#66CCFF"  > 
 	 
		<font size="4" face="MS Sans Serif, Tahoma, sans-serif"><img src="./images/docs.png" alt="" width="22" height="22" /> 
		รายงาน การใช้		</font> </div></th>
	</tr>
	<?php /*
	<tr>
		<td align="left" valign="top"><font size="2"
			face="MS Sans Serif, Tahoma, sans-serif"><a
				href="index.php?case_i=23">รายงานสรุปกราฟ</a> </font></td>
	</tr>

	<tr>
		<td align="left" valign="top"><font size="2"
			face="MS Sans Serif, Tahoma, sans-serif"><a href="msword_shot.php">รายงานการเข้าใช้<br>
					(ประจำเดือน)</a> </font></td>
	</tr>
	*/	?>
	<tr>
		<td align="left" valign="top"><font size="2"
			face="MS Sans Serif, Tahoma, sans-serif"><a href="index.php?case_i=10">รายงานการ Login ของสมาชิก</a> </font></td>
	</tr>
	<tr>
		<td align="left" valign="top"><font size="2"
			face="MS Sans Serif, Tahoma, sans-serif"><a
				href="index.php?case_i=60">รายงานจำนวนออนไลน์แยกตามวัน</a> </font></td>
	</tr>
	<tr>
		<td align="left" valign="top"><font size="2"
			face="MS Sans Serif, Tahoma, sans-serif"><a
				href="index.php?case_i=62">รายงานจำนวนออนไลน์แยกตามเวลา</a> </font></td>
	</tr>
	<tr>
		<td align="left" valign="top"><font size="2"
			face="MS Sans Serif, Tahoma, sans-serif"><a
				href="index.php?case_i=63">รายงานการใช้เน็ตแยกตามสัปดาห์</a> </font>		</td>
	</tr>
	<tr>
		<td align="left" valign="top"><font size="2"
			face="MS Sans Serif, Tahoma, sans-serif"><a
				href="index.php?case_i=64">รายงานการใช้เน็ตแยกตามเดือน</a> </font></td>
	</tr>
	<?php /* 
	<tr>
		<td align="left" valign="top"><font size="2"
			face="MS Sans Serif, Tahoma, sans-serif"><a
				href="index.php?case_i=67">รายงานการใช้ VPN</a> </font></td>
	</tr>
*/	?>
	<tr>
		<th align="left" valign="top" bgcolor="#66CCFF"> 
	 
		<font size="4" face="MS Sans Serif, Tahoma, sans-serif"><img src="./images/url.gif" alt="" width="22" height="22" /> 
			ควบคุมการเข้าใช้อินเตอร์เน็ต		</font> </div>		</th>
	</tr>
	<?php /*
	<tr>
		<td align="left" valign="top"><font size="2"
			face="MS Sans Serif, Tahoma, sans-serif"><a
				href="index.php?case_i=14">บล๊อคเว็บ</a> </font></td>
	</tr>
	<?php /*
	<tr>
		<td align="left" valign="top"><font size="2"
			face="MS Sans Serif, Tahoma, sans-serif"><a
				href="index.php?case_i=51">Limit Download Files</a> </font></td>
	</tr>
	
 
	<tr>
		<td align="left" valign="top"><font size="2"
			face="MS Sans Serif, Tahoma, sans-serif"><a
				href="index.php?case_i=45">บล๊อค Macaddress</a> </font></td>
	</tr>
	*/ ?>
 
 	<tr>
		<td align="left" valign="top"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><a 	href="index.php?case_i=80">Neighbor</a> </font></td>
	</tr>
	<tr>
		<td align="left" valign="top"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><a 	href="index.php?case_i=16">เพิ่ม/แก้ไขกลุ่มความเร็ว</a> </font></td>
	</tr>
<!-- <tr>
		<td align="left" valign="top"><font size="2"
			face="MS Sans Serif, Tahoma, sans-serif"><a
				href="index.php?case_i=77">ตั้งค่าระบบ QOS</a> </font></td>
	</tr>-->
	<tr>
		<th align="left" valign="top" bgcolor="#66CCFF"> 
  
		<font size="4" face="MS Sans Serif, Tahoma, sans-serif"><img src="./images/document.png" alt="" width="22" height="22" /> 
		ตั้งค่า		</font> </div>		</th>
	</tr>
	<tr>
		<td align="left" valign="top"><font size="2"
			face="MS Sans Serif, Tahoma, sans-serif"><a
				href="index.php?case_i=32">ข่าวหน้าแรก</a> </font></td>
	</tr>
		<?php /*
	<tr>
		<td align="left" valign="top"><font size="2"
			face="MS Sans Serif, Tahoma, sans-serif"><a
				href="index.php?case_i=33">จัดการ LOGO</a> </font></td>
	</tr>

 
	<tr>
		<td align="left" valign="top"><font size="2"
			face="MS Sans Serif, Tahoma, sans-serif"><a
				href="index.php?case_i=36">ตังค่า ระบบ </a> </font></td>
	</tr>	
	*/?>
 <tr>
		<td align="left" valign="top"><font size="2"
			face="MS Sans Serif, Tahoma, sans-serif"><a href="index.php?case_i=8">รับแจ้งปัญหา</a>
		</font></td>
	</tr>
	<tr>
		<td align="left" valign="top"><font size="2"
			face="MS Sans Serif, Tahoma, sans-serif"><a href="index.php?case_i=9">รายงานปัญหา
			</a> </font></td>
	</tr>
 		<tr>
		<td align="left" valign="top"><font size="2"
			face="MS Sans Serif, Tahoma, sans-serif"><a
				href="index.php?case_i=75">ตั้งค่าระบบส่ง sms</a> </font></td>
	</tr>
		<th align="left" valign="top" bgcolor="#66CCFF"> 
		 
		<font size="4" face="MS Sans Serif, Tahoma, sans-serif"><img src="./images/MSN.gif" alt="" width="22" height="22" /> 
	ผู้ดูแลระบบ		</font></div>		</th>
	</tr>
	<tr>
		<td align="left" valign="top"><font size="2"
			face="MS Sans Serif, Tahoma, sans-serif"><a
				href="index.php?case_i=12">เพิ่มผู้ดูแลระบบ</a> </font></td>
	</tr>
	<?php 
	/*<tr>
		<td align="left" valign="top"><a href="index.php?case_i=29"><font
				size="2" face="MS Sans Serif, Tahoma, sans-serif">สำรองข้อมูล</font>
		</a></td>
	</tr>
	*/
	?>

	<tr>
		<td align="left" valign="top"><font size="2"
			face="MS Sans Serif, Tahoma, sans-serif"><a
				href="index.php?case_i=68">รายงาน เข้าใช้งานของแอดมิน</a> </font></td>
	</tr>
	<tr>
		<td align="left" valign="top"><font size="2"
			face="MS Sans Serif, Tahoma, sans-serif"><a
				href="index.php?case_i=70">รายการการพยายามเข้าใช้ระบบ</a> </font>		</td>
	</tr>
	<tr>
		<td align="left" valign="top" bgcolor="#FFFFCC"><font size="2"
			face="MS Sans Serif, Tahoma, sans-serif"><a href="logout.php">ออกจากระบบ</a>
		</font></td>
	</tr>
</table>

