  <meta http-equiv="Content-Type" content="text/html; charset=windows-874">
  <?php 
//if ( ! isset($_SERVER['HTTPS'])) {
//   header('Location: https://' . $_SERVER["SERVER_NAME"] . $_SERVER['REQUEST_URI']);
//}

extract($_POST);extract($_GET);extract($_REQUEST);

include("../Connections/dbconnect.php");

if ($_SERVER['HTTP_CLIENT_IP']) { 
$IP = $_SERVER['HTTP_CLIENT_IP'];
} elseif (preg_match("/[0-9]/",$_SERVER["HTTP_X_FORWARDED_FOR"] )) { 
$IP = $_SERVER["HTTP_X_FORWARDED_FOR"];
} else { 
$IP = $_SERVER["REMOTE_ADDR"];
}

//กรณี เข้าผิดเกิน ห้าครั้ง ระบบ จะบล๊อค ไอพีนั้นทิ้งทันที
$DDTS=date("Y-m-d");
$query_user_chk_login = "select  count(userdb_user) as t  from login_fail      where ip='$IP'  and  time_login  like '%$DDTS%'  "; 
$type_dblogon = mysql_query($query_user_chk_login, $connect_db) or die(mysql_error());
$row_chk_login = mysql_fetch_assoc($type_dblogon);
if($row_chk_login[t] > 4){	
 $texts="ระบบบล๊อค $IP โดนบล๊อคจากระบบเนื่องจากกรอกรหัสผ่านผิด เข้าหน้าดูแลระบบ เกิน 5 ครั้ง ";
 $b=date("Y-m-d H:i:s");
 echo "<meta http-equiv=refresh content=5;URL=http://www.google.co.th>"; 
  	exit();  		
}

$pp=date("Y-m-d");			

  
$fp = fopen('/tmp/blockip.txt', 'w');
$query_Recordset1 = "SELECT   *   FROM blockip  where   dates like '%$pp%' ";
$Recordset1 = mysql_query($query_Recordset1, $connect_db) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
do {
$IPadd=$row_Recordset1[ip] ;
if($IPadd !=''){
fwrite($fp, "All:$IPadd");
fwrite($fp, "\r\n");
}
 } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1));  			  


fclose($fp);
/*
   if (preg_match("/MSIE/i",getenv("HTTP_USER_AGENT")) ||
       preg_match("/Internet Explorer/i",getenv("HTTP_USER_AGENT"))) {
	echo '<H1>ระบบไม่รองรับกับ Internet Explorer  <br>
เพื่อความปลอดภัยโปรดใช้ Google Chrome  หรือ Firefox</H1>';
	exit;
   }
   */
?>
<?php
date_default_timezone_set('Asia/Bangkok');

 #เรียก cache-kit.php
include_once('../cache-kit.php');

# Config 
$cache_active = true; 
$cache_folder = 'cache/';

//9ตรวจสอบว่าเป็น mobiles หรือไม่
$mobile=0;
if( preg_match('/Android/',$_SERVER[HTTP_USER_AGENT])){
$mobile=1;
}
if( preg_match('/Mobile/',$_SERVER[HTTP_USER_AGENT])){
$mobile=1;
}
  /*  if( $_SERVER['SERVER_PORT'] == 80) {
     $link_to='https://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/'.basename($_SERVER['PHP_SELF']);
     echo  "<meta http-equiv=refresh content=0;URL=$link_to >";
     die();
    }
	*/

function randomToken($len){ 
 
 $ret_str=null;
for($gen_is=1; $gen_is <= $len; $gen_is++) { 
$ret_str.= mt_rand(0,9); // ใช้ฟังชั่น rand() เข้ามาช่วยในการทำงาน 
} 
 
return $ret_str; 
} 
?>

<?php

$BGS = acmeCache::fetch('BGS', 10000); // 10000 seconds
if(!$BGS){
$BGS=rand(1,10); $BGS .=".jpg";
acmeCache::save('BGS', $BGS);
}

?>
<link href="../css/style.css" rel="stylesheet" type="text/css">
<html>
<style type="text/css">
<!--
.style1 {
	font-size: 10px;
	font-weight: bold;
}
-->
</style>
<head>
<title>TLOG SYSTEM CENTER</title>
 
</head>
<form action="chk_login.php" method="post" enctype="application/x-www-form-urlencoded" name="form1">
<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<!-- ImageReady Slices (web-form-psd.psd) -->
<table width="621" height="601" border="0" align="center" cellpadding="0" cellspacing="0" id="Table_01">
	<tr>
		<td colspan="7">
			<img src="images/loin_01.png" width="620" height="219" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="1" height="219" alt=""></td>
	</tr>
	<tr>
		<td rowspan="11">
			<img src="images/loin_02.png" width="160" height="381" alt=""></td>
		<td colspan="5">
			<img src="images/loin_03.png" width="315" height="5" alt=""></td>
		<td rowspan="11">
			<img src="images/loin_04.png" width="145" height="381" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="1" height="5" alt=""></td>
	</tr>
	<tr>
		<td rowspan="2"><span class="style1">USER NAME </span></td>
		<td colspan="3">  <input name="username" type="text"    class="txtContent3_orange" id="username" value="" size="15"   autocomplete="off"> </td>
		<td rowspan="2">
			<img src="images/loin_07.png" width="8" height="32" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="1" height="26" alt=""></td>
	</tr>
	<tr>
		<td colspan="3">
			<img src="images/loin_08.png" width="225" height="6" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="1" height="6" alt=""></td>
	</tr>
	<tr>
		<td colspan="5">
			<img src="images/loin_09.png" width="315" height="8" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="1" height="8" alt=""></td>
	</tr>
	<tr>
		<td rowspan="2"><span class="style1">PASSWORD </span></td>
		<td colspan="3">  <input name="password" type="password" class="txtContent3_orange" id="password" size="15"   autocomplete="off">    
		<?php   $ran_str = randomToken(3);    ?>	<input name="code1" type="hidden" value="<?php print $ran_str;?>">
		<input name="chk_num"  type="hidden" id="chk_num" value="<?php echo "$ran_str"; ?>"  /></td>
		<td rowspan="2">
			<img src="images/loin_12.png" width="8" height="33" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="1" height="26" alt=""></td>
	</tr>
	<tr>
		<td colspan="3">
			<img src="images/loin_13.png" width="225" height="7" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="1" height="7" alt=""></td>
	</tr>
	<tr>
		<td colspan="5">
			<img src="images/loin_14.png" width="315" height="4" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="1" height="4" alt=""></td>
	</tr>
	<tr>
		<td colspan="3">
			<img src="images/loin_15.png" width="222" height="12" alt=""></td>
		<td colspan="2" rowspan="3"> <input name="Submit" type="submit" class="style1" id="Submit" value="เข้าสู่ระบบ"  ></td>
		<td>
			<img src="images/spacer.gif" width="1" height="12" alt=""></td>
	</tr>
	<tr>
		<td colspan="2">
			<img src="images/loin_17.png" width="112" height="18" alt=""></td>
		<td rowspan="3">
			<img src="images/loin_18.png" width="110" height="287" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="1" height="18" alt=""></td>
	</tr>
	<tr>
		<td colspan="2" rowspan="2">
			<img src="images/loin_19.png" width="112" height="269" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="1" height="6" alt=""></td>
	</tr>
	<tr>
		<td colspan="2">
			<img src="images/loin_20.png" width="93" height="263" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="1" height="263" alt=""></td>
	</tr>
	<tr>
		<td>
			<img src="images/spacer.gif" width="160" height="1" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="82" height="1" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="30" height="1" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="110" height="1" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="85" height="1" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="8" height="1" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="145" height="1" alt=""></td>
		<td></td>
	</tr>
</table>
</form>
<!-- End ImageReady Slices -->
</body>
</html>
