<?php  
 session_start(); 
include("Connections/dbconnect.php");
 

?>
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">

<body background="images/bg1.gif">
<?php if($Submit_login==null )  { ?>
<form action="edit_user.php" method="post" enctype="application/x-www-form-urlencoded" name="form_login">
  <table width="407" border="0" align="center"  class=txtContentBold>
    <tr valign=middle bgcolor="#ECFFFF"> 
      <td colspan="3" bgcolor="#EBF3FF"><div align="left"><strong><font color="#FFFFFF" size="2"><font color="#0066CC"> 
          <font face="MS Sans Serif, Tahoma, sans-serif">&nbsp; </font></font></font><font color="#0066CC" face="MS Sans Serif, Tahoma, sans-serif"> 
          แก้ไขข้อมูลส่วนตัวโปรดใส่รหัสผ่าน</font></strong><br>
          <img src="images/horz_3.gif" width="250" height="1"></div></td>
    </tr>
    <tr valign=middle bgcolor="#ECFFFF"> 
      <th colspan="3" bgcolor="#FBFCFE">&nbsp;</th>
    </tr>
    <tr bgcolor="#F5F5F5"> 
      <td width="88" bgcolor="#FBFCFE"><div align="right"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong><font color="#333333">username</font></strong></font></div></td>
      <td width="309" bgcolor="#FBFCFE"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
        <input name="UserName" type="text" id="UserName" value=""    >
        </font></td>
    </tr>
    <tr bgcolor="#F5F5F5"> 
      <td bgcolor="#FBFCFE"><div align="right"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong><font color="#333333">password</font></strong></font></div></td>
      <td bgcolor="#FBFCFE"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
        <input name="password" type="password" id="password" >
        </font></td>
    </tr>
    <tr bgcolor="#ECFFFF"> 
      <td height="45" colspan="2" bgcolor="#FBFCFE"> <p align="center"> <font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
          <input name="Submit_login" type="submit" id="Submit_login" value="เข้าสู่ระบบ"  >
          <input name="cancel" type="reset" id="cancel" value="กรอกใหม่">
          </font></p>
        <p align="center">&nbsp;</p></td>
    </tr>
  </table>
    </form>
<?php exit(); } ?>
<?php

mysql_select_db($database_db, $connect_db);
if($Submit=="แก้ไขข้อมูลสมาชิก"    and  $Submit_login=='true')    {
include("include/function.php");
update("register","fullname ='$fullname',per='$per',room='$room',site='$site',email='$email' ,password='$pass' "," where UserName='$UserName'    and  status  <> '0' "); 
update("radcheck","Value ='$pass'  "," where UserName='$UserName'  and   Attribute='User-Password'  "); 

echo "<script type=text/javascript>";
echo "alert('บันทึกข้อมูลเรียบร้อยแล้ว ')";
echo "</script>";
exit();

}

  
$query_user = "SELECT 
  register.`status`,
  register.UserName,
  register.password,
  register.fullname,
  register.per,
  register.room,
  register.tel,
  register.site,
  register.email,
  radcheck.id,
  radcheck.UserName,
  radcheck.Attribute ,
  radcheck.op,
  radcheck.Value  As pass
FROM
  register
  INNER JOIN radcheck ON (register.UserName = radcheck.UserName)
WHERE
  register.`status` <> '0' and radcheck.Attribute ='User-Password'  
  and   register.UserName='$UserName' 
  and   register.password='$password' ";
$user_db = mysql_query($query_user, $connect_db) or die(mysql_error());
$row_user = mysql_fetch_assoc($user_db);
$totalRows_user= mysql_num_rows($user_db);


 
?><br>
<form action="edit_user.php" method="post" enctype="multipart/form-data" name="form1" >
  <table width="501" border="0" align="center">
    <tr bgcolor="#00AA00" > 
      <td colspan="2"><div align="center"><strong><font size="3" face="MS Sans Serif, Tahoma, sans-serif">รายละเอียด 
          ผู้ใช้งาน</font></strong></div></td>
    </tr>
    <tr > 
      <td width="34%" height="22" bgcolor="#59FF59"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>ชื่อ 
        Login</strong></font></td>
      <td width="66%" height="22" bgcolor="#CEFFCE"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
        &nbsp;&nbsp;&nbsp; 
        <input name="UserName"   type="text"  id="UserName" value="<?php echo $row_user['UserName']?>"  readonly="yes">
        *ไม่สามารถแก้ไขได้</font></td>
    </tr>
    <tr> 
      <td height="22" bgcolor="#59FF59"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>รหัสผ่าน</strong></font></td>
      <td height="22" bgcolor="#CEFFCE"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
        &nbsp;&nbsp;&nbsp; 
        <input name="pass"   type="text"  id="pass" value="<?php echo $row_user['pass']?>"  >
        </font></td>
    </tr>
    <tr> 
      <td height="22" bgcolor="#59FF59"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
        <strong>ชื่อ-นามสกุล</strong> </font></td>
      <td height="22" bgcolor="#CEFFCE"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;&nbsp;&nbsp; 
        <input name="fullname"   type="text"  id="fullname" value="<?php echo $row_user['fullname']?>" >
        </font></td>
    </tr>
    <tr> 
      <td height="22" bgcolor="#59FF59"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
        <strong><?php echo "$roomsDB"; ?></strong> </font></td>
      <td height="22" bgcolor="#CEFFCE"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;&nbsp;&nbsp; 
        <input name="room"   type="text"  id="room" value="<?php echo $row_user['room']?>" >
        </font></td>
    </tr>
    <tr> 
      <td height="22" bgcolor="#59FF59"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
        <strong><?php echo "$siteDB"; ?></strong> </font></td>
      <td height="22" bgcolor="#CEFFCE"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;&nbsp;&nbsp; 
        <input name="site"   type="text"  id="tel" value="<?php echo $row_user['site']?>">
        </font></td>
    </tr>
    <tr> 
      <td height="22" bgcolor="#59FF59"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
        <strong>E-mail</strong> </font></td>
      <td height="22" bgcolor="#CEFFCE"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;&nbsp;&nbsp; 
        <input name="email"   type="text"  id="email" value="<?php echo $row_user['email']?>">
        </font></td>
    </tr>
    <tr> 
      <td height="22" bgcolor="#59FF59"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
        <strong>เลขประจำตัวประชาชน</strong></font></td>
      <td height="22" bgcolor="#CEFFCE"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;&nbsp;&nbsp; 
        <input name="per"   type="text"  id="per" value="<?php echo $row_user['per']?>"  readonly="yes">
        *ไม่สามารถแก้ไขได </font></td>
    </tr>
    <tr> 
      <td height="22" bgcolor="#59FF59"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;</font> 
      </td>
      <td height="22" bgcolor="#CEFFCE"> <font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
	  <input type="hidden" name="Submit_login" value="true" >
        <input type="submit" name="Submit" value="แก้ไขข้อมูลสมาชิก">
        </font></td>
    </tr>
  </table>
</form>
<?php  
mysql_close($connect_db);
?>
</body>
</html>
