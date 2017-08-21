<?php
@ini_set('display_errors', '0');
$ip = $_SERVER['REMOTE_ADDR'];
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf8">
<title>Thaigqsoft Mail Server Online</title>
 </head>
 
<body background="images/bg.jpg">
 <?php
	if ($Submit2=="sendmail") {  
    	 
     
  $textarea=$_GET['textarea'];
  $subject=$_GET['subject'];
  $mailadmin_send=$_GET['email'];
 
  
  ###### ส่งเข้าเมล  
         include_once('PHPMailer/class.phpmailer.php');
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
        </font></div></td>
									  </tr>
									</table>';
	 
 
###################
$mail=new PHPMailer();
$mail->IsSMTP();
$mail->IsHTML(true);
$mail->SMTPAuth = "true";
$mail->SMTPSecure = "ssl";
$mail->Host ="smtp.gmail.com";
$mail->Port = 465;
$mail->CharSet = 'utf-8';
 
$mail->Username = "admin@thaigqsoft.com";
$mail->Password = "tanakornp2002";
 
 
 
//$subject= iconv( 'TIS-620', 'UTF-8', "$subject");
$mail->Subject = "$subject ";
$mail->AltBody = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
//$msg= iconv( 'TIS-620', 'UTF-8', "$msg");
$mail->MsgHTML($msg);
$mail->AddAddress("$mailadmin_send" ); 
if($mailadmin_send !='admin@thaigqsoft.com') 
{ 
$mail->AddAddress("admin@thaigqsoft.com" ); 
}
if($mailadmin_send !=''){
 if($mail->Send()){ print "$mailadmin_send mail OK";}else { echo "NO OK";}
 
}
 				 }
 
																				
	
 
	
 
		?>        
         
      
<p>&nbsp;</p>
</body>
</html>
