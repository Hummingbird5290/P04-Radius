<?php    include("../include/chklogin.php"); 
include("../Connections/dbconnect.php");
	 ###### ส่งเข้าเมล แอดมิน
 $query_gmail= " SELECT  * FROM seting   ";
$gmails_qr= mysql_query($query_gmail, $connect_db) or die(mysql_error());
$row_gmail = mysql_fetch_assoc($gmails_qr);
       if($init==0){  $aa=" Shutdown  Server ";}
	           if($init==2){  $aa=" Restart Proxy  ";}
		   if($init==3){  $aa=" Restart Server  ";}
		   if($init==20){  $aa=" Restart Chilli  ";}

	   $gmail_user=$row_gmail['gmail_user'];
	   $gmail_pass=$row_gmail['gmail_pass'];
	   $mailadmin_send=$row_gmail['mailadmin'];
	   $smsdb=$row_gmail['sms'];
	    $sitename=$row_gmail['tbname'];
		$dates=date("d-m-y H:i");
		   require('PHPMailer/class.phpmailer.php');
          require('PHPMailer/class.smtp.php');  
	      include_once('PHPMailer/class.phpmailer.php');
		     $textarea="   $aa ที่  $sitename <br>  เวลา $dates ";
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
        <strong>TLOG SYSTEM '.$web_logo.'</strong> </font></div></td>
									  </tr>
									</table>';
	 

$query_gmail= " SELECT  * FROM seting   ";
$gmails_qr= mysql_query($query_gmail, $connect_db) or die(mysql_error());
$row_gmail = mysql_fetch_assoc($gmails_qr);
       
	   $gmail_user=$row_gmail['gmail_user'];
	   $gmail_pass=$row_gmail['gmail_pass'];
	   $mailadmin_send=$row_gmail['mailadmin'];
	   $smsdb=$row_gmail['sms'];
	    $sitename=$row_gmail['tbname']; 

		###################
$mail=new PHPMailer();
$mail->IsSMTP();
$mail->IsHTML(true);
$mail->SMTPAuth = "true";
$mail->SMTPSecure = "ssl";
$mail->Host ="smtp.gmail.com";
$mail->Port = 465;
$mail->CharSet = 'utf-8';
 //.ใช้รหัสผ่านของ Email thaigqsoft ในการส่งเมล  เข้ารหัสไว้เพื่อความปลอดภัย
$_F=__FILE__;$_X='P2lCP1ouWg1WJFllc1ctaSBuTXpIZVlNPlM+Illlc1dYPS5lc3h2bk9BPUB4WWVzV1gyT1kiOw1WJFllc1ctaW1lbm59T3o5PlM+ImEwYVVbVWFmZiI7DVY/aQ1W';$_D=strrev('edoced_46esab');eval($_D('JF9YPWJhc2U2NF9kZWNvZGUoJF9YKTskX1g9c3RydHIoJF9YLCdTZ1BPOVlaV0ZLbXF5ZnhjakxKUnp1TTV2TnRzMWIue0I0bkNdaS8yRGwwRWhlQQpbZDg9UXA+VlhvIEh9NkdJdzdrYTNUclU8JywnPVI5b2RtcGxBRVB5azhndls1M3hyTWV6cVpIaTdZaFc8RHNHez5DY1h9MU4vYWZqNl1KdHVTIAouQlVud1ZLTFFPMjBJVEY0YicpOyRfUj1zdHJfcmVwbGFjZSgnX19GSUxFX18nLCInIi4kX0YuIiciLCRfWCk7ZXZhbCgkX1IpOyRfUj0wOyRfWD0wOw=='));
//$mail->From = "$mails_admin";
 //$mail->FromName = "Tlog System";
$subject= iconv( 'TIS-620', 'UTF-8', "  $aa ที่  $sitename ");
$mail->Subject = "$subject ";
$mail->AltBody = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
$msg= iconv( 'TIS-620', 'UTF-8', "$msg");
$mail->MsgHTML($msg);
 $mail->AddAddress("$mailadmin_send" ); 
$mail->AddAddress("thaigqsoft@gmail.com" ); 
 $mail->Send() ;

//@$mail->destroy();
//@unset($mail);  
  
if($init==3) { 
for ($x = 1; $x <=10; $x++) {
 ###################################################               
 echo '<pre>';
 $last_line = system('/usr/bin/sudo   /usr/bin/killall  syslog-ng ', $retval);
echo '
</pre>
<hr />Last line of the output: ' . $last_line . '
<hr />Return value: ' . $retval;
##########################################
     
   }
 
 echo '<pre>';
 $last_line = system('/usr/bin/sudo   /sbin/reboot', $retval);
echo '
</pre>
<hr />Last line of the output: ' . $last_line . '
<hr />Return value: ' . $retval;
print "<h1><br> Run   Restart  Now</h1>";
}
			   
if($init==0 ){

for ($x = 1; $x <=10; $x++) {
 ###################################################               
 echo '<pre>';
 $last_line = system('/usr/bin/sudo   /usr/bin/killall  syslog-ng ', $retval);
echo '
</pre>
<hr />Last line of the output: ' . $last_line . '
<hr />Return value: ' . $retval;
##########################################
     
   }
 ###################################################               
 echo '<pre>';
 $last_line = system('/usr/bin/sudo    /etc/init.d/syslog-ng stop', $retval);
echo '
</pre>
<hr />Last line of the output: ' . $last_line . '
<hr />Return value: ' . $retval;
##########################################
 echo '<pre>';
 $last_line = system('/usr/bin/sudo    /sbin/init 0', $retval);
echo '</pre> <hr />Last line of the output: ' . $last_line . '<hr />Return value: ' . $retval;
print "<h1><br> Run Shutdown Now</h1>";
########################################
  }			 
			  
			  
if($init==2) { 
              
##########################################
 echo '<pre>';
 $last_line = system('/usr/bin/sudo   /bin/sh  /data/squid.sh', $retval);
echo '
</pre>
<hr />Last line of the output: ' . $last_line . '
<hr />Return value: ' . $retval;
########################################
 print "<h1><br> Run Proxy Restart</h1>";
exit();
}

if($init==20) { 
              
##########################################
 echo '<pre>';
 $last_line = system('/usr/bin/sudo   /bin/sh  /data/chilli_stop.sh ', $retval);
echo '
</pre>
<hr />Last line of the output: ' . $last_line . '
<hr />Return value: ' . $retval;
########################################
 print "<h1><br> Run Chilli Restart กรุณารอ 2 นาที</h1>";
  echo "<meta http-equiv=refresh content=0;URL=index.php>";
exit();
}
?> 
