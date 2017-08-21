 <?php 
 
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
.style24 {font-family: "MS Sans Serif", Sans-serif, "Microsoft Sans Serif"; font-size: 10; }
.style25 {font-size: 10}
.style27 {font-size: 10; color: #FF0000; }
.style30 {
	font-family: "MS Sans Serif", Sans-serif, "Microsoft Sans Serif";
	font-weight: bold;
}
-->
</style>
</head>

<body>
<?php
$subject = "แจ้งรหัสผ่าน";

 
 
## Please Don't delete it. It will Error.  You can tell me about bug of program this way ##
       
      include_once('PHPMailer/class.phpmailer.php');
	  $WebMaster="admin@thaigqsoft.com";
	   mysql_select_db($database_edoc, $connect_db)  or trigger_error(mysql_error(),E_USER_ERROR);
$query_Recordset1 = " SELECT  *      FROM register   WHERE email = '$mail_send'         ";
$Recordset1 = mysql_query($query_Recordset1, $connect_db) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
      $UserEmail=$row_Recordset1['email'];
	   $UserName=$row_Recordset1['UserName'];
	    $password=$row_Recordset1['password'];
       $textarea=" ชื่อเข้าใช้งานคือ $UserEmail <br> รหัสผ่านคือ   $password   ";
	 

		 
	$msg ='<table width="800" border="0" align="center">
									  <tr> 
										
    <td height="38" bgcolor="#FF9900"><span class="style1"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">รายละเอียด</font></strong></span> 
      isylzjko 
      <div align="right"></div></td>
									  </tr>
									  <tr> 
										<td bgcolor="#FFFFCC"> '.$textarea.'</td>
									  </tr>
									  <tr> 
										<td bgcolor="#FFFFCC"><div align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><br>
        <strong>TLOG SYSTEM (www.thaigqsoft.com)</strong> </font></div></td>
									  </tr>
									</table>';
	 

 
 
 
 //#########################################
$mail    = new PHPMailer();
$mail->Host = "127.0.0.1";
$mail->Port = "25";
//$mail->SMTPAuth = false;
//$mail->Username = 'tanakornp@tttmaxnet.com';
//$mail->Password = '010464088';
$mail->Mailer = 'smtp';
$mail->IsHTML(true);
//$mail->CharSet = 'UTF-8';
 



$mail->From     = "admin@thaigqsoft.com";
//$mail->FromName = "ผู้ดูแลระบบ";

$mail->Subject = "$subject ";

$mail->AltBody = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

$mail->MsgHTML($msg);


if($UserEmail ==null) {                  }
$mail->AddAddress("$UserEmail");


if(!$mail->Send()) {   echo "Mailer Error: " . $mail->ErrorInfo;
		                                       echo                  "<script type=text/javascript>";
							                   echo                  "alert('ไม่สามารถส่ง Mail ได้กรุณาติดต่อผู้ดูแลระบบ   ')";
							                   echo                  "</script>";
						    echo "<meta http-equiv='refresh' content='0; url=index.php'>" ; exit();
 
}else 
              {
		                                       echo                  "<script type=text/javascript>";
							                   echo                  "alert(' ส่ง รหัสผ่านไที่  Mail $UserEmail ได้แล้ว')";
							                   echo                  "</script>";
					       echo "<meta http-equiv='refresh' content='0; url=index.php'>" ; exit();
																					 }
//#####################################
 ?>
 
</body>
</html>
