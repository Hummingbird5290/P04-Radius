<?php    include("../include/chklogin.php");    
 
 
  ?>
  <meta http-equiv="Content-Type" content="text/html; charset=windows-874">
   <link href="../css/style.css" rel="stylesheet" type="text/css">
   <span class="txtContent3_orange"><font size="+1">Network traffic monitor  </font></span>
   
<table width="692" border="0" class="sciIntro">
 <tr>
    <td width="686"  >  หน้าจอนี้จำเป็นต้องทำการติดตั้ง   โปรแกรม vnStat เพิ่มเติม  <br />
    หากยังไม่ได้ติดตั้ง จะทำให้แสดง Error <a href="doc/vnstat.pdf">คลิกอ่านวิธีการติดตั้ง</a></td>
  </tr>
 <tr>
    <td width="686" class="txtloginAP"  >  แสดงรายการชั่วโมงที่ผ่านมา   </td>
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
    <td width="686" class="txtloginAP"  >  แสดงรายการแบบวัน </td>
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
    <td width="686" class="txtloginAP"  >  แสดงรายการแบบเดือน </td>
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


