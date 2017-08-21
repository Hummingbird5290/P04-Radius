<?php    include("../include/chklogin.php");    
 
 
  ?>
  <meta http-equiv="Content-Type" content="text/html; charset=windows-874">
   <link href="../css/style.css" rel="stylesheet" type="text/css">
   <span class="txtContent3_orange"><font size="+1">รายการเปิดใช้งานพอร์ต ของลูกข่าย</font></span>
   
<table width="692" border="0" class="sciIntro">
 <tr>
   <td  >หากหน้าจอนี้มี error ให้สั่งที่ Terminal sudo apt-get install netstat-nat  พื่อติดตั้งโปรแกรมเสียก่อน</td>
 </tr>
 <tr>
    <td width="686"  > 
   จำนวนการเชื่อมต่อพอร์ต    <?            
##########################################
 
 $last_line = system('/usr/bin/sudo  /usr/bin/netstat-nat  -n | grep -v NATed  | wc -l', $retval);
 
########################################
 
?> &nbsp; ครั้ง</td>
  </tr>
  <tr>
    <td  > 
     <?            
##########################################
 
  shell_exec ('/usr/bin/sudo  /usr/bin/netstat-nat  -n | grep -v NATed  |grep tcp > /tmp/listip');
  shell_exec ('/usr/bin/sudo  /usr/bin/netstat-nat  -n | grep -v NATed  |grep udp >> /tmp/listip');
 shell_exec ('/usr/bin/sudo  /usr/bin/netstat-nat  -n | grep -v NATed  |grep icmp >> /tmp/listip');
// การอ่านข้อมูลจาก Text File
$f=fopen("/tmp/listip", "r"); 
$retval=fread($f,  filesize("/tmp/listip"));
fclose($f);


  $retval=preg_replace("/\n/i", "<br>", $retval);
  $retval=preg_replace("/  /i", "&nbsp;&nbsp;", $retval);
 $retval=preg_replace("/ESTABLISHED/i", "เชื่อมต่อได้แล้ว ", $retval);
  $retval=preg_replace("/LISTENING/i", "รอการติดต่อ ", $retval);
  $retval=preg_replace("/TIME_WAIT/i", "รอการตอบกลับ ", $retval);
    $retval=preg_replace("/SYN_SENT/i", "ถูก block อยู่ไม่สามารถส่งออกได้ ", $retval);
	 $retval=preg_replace("/CLOSED/i", "ปิดการเชื่อมต่อ", $retval);
	
 
 print  $retval;
########################################


?> </td>
  </tr>
</table>


