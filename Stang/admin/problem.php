<?php
$VLANIP_SERVER=$_SERVER['SERVER_ADDR'] ;
include("../Connections/dbconnect.php");
@ini_set('display_errors', '0');
 

function getIP()
{
	if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	else if (isset($_SERVER['REMOTE_ADDR'])) $ip = $_SERVER['REMOTE_ADDR'];
	else $ip = �UNKNOWN�;
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
	<table width="47%" border="0" align="center" cellpadding="0" cellspacing="0">
		<tr bgcolor="">
			<td height="180" valign="middle" bgcolor="">
			<form name="questionform" method="post" action="problem.php?domain_name=<?php print $domain_name;?>">
					<table width="82%" border="0" align="center" cellpadding="0"
						cellspacing="0">
						<tr>
						  <td height="21" valign="middle" bgcolor="#CCFFFF">&nbsp;</td>
						  <td colspan="2" bgcolor="#CCFFFF"><div align="center">
						    <h2><strong>�駻ѭ�ҡ����ҹ</strong> </h2>
						    �ҡ������ʼ�ҹ��ԡ�����===&gt;&quot;<a href="http://t-voip0.zapto.org:99/forget_pass.php?domain_name=<?php print $domain_name;?>">Click</a>&quot;<br>
						    �ó�����ѵ������������Ţ�ѵ���Ъ��� login ����������âͧ��ҹ����Һ���¤�Ѻ<br>
						    ���ͷ�����˹�ҷ����駢����š�Ѻ�ҧ SMS ����Һ
						     
						    <br>
						  �ҡ��������˹�ҷ����������ö���´��Թ���� � �� </div></td>
					  </tr>
						<tr>
							<td width="17%" height="21" valign="middle" bgcolor="#CCFFFF">&nbsp;</td>
							<td colspan="2" bgcolor="#CCFFFF"><font size="2"
								face="MS Sans Serif, Tahoma, sans-serif"> 
								<input name="name" type="text" class="input" id="name3">
							</font><font size="2"><span class="style1">&nbsp;<font
										color="#FF0000"><strong>&nbsp;</strong> </font><strong><span
											class="txtContent3_orange">���ͼ���� </span> </strong>
								</span> </font>							</td>
						</tr>
						<tr>
							<td height="21" valign="middle" bgcolor="#CCFFFF" class="style9">&nbsp;</td>
							<td colspan="2" bgcolor="#CCFFFF"><font size="2"
								face="MS Sans Serif, Tahoma, sans-serif"> 
								<input name="email" type="text" class="input" id="email">
							</font><font face="MS Sans Serif, Tahoma, sans-serif"><span
									class="style3">&nbsp;</span><span class="txtContent3_orange"><font
										color="#FF0000"><strong>&nbsp;</strong> </font> </span> </font><span
								class="txtContent3_orange"><font color="#FF0000"><strong>Email
											�����</strong> </font> </span></td>
						</tr>
						<tr>
							<td height="21" valign="middle" bgcolor="#CCFFFF">&nbsp;</td>
							<td bgcolor="#CCFFFF"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> <input
									name="email2" type="text" class="input" id="email2"> &nbsp;
							</font><font size="2"><strong><span class="txtContent3_orange">���ͷ����
											Login ����к�</span> </strong> </font>							</td>
							<td bgcolor="#CCFFFF" class="style4">&nbsp;</td>
						</tr>
						<tr>
							<td height="21" valign="middle" bgcolor="#CCFFFF">&nbsp;</td>
							<td bgcolor="#CCFFFF">&nbsp;</td>
							<td bgcolor="#CCFFFF" class="style4">&nbsp;</td>
						</tr>
						<tr>
							<td height="21" valign="middle" bgcolor="#CCFFFF">&nbsp;</td>
							<td bgcolor="#CCFFFF"><span class="style5">�ѭ�ҷ�辺</span></td>
							<td bgcolor="#CCFFFF" class="style4"><font size="2"
								face="MS Sans Serif, Tahoma, sans-serif">&nbsp;</font></td>
						</tr>
						<tr>
							<td height="30" valign="middle" bgcolor="#CCFFFF">&nbsp;</td>
							<td width="57%" bgcolor="#CCFFFF"><font size="2"
								face="MS Sans Serif, Tahoma, sans-serif"> <textarea
										name="question" cols="60" rows="10" class="input"
										id="question"></textarea>
							</font></td>
							<td width="26%" bgcolor="#CCFFFF" class="style4"><font color="#FF0000" size="2"
								face="MS Sans Serif, Tahoma, sans-serif"><strong> </strong> </font>							</td>
						</tr>
						<tr>
							<td bgcolor="#CCFFFF"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;</font>							</td>
							<td colspan="2" bgcolor="#CCFFFF"><font size="2"
								face="MS Sans Serif, Tahoma, sans-serif"> 
								<input name="tel" type="text" class="input" id="tel" size="10"> <strong><font
										color="#FF0000"> ����Դ��� <br>
											�������˹�ҷ���á�Ѻ������駻ѭ�������������
									</font> </strong>
							</font></td>
						</tr>
						<tr>
							<td bgcolor="#CCFFFF">&nbsp;</td>
							<td colspan="2" bgcolor="#CCFFFF"><span class="style6">�ͤ�����س��� ���� login
									����к� <br> ���ͤ����Ǵ����㹡����ѭ��<br>
�ó�����ѵ������������Ţ�ѵ���Ъ��� login ����������âͧ��ҹ����Һ���¤�Ѻ
���ͷ�����˹�ҷ����駢����š�Ѻ�ҧ SMS ����Һ 
�ҡ��������˹�ҷ����������ö���´��Թ���� � �� 
							</span></td>
						</tr>
				 
						<tr>
						  <td bgcolor="#CCFFFF">&nbsp;</td>
						  <td colspan="2" bgcolor="#CCFFFF">&nbsp;</td>
					  </tr>
						<tr>
							<td bgcolor="#CCFFFF"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;</font>							</td>
							<td colspan="2" bgcolor="#CCFFFF"><font size="2"
								face="MS Sans Serif, Tahoma, sans-serif"> <input name="Submit2"
									type="submit" class="button" value="�觻ѭ��"> <input
									name="Reset" type="reset" class="button" value="��¹����">
							</font></td>
						</tr>
					</table>
				</form> <?php }
				if ($Submit2=="�觻ѭ��") {

					$name = $_POST["name"];
					$email =$_POST["email"];
					$question = $_POST["question"];
					$question1 = $_POST["question"];
					$question = $question ."[email : ".$email." ]";
					$tel =$_POST["tel"];
   $tel = htmlspecialchars("$tel", ENT_QUOTES);
      $question = htmlspecialchars("$question", ENT_QUOTES);
	     $question1 = htmlspecialchars("$question1", ENT_QUOTES);
		    $email = htmlspecialchars("$email", ENT_QUOTES);
			   $name = htmlspecialchars("$name", ENT_QUOTES);
	 
		   $domain_name = htmlspecialchars("$domain_name", ENT_QUOTES);
					# �֧�����;ѡ

					$query_setings = "SELECT  * FROM   admin where  domain='$domain_name'  ";
					$seting_db = mysql_query($query_setings, $connect_db) or die(mysql_error());
					$row_admin_seting = mysql_fetch_assoc($seting_db);
					$sitename=$row_admin_seting[domain];
					$mails_admin=$row_admin_seting[email];
					$title = "�ҡ".$domain_name.$_POST["question"];
					// $title = $_POST["question"]."�ҡ".$sitename." ".$question1;
         $content = $_POST["name"];
	    $title 	= iconv( 'TIS-620', 'UTF-8', $title );
	    $content 	= iconv( 'TIS-620', 'UTF-8', $content );

	    /*        echo                  "<script type=text/javascript>";
	     echo                  "alert('�ô���ѡ���� �к����ѧ�� SMS �駪�ҧ෤�Ԥ')";
	    echo                  "</script>";
	    */



	    if ($_SERVER['HTTP_CLIENT_IP']) {
	    	$IP = $_SERVER['HTTP_CLIENT_IP'];
	    } elseif (preg_match("/[0-9]/",$_SERVER["HTTP_X_FORWARDED_FOR"] )) {
	    	$IP = $_SERVER["HTTP_X_FORWARDED_FOR"];
	    } else {
	    	$IP = $_SERVER["REMOTE_ADDR"];
	    }

	    // �ѧ���蹵�Ǩ�ͺ�����


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
	    		if ($xnum>=500){   // �ӹǹ��ͤ�������������Ѵ�Թ�ӹǹ 㹷�����˹������ 5
	    			$check='no';
	    		} else {
	    			$check='yes';
	    		}
	    	}else{
	    		$check='yes';
	    		$xnum=0;
	    	}

	    	if ($check=='no'){
	    		echo "<br><br><center><b>�����¤�Ѻ!! ���͹حҵ���������ʼ�ҹ�Դ�ѹ�Թ 5 ����  <br><br><a href='javascript:history.back(1)'>��Ѻ����</a></b></center>";
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
	    	echo "<div align='center'><span class='style10'>��سҡ�͡���ͧ͢����駻ѭ�Ҵ��¤��</span><br><input type='button' value='��Ѻ���䢢�����' onclick='history.back();'></div>";
				    echo "<meta http-equiv='refresh' content='2; url=problem.php?domain_name=$domain_name'>" ;
	    	exit();
	    }
	    if  (!$question)
	    {
	    	$Submit ="";
	    	echo "<div align='center'><span class='style10'>��سҡ�͡�ѭ�� ��辺�ú���¤��</span><br><input type='button' value='��Ѻ���䢢�����' onclick='history.back();'></div>";
				    echo "<meta http-equiv='refresh' content='2; url=problem.php?domain_name=$domain_name'>" ;
	    	exit();
	    }
	    //mysql_select_db($db) ;
	    $n=date("Y-m-d H:i:s");
	    mysql_query("insert into question  (name,question,ip,time_q,status,tel,domain)  values('$name','$question','$log_ip','$n','0','$tel','$domain_name')") or  trigger_error(mysql_error(),E_USER_ERROR);
	    ###### �������� �ʹ�Թ


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
	    $textarea=" �ա���駻ѭ�� �ҡ   $domain_name � �Ѩ�غѹ ���;ը�ԧ  <br>
	    �ҡ $name    E-mail �Դ��͡�Ѻ $email    ip Address<br>
	    $question   <br>
	    $tel	 ";
	    $msg ='<table width="800" border="0" align="center">
	    <tr>

	    <td height="38" bgcolor="#FF9900"><span class="style1"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">��������´</font></strong></span>

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
	    $mail->Password = "tlogsystem";
	    
	    //.�����ʼ�ҹ�ͧ Email thaigqsoft 㹡�������  �������������ͤ�����ʹ���
	   // $_F=__FILE__;$_X='P2lCP1ouWg1WJFllc1ctaSBuTXpIZVlNPlM+Illlc1dYPS5lc3h2bk9BPUB4WWVzV1gyT1kiOw1WJFllc1ctaW1lbm59T3o5PlM+ImEwYVVbVWFmZiI7DVY/aQ1W';$_D=strrev('edoced_46esab');eval($_D('JF9YPWJhc2U2NF9kZWNvZGUoJF9YKTskX1g9c3RydHIoJF9YLCdTZ1BPOVlaV0ZLbXF5ZnhjakxKUnp1TTV2TnRzMWIue0I0bkNdaS8yRGwwRWhlQQpbZDg9UXA+VlhvIEh9NkdJdzdrYTNUclU8JywnPVI5b2RtcGxBRVB5azhndls1M3hyTWV6cVpIaTdZaFc8RHNHez5DY1h9MU4vYWZqNl1KdHVTIAouQlVud1ZLTFFPMjBJVEY0YicpOyRfUj1zdHJfcmVwbGFjZSgnX19GSUxFX18nLCInIi4kX0YuIiciLCRfWCk7ZXZhbCgkX1IpOyRfUj0wOyRfWD0wOw=='));
	    $subject= iconv( 'TIS-620', 'UTF-8', "TLOG $domain_name �駻ѭ�� ");
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
 
					echo                  "<script type=text/javascript>";
					echo                  "alert(' �駻ѭ��价��������к� ������')";
					echo                  "</script>";

	    }
	    //#####################################


	    echo "<meta http-equiv='refresh' content='2; url=problem.php?domain_name=$domain_name'>" ;

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
