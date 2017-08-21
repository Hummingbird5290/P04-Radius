<?php include("../include/chklogin.php");    
include("../Connections/dbconnect.php");
include("../include/function.php");
if($submit=="บันทึก") {
  
$a=1;
 
$pattern = '/-/i';
$replacement = ':';
$UserName= preg_replace($pattern, $replacement, $UserName);
$UserName=strtoupper ($UserName);
$query_user = "select  UserName  from register   where UserName='$UserName'   or  fullname='$fullname'   ";

$type_db = mysql_query($query_user, $connect_db) or die(mysql_error());

$totalRows_user= mysql_num_rows($type_db);

if($totalRows_user !=null  or $totalRows_user >0 ) 
{   //ตรวจสอบว่า มี userlogin นี้อยุ่หรือไม่
            echo                  "<script type=text/javascript>";
		    echo                  "alert('มี user login นี้อยู่ในระบบแล้ว ')";
	        echo                  "</script>";
		    echo "<meta http-equiv=refresh content=0;URL=index.php>"; 
		 	exit();
}  else 
{  
           
if($totalRows_user == NULL  or $totalRows_user ==0 ) 
 
$register_day=date("Y-m-d H:i:s");
$chk_data_insert=mysql_query("INSERT INTO  register    (UserName,password,per,room,tel,fullname,status,email,site,register_day,idstd)
		      values('$UserName','password','$strID','$room','$tel','$fullname','0','$email','$site','$register_day','$idstd')") or die(mysql_error());
			  

if($chk_data_insert==1) {

 update("register","status ='1'","where UserName ='$UserName'  ");  
#############

																				  
mysql_query("INSERT INTO  usergroup     (UserName,GroupName ,priority)
		                                                                          values('$UserName','defult','1')") or die(mysql_error());

mysql_query("INSERT INTO  radcheck     (UserName,Attribute,op,Value)
		                                                                          values('$UserName','Auth-Type',':=','Accept')") or die(mysql_error());
																				  
mysql_query("delete from  radcheck where  UserName='$UserName' and Attribute='Expiration' ") ; 

  
			  																			  
mysql_query("INSERT INTO  macauthen     (macid)
		                                                                          values('$UserName')") ;
																				  
mysql_query("delete from  usergroup where  UserName='$UserName' ") ;
mysql_query("INSERT INTO  usergroup     (UserName,GroupName,priority)
		                                                                          values('$UserName','defult','1')") ;
 
 
//แก้ไขค่า dhcp server
 
echo preg_replace($pattern, $replacement, $UserName);
  system('/usr/bin/sudo /bin/chown www-data:www-data /etc/chilli.conf ', $retval);
  system('/usr/bin/sudo /bin/chown www-data:www-data /data/macauthen.sh ', $retval);
  $data_network="
include /etc/chilli/main.conf  # \r\n
include /etc/chilli/hs.conf  # \r\n
include /etc/chilli/local.conf  # \r\n

ipup=/data/coova.sh  # \r\n
ipdown=/etc/chilli/down.sh  # \r\n
# \r\n
# \r\n
 ";
 


 $query_Recordset1 = "SELECT   *   FROM macauthen  ";
$Recordset1 = mysql_query($query_Recordset1, $connect_db) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
if($row_Recordset1[macid] !=''){
 $list_mac ="macallowed   11-11-11-11-11-11";  
 
  do {
  $mac_regis=$row_Recordset1[macid];
if($mac_regis !=''){
 $pattern = '/:/i';
$replacement = '-';
$mac_regis= preg_replace($pattern, $replacement, $mac_regis);
$mac_regis=strtoupper ($mac_regis);
$list_mac .= ",$mac_regis";
$i++;

 } //if($mac_regis !=''){

} while ($row_Recordset1 = mysql_fetch_assoc($Recordset1));
}//if
 
 $data_network .=$list_mac.'# \r\n  
 macallowlocal  
 '   ;

 $f=fopen("/etc/chilli.conf", "w"); 
fputs($f, $data_network);
fclose($f); 
$stop_time=date("Y-m-d H:i:s");
 mysql_query( "update  radacct  set AcctStopTime  ='$stop_time'  , AcctTerminateCause='Admin-Reset-add mac address' where     AcctStopTime='0000-00-00 00:00:00'  ");
 
 


            echo                  "<script type=text/javascript>";
		    echo                  "alert('บันทึกข้อมูลเสร็จสิ้น')";
	        echo                  "</script>";
  
echo '<h2>ระบบกำลังอัพเดทฐานข้อมูลกรุณารอสักครู่ </h2>';
 echo "<meta http-equiv=refresh content=10;URL=index.php?case_i=53>"; 
 
		 	exit();  
			} else 
			{
		    echo                  "<script type=text/javascript>";
		    echo                  "alert('ระบบไม่สามารถบันทึกข้อมูลได้')";
	        echo                  "</script>";
		    echo "<meta http-equiv=refresh content=0;URL=index.php>"; 
 
		 	exit();  
			}
			}//   เช๊คว่ามี user เดิม
}

 
?>
<HTML>
<HEAD>
<TITLE>km</TITLE>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
</HEAD>


<BODY >
          <p align="center"><strong><font size="3" face="MS Sans Serif, Tahoma, sans-serif">Register Mac address</font></strong></p>
          <p align="center">(Mac address ที่บันทึกลงระบบในส่วนนี้จะไม่มีการเข้าหน้า Login ระบบจะอนุมัติให้เล่น Internet ได้เลยทันที)<br>
          หากท่านทำการคลิกบันทึก ระบบจะทำการเริ่มการแจกอินเตอร์เน็ตใหม่มีผลทำให้ผู้ใช้งานที่กำลัง Login อยู่จะโดนดีดออกจากระบบทันที<br>
หลังจากบันทึกข้อมูลเสร็จแล้วให้ทำการ Reboot ระบบ ใหม่</p>
<form action="index.php?case_i=53" method="post" enctype="multipart/form-data" name="form1" >

  <table width="100%" border="1" align="left">
    <tr valign="baseline"> 
      <td width="269" align="right" nowrap bgcolor="#FFFFCC"><strong><font color="#0000FF" size="2" face="MS Sans Serif, Tahoma, sans-serif">Mac ID</font></strong></td>
      <td colspan="2" valign="top" bgcolor="#FFFFFF"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong><font color="#FF0000">รูปแบบ 00-18-41-B9-F6-66
      อักษรตัวใหญ่</font></strong><br>
        <input name="UserName" type="text" id="UserName" value="" size="32">
        <input name="password" type="hidden" id="password" value="password" size="32">
        </font></td>
    </tr>
 
    <tr valign="baseline"> 
      <td height="69" align="right" nowrap bgcolor="#FFFFCC"><strong><font color="#0000FF" size="2" face="MS Sans Serif, Tahoma, sans-serif">ชื่อเครื่อง</font></strong></td>
      <td colspan="2" valign="top" bgcolor="#FFFFFF"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong><font color="#0000CC"><font color="#FF0000">ภาษาไทยได้<br>
        ใส่ให้ครบทั้งชื่อนามสกุล</font></font></strong><br>
         <input name="fullname" type="text" id="fullname" value="" size="32">
         <input name="room" type="hidden"  id="room" value="0000" size="32">
         <input name="site" type="hidden" id="site" size="32"  value="0000" >
         <input name="idstd" type="hidden" id="idstd" value="0000" size="32">
           <input name="strID" type="hidden" id="strID" value="0000" size="32">
        </font></td>
    </tr>
    <tr valign="baseline"> 
      <td height="52" align="right" nowrap bgcolor="#FFFFCC"><strong><font color="#0000FF" size="2" face="MS Sans Serif, Tahoma, sans-serif">เบอร์โทรศัพท์ติดต่อกลับ</font></strong></td>
      <td colspan="2" valign="top" bgcolor="#FFFFFF"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong><font color="#0000CC"><font color="#FF0000">โปรดใส่ 
        จะช่วยท่านได้มากกรณีท่าน<br>
        มีปัญหาในการใช้งาน </font></font></strong><br>
        <input name="tel" type="text" id="tel" value="" size="32">
        </font></td>
    </tr>
   <tr valign="baseline"> 
      <td align="right" nowrap bgcolor="#FFFFCC"><strong><font color="#0000FF" size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;</font></strong></td>
      <td width="979" valign="top" bgcolor="#FFFFFF"><div align="center"> <font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
          <input type="submit" value="บันทึก" name="submit"    >
          </font></div></td>
      <td width="17" valign="top" bgcolor="#FFFFFF"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;</font></td>
    </tr>
    <tr valign="baseline">
      <td align="right" nowrap bgcolor="#FFFFCC">&nbsp;</td>
      <td valign="top" bgcolor="#FFFFFF"><div align="center"><strong><font color="#FF0000">หลังจากบันทึกแล้วเพื่อให้ Mac Address ใช้งานได้จำเป็นต้อง เครื่อง ปิดสัญญาณ เน็ตแล้วต่อใหม่  เปิด ปิดไวเลส ของมืถือแล้วเปิดใหม่</font></strong></div></td>
      <td valign="top" bgcolor="#FFFFFF">&nbsp;</td>
    </tr>
    <tr valign="baseline">
      <td colspan="3" align="right" nowrap bgcolor="#FFFFCC">
      
      <table width="400" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr bgcolor="#CCCCCC" class="style26"> 
    <td width="445" height="31" bgcolor="#66CCFF"><div align="center" class="style1 style2"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">รายการ MAc ในระบบ</font></strong></div></td>
    <td width="55" bgcolor="#66CCFF"><div align="center" class="style5"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>ลบทิ้ง</strong></font></div></td>
  </tr>
  <?php 
  if($edit==1){
    $query_Recordset1 = "delete     FROM macauthen where macid='$iddel' ";
  mysql_query($query_Recordset1, $connect_db) or die(mysql_error());
    $query_Recordset1 = "delete     FROM register  where UserName ='$iddel' ";
  mysql_query($query_Recordset1, $connect_db) or die(mysql_error());
        $query_Recordset1 = "delete     FROM usergroup  where UserName ='$iddel' ";
  mysql_query($query_Recordset1, $connect_db) or die(mysql_error());
         $query_Recordset1 = "delete     FROM radcheck  where UserName ='$iddel' ";
  mysql_query($query_Recordset1, $connect_db) or die(mysql_error()); 
  system('/usr/bin/sudo /bin/chown www-data:www-data /etc/chilli.conf ', $retval);
  system('/usr/bin/sudo /bin/chown www-data:www-data /data/macauthen.sh ', $retval);
  $data_network="
include /etc/chilli/main.conf  # \r\n
include /etc/chilli/hs.conf  # \r\n
include /etc/chilli/local.conf  # \r\n

ipup=/data/coova.sh  # \r\n
ipdown=/etc/chilli/down.sh  # \r\n
# \r\n
# \r\n
 ";
 


 $query_Recordset1 = "SELECT   *   FROM macauthen  ";
$Recordset1 = mysql_query($query_Recordset1, $connect_db) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
if($row_Recordset1[macid] !=''){
 $list_mac ="macallowed   11-11-11-11-11-11";  
 
  do {
  $mac_regis=$row_Recordset1[macid];
if($mac_regis !=''){
 $pattern = '/:/i';
$replacement = '-';
$mac_regis= preg_replace($pattern, $replacement, $mac_regis);
$mac_regis=strtoupper ($mac_regis);
$list_mac .= ",$mac_regis";
$i++;

 } //if($mac_regis !=''){

} while ($row_Recordset1 = mysql_fetch_assoc($Recordset1));
}//if
 
 $data_network .=$list_mac.'# \r\n  
 macallowlocal  
 '   ;

 $f=fopen("/etc/chilli.conf", "w"); 
fputs($f, $data_network);
fclose($f); 
 
 
$stop_time=date("Y-m-d H:i:s");
 mysql_query( "update  radacct  set AcctStopTime  ='$stop_time'  , AcctTerminateCause='Admin-Reset-add mac address' where     AcctStopTime='0000-00-00 00:00:00'  ");
 
 


            echo                  "<script type=text/javascript>";
		    echo                  "alert('บันทึกข้อมูลเสร็จสิ้น')";
	        echo                  "</script>";
  
echo '<h2>ระบบกำลังอัพเดทฐานข้อมูลกรุณารอสักครู่ </h2>';
 echo "<meta http-equiv=refresh content=0;URL=index.php?case_i=53>"; 
 exit();
 
			} 
 
  $query_Recordset1 = "SELECT   *   FROM macauthen ";
$Recordset1 = mysql_query($query_Recordset1, $connect_db) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

  do { ?>
  <tr bgcolor="#FFFFFF" class="style26"> 
    <td height="23"><div align="center" class="style3"> 
        <div align="left"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><?php echo $row_Recordset1['macid']; ?></font></div>
      </div></td>
    <td><div align="center" class="style3"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><a href="<?php echo $editFormAction; ?>?case_i=53&edit=1&iddel=<?php echo $row_Recordset1['macid']; ?>" ><img src="../images/delete.gif" width="16" height="16" border="0"></a></font></div></td>
  </tr>
  <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
</table></td>
    </tr>
  </table>
</form> 
 
  
</BODY>
</HTML>
