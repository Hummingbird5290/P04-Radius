<?php    include("../include/chklogin.php");    
 
 
  ?>
  <meta http-equiv="Content-Type" content="text/html; charset=windows-874">
   <link href="../css/style.css" rel="stylesheet" type="text/css">
   <span class="txtContent3_orange"><font size="+1">��¡���Դ��ҹ���� �ͧ�١����</font></span>
   
<table width="692" border="0" class="sciIntro">
 <tr>
   <td  >�ҡ˹�Ҩ͹���� error �����觷�� Terminal sudo apt-get install netstat-nat  ���͵Դ�����������¡�͹</td>
 </tr>
 <tr>
    <td width="686"  > 
   �ӹǹ����������;���    <?            
##########################################
 
 $last_line = system('/usr/bin/sudo  /usr/bin/netstat-nat  -n | grep -v NATed  | wc -l', $retval);
 
########################################
 
?> &nbsp; ����</td>
  </tr>
  <tr>
    <td  > 
     <?            
##########################################
 
  shell_exec ('/usr/bin/sudo  /usr/bin/netstat-nat  -n | grep -v NATed  |grep tcp > /tmp/listip');
  shell_exec ('/usr/bin/sudo  /usr/bin/netstat-nat  -n | grep -v NATed  |grep udp >> /tmp/listip');
 shell_exec ('/usr/bin/sudo  /usr/bin/netstat-nat  -n | grep -v NATed  |grep icmp >> /tmp/listip');
// �����ҹ�����Ũҡ Text File
$f=fopen("/tmp/listip", "r"); 
$retval=fread($f,  filesize("/tmp/listip"));
fclose($f);


  $retval=preg_replace("/\n/i", "<br>", $retval);
  $retval=preg_replace("/  /i", "&nbsp;&nbsp;", $retval);
 $retval=preg_replace("/ESTABLISHED/i", "�������������� ", $retval);
  $retval=preg_replace("/LISTENING/i", "�͡�õԴ��� ", $retval);
  $retval=preg_replace("/TIME_WAIT/i", "�͡�õͺ��Ѻ ", $retval);
    $retval=preg_replace("/SYN_SENT/i", "�١ block �����������ö���͡�� ", $retval);
	 $retval=preg_replace("/CLOSED/i", "�Դ�����������", $retval);
	
 
 print  $retval;
########################################


?> </td>
  </tr>
</table>


