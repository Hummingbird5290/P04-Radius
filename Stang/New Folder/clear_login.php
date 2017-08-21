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
<form action="index.php?case_i=5" method="post" enctype="application/x-www-form-urlencoded" name="form_login">
  <table width="471" border="0" align="center"  class=txtContentBold>
    <tr valign=middle bgcolor="#ECFFFF"> 
      <td height="48" colspan="3" bgcolor="#EBF3FF"> <div align="center"><strong><font color="#0000FF">Clear 
          ค่า Login&nbsp;โปรดใส่รหัสผ่านเข้า internet เพื่อ clear ค่า </font></strong></div></td>
    </tr>
    <tr valign=middle bgcolor="#ECFFFF"> 
      <th colspan="3" bgcolor="#FBFCFE">&nbsp;</th>
    </tr>
    <tr bgcolor="#F5F5F5"> 
      <td width="135" bgcolor="#FBFCFE"><div align="right"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong><font color="#333333">username</font></strong></font></div></td>
      <td width="262" bgcolor="#FBFCFE"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
        <input name="UserName2" type="text" id="UserName2" value=""    >
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
          <input name="Submit_login" type="submit" id="Submit_login" value="ตกลง"  >
          <input name="cancel" type="reset" id="cancel" value="กรอกใหม่">
          </font></p>
        <p align="center">&nbsp;</p></td>
    </tr>
  </table>
    </form>
<?php   } ?>
<?php


if(   $Submit_login=='ตกลง')    {
mysql_select_db($database_db, $connect_db);
include("include/function.php");
$stop_time=date("Y-m-d H:i:s");
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
  and   register.UserName='$UserName2' 
  and   register.password='$password' ";
$user_db = mysql_query($query_user, $connect_db) or die(mysql_error());
$row_user = mysql_fetch_assoc($user_db);
$totalRows_user= mysql_num_rows($user_db);

if($totalRows_user >0)  {
mysql_db_query($database_edoc, "update  radacct  set AcctStopTime  ='$stop_time'  , AcctTerminateCause='User-Reset' where   UserName='$UserName2'   and  AcctStopTime='0000-00-00 00:00:00'  ");

echo "<script type=text/javascript>";
echo "alert('ท่านสามารถ login ได้แล้ว ')";
echo "</script>";
echo  "<meta http-equiv=refresh content=0;URL=index.php?a=0 >";
exit();
                                   }
}

  
?>
 
 
<?php  
mysql_close($connect_db);
?>
</body>
</html>
