<?php 
header('Content-Type: text/html; charset=utf-8');
ob_start();
session_start();
// print   $_SERVER["REQUEST_URI"];
extract($_POST);extract($_GET);extract($_REQUEST);

 if($_SESSION["domain"]=='demo'){
 $bb=  iconv('TIS-620', 'UTF-8', "ผู้ใช้ ทดสอบระบบ ส่ง sms ไม่ได้ :P ");
      echo                  "<script type=text/javascript>";
		    echo                  "alert('$bb ')";
	        echo                  "</script>";  
echo "<meta http-equiv='refresh' content='0; url=https://www.thaigqsoft.info/index.php?case_i=2'>" ; 
 exit();
 
}

if ($_SERVER['HTTP_CLIENT_IP']) {
	$IP = $_SERVER['HTTP_CLIENT_IP'];
} elseif (preg_match("/[0-9]/",$_SERVER["HTTP_X_FORWARDED_FOR"] )) {
	$IP = $_SERVER["HTTP_X_FORWARDED_FOR"];
} else {
	$IP = $_SERVER["REMOTE_ADDR"];
}
$SENDSMSNAME='020000000';


include("../Connections/dbconnect.php");
include("sms.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=windows-874">

<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
}

.style24 {
	font-family: "MS Sans Serif", Sans-serif, "Microsoft Sans Serif";
	font-size: 10;
}

.style25 {
	font-size: 10
}

.style27 {
	font-size: 10;
	color: #FF0000;
}

.style30 {
	font-family: "MS Sans Serif", Sans-serif, "Microsoft Sans Serif";
	font-weight: bold;
}
-->
</style>
</head>

<body>
	<?php

	mysql_select_db($database_edoc,$connect_db);
		$NN=date("Y-m-d");
		$NY=date("Y-m");
		$mail_send = htmlspecialchars("$mail_send", ENT_QUOTES);
	 	$query_Recordset1 = " SELECT  count(users)  as a   FROM  count_sms   WHERE users = '$mail_send'   and  dates like '%$NY%'     ";
	$Recordset1 = mysql_query($query_Recordset1, $connect_db) or die(mysql_error());
	$row_Recordset1 = mysql_fetch_assoc($Recordset1);
	
	if($row_Recordset1[a] >3 and $_GET[adminOK]==NULL){
	$MAXSMS='ท่านใช้  การแจ้งลืมรหัสผ่านเกิน 3 ครั้ง / เดือน';
	$MAXSMS=  iconv('TIS-620', 'UTF-8', $MAXSMS);
	    echo                  "<script type=text/javascript>";
		echo                  "alert(' $MAXSMS')";
		echo                  "</script>";
 	echo "<meta http-equiv='refresh' content='0; url=forget_pass.php?domain_name=$domain_name'>" ; exit();
 	}
 	$query_Recordset1 = " SELECT  *      FROM  register   WHERE UserName = '$mail_send'      and domain='$domain_name'   ";
	$Recordset1 = mysql_query($query_Recordset1, $connect_db) or die(mysql_error());
	$row_Recordset1 = mysql_fetch_assoc($Recordset1);
	 
    $TEL=$row_Recordset1[tel];
	$phones=$row_Recordset1[tel];
	$psuser=$row_Recordset1[pass_rec];
	# DECODE(pass,'thaigqsoft')
  $query_Recordset1 = " SELECT    *, pass  as upass FROM  radpostauth   WHERE user = '$mail_send'     and reply='Access-Accept'   order by date DESC    ";
	$Recordset1 = mysql_query($query_Recordset1, $connect_db) or die(mysql_error());
	$row_Recordset1 = mysql_fetch_assoc($Recordset1);

	$UserName=$row_Recordset1['user'];
	$password=$row_Recordset1['upass'];
 	if($UserName=='' or $password==''){
	$MAXSMS='ไม่พบชื่อผู้ใช้งานของท่านในระบบ';
	$MAXSMS=  iconv('TIS-620', 'UTF-8', $MAXSMS);
        echo                  "<script type=text/javascript>";
		echo                  "alert(' $MAXSMS ')";
		echo                  "</script>";
		echo "<meta http-equiv='refresh' content='0; url=forget_pass.php?domain_name=$domain_name'>" ; exit();	
	}

if($psuser !=''){	 	
 $textarea="wifi user = $UserName pass = $psuser";
	} else {
 $textarea="wifi user = $UserName pass = $password";	
	}	
//	$textarea=  iconv('UTF-8', 'TIS-620', $textarea);
 if($TEL !=NULL){
$pattern = '/-/i';
$replacement = NULL;
$TEL= preg_replace($pattern, $replacement, $TEL);

$pattern = '/ /i';
$replacement = NULL;
$TEL= preg_replace($pattern, $replacement, $TEL);

$SMSSQL = " SELECT   * from sms_seting where domain='$domain_name'    ";
// $SMSSQL = " SELECT   * from sms_seting where domain='huzzun'    ";
	$Recordsetsms= mysql_query($SMSSQL, $connect_db) or die(mysql_error());
	$row_sms = mysql_fetch_assoc($Recordsetsms);
 
$sms = new thsms();
$sms->username   = $row_sms[users];
$sms->password   = $row_sms[pass];

if($row_sms[users]==''  or $row_sms[pass]=''){
 $MAXSMS='ระบบไม่พร้อมใช้งาน โปรดติดต่อผู้ดูแลระบบ';
 $MAXSMS=  iconv('TIS-620', 'UTF-8', $MAXSMS);
 echo                  "<script type=text/javascript>";
		echo                  "alert(' $MAXSMS ')";
		echo                  "</script>";
 	echo "<meta http-equiv='refresh' content='0; url=http://www.thaigqsoft.info/forget_pass.php?domain_name=$domain_name'>" ; exit();
}
  print '<br>';
//$a = $sms->getCredit();
//var_dump( $a);
//print_r($a); 
 print '<br>';
#SMS 

  $b = $sms->send( "$SENDSMSNAME", $TEL, $textarea);

if($TEL==NULL){
$MAXSMS='ไม่พบหมายเลขโทรศัพท์ ของผู้ใช้';
 $MAXSMS=  iconv('TIS-620', 'UTF-8', $MAXSMS);
 echo                  "<script type=text/javascript>";
		echo                  "alert(' $MAXSMS ')";
		echo                  "</script>";
if($_GET[adminOK]=='OK'){
echo "<meta http-equiv='refresh' content='0; url=https://www.thaigqsoft.info/index.php?case_i=2'>" ; 
}else {
echo "<meta http-equiv='refresh' content='0; url=forget_pass.php?domain_name=$domain_name'>" ; 
 }
 exit();
}
//var_dump( $b);
 print '<br>';
 //print_r($b);
 {
 $MAXSMS="ระบบได้แจ้งรหัสผ่านไปที่เบอร์ โทรศัพท์ $phones ของท่านแล้ว ";
	$MAXSMS=  iconv('TIS-620', 'UTF-8', $MAXSMS);
	echo                  "<script type=text/javascript>";
		echo                  "alert(' $MAXSMS  ')";
		echo                  "</script>";
		
		//count_sms
if($_GET[adminOK]=='OK'){
echo "<meta http-equiv='refresh' content='0; url=https://www.thaigqsoft.info/index.php?case_i=2'>" ; 
}
if($_GET[adminOK]==NULL){
echo "<meta http-equiv='refresh' content='0; url=forget_pass.php?domain_name=$domain_name'>" ; 
 mysql_query("INSERT INTO  count_sms (users,dates) values('$mail_send','$NN')", $connect_db) or die(mysql_error());
}
 		exit();
}
 
} else {
 $MAXSMS="ไม่พบรหัสผ่าน หรือหมายเลขโทรศัพท์ของ  $mail_send ";
 	$MAXSMS=  iconv('TIS-620', 'UTF-8', $MAXSMS);
 echo                  "<script type=text/javascript>";
		echo                  "alert(' $MAXSMS ')";
		echo                  "</script>";

	if($_GET[adminOK]=='OK'){
echo "<meta http-equiv='refresh' content='0; url=http://www.thaigqsoft.info/index.php?case_i=2'>" ; 
}else {
echo "<meta http-equiv='refresh' content='0; url=forget_pass.php?domain_name=$domain_name'>" ; 
 }
 		exit();
	 
}

	//#####################################
	?>

</body>
</html>
