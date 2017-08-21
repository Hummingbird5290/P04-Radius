 <?php 
 include("../include/chklogin.php");
 ini_set('date.timezone ', 'Asia/Bangkok');
 
 if ($_SERVER['HTTP_CLIENT_IP']) { 
$IP = $_SERVER['HTTP_CLIENT_IP'];
} elseif (preg_match("/[0-9]/",$_SERVER["HTTP_X_FORWARDED_FOR"] )) { 
$IP = $_SERVER["HTTP_X_FORWARDED_FOR"];
} else { 
$IP = $_SERVER["REMOTE_ADDR"];
}

// ฟังก์ชั่นตรวจสอบการโพส
	
	
	 
 include("../Connections/dbconnect.php");
 
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
$subject = "TLOG Mail  Send";

 
 
## Please Don't delete it. It will Error.  You can tell me about bug of program this way ##
       
 
	   require('PHPMailer/class.phpmailer.php');
       require('PHPMailer/class.smtp.php');
	   
	  $WebMaster="admin@thaigqsoft.info";
	   mysql_select_db($database_edoc);   

  $data_detail = htmlspecialchars("$data_detail", ENT_QUOTES);	   
 
$data_detail= iconv( 'TIS-620', 'UTF-8', "$data_detail");
	
 	# ดึงชื่อหอพัก
$query_setings = "SELECT  * FROM   seting    ";
$seting_db = mysql_query($query_setings, $connect_db) or die(mysql_error());
$row_admin_seting = mysql_fetch_assoc($seting_db);
$sitename=$row_admin_seting[tbname];

       
  
	 

 
 
 
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
$mail->CharSet = 'utf-8';
$mail->Username = "$gmail_user";
$mail->Password = "$gmail_pass";
 
$mail->Subject = "$subject ";
$mail->AltBody = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

$mail->MsgHTML("$data_detail");

###################
if($alluser !='1'){
$query_Recordset1 = " SELECT  *      FROM  register   WHERE UserName = '$UserName'   and  domain='$domian_name'      ";
$Recordset1 = mysql_query($query_Recordset1, $connect_db) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
       $UserEmail=$row_Recordset1['email'];
	   $UserName=$row_Recordset1['UserName'];
$mail->AddAddress("$UserEmail");

print  "Senting Email To  $UserEmail <br>";
if(!$mail->Send()) {                echo "Mailer Error: " . $mail->ErrorInfo;
		                                       echo                  "<script type=text/javascript>";
							                   echo                  "alert('ไม่สามารถส่ง Mail  ถึง $UserEmail ได้    ')";
							                   echo                  "</script>";  
						    echo "<meta http-equiv='refresh' content='0; url=index.php?case_i=61'>" ; exit();
 
}else 
              {
		                                       echo                  "<script type=text/javascript>";
							                   echo                  "alert(' ส่ง   Mail $UserEmail ได้แล้ว')";
							                   echo                  "</script>";
				  echo "<meta http-equiv='refresh' content='0; url=index.php?case_i=61'>" ; exit();
																					 }
}    //ส่งเมลถึงทุกคน
if($alluser =='1'){
$query_Recordset1 = " SELECT  *      FROM  register     where status='1' and   email <>''  and  domain='$domian_name'   ";
$Recordset1 = mysql_query($query_Recordset1, $connect_db) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
      do { 
	   $UserEmail=$row_Recordset1['email'];
	   $UserName=$row_Recordset1['UserName'];
	   
 unset($mail);
$mail=new PHPMailer();
$mail->IsSMTP();
$mail->IsHTML(true);
$mail->SMTPAuth = "true";
$mail->SMTPSecure = "ssl";
$mail->Host ="smtp.gmail.com";
$mail->Port = 465;
$mail->CharSet = 'utf-8';
$mail->Username = "$gmail_user";
$mail->Password = "$gmail_pass";
 
$mail->Subject = "$subject ";
$mail->AltBody = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
$mail->MsgHTML("$data_detail");
$mail->AddAddress("$UserEmail");
$mail->Send();
print  "Senting Email To  $UserEmail <br>";
} while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); 
}
//#####################################
 ?>
 
</body>
</html>
