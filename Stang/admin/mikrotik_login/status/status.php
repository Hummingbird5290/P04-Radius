<?php
ob_start();
session_start();
include("db.php");
ini_set('date.timezone ', 'Asia/Bangkok');
/*
    ini_set('display_errors', 0);
   error_reporting(0); 
   */
  ini_set("max_execution_time", "30000");
  
//include("/var/www/html/google.php");
$rad=rand(0,50);
if($rad==15){
  $query_seting = "delete   FROM radcheck  where   Attribute=''    ";
  mysql_query($query_seting, $connect_db) or die(mysql_error());
  $query_seting = "delete   FROM radcheck  where   Value=''    ";
  mysql_query($query_seting, $connect_db) or die(mysql_error());
}
function formatBytes($bytes) {
        if ($bytes >= 1073741824)
        {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        }
        elseif ($bytes >= 1048576)
        {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        }
        elseif ($bytes >= 1024)
        {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        }
        elseif ($bytes > 1)
        {
            $bytes = $bytes . ' bytes';
        }
        elseif ($bytes == 1)
        {
            $bytes = $bytes . ' byte';
        }
        else
        {
            $bytes = '0 bytes';
        }

        return $bytes;
}

  function UDataCHK($name,$connect_db) {
 
     mysql_query("SET character_set_results=tis620");
    mysql_query("SET character_set_client=tis620");
    mysql_query("SET character_set_connection=tis620");
    mysql_query("SET collation_connection = tis620_thai_ci");
    mysql_query("SET collation_database = tis620_thai_ci");
    mysql_query("SET  collation_server = tis620_thai_ci");
	
$query_Max = "SELECT  *  from radcheck  where   UserName ='$name'  and Attribute='Expiration'   ";
 $Recordset1_Max = mysql_query($query_Max, $connect_db) or die(mysql_error());
$row_Max = mysql_fetch_assoc($Recordset1_Max);
  
return $times=$row_Max[Value];

}
/*
Author: Daniel Kassner
Website: http://www.danielkassner.com
*/
function getOS($userAgent) {
  // Create list of operating systems with operating system name as array key 
	$oses = array (
		'iPhone' => '(iPhone)',
		'Windows 3.11' => 'Win16',
		'Windows 95' => '(Windows 95)|(Win95)|(Windows_95)', // Use regular expressions as value to identify operating system
		'Windows 98' => '(Windows 98)|(Win98)',
		'Windows 2000' => '(Windows NT 5.0)|(Windows 2000)',
		'Windows XP' => '(Windows NT 5.1)|(Windows XP)',
		'Windows 2003' => '(Windows NT 5.2)',
		'Windows Vista' => '(Windows NT 6.0)|(Windows Vista)',
		'Windows 7' => '(Windows NT 6.1)|(Windows 7)',
		'Windows NT 4.0' => '(Windows NT 4.0)',
        'Windows  8' => '(Windows NT 6.2)',	
		'Windows ME' => 'Windows ME',
		'Open BSD'=>'OpenBSD',
		'Sun OS'=>'SunOS',
		'Linux'=>'(Linux)|(X11)',
		'Safari' => '(Safari)',
		'Macintosh'=>'(Mac_PowerPC)|(Macintosh)',
		'QNX'=>'QNX',
		'BeOS'=>'BeOS',
		'OS/2'=>'OS/2',
		'Search Bot'=>'(nuhk)|(Googlebot)|(Yammybot)|(Openbot)|(Slurp/cat)|(msnbot)|(ia_archiver)'
	);

	foreach($oses as $os=>$pattern){ // Loop through $oses array
    // Use regular expressions to check operating system type
		if(eregi($pattern, $userAgent)) { // Check if a value in $oses array matches current user agent.
			return $os; // Operating system was matched so return $oses key
		}
	}
	return 'Unknown'; // Cannot find operating system so return Unknown
}
  $os= getOS($_SERVER['HTTP_USER_AGENT']);
 $serverip=$_GET['serverip'];

 
function time_left($integer) 
{ 
    $seconds=$integer; 
    if ($seconds/60 >=1) 
    { 
	    $minutes=floor($seconds/60); 
	    if ($minutes/60 >= 1) 
	    { # Hours 
  		  $hours=floor($minutes/60); 
		    if ($hours/24 >= 1) 
	 	   { #days 
		    $days=floor($hours/24); 
		    if ($days/7 >=1) 
		   { #weeks 
		   $weeks=floor($days/7); 
		    if ($weeks>=2) $return="$weeks สัปดาห์"; 
		    else $return="$weeks สัปดาห์"; 
		    } #end of weeks 
    $days=$days-(floor($days/7))*7; 
    if ($weeks>=1 && $days >=1) $return="$return, "; 
    if ($days >=2) $return="$return $days วัน"; 
    if ($days ==1) $return="$return $days วัน"; 
    } #end of days 
    $hours=$hours-(floor($hours/24))*24; 
    if ($days>=1 && $hours >=1) $return="$return, "; 
    if ($hours >=2) $return="$return $hours ชั่วโมง"; 
    if ($hours ==1) $return="$return $hours ชั่วโมง"; 
    } #end of Hours 
    $minutes=$minutes-(floor($minutes/60))*60; 
    if ($hours>=1 && $minutes >=1) $return="$return, "; 
    if ($minutes >=2) $return="$return $minutes นาที"; 
    if ($minutes ==1) $return="$return $minutes นาที"; 
    } #end of minutes 
    $seconds=$integer-(floor($integer/60))*60; 
    if ($minutes>=1 && $seconds >=1) $return="$return, "; 
    if ($seconds >=2) $return="$return $seconds วินาที"; 
    if ($seconds ==1) $return="$return $seconds วินาที"; 
    $return="$return."; 
    return $return; 
} 

  $query_seting = "SELECT   *   FROM radacct  where   UserName='$_GET[username]' and  	 FramedIPAddress='$_GET[ip]'  and  AcctStopTime ='0000-00-00 00:00:00'  order by 	 RadAcctId desc  ";
$seting_q= mysql_query($query_seting, $connect_db) or die(mysql_error());
$row_seting = mysql_fetch_assoc($seting_q);
$user_online_rows = mysql_num_rows($seting_q); //นับดูว่า มีใครออนไลน์ เกิน จำนวนที่กำหนดไว้มั้ย

  //หาว่าคนนี้อยู่กลุ่มใหน
 $query_simultaneous = "SELECT   *   FROM usergroup  where   UserName='$_GET[username]' "; 
$simultaneous_query= mysql_query($query_simultaneous, $connect_db) or die(mysql_error());
$row_simultaneous= mysql_fetch_assoc($simultaneous_query);
//หาว่ากล่มนี้ นั้น กำหนดว่าออนไลน์ได้กี่คน
$query_simultaneous = "SELECT   *   FROM radgroupcheck  where   GroupName='$row_simultaneous[GroupName]'  and  Attribute='Simultaneous-Use' ";
$simultaneous_query= mysql_query($query_simultaneous, $connect_db) or die(mysql_error());
$row_simultaneous= mysql_fetch_assoc($simultaneous_query);
if($row_simultaneous['Value']==''){ $row_simultaneous['Value']='1';}
 //ตรวจเช็คว่าออนไลน์เกินหว่าที่กำหนดไว้ในกลุ่มมั้ย
 if($user_online_rows > $row_simultaneous['Value'] ){
//echo  "<meta http-equiv=refresh content=0;URL=http://$serverip/logout>";
print $user_online_rows;
//exit();
 }

 
// if($row_seting[os]==''  or  $row_seting[os]==NULL ){
  $RadAcctId=$row_seting[RadAcctId];
  $query_seting = "update  radacct  set os='$os'  where   RadAcctId='$RadAcctId'   ";
  mysql_query($query_seting, $connect_db) or die(mysql_error());
  
  $AGOS=$_SERVER['HTTP_USER_AGENT'];
    $query_seting = "update  radacct  set HTTP_USER_AGENT='$AGOS'  where   RadAcctId='$RadAcctId'   ";
  mysql_query($query_seting, $connect_db) or die(mysql_error());
// } 
 if($row_seting[RadAcctId]==NULL) {
//echo  "<meta http-equiv=refresh content=0;URL=http://$serverip/logout>";
exit();
 }
?>
<html>
<head>
<title>Hotspot &gt; status</title>
 
<meta http-equiv="refresh" content="120">
 
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<meta http-equiv="pragma" content="no-cache">
<meta http-equiv="expires" content="-1">
<style type="text/css">
<!--
textarea,input,select {
	background-color: #FDFBFB;
	border: 1px #BBBBBB solid;
	padding: 2px;
	margin: 1px;
	font-size: 14px;
	color: #808080;
}

.tabula{
 
border-width: 1px; 
border-collapse: collapse; 
border-color: #c1c1c1; 
background-color: transparent;
font-family: verdana;
font-size: 11px;
}

body{ color: #737373; font-size: 12px; font-family: verdana; }

a, a:link, a:visited, a:active { color: #AAAAAA; text-decoration: none; font-size: 12px; }
a:hover { border-bottom: 1px dotted #c1c1c1; color: #AAAAAA; }
img {border: none;}
td { font-size: 12px; padding: 4px;}

 table.contacts
{ width: 580px;
background-color: #fafafa;
border: 1px #000000 solid;
border-collapse: collapse;
border-spacing: 0px; }


td.contactDept
{ background-color: #99CCCC;
border: 1px #000000 solid;
font-family: Verdana;
font-weight: bold;
font-size: 12px;
color: #404040; }


td.contact
{ border-bottom: 1px #6699CC dotted;
text-align: left;
font-family: Verdana, sans-serif, Arial;
font-weight: normal;
font-size: .7em;
color: #404040;
background-color: #fafafa;
padding-top: 4px;
padding-bottom: 4px;
padding-left: 8px;
padding-right: 0px; }
-->
</style>
 <style type="text/css">
.styled-button-2 {
	-webkit-box-shadow:rgba(0,0,0,0.2) 0 1px 0 0;
	-moz-box-shadow:rgba(0,0,0,0.2) 0 1px 0 0;
	box-shadow:rgba(0,0,0,0.2) 0 1px 0 0;
	border-bottom-color:#333;
	border:1px solid #61c4ea;
	background-color:#7cceee;
	border-radius:5px;
	-moz-border-radius:5px;
	-webkit-border-radius:5px;
	color:#333;
	font-family:'Verdana',Arial,sans-serif;
	font-size:14px;
	text-shadow:#b2e2f5 0 1px 0;
	padding:5px
}
.logout {color: #FF0000;font-size:14px;text-shadow:#b2e2f5 0 1px 0;}
 
 </style>
 


</head>
<body bottommargin="0" topmargin="0" leftmargin="0" rightmargin="0" >


<table width="100%" height="100%">

<tr>
<td align="center" valign="middle">
 
<h2>
 
	<br><div style="text-align: center;">ยินดีต้อนรับ <?php print $_GET[username]; ?></div><br>
 
</h2>
<table width="420" border="1" class="tabula"  >
	<tr>
	  <td colspan="2" align="right" class="contactDept"><div align="center">HISPEED WIFI</div></td>
	  </tr>
	  	<tr>
	  <td width="164" align="right">Node:</td>
	  <td width="239"> <?php print $row_seting[NASIPAddress]; ?></td>
	  </tr>
	<tr><td align="right">หมายเลข แอดเดรส:</td><td><?php print $_GET[ip]; ?></td></tr>
		  <tr>
	    <td align="right">แมค แอดเดรส: </td>
	    <td><?php print $row_seting[CallingStationId]; ?></td>	 
 </tr>
	<tr><td align="right">ปริมาณข้อมูล ดาวน์โหลด/อัพโหลด :</td><td><?php print formatBytes($row_seting[AcctInputOctets]); ?>&nbsp;/&nbsp; <?php print formatBytes($row_seting[AcctOutputOctets]); ?></td></tr>
 
	<tr><td align="right">เวลาเชื่อมต่อ:</td><td>
<?php print time_left($row_seting[AcctSessionTime])  ?>
 
  </td></tr>

<!--	<tr>
	  <td align="right">เวลาในการเชื่อมต่อ/ครั้ง:</td>
	  <td>
<?php print time_left($row_seting[AcctSessionTime])  ?>  </td>
	  </tr>-->
	<tr>
	  <td align="right">วันหมดอายุการใช้งานคือ</td>
	  <td><?php print UDataCHK($row_data_iuser['UserName'],$connect_db);     ?></td>
	  </tr>
  <tr>
      <td colspan="2" align="right" height="30"> <center>
	     <a href="https://www.thaigqsoft.info/edit_user_pass_mk.php" target="_blank" style="color: #000000">แก้ไขข้อมูลส่วนตัว</a>
      </center></td>
	  </tr>
  <tr bgcolor="#FFFFCC">
    <td colspan="2" align="right" height="30">  <div align="center"><a href="http://<?php print $serverip;?>/logout" target="_blank" class="logout">Logout</a></div></td>
  </tr>
      </table>
 
 
</div></td>
</table> 
 <?php   mysql_close($connect_db);
 $a= rand(5,200);   ?>
 <meta http-equiv="refresh" content="<? print $a;?>">
 
</body>
</html>
