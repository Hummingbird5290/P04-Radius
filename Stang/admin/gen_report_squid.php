  <?php include("../include/chklogin.php");   ?>
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
</head>

<body>
<?php
 //if($Submit=="ปรับปรุงฐานข้อมูลการเข้าเว็บของลูกข่าย"){
$command ="/usr/bin/sudo  /usr/bin/perl  /var/www/lightsquid/lightparser.pl  ";
 exec($command, $result, $rval);
for ($i = 0; $i < sizeof($result); $i++) {
echo "$result[$i]<br>";
$b .="$result[$i]";
}

################  ปรับปรุงเสร็จแล้วก็ลบไฟล์ log squid 
$command ="/usr/bin/sudo  /bin/rm  -f  /var/log/squid/*.*   ";
 exec($command, $result, $rval);
for ($i = 0; $i < sizeof($result); $i++) {
echo "$result[$i]<br>";
$b .="$result[$i]";
}
################  ปรับปรุงเสร็จแล้วก็ลบไฟล์ log squid 
$command ="/usr/bin/sudo  /bin/rm  -f  /var/log/squid/*.*   ";
 exec($command, $result, $rval);
for ($i = 0; $i < sizeof($result); $i++) {
echo "$result[$i]<br>";
$b .="$result[$i]";
}

################# สั่งรัน squid ใหม่
$command ="/usr/bin/sudo  /usr/sbin/squid -k reconfig   ";
 exec($command, $result, $rval);
for ($i = 0; $i < sizeof($result); $i++) {
echo "$result[$i]<br>";
$b .="$result[$i]";
}
$mdate_DAY = date("d-m-Y   H:i");
echo "<strong><font color=\"#FF0000\" size=\"2\" face=\"MS Sans Serif, Tahoma, sans-serif\"><center>ปรับปรุงฐานข้อมูลการเข้าเว็บของลูกข่ายเสร็จสิ้น  เวลา  $mdate_DAY </center></font></strong>";
echo  "<br>";
 
//}//end if
?>
<table width="402" border="1" align="center">

  <tr> 
    <td bgcolor="#FFCCCC"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><img src="images/copy.gif" width="23" height="22"><a href="squid.php" target="_blank">ดูรายงานการเข้าเว็บ</a></font></strong></td>
  </tr>
  <tr> 
    <td bgcolor="#FFCCCC"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><img src="images/copy.gif" width="23" height="22"><a href="index.php?case_i=11">รายงานการเข้าเว็บแบบเฉพาะ 
      IP</a></font></strong></td>
  </tr>
  <tr> 
    <td bgcolor="#FFCCCC"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><img src="images/copy.gif" width="23" height="22"><a href="index.php?case_i=24">รายงานการเข้าเว็บแบบค้นหาผู้เข้าเว็บ 
      </a></font></strong></td>
  </tr>
  <tr>
    <td bgcolor="#FFCCCC"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><img src="images/copy.gif" width="23" height="22"><a href="index.php?case_i=28">รายงานการเข้าเว็บแบบค้นหาจาก 
      Mac Address </a></font></strong></td>
  </tr>
</table>
</body>
</html>
