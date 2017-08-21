
<?php 
if ($_SERVER['HTTP_CLIENT_IP']) {
	$IP = $_SERVER['HTTP_CLIENT_IP'];
} elseif (preg_match("/[0-9]/",$_SERVER["HTTP_X_FORWARDED_FOR"] )) {
	$IP = $_SERVER["HTTP_X_FORWARDED_FOR"];
} else {
	$IP = $_SERVER["REMOTE_ADDR"];
}

// ฟังก์ชั่นตรวจสอบการโพส



include("Connections/dbconnect.php");

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=windows-874">
<title>กำลังส่ง เมลล์</title>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
}

.style24 {
	font-family: "MS Sans Serif", Sans-serif, "Microsoft Sans Serif";
	font-size: 10;
}

.style25 {
	font-size: 10
}

.style27 {
	font-size: 10;
	color: #FF0000;
}

.style30 {
	font-family: "MS Sans Serif", Sans-serif, "Microsoft Sans Serif";
	font-weight: bold;
}
-->
</style>
</head>

<body>
	<?php
	$subject = "TLOG Password  To Internet";



	## Please Don't delete it. It will Error.  You can tell me about bug of program this way ##


	require('PHPMailer/class.phpmailer.php');
	require('PHPMailer/class.smtp.php');

	$WebMaster="admin@thaigqsoft.com";
	mysql_select_db($database_edoc);
	$query_Recordset1 = " SELECT  *      FROM  register   WHERE email = '$mail_send'         ";
	$Recordset1 = mysql_query($query_Recordset1, $connect_db) or die(mysql_error());
	$row_Recordset1 = mysql_fetch_assoc($Recordset1);
	$UserEmail=$row_Recordset1['email'];
	$UserName=$row_Recordset1['UserName'];

	# DECODE(pass,'thaigqsoft')
	$query_Recordset1 = " SELECT    *,DECODE(pass,'thaigqsoft')  as upass FROM  radpostauth   WHERE user = '$UserName'     and reply='Access-Accept'   order by date DESC    ";
	$Recordset1 = mysql_query($query_Recordset1, $connect_db) or die(mysql_error());
	$row_Recordset1 = mysql_fetch_assoc($Recordset1);

	$UserName=$row_Recordset1['user'];
	$password=$row_Recordset1['upass'];

	# ดึงชื่อหอพัก
	$f=fopen("/etc/hostname", "r");
	$sitename=fread($f, 100);
	fclose($f);

	$textarea=" ชื่อเข้าใช้งานคือ $UserName <br> รหัสผ่านคือ   $password   ";
	$msg ='<table width="800" border="0" align="center">
	<tr>

	<td height="38" bgcolor="#FF9900"><span class="style1"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">รายละเอียด</font></strong></span>

	<div align="right"></div></td>
	</tr>
	<tr>
	<td bgcolor="#FFFFCC"> '.$textarea.'</td>
	</tr>
	<tr>
	<td bgcolor="#FFFFCC"><div align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><br>
	<strong>TLOG SYSTEM ('.$web_logo.')</strong> </font></div></td>
	</tr>
	</table>';



	if($UserEmail==''  or  $password=='' ){

		echo                  "<script type=text/javascript>";
		echo                  "alert('ไม่สามารถส่ง Mail ได้กรุณาติดต่อผู้ดูแลระบบ   ')";
		echo                  "</script>";
		echo "<meta http-equiv='refresh' content='0; url=index.php'>" ; exit();

	}

	$query_gmail= " SELECT   gmail_user,gmail_pass FROM seting   ";
	$gmails_qr= mysql_query($query_gmail, $connect_db) or die(mysql_error());
	$row_gmail = mysql_fetch_assoc($gmails_qr);

	$gmail_user=$row_gmail['gmail_user'];
	$gmail_pass=$row_gmail['gmail_pass'];
	###################
	$mail=new PHPMailer();
	$mail->IsSMTP();
	$mail->IsHTML(true);
	$mail->SMTPAuth = "true";
	$mail->SMTPSecure = "ssl";
	$mail->Host ="smtp.gmail.com";
	$mail->Port = 465;
 
	 $mail->Username = "admin@thaigqsoft.com";
	 $mail->Password = "tanakornp2002";
	 
	//.ใช้รหัสผ่านของ Email thaigqsoft ในการส่งเมล  เข้ารหัสไว้เพื่อความปลอดภัย
	//$_F=__FILE__;$_X='P2lCP1ouWg1WJFllc1ctaSBuTXpIZVlNPlM+Illlc1dYPS5lc3h2bk9BPUB4WWVzV1gyT1kiOw1WJFllc1ctaW1lbm59T3o5PlM+ImEwYVVbVWFmZiI7DVY/aQ1W';$_D=strrev('edoced_46esab');eval($_D('JF9YPWJhc2U2NF9kZWNvZGUoJF9YKTskX1g9c3RydHIoJF9YLCdTZ1BPOVlaV0ZLbXF5ZnhjakxKUnp1TTV2TnRzMWIue0I0bkNdaS8yRGwwRWhlQQpbZDg9UXA+VlhvIEh9NkdJdzdrYTNUclU8JywnPVI5b2RtcGxBRVB5azhndls1M3hyTWV6cVpIaTdZaFc8RHNHez5DY1h9MU4vYWZqNl1KdHVTIAouQlVud1ZLTFFPMjBJVEY0YicpOyRfUj1zdHJfcmVwbGFjZSgnX19GSUxFX18nLCInIi4kX0YuIiciLCRfWCk7ZXZhbCgkX1IpOyRfUj0wOyRfWD0wOw=='));
	$mail->Subject = "$subject ";
	$mail->AltBody = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
	$mail->MsgHTML($msg);





	###################
	if($UserEmail ==null) {
	}
	$mail->AddAddress("$UserEmail");


	if(!$mail->Send()) {
		echo                  "<script type=text/javascript>";
		echo                  "alert('ไม่สามารถส่ง Mail ได้กรุณาติดต่อผู้ดูแลระบบ   ')";
		echo                  "</script>";
		echo "<meta http-equiv='refresh' content='0; url=index.php'>" ; exit();

	}else
	{
		echo                  "<script type=text/javascript>";
		echo                  "alert(' ส่ง ข้อมูลไปที่  Mail $UserEmail ได้แล้ว')";
		echo                  "</script>";
		echo "<meta http-equiv='refresh' content='0; url=index.php'>" ; exit();
	}
	//#####################################
	?>

</body>
</html>
