<?
include("Connections/dbconnect.php");
$domain_system=$_GET['domain'];
function randomToken($len) {
	srand( date("s") );
	#$chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
	//$chars ="ABCDEFGHIJKLMQRSTUVWXYZ";
	$chars = "123456789"; // กำหนดอักขษะที่จะนำมา random แก้ได้นะ
	$ret_str = "";
	$num = strlen($chars);
	for($i=0; $i < $len; $i++) {
		$ret_str.= $chars[rand()%$num]; // ใช้ฟังชั่น rand() เข้ามาช่วยในการทำงาน
	}
	return $ret_str;
}
include("include/function.php");
$date_active_card=date("Y-m-d H:i:s");

if($sumbit=='เติมเวลา'   ) {

	$per = preg_replace("/ /i", "", $per);
	$idcard = preg_replace("/ /i", "", $idcard);
	if($chk_num !=$code1) {
		echo                  "<script type=text/javascript>";
		echo                  "alert('กรุณา กรอกข้อมูล รหัสรักษาความปลอดภัยให้ตรงกับรูปภาพ            ')";
		echo                  "</script>";
		echo "<meta http-equiv=refresh content=0;URL=index.php?case_i=9>";
		exit();
	}
	$time_active=date("H:i:s");

	if($per ==""  or $idcard=="" ) {
		echo                  "<script type=text/javascript>";
		echo                  "alert('กรุณา กรอกข้อมูล ให้ครบ             ')";
		echo                  "</script>";
		echo "<meta http-equiv=refresh content=0;URL=index.php?case_i=9>";
		exit();
	}

 
	$todates_chk=date("Y-m-d");
	$query_user = "select  * from card      where idcard='$idcard'  and  domain='$domain_system'   "; // and idcard  not in  (    select  idcard  from table_card_user   )       ";
	$type_db = mysql_query($query_user, $connect_db) or die(mysql_error());
	$row_Recordset1 = mysql_fetch_assoc($type_db);
	$totalRows_user= mysql_num_rows($type_db);
	$GroupName=$row_Recordset1['GroupName'];

	if($totalRows_user==0  ) {   //ตรวจสอบว่า มี cardid นี้อยุ่หรือไม่
		  
                  
					echo                  "<script type=text/javascript>";
		            echo                  "alert(' ไม่มีหมายเลขบัตรนี้ในระบบ ')";
		             echo                  "</script>";	   
					 echo "<meta http-equiv=refresh content=0;URL=index.php?case_i=6>";
	            	exit();
 }
 
	if($row_Recordset1[active]==1   ) {   //ตรวจสอบว่า มี cardid นี้อยุ่หรือไม่
		  
   echo "<h2><center>('บัตรนี้ ถูกใช้งานไปแล้ว  เมื่อ     ". date_to_thai_return($row_Recordset1[time_active])."   โดยผู้ใช้  $row_Recordset1[UserName] ')</center></h2><br>";
		        echo "<h1><center> <a href='index.php?case_i=6'> กลับไปหน้าเติมบัตร</a></center></h1>";
					 
	            	exit();
 }  else {
		//      $query_user2 = "select  * from register      where per='$per'  and password=md5('$password')   and   status='1'     ";
		$query_user2 = "select  * from register      where per='$per'     and   status='1'  and  domain='$domain_system'    ";
		$type_user2 = mysql_query($query_user2, $connect_db) or die(mysql_error());
		$row_Recordset2 = mysql_fetch_assoc($type_user2);
		$a_name=$row_Recordset2[UserName];
		$totalRows_user2= mysql_num_rows($type_user2);
		if($totalRows_user2 ==0   ) {
			echo                  "<script type=text/javascript>";
			echo                  "alert('ไม่มีผู้ใช้นี้ในระบบ  ')";
			echo                  "</script>";
			echo "<meta http-equiv=refresh content=0;URL=index.php?case_i=6>";
			exit();
		}   else {
			if($row_Recordset1[type_time]=='ชั่วโมง'  or $row_Recordset1[type_time]=='นาที' ) {
				$query_time= "select  *  from radcheck      where UserName='$a_name'   and Attribute='Expiration'              ";
				$type_time = mysql_query($query_time, $connect_db) or die(mysql_error());
				$row_time_db = mysql_fetch_assoc($type_time);
				$date_db=$row_time_db[Value];
				#ทำการแยกวันที่ เวลา จากตัวแปร  $date_db มาเป็น array
				$a_time= explode(" ",$date_db) ;
				$a_time[0];  //วัน
				$a_time[1];  //เดือน
				$a_time[2];  //ปี
				#แปลง เดือน เป็น ตัวเลข
				$a_time[1]=re_name($a_time[1]);
				$date_db="$a_time[2]-$a_time[1]-$a_time[0]";
				$date_now=date("Y-m-d");
				$cal_date=(strtotime($date_now) - strtotime($date_db) ) / ( 60 * 60 * 24 );
				$cal_date2=(strtotime($date_db) - strtotime($date_now) ) / ( 60 * 60 * 24 );
				$ddtodays=date("Y-m-d");
				if($cal_date < 0  or ( $cal_date == 0 or  $date_db  <=$ddtodays )   ) {

					###### ลบฟิว  ของ จำนวนชั่วโมงทิ้ง
					mysql_query("delete   from   radcheck  where  UserName='$a_name'     and  Attribute='Max-All-Session'  ") ;
					###### ลบฟิว  ของ จำนวนวันทิ้ง
					mysql_query("delete   from   radcheck  where  UserName='$a_name'     and  Attribute='Expiration'  ") ;
					#ดึงเวลาปัจจุบันมา เพื่อ กำหนดวันสุดท้ายที่จะใช้ระบบได้
					$date_add_db=date('Y-m-d', mktime(0,0,0, date('m'),date('d')+ $row_Recordset1[H_end],date('Y')));
					#แปลงวันที่ให้อยู่ในรูป radius
					$radius_time= explode("-",$date_add_db) ;
					$radius_time[2];  //วัน
					$radius_time[1];  //เดือน
					$radius_time[0];  //ปี
					$date_add_db2=re_name2($radius_time[1]);
					$Hourts=date("H:i:s");
					$date_add_db="$radius_time[2] $date_add_db2 $radius_time[0] $Hourts";
					$H_end=$row_Recordset1[date_end]*60*60;
					$H_end_times=$row_Recordset1[date_end];
					if($row_Recordset1[type_time] !='ชั่วโมง') {
						mysql_query("INSERT INTO  radcheck  (UserName,Attribute,op,Value)
								values('$a_name','Expiration',':=','$date_add_db')")  	or    die ("Add ข้อมูลลง Table ไม่ได้ ");
					}
					mysql_query("INSERT INTO  radcheck  (UserName,Attribute,op,Value)   values('$a_name','Max-All-Session',':=','$H_end_times')")
					or    die ("Add ข้อมูลลง Table ไม่ได้ ");



					update("usergroup", "GroupName='$GroupName'  "," where UserName='$a_name'     ");

					update("radacct", "AcctSessionTime='0'  "," where UserName='$a_name'     ");

					update("card", "active='1' , UserName='$a_name' ,time_active='$date_active_card'   "," where idcard='$idcard'   and  domain='$domain_system'     ");
 
					mysql_query("INSERT INTO  table_card_user  (idcard,UserName,active)   values('$idcard','$a_name','1','$domain_system')")
					or    die ("Add ข้อมูลลง Table ไม่ได้ ");
					if($row_Recordset1[type_time]=='ชั่วโมง' or $row_Recordset1[type_time]=='นาที' ) {
						$msg_s ='เรียบร้อยแล้ว' ;
					} else {
						$msg_s= " เรียบร้อยแล้ว วันหมดอายุการใช้งาน คือ  $date_add_db ";
					}

					echo                  "<script type=text/javascript>";
					echo                  "alert('$msg_s')";
					echo                  "</script>";
					echo "<meta http-equiv=refresh content=0;URL=index.php?case_i=200>";
					exit();
					###########################
				}   else {

					echo                  "<script type=text/javascript>";
					echo                  "alert('เวลาในระบบของท่านยังไม่หมดไม่สามารถเติมแบบ ชั่วโมงได้  ')";
					echo                  "</script>";
					echo "<meta http-equiv=refresh content=0;URL=index.php?case_i=200>";
					exit();
				}

			} else { // echo "วัน";
				############### ดึงวันที่ หมดอายุในฐานข้อมูลมาอัพเดท ######

				$query_time= "select  *  from radcheck      where UserName='$a_name'   and Attribute='Expiration'              ";
				$type_time = mysql_query($query_time, $connect_db) or die(mysql_error());
				$row_time_db = mysql_fetch_assoc($type_time);
				$date_db=$row_time_db[Value];

				#ทำการแยกวันที่ เวลา จากตัวแปร  $date_db มาเป็น array
				$a_time= explode(" ",$date_db) ;
				$a_time[0];  //วัน
				$a_time[1];  //เดือน
				$a_time[2];  //ปี
				#แปลง เดือน เป็น ตัวเลข
				$a_time[1]=re_name($a_time[1]);
				$date_db="$a_time[2]-$a_time[1]-$a_time[0]";
				$date_now=date("Y-m-d");
				$cal_date=(strtotime($date_now) - strtotime($date_db) ) / ( 60 * 60 * 24 );
				$cal_date2=(strtotime($date_db) - strtotime($date_now) ) / ( 60 * 60 * 24 );
				#ถ้า $cal_date  > 0  ต้องเอาผลต่างมาบวก เพื่อเพิ่มวัน แต่ ถ้า < 0 ก็แค่เพิ่มวัน register ไป
				#กรณียังมีวันเหลือในฐานข้อมูล แต่ซื้อเงินมาเติมวันเพิ่ม
				if($cal_date < 0   ) {
					//	$aaaaaa=1;
					include("no_user_time.php");
					echo                  "<script type=text/javascript>";
					echo                  "alert('เวลาในระบบของท่านยังไม่หมดไม่สามารถเติมได้  ')";
					echo                  "</script>";
					echo "<meta http-equiv=refresh content=0;URL=index.php?case_i=200>";
					exit();
				}

				#########  ยังมีเวลาเหลือในระบบ ให้บวกเพิ่ม  ๒๒๒๒๒๒๒
				if($cal_date > 0   or  $cal_date ==0) {  #upใน db เพิ่ม
					$date_add_db=date('Y-m-d', mktime(0,0,0, date('m'),date('d')+ $row_Recordset1[date_end],date('Y')));
				#แปลงวันที่ให้อยู่ในรูป radius
				$radius_time= explode("-",$date_add_db) ;
				$radius_time[2];  //วัน
				$radius_time[1];  //เดือน
				$radius_time[0];  //ปี
				$date_add_db2=re_name2($radius_time[1]);
				$Hourts=date("H:i:s");
				$date_add_db="$radius_time[2] $date_add_db2 $radius_time[0] $Hourts";
				//echo " +  $date_add_db";

				mysql_query("delete   from   radcheck  where  UserName='$a_name'     and  Attribute='Expiration'  ") ;
				mysql_query("INSERT INTO  radcheck  (UserName,Attribute,op,Value)   values('$a_name','Expiration',':=','$date_add_db')") or    die ("Add ข้อมูลลง Table ไม่ได้ ");

				update("usergroup", "GroupName='$GroupName'  "," where UserName='$a_name'     ");
				update("card", "active='1' , UserName='$a_name' ,time_active='$date_active_card'   "," where idcard='$idcard'       ");

				###### ลบฟิว  ของ จำนวนชั่วโมงทิ้ง
				mysql_query("delete   from   radcheck  where  UserName='$a_name'     and  Attribute='Max-All-Session'  ") ;
				update("radacct", "AcctSessionTime='0'  "," where UserName='$a_name'     ");
				###########################
				mysql_query("INSERT INTO  table_card_user  (idcard,UserName,active,domain)   values('$idcard','$a_name','1','$domain_system')") or    die ("Add ข้อมูลลง Table ไม่ได้ ");
				echo                  "<script type=text/javascript>";
				echo                  "alert('เรียบร้อยแล้ว วันหมดอายุการใช้งาน คือ  $date_add_db  ')";
				echo                  "</script>";
				// $aaaaaa=2;
				}


			} //จบ เช็คประเภทเวลา
		}     // จบตรวจสอบว่า มี user นี้อยุ่หรือไม่
	}		 // จบตรวจสอบว่า มี cardid นี้อยุ่หรือไม่
	echo "<meta http-equiv=refresh content=0;URL=index.php?case_i=200>";
	// print  $cal_date ;

} // sumbit
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<title>idcard</title>

<link href="main.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.style12 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
}

.style19 {
	font-weight: bold
}

body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
-->
</style>
</head>

<body>
	<table width="530" height="487" border="0" cellpadding="0"
		cellspacing="0" background="verture.jpg">
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td height="211">&nbsp;</td>
			<td valign="top"><table width="424" border="0" align="center">
					<tr>
						<td width="418"><form action="index.php?case_i=9" method="post"
								enctype="multipart/form-data">
								<table width="100%" border="0" cellspacing="0" cellpadding="0">
									<tr>
										<td width="36%"><div align="right" class="style12">หมายเลขบัตรประชาชน::</div>
										</td>
										<td width="64%"><font size="3"
											face="MS Sans Serif, Tahoma, sans-serif">&nbsp;<span
												class="style25"> <input name="per" type="text" class="input"
													id="per" size="40">
											</span>
										</font></td>
									</tr>
									<tr>
										<td><div align="right" class="style12">หมายเลขบัตร::</div></td>
										<td><font size="3" face="MS Sans Serif, Tahoma, sans-serif"><span
												class="style25"> &nbsp; <input name="idcard" type="text"
													class="input" id="idcard" size="40">
											</span> </font></td>
									</tr>
									<!--        <tr>
                                            <td class="style12">
                                           <div align="right">รหัสผ่านเข้าระบบ</div> </td>
                                            <td><font size="3" face="MS Sans Serif, Tahoma, sans-serif"><span class="style25">&nbsp;
                                                        <input name="password" type="password" class="input" id="password" size="20"   >
                                                    </span></font>
                                                    </td>
                                        </tr>     -->
									<tr>
										<td><div align="right"></div></td>
										<td><div align="left">
												<font color="#0000FF"> &nbsp; <?php   $ran_str = randomToken(4);    ?>
													<img src="pic_text.php?str=<?=$ran_str?>" width="100"
													height="30">
												</font>
											</div></td>
									</tr>
									<tr>
										<td><div align="right">
												<font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>รหัสความปลอดภัย:</strong>
												</font>
											</div></td>
										<td><font color="#0000FF"> &nbsp; <input name="code1"
												type="text" id="code1" size="10" />
										</font></td>
									</tr>
									<tr>
									</tr>
									<tr>
										<td colspan="2">&nbsp;</td>
									</tr>
									<tr>
										<td colspan="2"><div align="center">
												<font size="3" face="MS Sans Serif, Tahoma, sans-serif"> <input
													name="chk_num" type="hidden" id="chk_num"
													value="<?php echo "$ran_str"; ?>" /> <input name="sumbit"
													type="submit" class="input" id="sumbit" value="เติมเวลา">
												</font>
											</div></td>
									</tr>
									<tr>
										<td colspan="2"></td>
									</tr>
								</table>
							</form></td>
					</tr>
				</table></td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td height="129">&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
	</table>
	<br>
	</p>
	<p>&nbsp;</p>
</body>
</html>
