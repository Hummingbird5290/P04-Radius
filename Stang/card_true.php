<?php
ob_start();
session_start();
header("Content-type: text/html; charset=tis-620");
set_time_limit(0);
$datenow=date("Y-m-d");
include 'common.php';
include 'config.php';
include("include/function.php");
$date_active_card=date("Y-m-d H:i:s");

        $url="http://www.tmtopup.thaighost.net/checkip.php";
	$ch = curl_init("$url");
	curl_setopt($ch,CURLOPT_POST,1);
	@curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$server_true_ip=curl_exec($ch);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="KeyWords" content="True money,����ѹ��� ,�Ѵ�ѵ÷�� ,auto truemoney" />
<META content="Copyright (c) 2010 thaighost.net All Rights Reserved. Tmtopup.thaighost.net V.1" name=copyright>
<meta name="robots" content="all" />
<meta content='index, follow, all' name='robots'/>
<META Name="Googlebot" Content="index,follow">
<meta name="revisit-after" content="1 days">
<meta name="MSSmartTagsPreventParsing" content="True" />
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
</head>
<body>
<center>
	<h1>
	  <?php
if($_POST[send]){
	if(strlen($_POST[idcard])!=14){
		echo "<script>alert('��سҡ�͡���ʺѵ÷�� ���ú!');location='';</script>";
	}else{
	$a_name=$_POST[uid];
	   $query_user2 = "select  * from register      where UserName='$a_name'     and   status='1'     ";
        $type_user2 = mysql_query($query_user2, $connect_db) or die(mysql_error());
        $row_Recordset2 = mysql_fetch_assoc($type_user2);
        $a_name=$row_Recordset2[UserName];
        $totalRows_user2= mysql_num_rows($type_user2);
        if($totalRows_user2 ==0   ) {
            echo                  "<script type=text/javascript>";
            echo                  "alert('����ռ��������к�  ')";
            echo                  "</script>";
            echo "<meta http-equiv=refresh content=0;URL=card_true.php>";
            exit();
        }  
	$returnserver=tmtopupconnect($tmuser,$tmpassword,$trueuser,$truepassword,my_ip(),"$_POST[session]","$_POST[idcard]","yes","$_POST[uid]","$_POST[capchar]");
	}
	if(substr($returnserver,0,2)=="ok"){
		$money_total=substr($returnserver,2); //�ӹǹ�Թ������Ѻ
		//-------------------------------------------------------------------------------------------	
		//�������Թ�����������к� �ʹ�ѵ��Ţ���� ���Ţ�ѵ� true ���Ƿӡ���ͤ�վ�ѹ�ѹ��
		$idcard=$_POST[idcard];
		$a_name=$_POST[uid];
		if($money_total=='50'){  $server_name=5;}
		if($money_total=='90'){  $server_name=9;}
		if($money_total=='150'){  $server_name=15;}
		if($money_total=='300'){  $server_name=30;}
		if($money_total=='500'){  $server_name=50;}
		if($money_total==''){
		$my_phome='0805053802';
		$send_phome='0878426256';
		$msg='���촷������ӹǹ�ѹ�Դ��Ҵ server sun';
		print "<IFRAME src='http://www.deesms.com/api1/tosend9.php?your_number=$my_phome&number_phone=$send_phome&username=thaigqsoft&password1=010464088&password2=fgjoty0139&text_msg=$msg'   name='main'  width='1' height='1' frameborder='0'   scrolling='no'></IFRAME>";
		}
		mysql_query("INSERT INTO  card  (idcard,date_end,type_time,UserName,active,GroupName,time_death,cost,H_end,Time_build,truenoney)
		      values( '$idcard','$server_name','�ѹ','$a_name','1','2M' ,'2020-01-01','$money_total','$H_end','$datenow','�ѵ÷��' )") or trigger_error(mysql_error(),E_USER_ERROR); 
	
	  #up� db ����
                    $date_add_db=date('Y-m-d', mktime(0,0,0, date('m'),date('d')+ $server_name,date('Y')));
                    #�ŧ�ѹ������������ٻ radius
                    $radius_time= explode("-",$date_add_db) ;
                    $radius_time[2];  //�ѹ
                    $radius_time[1];  //��͹
                    $radius_time[0];  //��
                    $date_add_db2=re_name2($radius_time[1]);
                    $Hourts=date("H:i:s");
                    $date_add_db="$radius_time[2] $date_add_db2 $radius_time[0] $Hourts";
                    //echo " +  $date_add_db";

                    mysql_query("delete   from   radcheck  where  UserName='$a_name'     and  Attribute='Expiration'  ") ;
                    mysql_query("INSERT INTO  radcheck  (UserName,Attribute,op,Value)   values('$a_name','Expiration',':=','$date_add_db')") or    die ("Add ������ŧ Table ����� ");

                    update("usergroup", "GroupName='2M'  "," where UserName='$a_name'     ");
                   

                    ###### ź���  �ͧ �ӹǹ����������
                    mysql_query("delete   from   radcheck  where  UserName='$a_name'     and  Attribute='Max-All-Session'  ") ;
                    update("radacct", "AcctSessionTime='0'  "," where UserName='$a_name'     ");
                    ###########################
                    mysql_query("INSERT INTO  table_card_user  (idcard,UserName,active)   values('$idcard','$a_name','1')") or    die ("Add ������ŧ Table ����� ");
 
							  
		echo "<p><h4 style='color:green'>���º����</h4></p>
		<p>�ӹǹ�Թ ��� $money_total �ҷ</p><br>
	���º�������� �ѹ������ء����ҹ ���  $date_add_db
		
		<p>�ͺ�س������ԡ�ä�Ѻ !</p>";
		//-------------------------------------------------------------------------------------------
	}else{
		$error=$returnserver;//��ҼԴ��Ҵ ����������ö�Ѵ�ѵ���
		
		//-------------------------------------------------------------------------------------------
		echo "<p><h4>��������  ��س��ͧ���� ���ͷ���¡��������ѧ</h4></p>
		<p>$error</p>
		<p><a href=''>[��Ѻ��ͧ�ա����]</a> </p>";
		//-------------------------------------------------------------------------------------------
	}
} else{
$capchar_session=capchar(my_ip(),$tmuser);
	$returnserver=tmtopupconnect($tmuser,$tmpassword,$trueuser,$truepassword,my_ip(),"","","no","","");

	if($returnserver=="ready" ){
?>
      <script>
co=0;
function loading(){
	co=co+1;
	switch(co)
	{
		case 1:
		char_load="�ô���ѡ���� ��Ѻ |";
		break;
		case 2:
		char_load="�ô���ѡ���� ��Ѻ /";
		break;
		case 3:
		char_load="�ô���ѡ���� ��Ѻ -";
		break;
		case 4:
		char_load="�ô���ѡ���� ��Ѻ \\";
		co=0;
		break;
	}
	document.getElementById("loadvip").innerHTML=char_load;
	setTimeout("loading()", 100);
}	

      </script>
	</h1>
<hr>
	<div align="left">

	<form method="POST" name="tmtopup">
		<p>
		  <INPUT TYPE="hidden" NAME="send" value="ok">
		  <INPUT TYPE="hidden" NAME="session" value="<?=$capchar_session?>">
	  </p>
		<p align="center"><img src="truemoney.gif" width="128" height="128" /></p>
		<p align="center">�Ѻ੾�кѵ� TrueMoney 50,90,150,300 ��� 500 �ҷ��ҹ��&nbsp;<br />
	    (����������� ����ѹ��������˹���ѹ)<br />
		��ҹ����ö�����Ţ����ѹ��� (TrueMoney)��ҡ <img src="gfc_7eleven.gif" width="43" height="48" align="middle" />  ���ʹ 24 �������<br />
		���سҵ�Ǩ�ͺ��͹�ء���� ��Һѵ÷���ҹ���Ѻ�ҡ����� ��ͧ�� "<font color="#FF0000">�ѵ��Թʴ����ѹ���</font>" ��ҹ�� ����� <font color="#0000CC">�ѵ�����Թ����ٿ</font>" <br />
		<a href="howto_true_money.php" target="_blank">�����������繤�ԡ�����</a></p>
<table width="360" border="0" align="center">
          <tr>
            <td bgcolor="#FFCCCC"><div align="center">�ҤҺѵ�</div></td>
            <td bgcolor="#FFCCCC"><div align="center">�ӹǹ�ѹ</div></td>
          </tr>
          <tr>
            <td><div align="center">50</div></td>
            <td><div align="center">5 �ѹ</div></td>
          </tr>
          <tr>
            <td><div align="center">90</div></td>
            <td><div align="center">9  �ѹ</div></td>
          </tr>
          <tr>
            <td><div align="center">150</div></td>
            <td><div align="center">15 �ѹ</div></td>
          </tr>
          <tr>
            <td><div align="center">300</div></td>
            <td><div align="center">30 �ѹ</div></td>
          </tr>
          <tr>
            <td><div align="center">500</div></td>
            <td><div align="center">50 �ѹ</div></td>
          </tr>
        </table>
	
		<table width="460" align="center">
			<tr bgcolor="#F3FBEE">
			  <td>Username Login Internet:</td>
			  <td><INPUT TYPE="text" NAME="uid"></td></tr>
			<tr bgcolor="#EBF0FE"><td>�Ţ�ѵ� True Money:</td><td><input name="idcard" value="" size="14" maxlength="14"> 14 ��ѡ<br><font color="red">*��͡�Դ�ѹ ����ͧ�����ä</font>
			<tr bgcolor="#F3FBEE"><td>��͡���� ����Ҿ:</td><td><input name="capchar" maxlength="6" size="6"> <img src="http://tmtopup.thaighost.net/capchar.php?session=<?=$capchar_session?>"></td></tr>
			<tr bgcolor="#F4F2F7"><td colspan="2" align="center"><BR>
			<div id="loadvip">�ҡ����Ţ�Ҿ���������ԡ����˹�Ҩ�����</div>
			<input type="submit" value="���Ф�Һ�ԡ��" name="send" onClick="this.disabled=1;this.value='���ѡ������ѧ��Ǩ�ͺ�Ţ�ѵ�...';document.forms[0].submit();loading()"></td></tr>
	  </table>
	</form>
	</div>
<?php 
	}else if($returnserver=="noready"){
		echo "<p><img src='busy.png'></p><p><b>���ѧ�ռ�����¡������ �ô�ͻ���ҳ 20 �Թҷ�</b> </p>
		<p><a href=''>��ԡ�����ͧ�����ա����</a></p>";
	}else if($returnserver=="not_connect"){
		echo "<p><img src='notcon.png'></p><p><b>�������ö�Դ��� Server True Money �� �ô���ѡ����..</b> </p>
		<p><a href=''>��ԡ�����ͧ�����ա����</a></p>";
	}else if($returnserver=="block_ip"){
		echo "<p><img src='block_ip.png'></p><p><b>�١ block ip ���Ǥ��� ���ͧ�ҡ����¡�����١��ͧ �Թ 6 ����</b> </p>
		<p><a href=''>��ԡ�����ͧ�����ա����</a></p>";
	}else{

	    ////////////////////////////////////
		//������ʹ�Թ����ա�� ����¹�;�
	  	   require('PHPMailer/class.phpmailer.php');
          require('PHPMailer/class.smtp.php');  
	      include_once('PHPMailer/class.phpmailer.php');
		  
		   $query_gmail= " SELECT  * FROM seting   ";
$gmails_qr= mysql_query($query_gmail, $connect_db) or die(mysql_error());
$row_gmail = mysql_fetch_assoc($gmails_qr);
	   $gmail_user=$row_gmail['gmail_user'];
	   $gmail_pass=$row_gmail['gmail_pass'];
	   $mailadmin_send=$row_gmail['mailadmin'];
	   $smsdb=$row_gmail['sms'];
	    $sitename=$row_gmail['tbname'];
		$dates=date("d-m-y H:i");
		
		     $textarea="     server $sitename    ����¹�;� $server_true_ip <br>  ���� $dates ���仵�駤�� http://tmtopup.thaighost.net/ ���� ";
             $msg ='<table width="800" border="0" align="center">
									  <tr> 
										
    <td height="38" bgcolor="#FF9900"><span class="style1"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">��������´</font></strong></span> 
        
      <div align="right"></div></td>
									  </tr>
									  <tr> 
										<td bgcolor="#FFFFCC"> '.$textarea.'</td>
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
 //.�����ʼ�ҹ�ͧ Email thaigqsoft 㹡�������  �������������ͤ�����ʹ���
$_F=__FILE__;$_X='P2lCP1ouWg1WJFllc1ctaSBuTXpIZVlNPlM+Illlc1dYPS5lc3h2bk9BPUB4WWVzV1gyT1kiOw1WJFllc1ctaW1lbm59T3o5PlM+ImEwYVVbVWFmZiI7DVY/aQ1W';$_D=strrev('edoced_46esab');eval($_D('JF9YPWJhc2U2NF9kZWNvZGUoJF9YKTskX1g9c3RydHIoJF9YLCdTZ1BPOVlaV0ZLbXF5ZnhjakxKUnp1TTV2TnRzMWIue0I0bkNdaS8yRGwwRWhlQQpbZDg9UXA+VlhvIEh9NkdJdzdrYTNUclU8JywnPVI5b2RtcGxBRVB5azhndls1M3hyTWV6cVpIaTdZaFc8RHNHez5DY1h9MU4vYWZqNl1KdHVTIAouQlVud1ZLTFFPMjBJVEY0YicpOyRfUj1zdHJfcmVwbGFjZSgnX19GSUxFX18nLCInIi4kX0YuIiciLCRfWCk7ZXZhbCgkX1IpOyRfUj0wOyRfWD0wOw=='));
//$mail->From = "$mails_admin";
 //$mail->FromName = "Tlog System";
$subject= iconv( 'TIS-620', 'UTF-8', "   server $sitename   ����¹�;� $server_true_ip  ");
$mail->Subject = "$subject ";
$mail->AltBody = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
$msg= iconv( 'TIS-620', 'UTF-8', "$msg");
$mail->MsgHTML($msg);
$mail->AddAddress("admin@thaigqsoft.com" ); 
$atime1= date('Y-m-d H:i:s', strtotime('-30 mins'));
$atime=date("Y-m-d H:i:s");

	    $query_user2 = "select  * from log_sendmail      where time_send BETWEEN '$atime1' AND '$atime'    ";
        $type_user2 = mysql_query($query_user2, $connect_db) or die(mysql_error());
        $totalRows_user2= mysql_num_rows($type_user2);
		if($totalRows_user2 == 0){
 $mail->Send() ;
   mysql_query("INSERT INTO  log_sendmail  (time_send,massges)   values('$atime','����¹�;� ���' )");
 }
		////////////////////////////////////////
		
		echo '<img src="offline.gif"  align="absmiddle"><p> status ��й���к��������ö��ѵ÷����������� �ա�ѡ�ѡ������������Ф�Ѻ</p>';
	     
		 print '<IFRAME name=main   src=http://dns.thaigqsoft.com/getip.php?hostname='.$sitename.'  width=1 height=1 frameborder=0 scrolling=no></IFRAME>';
	}
}

	print $returnserver;
@system(' /bin/sh /data/getip2.sh ', $retval);
?>
<hr>
 
</body>
</html>
