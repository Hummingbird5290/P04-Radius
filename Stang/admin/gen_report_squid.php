  <?php include("../include/chklogin.php");   ?>
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
</head>

<body>
<?php
 //if($Submit=="��Ѻ��ا�ҹ�����š�������红ͧ�١����"){
$command ="/usr/bin/sudo  /usr/bin/perl  /var/www/lightsquid/lightparser.pl  ";
 exec($command, $result, $rval);
for ($i = 0; $i < sizeof($result); $i++) {
echo "$result[$i]<br>";
$b .="$result[$i]";
}

################  ��Ѻ��ا�������ǡ�ź��� log squid 
$command ="/usr/bin/sudo  /bin/rm  -f  /var/log/squid/*.*   ";
 exec($command, $result, $rval);
for ($i = 0; $i < sizeof($result); $i++) {
echo "$result[$i]<br>";
$b .="$result[$i]";
}
################  ��Ѻ��ا�������ǡ�ź��� log squid 
$command ="/usr/bin/sudo  /bin/rm  -f  /var/log/squid/*.*   ";
 exec($command, $result, $rval);
for ($i = 0; $i < sizeof($result); $i++) {
echo "$result[$i]<br>";
$b .="$result[$i]";
}

################# ����ѹ squid ����
$command ="/usr/bin/sudo  /usr/sbin/squid -k reconfig   ";
 exec($command, $result, $rval);
for ($i = 0; $i < sizeof($result); $i++) {
echo "$result[$i]<br>";
$b .="$result[$i]";
}
$mdate_DAY = date("d-m-Y   H:i");
echo "<strong><font color=\"#FF0000\" size=\"2\" face=\"MS Sans Serif, Tahoma, sans-serif\"><center>��Ѻ��ا�ҹ�����š�������红ͧ�١�����������  ����  $mdate_DAY </center></font></strong>";
echo  "<br>";
 
//}//end if
?>
<table width="402" border="1" align="center">

  <tr> 
    <td bgcolor="#FFCCCC"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><img src="images/copy.gif" width="23" height="22"><a href="squid.php" target="_blank">����§ҹ���������</a></font></strong></td>
  </tr>
  <tr> 
    <td bgcolor="#FFCCCC"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><img src="images/copy.gif" width="23" height="22"><a href="index.php?case_i=11">��§ҹ���������Ẻ੾�� 
      IP</a></font></strong></td>
  </tr>
  <tr> 
    <td bgcolor="#FFCCCC"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><img src="images/copy.gif" width="23" height="22"><a href="index.php?case_i=24">��§ҹ���������Ẻ���Ҽ�������� 
      </a></font></strong></td>
  </tr>
  <tr>
    <td bgcolor="#FFCCCC"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><img src="images/copy.gif" width="23" height="22"><a href="index.php?case_i=28">��§ҹ���������Ẻ���Ҩҡ 
      Mac Address </a></font></strong></td>
  </tr>
</table>
</body>
</html>
