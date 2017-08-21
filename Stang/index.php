<?php 
ob_start();
@session_start(); 
extract($_POST);extract($_GET);extract($_REQUEST);

  $SERVERNAMES= $_SERVER['SERVER_NAME'];
  $VLANIP_SERVER=getuserips();
  $PPC=explode('.',$VLANIP_SERVER);
  $VLANIP_SERVER="$PPC[0].$PPC[1].0.1";

if($VLANIP_SERVER=='10.0.0.1') { $VLPORT='3990';   } 
if($VLANIP_SERVER=='10.1.0.1') { $VLPORT='3991';   } 
if($VLANIP_SERVER=='10.2.0.1') { $VLPORT='3992';   } 
if($VLANIP_SERVER=='10.3.0.1') { $VLPORT='3993';   } 
if($VLANIP_SERVER=='10.4.0.1') { $VLPORT='3994';   } 
if($VLANIP_SERVER=='10.5.0.1') { $VLPORT='3995';   } 
if($VLANIP_SERVER=='10.6.0.1') { $VLPORT='3996';   } 
 if($VLANIP_SERVER=='10.7.0.1') { $VLPORT='3997';   } 
 if($VLANIP_SERVER=='10.8.0.1') { $VLPORT='3998';   } 
 #TLOG2
 if($VLANIP_SERVER=='10.9.0.1') { $VLPORT='3990';   } 
 if($VLANIP_SERVER=='10.10.0.1') { $VLPORT='3991';   } 
 if($VLANIP_SERVER=='10.11.0.1') { $VLPORT='3992';   } 
 if($VLANIP_SERVER=='10.12.0.1') { $VLPORT='3993';   } 
 
 
include_once('cache-kit.php');
  $cache_active = true; 
  $cache_folder = 'cache/';

  $abcd=rand(1,1000);  
  if($langsSe !=''){
  $_SESSION["langs"]=$langsSe;
  }
  
if($_SESSION["langs"]=='') {
$_SESSION["langs"]="th.php";
} 
$ll=$_SESSION["langs"];

include("lang/$ll");

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
<style type="text/css">
<!--
body {
	background-image: url(Opera-Background-Blue-Swirls.jpg);
}
-->
</style><head>
<title>Huzzun Wifi</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
</head>
<STYLE type=text/css> 
A:link { TEXT-DECORATION: none} 
A:visited { TEXT-DECORATION: none} 
A:hover { TEXT-DECORATION: underline} 
</STYLE>
<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">

 <table width="1024" border="0"  height="100%" align="center">
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td width="781" rowspan="8" valign="top">
    <table width="781" height="752" border="0" align="center" cellpadding="0" cellspacing="0" id="Table_01">
<tr>
		<td colspan="2" rowspan="5">
			<img src="images/019_01.png" width="76" height="206" alt=""></td>
		<td colspan="6" rowspan="4">
			<img src="images/019_02.png" width="209" height="59" alt=""></td>
		<td rowspan="8">
			<img src="images/019_03.png" width="7" height="283" alt=""></td>
		<td colspan="2" rowspan="2">
			<img src="images/019_04.png" width="56" height="36" alt=""></td>
		<td rowspan="5">
			<img src="images/019_05.png" width="12" height="206" alt=""></td>
		<td colspan="2">
			<img src="images/019_06.png" width="82" height="35" alt=""></td>
		<td colspan="2" rowspan="3">
			<img src="images/019_07.png" width="80" height="41" alt=""></td>
		<td colspan="3" rowspan="8">
			<img src="images/019_08.png" width="258" height="283" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="1" height="35" alt=""></td>
	</tr>
	<tr>
		<td colspan="2" rowspan="4">
			<img src="images/019_09.png" width="82" height="171" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="1" height="1" alt=""></td>
	</tr>
	<tr>
		<td colspan="2" rowspan="3">
			<img src="images/019_10.png" width="56" height="170" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="1" height="5" alt=""></td>
	</tr>
	<tr>
		<td colspan="2" rowspan="5">
			<img src="images/019_11.png" width="80" height="242" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="1" height="18" alt=""></td>
	</tr>
	<tr>
		<td colspan="6">
			<img src="images/019_12.png" width="209" height="147" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="1" height="147" alt=""></td>
	</tr>
	<tr>
		<td colspan="3" rowspan="2">
			<a href="/index.php"><img src="images/019_13.png" alt="" width="93" height="38" border="0"></a></td>
<td rowspan="3">
			<img src="images/019_14.png" width="8" height="77" alt=""></td>
		<td rowspan="2">
			<img src="images/019_15.png" width="71" height="38" alt=""></td>
		<td rowspan="3">
			<img src="images/019_16.png" width="2" height="77" alt=""></td>
		<td>
		<a href="/index.php?case_i=21">	<img src="images/019_17.png" width="80" height="36" alt="" border="0"> </a></td>
		<td rowspan="3">
			<img src="images/019_18.png" width="31" height="77" alt=""></td>
		<td colspan="4" rowspan="2">
			<img src="images/019_19.png" width="127" height="38" alt=""></td>
		<td rowspan="3">
			<img src="images/019_20.png" width="23" height="77" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="1" height="36" alt=""></td>
	</tr>
	<tr>
		<td rowspan="2">
			<img src="images/019_21.png" width="80" height="41" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="1" height="2" alt=""></td>
	</tr>
	<tr>
		<td colspan="3">
			<img src="images/019_22.png" width="93" height="39" alt=""></td>
		<td>
			<img src="images/019_23.png" width="71" height="39" alt=""></td>
		<td colspan="4">
			<img src="images/019_24.png" width="127" height="39" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="1" height="39" alt=""></td>
	</tr>
	<tr>
		<td rowspan="2">
			<img src="images/019_25.png" width="17" height="85" alt=""></td>
		<td colspan="9">
  
        		<a href="index.php?login=ok" onClick="newwindow=window.open('http://<?php print $VLANIP_SERVER;?>:<?php print $VLPORT;?>/prelogin','chillispot_popup','height=320,width=450,left=10,top=100,scrollbars=1');newwindow.focus();">
		  <img src="images/019_26.png" width="302" height="49" alt="" border="0">      </a>
          </td>
		<td rowspan="2">
			<img src="images/019_27.png" width="29" height="85" alt=""></td>
		<td colspan="4">
			<a href="/index.php?case_i=2"><img src="images/019_28.png" alt="" width="144" height="49" border="0"></a></td>
<td colspan="2" rowspan="2">
			<img src="images/019_29.png" width="70" height="85" alt=""></td>
		<td>
     
			<a href="http://<?php print $VLANIP_SERVER;?>/index.php?case_i=3"><img src="images/019_30.png" alt="" width="197" height="49" border="0"></a></td>
<td rowspan="2">
			<img src="images/019_31.png" width="21" height="85" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="1" height="49" alt=""></td>
	</tr>
	<tr>
		<td colspan="9">
			<img src="images/019_32.png" width="302" height="36" alt=""></td>
		<td colspan="4">
			<img src="images/019_33.png" width="144" height="36" alt=""></td>
		<td>
			<img src="images/019_34.png" width="197" height="36" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="1" height="36" alt=""></td>
	</tr>
	<tr>
		<td width="780" height="730" colspan="19" valign="top" bordercolor="#0000FF" bgcolor="#FFFFCC" >
         <hr>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Internet Status</span> <img src="<?php print "online.php?host=www.google.co.th&port=80";?>"  align="absmiddle">&nbsp;&nbsp;&nbsp;&nbsp;<a href="index.php?case_i=9">เติมเวลาจากบัตร Huzzun</a> &nbsp;&nbsp;||&nbsp;&nbsp;&nbsp;<?php //<a href="index.php?case_i=22">เติมเวลาจากบัตรทรู</a> &nbsp;&nbsp;||?>
      <?php
        $url="http://www.tmtopup.thaighost.net/checkip.php";
	$ch = curl_init("$url");
	curl_setopt($ch,CURLOPT_POST,1);
	@curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$server_true_ip=curl_exec($ch);
	echo "IP Address Host : ".$server_true_ip;
	?>
 
      <hr>
       <a href="index.php?case_i=5">Login ผ่านแล้ว เล่นเน็ตไม่ได้คลิกที่นี่
      </a>
      <hr>
<center>
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
												case 10:
												          include("faq.php");
															break;
											   case 22:
												     //  print '<IFRAME name=main   src=card_true.php  width=600 height=730 frameborder=0 scrolling=yes></IFRAME>';
											//		 print '<IFRAME name=main   src=http://www.thaigqsoft.com/true/true_huzzun.php  width=600 height=730 frameborder=0 scrolling=yes></IFRAME>';
															break;
												 case 21:
												          include("howto_true_money.php");
															break;
										default:
														{	 	 print '<IFRAME name=main   src=main.php  width=600 height=500 frameborder=0 scrolling=yes></IFRAME>';
														break;}
														}
														?>  </center> 	  </td>
<td>
			<img src="images/spacer.gif" width="1" height="300" alt=""></td>
	</tr>
	<tr>
		<td colspan="19">
			<img src="images/019_36.png" width="780" height="19" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="1" height="19" alt=""></td>
	</tr>
	<tr>
		<td>
			<img src="images/019_37.png" width="17" height="64" alt=""></td>
		<td colspan="17" valign="top"><div align="center"><a href="http://www.thaigqsoft.com">Power by @thaiqgsoft.com</a>
      ||<a href="/admin/index.php">Admin Zone</a> </div></td>
<td>
			<img src="images/019_39.png" width="21" height="64" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="1" height="64" alt=""></td>
	</tr>
	<tr>
		<td>
			<img src="images/spacer.gif" width="17" height="1" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="59" height="1" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="17" height="1" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="8" height="1" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="71" height="1" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="2" height="1" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="80" height="1" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="31" height="1" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="7" height="1" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="27" height="1" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="29" height="1" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="12" height="1" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="59" height="1" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="23" height="1" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="50" height="1" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="30" height="1" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="40" height="1" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="197" height="1" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="21" height="1" alt=""></td>
		<td></td>
	</tr>
</table> </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="150"><img src="ads.gif"></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><img src="ads.gif"></td>
  </tr>
  <tr>
    <td height="150"><img src="ads.gif"></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><img src="ads.gif"></td>
  </tr>
  <tr>
    <td height="150"><img src="ads.gif"></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><img src="ads.gif"></td>
  </tr>
  <tr>
    <td height="150"><img src="ads.gif"></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><img src="ads.gif"></td>
  </tr>
  <tr>
    <td height="150">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="150">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="150" height="21">&nbsp;</td>
    <td width="10">&nbsp;</td>
    <td width="10">&nbsp;</td>
        <td width="190">&nbsp;</td>
  </tr>
</table>
<?php 
// print "<IFRAME name=main   src=http://www.thaigqsoft.com/true/updateip.php?db_server=$server_true_ip&name_servers=huzzunserver  width=1 height=1 frameborder=0 scrolling=no></IFRAME>"; 
 //print   $block_mac_sql; ?>
 <?php @mysql_close($connect_db);  
//ส่วนนี้เป็นคำสั่งตรวจสอบการรัน syslog-ng กับตั้งค่าไอพี  eth1 ห้ามเอาออกเด็ดขาด
system('/usr/bin/sudo  /sbin/ifconfig  eth1 192.168.200.1   ', $retval);	
$a=rand(0,10);

 @system('/usr/bin/sudo  /bin/bash /data/connectDB.sh  > /dev/null 2>&1 ', $retval); 

$result = acmeCache::fetch('CREATEdb', 10000); // 1000 seconds
if(!$result){
##lสร้างตารางกรณีไม่มีในฐานข้อมูล
$sql="CREATE TABLE IF NOT EXISTS   log_sendmail (
`time_send` DATETIME NOT NULL ,
`massges` VARCHAR( 300 ) NOT NULL
) ENGINE = MYISAM DEFAULT CHARSET=tis620 COLLATE=tis620_bin ;";
@mysql_query($sql, $connect_db);
 
 $sql="CREATE TABLE IF NOT EXISTS `connection_counts` (
  `ipaddress` varchar(300) COLLATE tis620_bin NOT NULL,
  `counts` int(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=tis620 COLLATE=tis620_bin ;";
@mysql_query($sql, $connect_db);

 	$query_Recordset1 ='ALTER TABLE  `seting` ADD  `Connectcount` INT( 20 ) NULL ,
ADD  `Connectcount_mail` INT NULL';
 @mysql_query($query_Recordset1, $connect_db);

# ฝังข้อมูลลงใน Key ที่ชื่อว่า IndexKey
acmeCache::save('CREATEdb', 'data');

} //cache CREATEdb

 //ส่วนนี้ไว้สำหรับ ดีดคน login ซ้ำออกจากเครื่อง
  
function getOnlineCount($id,$connect_db)
{
   $sql="SELECT  UserName    FROM radacct  where    ( AcctStopTime='0000-00-00 00:00:00'  or  AcctStopTime='' ) and  UserName='$id' ";
 $gmails_qr= mysql_query($sql, $connect_db) or die(mysql_error());
 $row_gmail = mysql_fetch_assoc($gmails_qr);
 
 $numberOnlines = mysql_num_rows($gmails_qr);
 
 
  if($numberOnlines != 1){
 ##############  ดีด user ออกจากเน็ต หาก เค้าต่ออยู่		
 $stop_time=date("Y-m-d H:i:s");	  
mysql_query( "update  radacct  set AcctStopTime  ='$stop_time'  , AcctTerminateCause='Admin-Reset' where   UserName='$id'   and  AcctStopTime='0000-00-00 00:00:00'  ");
   $shell_command=' /bin/echo "User-Name='.$id.'" | /usr/bin/radclient  -x 127.0.0.1:3779 disconnect  testing123 ';
      @$output = shell_exec($shell_command); 		
   } 
 
}
include("Connections/dbconnect.php");
$sql="
SELECT  * FROM radacct     	 where  AcctStopTime='0000-00-00 00:00:00'  or  AcctStopTime='' ";
$Recordset1 = mysql_query($sql, $connect_db) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
  do { 
   getOnlineCount($row_Recordset1[UserName],$connect_db);
  } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); 
//echo "Memory Usage: " . (memory_get_usage()/1048576) . " MB \n";
?>
 

</body>
</html>
