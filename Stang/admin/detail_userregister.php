<?php  include("../include/chklogin.php");  
include("../Connections/dbconnect.php");
?>
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">

<body background="images/bg1.gif">
<?php
mysql_select_db($database_db, $connect_db);

$query_user = "  SELECT * FROM `register`  where  UserName='$id_edit'  	  ";

$user_db = mysql_query($query_user, $connect_db) or die(mysql_error());
$row_user = mysql_fetch_assoc($user_db);
$totalRows_user= mysql_num_rows($user_db);

include("../include/function.php");
 
?>

  
<table width="450" border="0" align="center">
  <tr bgcolor="#00AA00" > 
    <td colspan="2"><div align="center"><strong><font size="3" face="MS Sans Serif, Tahoma, sans-serif">รายละเอียด 
        ผู้สมัครเข้าใช้งาน</font></strong></div></td>
  </tr>
  <tr > 
    <td width="34%" height="22" bgcolor="#59FF59"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">ชื่อ 
      Login</font></strong></td>
    <td width="66%" height="22" bgcolor="#CEFFCE"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
      &nbsp;&nbsp;&nbsp;<?php echo $row_user['UserName']?></font></td>
  </tr>
  <tr> 
    <td height="22" bgcolor="#59FF59"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
      ชื่อ-นามสกุล </font></strong></td>
    <td height="22" bgcolor="#CEFFCE"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;&nbsp;&nbsp;<?php echo $row_user['fullname']?></font></td>
  </tr>
  <tr> 
    <td height="22" bgcolor="#59FF59"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
      เลขที่ห้องพัก </font></strong></td>
    <td height="22" bgcolor="#CEFFCE"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;&nbsp;&nbsp;<?php echo $row_user['room']?></font></td>
  </tr>
  <tr> 
    <td height="22" bgcolor="#59FF59"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
      หอพัก / Apartment Name / Site name </font></strong></td>
    <td height="22" bgcolor="#CEFFCE"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;&nbsp;&nbsp;<?php echo $row_user['site']?></font></td>
  </tr>
  <tr> 
    <td height="22" bgcolor="#59FF59"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
      เบอร์ที่ติดต่อได้ </font></strong></td>
    <td height="22" bgcolor="#CEFFCE"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;&nbsp;&nbsp;<?php echo $row_user['tel']?></font></td>
  </tr>
  <tr> 
    <td height="22" bgcolor="#59FF59"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
      E-mail </font></strong></td>
    <td height="22" bgcolor="#CEFFCE"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;&nbsp;&nbsp;<?php echo $row_user['email']?></font></td>
  </tr>
  <tr> 
    <td height="22" bgcolor="#59FF59"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
      เลขประจำตัวประชาชน</font></strong></td>
    <td height="22" bgcolor="#CEFFCE"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;&nbsp;&nbsp;<?php echo $row_user['per']?></font></td>
  </tr>
</table>

<?php  
mysql_close($connect_db);
?>
</body>
</html>
