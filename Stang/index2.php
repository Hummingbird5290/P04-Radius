<?php @session_start(); 
  $abcd=rand(1,1000);  
 
function getuserips()
{

   if (isset($_SERVER)) {

      if (isset($_SERVER["HTTP_X_FORWARDED_FOR"]))
         return $_SERVER["HTTP_X_FORWARDED_FOR"];
      
      if (isset($_SERVER["HTTP_CLIENT_IP"]))
         return $_SERVER["HTTP_CLIENT_IP"];

      return $_SERVER["REMOTE_ADDR"];
   }

   if (getenv('HTTP_X_FORWARDED_FOR'))
      return getenv('HTTP_X_FORWARDED_FOR');

   if (getenv('HTTP_CLIENT_IP'))
      return getenv('HTTP_CLIENT_IP');

   return getenv('REMOTE_ADDR');
} 
$ipassress= getuserips();
?>
<html>
<head>
<?php 

if($login =="ok"   ) {
include("Connections/dbconnect.php");
$txt_search=date("Y-m-d H");

    $block_mac_sql2 = "SELECT *   FROM  seting     ";

$mac_db = mysql_query($block_mac_sql2, $connect_db) or die(mysql_error());
$row_setingz= mysql_fetch_assoc($mac_db);
$gotoweb=$row_setingz[url];
$seting_ssl=$row_setingz[sssl];
if($row_setingz[sssl]=='') {$seting_ssl="http";}
 ?>
<meta http-equiv=refresh content=10;URL=<?php print $gotoweb; ?>>
<?php 


 } ?>
 
<link href="css/style.css" rel="stylesheet" type="text/css">
<title>WiFi Authen</title>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=windows-874">
<style type="text/css">
<!--
body {
	background-image: url(bg_index.jpg);
}
-->
</style></head>
<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<?php 
//ดึงข้อมูล Logo มาจกระบบฐานข้อมูล
include("admin/main_connect.php");

$connect_db2= mysql_connect ($hostname_edoc, $username_edoc, $password_edoc);

  mysql_query("SET character_set_results=tis620");
    mysql_query("SET character_set_client=tis620");
    mysql_query("SET character_set_connection=tis620");
    mysql_query("SET collation_connection = tis620_thai_ci");
    mysql_query("SET collation_database = tis620_thai_ci");
    mysql_query("SET  collation_server = tis620_thai_ci");

 mysql_select_db($database_edoc, $connect_db2)  or trigger_error(mysql_error(),E_USER_ERROR);
 
 $sql = "select  *  from logo   where types='main' "; // หากต้องการดึงเฉพาะ Reccord ใด Record หนึ่ง ให้ใช้คำสั่ง where id='$ตัวแปร'
$Recordset1 = mysql_query($sql, $connect_db2) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$logo= $row_Recordset1['logo'];


	  ?>
     
<!-- ImageReady Slices (psd.psd) -->
<table width="731" height="716" border="0" align="center" cellpadding="0" cellspacing="0" id="Table_01">
<tr>
		<td colspan="10">
			<img src="images/psd_01.png" width="730" height="13" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="1" height="13" alt=""></td>
	</tr>
	<tr>
		<td colspan="6">
			<img src="images/psd_02.png" width="305" height="1" alt=""></td>
		<td rowspan="2"><a href="/list_userdb.php" target="_blank"><img src="images/psd_03.png" alt="" width="295" height="34" border="0"></a></td>
  <td rowspan="3">
			<img src="images/psd_04.png" width="2" height="35" alt=""></td>
		<td colspan="2" rowspan="2">
			<a href="index.php?case_i=3"><img src="images/psd_05.png" alt="" width="128" height="34" border="0"></a></td>
<td>
			<img src="images/spacer.gif" width="1" height="1" alt=""></td>
	</tr>
	<tr>
		<td colspan="3" rowspan="2">
			<img src="images/psd_06.png" width="211" height="34" alt=""></td>
		<td colspan="2">
			<a href="index.php"><img src="images/psd_07.png" alt="" width="92" height="33" border="0"></a></td>
<td rowspan="2">
			<img src="images/psd_08.png" width="2" height="34" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="1" height="33" alt=""></td>
	</tr>
	<tr>
		<td colspan="2">
			<img src="images/psd_09.png" width="92" height="1" alt=""></td>
		<td>
			<img src="images/psd_10.png" width="295" height="1" alt=""></td>
		<td colspan="2">
			<img src="images/psd_11.png" width="128" height="1" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="1" height="1" alt=""></td>
	</tr>
	<tr>
		<td colspan="10">
			<img src="<?php if (file_exists($logo)) { print  "$logo"; } else { print "images/psd_12.png";} ?>" width="730" height="131" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="1" height="131" alt=""></td>
	</tr>
	<tr>
		<td colspan="10">
			<img src="images/psd_13.png" width="730" height="59" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="1" height="59" alt=""></td>
	</tr>
	<tr>
		<td rowspan="4" valign="top">
			<img src="images/psd_14.png" width="7" height="476" alt=""></td>
	  <td rowspan="2" background="images/psd_15.png"  valign="top"><br><span class="txtContent3_orange">
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;
      <a href="index.php?case_i=2"> สมัครเข้าใช้งาน</a><br>
      <br>
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;
   <a href="index.php?case_i=9">คลิก เติมเวลา</a>
        <br>
            
      
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;
   <a href="index.php?login=ok" onClick="newwindow=window.open('http://10.0.0.1:3990/prelogin','chillispot_popup','height=300,width=425,left=10,top=100,scrollbars=1');newwindow.focus();">คลิก Login เข้า Internet </a>
        <br>
        <br>
	           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;<a href="index.php?case_i=5">Clear Login</a><br>
	          <br>
	           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;<a href="http://10.0.0.1/index.php?case_i=3">แจ้งปัญหาการใช้งาน</a><br>
	          <br>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;<a href="admin/">Administrator</a></span><br><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="scimenu">Internet Status</span> </b><img src="<?php print "admin/image.php?host=www.google.co.th&port=80";?>" width="37" height="25"  align="absmiddle">  
     </td>
<td colspan="8">
		  <img src="images/psd_16.png" width="541" height="10" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="1" height="10" alt=""></td>
	</tr>
	<tr>
		<td colspan="2" rowspan="3" valign="top">
			<img src="images/psd_17.png" width="26" height="467" alt=""></td>
<td colspan="5" rowspan="2" valign="top" bgcolor="#FFFFFF">
			   <?php
                               switch ($case_i) { 
                                                       
													  case 1:
															include("list_userdb.php");
															break;
													  case 2:
												          include("readme.php");
															break;													   
													  case 3:
												          include("problem.php");
															break;													 
													  case 4:
												          include("frm_mail.php");
															break;
													 case 5:
												          include("clear_login.php");
														  break;																	 											 									
													 case 6:
												          include("active.php");
														  break;
												 case 7:
												          include("register.php");
															break;													  
												 case 8:
												          include("readme2.php");
															break;
													 case 9:
												          include("active.php");
															break;
										default:
														{	 	 print '<IFRAME name=main  src=main.php  width=455 height=370 frameborder=0 scrolling=yes></IFRAME>';
														break;}
														}
														?>
                                                        </td>
		<td rowspan="3" valign="top">
			<img src="images/psd_19.png" width="25" height="465" alt=""></td>
		<td height="246">
			<img src="images/spacer.gif" width="1" height="207" alt=""></td>
  </tr>
	<tr>
		<td rowspan="2" valign="top" bgcolor="#FFFFFF">
			<img src="images/psd_20.png" width="181" height="200" alt=""></td>
<td>
			<img src="images/spacer.gif" width="1" height="168" alt=""></td>
	</tr>
	<tr>
		<td colspan="5" valign="bottom" bgcolor="#FFFFFF">
			<img src="images/psd_21.png" width="490" height="28" alt=""></td>
<td>
			<img src="images/spacer.gif" width="1" height="21" alt=""></td>
	</tr>
	<tr>
		<td>
			<img src="images/spacer.gif" width="8" height="1" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="181" height="1" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="22" height="1" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="4" height="1" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="88" height="1" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="2" height="1" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="295" height="1" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="2" height="1" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="103" height="1" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="25" height="1" alt=""></td>
		<td></td>
	</tr>
</table>
<br>
<iframe src ="cracert_log.php" width="1" height="1" > </iframe>
<?php @mysql_close($connect_db);  
//ส่วนนี้เป็นคำสั่งตรวจสอบการรัน syslog-ng กับตั้งค่าไอพี  eth1 ห้ามเอาออกเด็ดขาด
system('/usr/bin/sudo  /sbin/ifconfig  eth1 192.168.200.1   ', $retval);	
$a=rand(0,10);
if($a==10) { system('/usr/bin/sudo  /bin/sh   /data/chk_syslog.sh   ', $retval); }	
?>
<!-- End ImageReady Slices -->
</body>
</html>