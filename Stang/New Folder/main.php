<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<table width="100%" border="0" align="center">
  <tr> 
    <td valign="top"><div align="center"> 
	<?php
	 include_once ("Connections/dbconnect.php");
	   $query_Recordset1 = "SELECT   *   FROM   news    ";
$Recordset1 = mysql_query($query_Recordset1, $connect_db) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
print  $row_Recordset1[news];
	?>
	
	 </div></td>
  </tr>
</table>
<p align="center"><font size="3" face="MS Sans Serif, Tahoma, sans-serif"><a href="ict.pdf"><font size="2"><strong>อ่านพระราชบัญญัต 
  ว่าด้วยการกระทำความผิดเกี่ยวกับคอมพิวเตอร์ พ.ศ. ๒๕๕๐</strong></font><br>
  คลิกที่นี่</a></font></p>  
<p align="center">&nbsp; <font size="2" face="MS Sans Serif, Tahoma, sans-serif"><font color="#FF0000"><strong> 
<div align="center"><font size="3"> </font></div>
</strong></font></font> 
<table width="100%" border="0" align="center">
  <tr> 
    <td colspan="4" bgcolor="#FFFFCC"><div align="center"><font color="#0000FF" size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
        </font></div></td>
  </tr>
  <tr> 
    <td colspan="4" bgcolor="#FFCC99"><div align="center"><font color="#0000FF" size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>ปริมาณข้อมูลที่วิ่งผ่าน 
        Server Internet</strong></font></div></td>
  </tr>
  <tr> 
    <td colspan="4"><div align="center"><font face="MS Sans Serif, Tahoma, sans-serif"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong><img src="/mrtg/127.0.0.1_eth0-day.png"></strong></font></font></div></td>
  </tr>
  <tr> 
    <td colspan="4" bgcolor="#FFCC99"><div align="center"><font color="#0000FF" size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>การทำงานของ 
        CPU </strong></font></div></td>
  </tr>
  <tr> 
    <td colspan="4"><div align="center"><font face="MS Sans Serif, Tahoma, sans-serif"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong><img src="/mrtg/localhost.cpu-day.png"></strong></font></font></div></td>
  </tr>
  <tr> 
    <td colspan="4" bgcolor="#FFCC99"><div align="center"><font color="#0000FF" size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>ปริมาณการใช้งานแรม</strong></font></div></td>
  </tr>
  <tr> 
    <td colspan="4"><div align="center"><font face="MS Sans Serif, Tahoma, sans-serif"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong><img src="/mrtg/localhost.mem-day.png"></strong></font></font></div></td>
  </tr>
</table>
<font size="2" face="MS Sans Serif, Tahoma, sans-serif"><font color="#FF0000"><strong><br>
</strong></font></font> 
 
</p>
<?  $hostname = "127.0.0.1";?>
    
  
<table width="100%" border="0">
  <tr bgcolor="#FFCCCC"> 
    <td><div align="center"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">AUTHEN 
        SYSTEM</font></strong></div></td>
    <td><div align="center"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">DATABASE 
        SYSTEM</font></strong></div></td>
    <td><div align="center"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">PROXY 
        SYSTEM</font></strong></div></td>
  </tr>
  <tr bgcolor="#FFFFFF"> 
    <td><div align="center"><?php echo "<img src='admin/image.php?host=$hostname&port=443'>"; ?></div></td>
    <td><div align="center"><?php echo "<img src='admin/image.php?host=$hostname&port=3306'>"; ?></div></td>
    <td><div align="center"><?php echo "<img src='admin/image.php?host=$hostname&port=8080'>"; ?></div></td>
  </tr>
</table>
      