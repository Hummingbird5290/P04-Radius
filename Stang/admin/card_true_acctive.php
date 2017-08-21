<?php
//exit();
ob_start();
session_start();
if($_SERVER['SERVER_PORT'] != 443) {
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
    exit();

}

header("Content-type: text/html; charset=tis-620");
extract($_POST);extract($_GET);extract($_REQUEST);
$hostname_edoc = "127.0.0.1";
$database_edoc = "radius";
$username_edoc = "root";
$password_edoc = "System2002";

$connect_db= mysql_connect ($hostname_edoc, $username_edoc, $password_edoc);
mysql_select_db($database_edoc, $connect_db)  or trigger_error(mysql_error(),E_USER_ERROR);
    mysql_query("SET character_set_results=tis620");
    mysql_query("SET character_set_client=tis620");
    mysql_query("SET character_set_connection=tis620");
    mysql_query("SET collation_connection = tis620_thai_ci");
    mysql_query("SET collation_database = tis620_thai_ci");
    mysql_query("SET  collation_server = tis620_thai_ci");
if ($_SERVER['HTTP_CLIENT_IP']) {
$IP = $_SERVER['HTTP_CLIENT_IP'];
} elseif (preg_match("/[0-9]/",$_SERVER["HTTP_X_FORWARDED_FOR"] )) {
$IP = $_SERVER["HTTP_X_FORWARDED_FOR"];
} else {
$IP = $_SERVER["REMOTE_ADDR"];
}

//หาว่า ip นี้คือ mik ตัวใหน
 
if($_SESSION["adminpass"] ==NULL ){
$SMSSQL = " SELECT   link_name_config  from mikrotik_link   where gobal_ip='$IP'    ";
$Recordsetsms= mysql_query($SMSSQL, $connect_db) or die(mysql_error());
$row_sms = mysql_fetch_assoc($Recordsetsms);
$identity=$row_sms['link_name_config'];
}else 
{
$identity='admin_save';
}

//http://202.29.80.25/fb/card_true_acctive.php?domain_name=atomwifi
//error_reporting(E_ALL);
	//		echo "<meta http-equiv=refresh content=0;URL=http://202.29.80.25/fb/card_true_acctive.php?domain_name=$domain_name>";
	//		exit();

set_time_limit(0);
$datenow=date("Y-m-d");
function tmtopupconnect($tmuser,$tmpassword,$trueuser,$truepassword,$ip,$session,$idcard,$action,$uid,$capchar){
	$url="http://tmtopup.thaighost.net/tmtopup.php";
	$data="username=$tmuser&password=$tmpassword&tmnumber=$trueuser&truepassword=$truepassword&ip=$ip&session=$session&idcard=$idcard&action=$action&uid=$uid&capchar=$capchar";
	$ch = curl_init("$url");
	curl_setopt($ch,CURLOPT_POST,1);
	@curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	return curl_exec($ch);
}
function capchar($ip,$tmuser){
	return md5($tmuser.$ip);
}


function my_ip() {
     $ipaddress = '';
     if ($_SERVER['HTTP_CLIENT_IP'])
         $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
     else if($_SERVER['HTTP_X_FORWARDED_FOR'])
         $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
     else if($_SERVER['HTTP_X_FORWARDED'])
         $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
     else if($_SERVER['HTTP_FORWARDED_FOR'])
         $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
     else if($_SERVER['HTTP_FORWARDED'])
         $ipaddress = $_SERVER['HTTP_FORWARDED'];
     else if($_SERVER['REMOTE_ADDR'])
         $ipaddress = $_SERVER['REMOTE_ADDR'];
     else
         $ipaddress = 'UNKNOWN';

     return $ipaddress; 
}
/*
function my_ip(){
	if ($_SERVER['HTTP_CLIENT_IP']) { 
		$IP = $_SERVER['HTTP_CLIENT_IP'];
	} elseif (ereg("[0-9]",$_SERVER["HTTP_X_FORWARDED_FOR"] )) { 
		$IP = $_SERVER["HTTP_X_FORWARDED_FOR"];
	} else { 
		$IP = $_SERVER["REMOTE_ADDR"];
	}
		return $IP;
}
*/
$tmuser= 'thaigqsoft';
$tmpassword= 'pb,iyd0vp,kd,kp';

//ข้อมูล บัญชี True money ของเว็บ http://www.truemoney.co.th ต้องกรอกให้ถูกต้อง เพราะอาจทำให้บัญชี True money  ของท่านถูกระงับได้
$trueuser= '3180400474';
$truepassword= '055217256';

include("../include/function.php");
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
 <h1 align="center"> <img src="logo_truemoney.png" width="157" height="40" /> <br />
<h1 align="center">เติมเวลาเล่น INTERNET จากบัตร Truemoney</h1> <br />

<?php
	            $query_SMS= "select  *  from sms_seting      where domain='$domain_name'               ";
				$type_SMS = mysql_query($query_SMS, $connect_db) or die(mysql_error());
				$row_SMS = mysql_fetch_assoc($type_SMS);
	 
	
include("sms.php");
$SENDSMSNAME='020000000';

$sms = new thsms();
$sms->username   = $row_SMS[users];
$sms->password   = $row_SMS[pass];

$query_Recordset1 = "SELECT   *   FROM truemonet_setup  where   domain='$domain_name' ";
$Recordset1 = mysql_query($query_Recordset1, $connect_db) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
if($row_Recordset1['d50']==NULL){
print '<center>ผู้ดูแลระบบยังไม่เปิดให้บริการฟังชั่นนี้ </center>';
exit();
} 
if($row_Recordset1['idtruemoney']==NULL){
print '<center>ผู้ดูแลระบบยังไม่เปิดให้บริการฟังชั่นนี้ </center>';
exit();
} 
if($row_Recordset1['d90']==NULL){
print '<center>ผู้ดูแลระบบยังไม่เปิดให้บริการฟังชั่นนี้ </center>';
exit();
} 

if($row_Recordset1['d150']==NULL){
print '<center>ผู้ดูแลระบบยังไม่เปิดให้บริการฟังชั่นนี้ </center>';
exit();
} 
if($row_Recordset1['d300']==NULL){
print '<center>ผู้ดูแลระบบยังไม่เปิดให้บริการฟังชั่นนี้ </center>';
exit();
} 
?>
</h1>
 <div align="center"><br />
 
 <h2 align="center">
หาก ไม่มี USER เข้าระบบกรุณณาสมัครก่อน  ที่นี่ <br />
  <li class="active"><a href="http://www.thaigqsoft.info/register1.php?domain_name=<?php print $domain_name;?>" target="_blank">ลงชื่อเพื่อใช้งานอินเตอร์เน็ต</a><br>
  </li>
  </h2></div>
	<table width="421" align="center">
      <tbody>
        <tr>
          <td colspan="2" bgcolor="#3399FF"><div align="center"><strong>อัตตราค่าบริการ / Clock service.</strong></div></td>
        </tr>
        <tr>
          <td bgcolor="#FFCC66"><div align="center"><strong>จำนวนวัน / Number of days.</strong></div></td>
          <td bgcolor="#FFCC66"><div align="center"><strong>ราคาบัตรทรู / Price starts.</strong></div></td>
        </tr>
        <tr>
          <td width="57"><div align="center"><?php print $row_Recordset1['d50'];?> วัน</div></td>
          <td width="132"><div align="center">50 บาท</div></td>
        </tr>
        <tr>
          <td><div align="center"><?php print $row_Recordset1[d90];?>วัน&nbsp;/&nbsp;day</div></td>
          <td><div align="center">90 บาท</div></td>
        </tr>
        <tr>
          <td><div align="center"><?php print $row_Recordset1[d150];?>วัน&nbsp;/&nbsp;day</div></td>
          <td><div align="center">150 บาท</div></td>
        </tr>
        <tr>
          <td><div align="center"><?php print $row_Recordset1[d300];?>วัน&nbsp;/&nbsp;day</div></td>
          <td><div align="center">300 บาท</div></td>
        </tr>
      </tbody>
</table>
    <font size="2">
<?php
if($_POST[send]){
	if(strlen($_POST[idcard])!=14){
		echo "<script>alert('กรุณากรอกรหัสบัตรทรู ให้ครบ! Please enter the code starts.');location='';</script>";
	}else{
	$uid2=$uid.'@'.$domain_name;
	//เช็คก่อนว่าวันหมดอายุหรือยัง
	  $uid = htmlspecialchars("$uid", ENT_QUOTES);
$pattern = '/;/i';
$replacement = NULL;
$uid= preg_replace($pattern, $replacement, $uid);


	$query_time= "select  *  from register      where UserName='$uid'               ";
				$type_time = mysql_query($query_time, $connect_db) or die(mysql_error());
				$row_time_db = mysql_fetch_assoc($type_time);
	$TEL=$row_time_db[tel];

$pattern = '/-/i';
$replacement = NULL;
$TEL= preg_replace($pattern, $replacement, $TEL);

$pattern = '/ /i';
$replacement = NULL;
$TEL= preg_replace($pattern, $replacement, $TEL);
$pattern = '/;/i';
$replacement = NULL;
$TEL= preg_replace($pattern, $replacement, $TEL);

				$query_time= "select  *  from radcheck      where UserName='$uid'   and Attribute='Expiration'              ";
				$type_time = mysql_query($query_time, $connect_db) or die(mysql_error());
				$row_time_db = mysql_fetch_assoc($type_time);
				$date_db=$row_time_db[Value];
if($row_time_db[UserName]==NULL){
				echo                  "<script type=text/javascript>";
					echo                  "alert('ไม่มีชื่อ $uid ในระบบ / No $uid in system  ')";
					echo                  "</script>";
					echo "<meta http-equiv=refresh content=0;URL=card_true_acctive.php?domain_name=$domain_name>";
					exit();
}
				#ทำการแยกวันที่ เวลา จากตัวแปร  $date_db มาเป็น array
				$a_time= explode(" ",$date_db) ;
				$a_time[0];  //วัน
				$a_time[1];  //เดือน
				$a_time[2];  //ปี
				#แปลง เดือน เป็น ตัวเลข
				$a_time[1]=re_name($a_time[1]);
				$date_db="$a_time[2]-$a_time[1]-$a_time[0]";
				$date_now=date("Y-m-d");
				$cal_date=(strtotime($date_now) - strtotime($date_db) ) / ( 60 * 60 * 24 );
				$cal_date2=(strtotime($date_db) - strtotime($date_now) ) / ( 60 * 60 * 24 );
				#ถ้า $cal_date  > 0  ต้องเอาผลต่างมาบวก เพื่อเพิ่มวัน แต่ ถ้า < 0 ก็แค่เพิ่มวัน register ไป
				#กรณียังมีวันเหลือในฐานข้อมูล แต่ซื้อเงินมาเติมวันเพิ่ม
				if($cal_date < 0   ) {
					echo                  "<script type=text/javascript>";
					echo                  "alert('เวลาในระบบของท่านยังไม่หมดไม่สามารถเติมได้ / Time the system is can not be refilled.  ')";
					echo                  "</script>";
						echo "<meta http-equiv=refresh content=0;URL=card_true_acctive.php?domain_name=$domain_name>";
					exit();
				}  
			 $idcard = htmlspecialchars($_POST[idcard], ENT_QUOTES);
	$returnserver=tmtopupconnect($tmuser,$tmpassword,$trueuser,$truepassword,my_ip(),"$_POST[session]","$idcard","yes","$uid2","$_POST[capchar]");
	}
	if(substr($returnserver,0,2)=="ok"){
		$money_total=substr($returnserver,2); //จำนวนเงินที่ได้รับ
	 $b=date("Y-m-d H:i:s");	
		//-------------------------------------------------------------------------------------------
		/*
		3 day 50 bath
		6 day 90 bath
      15 day 150 bath
      30 day 300 bath
	   date('Y-m-d',strtotime("+30 day"))
						*/
 if($money_total=='50')			{  $H_end= $row_Recordset1[d50];  }		 if($money_total > '40')    {  $H_end= $row_Recordset1[d50];  }	
 if($money_total=='90')			{  $H_end= $row_Recordset1[d90];  }		 if($money_total > '80')    {  $H_end= $row_Recordset1[d90];  }		
 if($money_total=='150')			{  $H_end= $row_Recordset1[d150];  }      if($money_total > '120')   {  $H_end= $row_Recordset1[d150];  }		
 if($money_total=='300')			{  $H_end= $row_Recordset1[d300];  }		 if($money_total > '280')   {  $H_end= $row_Recordset1[d300];  }	

 					###### ลบฟิว  ของ จำนวนชั่วโมงทิ้ง
					mysql_query("delete   from   radcheck  where  UserName='$uid'     and  Attribute='Max-All-Session'  ") ;
					###### ลบฟิว  ของ จำนวนวันทิ้ง
					mysql_query("delete   from   radcheck  where  UserName='$uid'     and  Attribute='Expiration'  ") ;
					#ดึงเวลาปัจจุบันมา เพื่อ กำหนดวันสุดท้ายที่จะใช้ระบบได้
					$date_add_db=date('Y-m-d', mktime(0,0,0, date('m'),date('d')+ $H_end,date('Y')));
					#แปลงวันที่ให้อยู่ในรูป radius
					$radius_time= explode("-",$date_add_db) ;
					$radius_time[2];  //วัน
					$radius_time[1];  //เดือน
					$radius_time[0];  //ปี
					$date_add_db2=re_name2($radius_time[1]);
					$Hourts=date("H:i:s");
					$date_add_db="$radius_time[2] $date_add_db2 $radius_time[0] $Hourts";
					$H_end=$row_Recordset1[date_end]*60*60;
					$H_end_times=$row_Recordset1[date_end];
					


mysql_query("update    usergroup   set   GroupName='Truemoney'  where UserName='$uid'    ")or    die ("Add ข้อมูลลง Table ไม่ได้ ");
mysql_query("INSERT INTO  radcheck  (UserName,Attribute,op,Value)
								values('$uid','Expiration',':=','$date_add_db')")  	or    die ("Add ข้อมูลลง Table ไม่ได้ ");
													
$texts="ผู้ใช้งาน $uid เติมเลขบัตรทรู $idcard จำนวนเงิน $money_total   วันหมดอายุการใช้งาน คือ  $date_add_db ";


mysql_query("INSERT INTO  noute_data  (UserName,texts,date_add,admin,domain)
		      values('$idcard', '$texts','$b'  ,'system','$domain_name' )") or trigger_error(mysql_error(),E_USER_ERROR);       		
			  
 $money_db=$money_total-($money_total*0.11);		  
 
mysql_query("INSERT INTO  card_true  (UserName,date_add,idcard,domain,cost,TF,identity)
		      values('$uid','$b'  ,'$idcard','$domain_name','$money_db' ,'0','$identity')") or trigger_error(mysql_error(),E_USER_ERROR);   			  			
		echo "<p><h4 style='color:green'>เรียบร้อย / Finish</h4></p>
		<p>จำนวนเงิน คือ $money_total บาท  /  Amount is $money_total THB</p>
		<p>ขอบคุณที่ใช้บริการครับ  / Thank you for using it.<br>
	         เรียบร้อยแล้ว วันหมดอายุการใช้งาน คือ  $date_add_db ! / Already The expiration date is $date_add_db!</p>";
			 echo "<br> ท่านสามารถกรอกรหัสผ่านเพื่อเข้าเล่นอินเตอร์เน็ตได้เลย <a href='http://www.google.co.th'> คลิก</a>";
	 if($TEL !=NULL){
 $MAXSMS=  iconv('TIS-620', 'UTF-8', $texts);
 //  $b = $sms->send( "020000000", $TEL, $MAXSMS);
   }		 			 
 
 //$MAXSMS=  iconv('TIS-620', 'UTF-8',"  $uid  $domain_name เติมเงิน $money_db บาท ");
 // $sms->send( "$SENDSMSNAME", '0878426256', $MAXSMS);
 

 $MAXSMS=  iconv('TIS-620', 'UTF-8'," WIFI $uid  วันหมดอายุการใช้งาน คือ  $date_add_db ");
 // $sms->send( "$SENDSMSNAME", '$tels', $MAXSMS);
  // กำหนด UID ของท่าน
define('UID', '31678');

// กำหนด API Token ของท่าน
define('TOKEN', '7ab89a13c207c05ddd801b379b09f8a4');

$postfields = 'uid=' . UID . '&token=' . TOKEN . '&msisdn='.$tels.'&message=' . rawurlencode($MAXSMS);
$curl = curl_init('https://www.tmtopup.com/sendsms_api.php');
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($curl, CURLOPT_TIMEOUT, 10);
curl_setopt($curl, CURLOPT_HEADER, FALSE);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, TRUE);
curl_setopt($curl, CURLOPT_POST, TRUE);
curl_setopt($curl, CURLOPT_POSTFIELDS, $postfields);
$curl_content = curl_exec($curl);
curl_close($curl);
unset($curl);
/*
$tels='0878426256';
$postfields = 'uid=' . UID . '&token=' . TOKEN . '&msisdn='.$tels.'&message=' . rawurlencode($MAXSMS);
$curl = curl_init('https://www.tmtopup.com/sendsms_api.php');
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($curl, CURLOPT_TIMEOUT, 10);
curl_setopt($curl, CURLOPT_HEADER, FALSE);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, TRUE);
curl_setopt($curl, CURLOPT_POST, TRUE);
curl_setopt($curl, CURLOPT_POSTFIELDS, $postfields);
$curl_content = curl_exec($curl);
curl_close($curl);
*/
			 exit();
		//-------------------------------------------------------------------------------------------
	}else{
		$error=$returnserver;//ค่าผิดพลาด ที่ไม่สามารถตัดบัตรได้
		
		//-------------------------------------------------------------------------------------------
		echo "<p><h4>ไม่สำเร็จ  กรุณาลองใหม่ หรือทำรายการในภายหลัง / Please try again or unsuccessful transaction later.</h4></p>
		<p>$error</p>
		<p><a href=''>[กลับไปลองอีกครั้ง / Go back and try again]</a> </p>";
 echo "<meta http-equiv=refresh content=5;URL=card_true_acctive.php?domain_name=$domain_name>";
		//-------------------------------------------------------------------------------------------
	}
} else{
	$capchar_session=capchar(my_ip(),$tmuser);
	$returnserver=tmtopupconnect($tmuser,$tmpassword,$trueuser,$truepassword,my_ip(),"","","no","","");
	if($returnserver=="ready"){
?>
<script>
co=0;
function loading(){
	co=co+1;
	switch(co)
	{
		case 1:
		char_load="โปรดรอสักครู่ ครับ  Please wait. |";
		break;
		case 2:
		char_load="โปรดรอสักครู่ ครับ  Please wait. /";
		break;
		case 3:
		char_load="โปรดรอสักครู่ ครับ  Please wait. -";
		break;
		case 4:
		char_load="โปรดรอสักครู่ ครับ Please wait. \\";
		co=0;
		break;
	}
	document.getElementById("loadvip").innerHTML=char_load;
	setTimeout("loading()", 100);
}	

</script>


	<hr>
	<div align="left">
	<form method="POST" name="tmtopup">
		<INPUT TYPE="hidden" NAME="send" value="ok">
		<INPUT TYPE="hidden" NAME="domain_name" value="<?php print $_GET[domain_name];?>">
		<INPUT TYPE="hidden" NAME="session" value="<?=$capchar_session?>">
		<table width="561" align="center">
			<tr bgcolor="#F3FBEE">
			  <td>Username Login:</td>
			  <td><INPUT TYPE="text" NAME="uid"></td></tr>
			<tr bgcolor="#EBF0FE"><td>เลขบัตร True Money:</td><td><input name="idcard" value="" size="14" maxlength="14"> 14 หลัก<br><font color="red">*กรอกติดกัน ไม่ต้องเว้นวรรค</font>
			<tr bgcolor="#F3FBEE">
			  <td>เบอร์โทรศัพท์</td>
			  <td><input name="tels" value="" size="14" maxlength="14" />
			    ไม่ต้องใส่ - </td>
		  </tr>
			<tr bgcolor="#F3FBEE">
			  <td>กรอกรหัส ตามภาพ
		      /Picger Code:</td>
			  <td><input name="capchar" maxlength="6" size="6"> <img src="http://tmtopup.thaighost.net/capchar.php?session=<?=$capchar_session?>"></td></tr>
			<tr bgcolor="#F4F2F7"><td colspan="2" align="center"><BR><div id="loadvip"></div>
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
		echo "<p>ยังไม่พร้อมใช้งาน โปรดติดต่อผู้ดูแลระบบ $returnserver</p>";
	}
}
?>
<hr>
<?php
//print my_ip();
print $_SERVER['HTTP_CLIENT_IP'];?>
</body>
</html>
