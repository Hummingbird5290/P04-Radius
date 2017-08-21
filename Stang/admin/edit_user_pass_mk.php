<?php  
 session_start(); 
 extract($_POST);extract($_GET);extract($_REQUEST);
include("../Connections/dbconnect.php");
 
 function randomToken($len) { 
srand( date("s") ); 
//$chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ"; 
$chars ="ABCDEFGHIJKLM";
//$chars.= "1234567890"; // กำหนดอักขษะที่จะนำมา random แก้ได้นะ 
$ret_str = ""; 
$num = strlen($chars); 
for($i=0; $i < $len; $i++) { 
$ret_str.= $chars[rand()%$num]; // ใช้ฟังชั่น rand() เข้ามาช่วยในการทำงาน 
} 
return $ret_str; 
}  


?>
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">

<body background="images/bg1.gif">
<?php if($Submit_login==NULL )  { ?>
<form action="edit_user_pass_mk.php" method="post" enctype="application/x-www-form-urlencoded" name="form_login">
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
    <tr bgcolor="#F5F5F5">
      <td bgcolor="#FBFCFE">&nbsp;</td>
      <td bgcolor="#FBFCFE"><?php   $ran_str = randomToken(3);    ?>
                      <img src="pic_text.php?str=<?=$ran_str?>" width="100" height="30" align="bottom">&nbsp; </td>
    </tr>
    <tr bgcolor="#F5F5F5"> 
      <td bgcolor="#FBFCFE"><div align="right"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>รหัสรักษาความปลอดภัย</strong></font></div></td>
      <td bgcolor="#FBFCFE"><input name="code1" type="text" id="code1" size="10" /> <input name="chk_num"  type="hidden" id="chk_num" value="<?php echo "$ran_str"; ?>"  />&nbsp;</td>
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

if($Submit=="แก้ไขข้อมูลสมาชิก"     and $Submit_login=="true"   )    {

 
 if($pass225 ==NULL   )  { 
 
  	         echo                  "<script type=text/javascript>";
		    echo                  "alert('กรุณา กรอกรหัสผ่าน เดิมด้วย เพื่อยืนยันการแก้ไขข้อมูล       ')";
	        echo                  "</script>";  
			     echo "<meta http-equiv=refresh content=0;URL=edit_user.php>"; 
				
		 	exit();  		
 

 }
include("../include/function.php");
$pass225 = htmlspecialchars("$pass225", ENT_QUOTES);
$pattern = '/;/i';
$replacement = NULL;
$pass225= preg_replace($pattern, $replacement, $pass225);

$UserName = htmlspecialchars("$UserName", ENT_QUOTES);
$pattern = '/;/i';
$replacement = NULL;
$UserName= preg_replace($pattern, $replacement, $UserName);

$pass226=$pass225;
$pass225=md5($pass225);

$query_user = "SELECT   *   FROM    register  WHERE   UserName='$UserName'  and password='$pass225' ";
$user_db = mysql_query($query_user, $connect_db) or die(mysql_error());
$row_user = mysql_fetch_assoc($user_db);
$totalRows_user= mysql_num_rows($user_db);
if($totalRows_user >0) {

update("register","fullname ='$fullname',room='$room',site='$site',email='$email' "," where UserName='$UserName'    and  status  <> '0' "); 

 


 
if( $pass  !='')
{
 $UserName = htmlspecialchars("$UserName", ENT_QUOTES);
 $pass = htmlspecialchars("$pass", ENT_QUOTES);
 $room = htmlspecialchars("$room", ENT_QUOTES);
 $fullname = htmlspecialchars("$fullname", ENT_QUOTES);
 $email = htmlspecialchars("$email", ENT_QUOTES);
 $tel = htmlspecialchars("$tel", ENT_QUOTES);
$site = htmlspecialchars("$site", ENT_QUOTES);

$strID = htmlspecialchars("$strID", ENT_QUOTES);
$pattern = '/;/i';
$replacement = NULL;
$UserName= preg_replace($pattern, $replacement, $UserName);
$pass= preg_replace($pattern, $replacement, $pass);
$room= preg_replace($pattern, $replacement, $room);
$fullname= preg_replace($pattern, $replacement, $fullname);
$email= preg_replace($pattern, $replacement, $email);
$tel= preg_replace($pattern, $replacement, $tel);
$site= preg_replace($pattern, $replacement, $site);
$strID= preg_replace($pattern, $replacement, $strID);
$pass=md5($pass);
update("register","fullname ='$fullname',room='$room',site='$site',email='$email' ,password='$pass' ,pass_rec='$pass226' "," where UserName='$UserName'    and  status  <> '0' "); 
update("radcheck","Value ='$pass'  "," where UserName='$UserName'  and   Attribute='MD5-Password'  "); 
####จัดการรูปที่ upload เข้ามา

}
echo "<script type=text/javascript>";
echo "alert('บันทึกข้อมูลเรียบร้อยแล้ว ')";
echo "</script>";
// echo "<meta http-equiv='refresh' content='0; url=edit_user.php'>" ;  
print "<center><h1>ขอบคุณที่ใช้บริการ</h1></center>";
exit();
}
}

$password=md5($password);

$query_user = "SELECT 
  register.`status`,
  register.UserName,
  register.password,
  register.fullname,
  register.per,
    register.pic_user,
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
  register.`status` <> '0' and radcheck.Attribute ='MD5-Password'  
  and   register.UserName='$UserName' 
  and   register.password='$password' ";
$user_db = mysql_query($query_user, $connect_db) or die(mysql_error());
$row_user = mysql_fetch_assoc($user_db);
$totalRows_user= mysql_num_rows($user_db);


 
?><br>
<form action="edit_user_pass_mk.php" method="post" enctype="multipart/form-data" name="form1" >
  <table width="708" border="0" align="center">
    <tr bgcolor="#00AA00" > 
      <td colspan="2"><div align="center"><strong><font size="3" face="MS Sans Serif, Tahoma, sans-serif">รายละเอียด 
          ผู้ใช้งาน</font></strong></div></td>
    </tr>
    <tr > 
      <td width="32%" height="22" bgcolor="#59FF59"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>ชื่อ 
        Login</strong></font></td>
      <td width="68%" height="22" bgcolor="#CEFFCE"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
        &nbsp;&nbsp;&nbsp; 
        <input name="UserName"   type="text"  id="UserName" value="<?php echo $row_user['UserName']?>"  readonly="yes">
        *ไม่สามารถแก้ไขได้</font></td>
    </tr>
    <tr> 
      <td height="22" bgcolor="#59FF59"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>รหัสผ่านใหม่</strong></font></td>
      <td height="22" bgcolor="#CEFFCE"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
        &nbsp;&nbsp;&nbsp; 
        <input name="pass"   type="password"  id="pass" value=""  >
        *หากไม่ต้องการเปลี่ยนปล่อยว่างไว้</font></td>
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
        <strong>เลขที่ห้องพัก / Number of rooms.</strong> </font></td>
      <td height="22" bgcolor="#CEFFCE"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;&nbsp;&nbsp; 
        <input name="room"   type="text"  id="room" value="<?php echo $row_user['room']?>" >
        </font></td>
    </tr>
    <tr> 
      <td height="22" bgcolor="#59FF59"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
        <strong>หอพัก / Apartment Name / Site name</strong> </font></td>
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
        <?php echo $row_user['per']?></font></td>
    </tr>
    <tr>
      <td height="22" bgcolor="#59FF59"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> <strong>TEL</strong></font></td>
      <td height="22" bgcolor="#CEFFCE"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;&nbsp;&nbsp; <?php echo $row_user['tel']?></font></td>
    </tr>
    <tr> 
      <td height="22" bgcolor="#59FF59"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>รหัสผ่านเดิมเพื่อยืนยัน</strong></font></td>
      <td height="22" bgcolor="#CEFFCE">&nbsp;&nbsp;&nbsp;<font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
        <input name="pass225"   type="password"  id="pass225" value=""  >
        <font color="#FF0000"><strong>*ถ้าท่านต้องการแก้ไขข้อมูลกรุณาใส่เพื่อยืนยัน 
        </strong></font></font></td>
    </tr>
 
    <tr> 
      <td height="22" bgcolor="#59FF59"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;</font>      </td>
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
