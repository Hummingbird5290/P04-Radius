<?php    include("../include/chklogin.php");    
 
 
  ?>
  <meta http-equiv="Content-Type" content="text/html; charset=windows-874">
   <link href="../css/style.css" rel="stylesheet" type="text/css">
   <span class="txtContent3_orange"><font size="+1">Network traffic monitor  </font></span>
   
<table width="692" border="0" class="sciIntro">
 <tr>
    <td width="686"  >  ˹�Ҩ͹����繵�ͧ�ӡ�õԴ���   ����� vnStat �������  <br />
    �ҡ�ѧ�����Դ��� �з�����ʴ� Error <a href="doc/vnstat.pdf">��ԡ��ҹ�Ըա�õԴ���</a></td>
  </tr>
 <tr>
    <td width="686" class="txtloginAP"  >  �ʴ���¡�ê����������ҹ��   </td>
  </tr>
  <tr>
    <td  > 
     <?            
 
  ###################################################               
 echo '<pre>';
 $last_line = system('/usr/bin/sudo   /usr/bin/vnstat -h', $retval);
echo '
</pre>';
echo '<hr />';
##########################################
 
?> </td>
  </tr>
  
   <tr>
     <td  >&nbsp;</td>
   </tr>
   <tr>
    <td width="686" class="txtloginAP"  >  �ʴ���¡��Ẻ�ѹ </td>
  </tr>
  <tr>
    <td  > 
     <?            
##########################################
         
 echo '<pre>';
 $last_line = system('/usr/bin/sudo   /usr/bin/vnstat -d', $retval);
echo '
</pre>';
 echo '<hr />';
##########################################
 
?> </td>
  </tr>
  
    <tr>
      <td  >&nbsp;</td>
    </tr>
    <tr>
    <td width="686" class="txtloginAP"  >  �ʴ���¡��Ẻ��͹ </td>
  </tr>
  <tr>
    <td  > 
     <?            
 
  ###################################################               
 echo '<pre>';
 $last_line = system('/usr/bin/sudo   /usr/bin/vnstat -m', $retval);
echo '
</pre>';
 echo '<hr />';
##########################################
 
?> </td>
  </tr>
  
      <tr>
        <td  >&nbsp;</td>
      </tr>
      <tr>
    <td width="686" class="txtloginAP"  > TOP 10</td>
  </tr>
  <tr>
    <td  > 
     <?            
 
 
 
  ###################################################               
 echo '<pre>';
 $last_line = system('/usr/bin/sudo   /usr/bin/vnstat -t', $retval);
echo '
</pre>';
 
 
echo '<hr />';
##########################################
 
?> </td>
  </tr>


</table>


