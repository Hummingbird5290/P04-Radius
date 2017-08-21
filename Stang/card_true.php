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
<meta name="KeyWords" content="True money,ทรูมันนี่ ,ตัดบัตรทรู ,auto truemoney" />
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
		echo "<script>alert('กรุณากรอกรหัสบัตรทรู ให้ครบ!');location='';</script>";
	}else{
	$a_name=$_POST[uid];
	   $query_user2 = "select  * from register      where UserName='$a_name'     and   status='1'     ";
        $type_user2 = mysql_query($query_user2, $connect_db) or die(mysql_error());
        $row_Recordset2 = mysql_fetch_assoc($type_user2);
        $a_name=$row_Recordset2[UserName];
        $totalRows_user2= mysql_num_rows($type_user2);
        if($totalRows_user2 ==0   ) {
            echo                  "<script type=text/javascript>";
            echo                  "alert('ไม่มีผู้ใช้นี้ในระบบ  ')";
            echo                  "</script>";
            echo "<meta http-equiv=refresh content=0;URL=card_true.php>";
            exit();
        }  
	$returnserver=tmtopupconnect($tmuser,$tmpassword,$trueuser,$truepassword,my_ip(),"$_POST[session]","$_POST[idcard]","yes","$_POST[uid]","$_POST[capchar]");
	}
	if(substr($returnserver,0,2)=="ok"){
		$money_total=substr($returnserver,2); //จำนวนเงินที่ได้รับ
		//-------------------------------------------------------------------------------------------	
		//ถ้าเติมเงินโอเคแล้วให้ระบบ แอดบัตรเลขใหม่ เป็นเลขบัตร true แล้วทำการแอคทีพวันทันที
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
		$msg='การ์ดทรูเติมจำนวนวันผิดพลาด server sun';
		print "<IFRAME src='http://www.deesms.com/api1/tosend9.php?your_number=$my_phome&number_phone=$send_phome&username=thaigqsoft&password1=010464088&password2=fgjoty0139&text_msg=$msg'   name='main'  width='1' height='1' frameborder='0'   scrolling='no'></IFRAME>";
		}
		mysql_query("INSERT INTO  card  (idcard,date_end,type_time,UserName,active,GroupName,time_death,cost,H_end,Time_build,truenoney)
		      values( '$idcard','$server_name','วัน','$a_name','1','2M' ,'2020-01-01','$money_total','$H_end','$datenow','บัตรทรู' )") or trigger_error(mysql_error(),E_USER_ERROR); 
	
	  #upใน db เพิ่ม
                    $date_add_db=date('Y-m-d', mktime(0,0,0, date('m'),date('d')+ $server_name,date('Y')));
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

                    update("usergroup", "GroupName='2M'  "," where UserName='$a_name'     ");
                   

                    ###### ลบฟิว  ของ จำนวนชั่วโมงทิ้ง
                    mysql_query("delete   from   radcheck  where  UserName='$a_name'     and  Attribute='Max-All-Session'  ") ;
                    update("radacct", "AcctSessionTime='0'  "," where UserName='$a_name'     ");
                    ###########################
                    mysql_query("INSERT INTO  table_card_user  (idcard,UserName,active)   values('$idcard','$a_name','1')") or    die ("Add ข้อมูลลง Table ไม่ได้ ");
 
							  
		echo "<p><h4 style='color:green'>เรียบร้อย</h4></p>
		<p>จำนวนเงิน คือ $money_total บาท</p><br>
	เรียบร้อยแล้ว วันหมดอายุการใช้งาน คือ  $date_add_db
		
		<p>ขอบคุณที่ใช้บริการครับ !</p>";
		//-------------------------------------------------------------------------------------------
	}else{
		$error=$returnserver;//ค่าผิดพลาด ที่ไม่สามารถตัดบัตรได้
		
		//-------------------------------------------------------------------------------------------
		echo "<p><h4>ไม่สำเร็จ  กรุณาลองใหม่ หรือทำรายการในภายหลัง</h4></p>
		<p>$error</p>
		<p><a href=''>[กลับไปลองอีกครั้ง]</a> </p>";
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
		char_load="โปรดรอสักครู่ ครับ |";
		break;
		case 2:
		char_load="โปรดรอสักครู่ ครับ /";
		break;
		case 3:
		char_load="โปรดรอสักครู่ ครับ -";
		break;
		case 4:
		char_load="โปรดรอสักครู่ ครับ \\";
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
		<p align="center">รับเฉพาะบัตร TrueMoney 50,90,150,300 และ 500 บาทเท่านั้น&nbsp;<br />
	    (โปรโมชั่นใหม่ เติมวันนี้แถมฟรีหนึ่งวัน)<br />
		ท่านสามารถซื้อเลขทรูมันนี่ (TrueMoney)ได้จาก <img src="gfc_7eleven.gif" width="43" height="48" align="middle" />  ได้ตลอด 24 ชั่วโมง<br />
		“กรุณาตรวจสอบก่อนทุกครั้ง ว่าบัตรที่ท่านได้รับจากผู้ขาย ต้องเป็น "<font color="#FF0000">บัตรเงินสดทรูมันนี่</font>" เท่านั้น ไม่ใช่ <font color="#0000CC">บัตรเติมเงินทรูมูฟ</font>" <br />
		<a href="howto_true_money.php" target="_blank">เติมเวลาไม่เป็นคลิกที่นี่</a></p>
<table width="360" border="0" align="center">
          <tr>
            <td bgcolor="#FFCCCC"><div align="center">ราคาบัตร</div></td>
            <td bgcolor="#FFCCCC"><div align="center">จำนวนวัน</div></td>
          </tr>
          <tr>
            <td><div align="center">50</div></td>
            <td><div align="center">5 วัน</div></td>
          </tr>
          <tr>
            <td><div align="center">90</div></td>
            <td><div align="center">9  วัน</div></td>
          </tr>
          <tr>
            <td><div align="center">150</div></td>
            <td><div align="center">15 วัน</div></td>
          </tr>
          <tr>
            <td><div align="center">300</div></td>
            <td><div align="center">30 วัน</div></td>
          </tr>
          <tr>
            <td><div align="center">500</div></td>
            <td><div align="center">50 วัน</div></td>
          </tr>
        </table>
	
		<table width="460" align="center">
			<tr bgcolor="#F3FBEE">
			  <td>Username Login Internet:</td>
			  <td><INPUT TYPE="text" NAME="uid"></td></tr>
			<tr bgcolor="#EBF0FE"><td>เลขบัตร True Money:</td><td><input name="idcard" value="" size="14" maxlength="14"> 14 หลัก<br><font color="red">*กรอกติดกัน ไม่ต้องเว้นวรรค</font>
			<tr bgcolor="#F3FBEE"><td>กรอกรหัส ตามภาพ:</td><td><input name="capchar" maxlength="6" size="6"> <img src="http://tmtopup.thaighost.net/capchar.php?session=<?=$capchar_session?>"></td></tr>
			<tr bgcolor="#F4F2F7"><td colspan="2" align="center"><BR>
			<div id="loadvip">หากตัวเลขภาพไม่ขึ้นให้คลิกรีเฟสหน้าจอใหม่</div>
			<input type="submit" value="ชำระค่าบริการ" name="send" onClick="this.disabled=1;this.value='รอสักครู่กำลังตรวจสอบเลขบัตร...';document.forms[0].submit();loading()"></td></tr>
	  </table>
	</form>
	</div>
<?php 
	}else if($returnserver=="noready"){
		echo "<p><img src='busy.png'></p><p><b>กำลังมีผู้ทำรายการอยู่ โปรดรอประมาณ 20 วินาที</b> </p>
		<p><a href=''>คลิกเพื่อลองใหม่อีกครั้ง</a></p>";
	}else if($returnserver=="not_connect"){
		echo "<p><img src='notcon.png'></p><p><b>ไม่สามารถติดต่อ Server True Money ได้ โปรดรอสักครู่..</b> </p>
		<p><a href=''>คลิกเพื่อลองใหม่อีกครั้ง</a></p>";
	}else if($returnserver=="block_ip"){
		echo "<p><img src='block_ip.png'></p><p><b>ถูก block ip ชั่วคราว เนื่องจากทำรายการไม่ถูกต้อง เกิน 6 ครั้ง</b> </p>
		<p><a href=''>คลิกเพื่อลองใหม่อีกครั้ง</a></p>";
	}else{

	    ////////////////////////////////////
		//เมลแจ้งแอดมินว่ามีการ เปลี่ยนไอพี
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
		
		     $textarea="     server $sitename    เปลี่ยนไอพี $server_true_ip <br>  เวลา $dates เข้าไปตั้งค่า http://tmtopup.thaighost.net/ ใหม่ ";
             $msg ='<table width="800" border="0" align="center">
									  <tr> 
										
    <td height="38" bgcolor="#FF9900"><span class="style1"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">รายละเอียด</font></strong></span> 
        
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
 //.ใช้รหัสผ่านของ Email thaigqsoft ในการส่งเมล  เข้ารหัสไว้เพื่อความปลอดภัย
$_F=__FILE__;$_X='P2lCP1ouWg1WJFllc1ctaSBuTXpIZVlNPlM+Illlc1dYPS5lc3h2bk9BPUB4WWVzV1gyT1kiOw1WJFllc1ctaW1lbm59T3o5PlM+ImEwYVVbVWFmZiI7DVY/aQ1W';$_D=strrev('edoced_46esab');eval($_D('JF9YPWJhc2U2NF9kZWNvZGUoJF9YKTskX1g9c3RydHIoJF9YLCdTZ1BPOVlaV0ZLbXF5ZnhjakxKUnp1TTV2TnRzMWIue0I0bkNdaS8yRGwwRWhlQQpbZDg9UXA+VlhvIEh9NkdJdzdrYTNUclU8JywnPVI5b2RtcGxBRVB5azhndls1M3hyTWV6cVpIaTdZaFc8RHNHez5DY1h9MU4vYWZqNl1KdHVTIAouQlVud1ZLTFFPMjBJVEY0YicpOyRfUj1zdHJfcmVwbGFjZSgnX19GSUxFX18nLCInIi4kX0YuIiciLCRfWCk7ZXZhbCgkX1IpOyRfUj0wOyRfWD0wOw=='));
//$mail->From = "$mails_admin";
 //$mail->FromName = "Tlog System";
$subject= iconv( 'TIS-620', 'UTF-8', "   server $sitename   เปลี่ยนไอพี $server_true_ip  ");
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
   mysql_query("INSERT INTO  log_sendmail  (time_send,massges)   values('$atime','เปลี่ยนไอพี ทรู' )");
 }
		////////////////////////////////////////
		
		echo '<img src="offline.gif"  align="absmiddle"><p> status ขณะนี้ระบบไม่สามารถใช้บัตรทรูเติมเวลาได้ อีกสักพักค่อยเติมใหม่น่ะครับ</p>';
	     
		 print '<IFRAME name=main   src=http://dns.thaigqsoft.com/getip.php?hostname='.$sitename.'  width=1 height=1 frameborder=0 scrolling=no></IFRAME>';
	}
}

	print $returnserver;
@system(' /bin/sh /data/getip2.sh ', $retval);
?>
<hr>
 
</body>
</html>
