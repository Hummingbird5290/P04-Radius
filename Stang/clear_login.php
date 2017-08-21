<?php  
 session_start(); 
include("Connections/dbconnect.php");
 

?>
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">

<link href="main.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.style1 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
}
.style2 {color: #FFFFFF}
.style3 {font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; color: #FFFFFF; }
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
-->
</style>
<body background="images/bg1.gif">
<?php if($Submit_login==null )  { ?>
<form action="index.php?case_i=5" method="post" enctype="application/x-www-form-urlencoded" name="form_login">
  <table width="532" height="521" border="0" cellpadding="0" cellspacing="0" background="c3r.jpg">
    <tr>
      <td width="199" height="196">&nbsp;</td>
      <td width="303">&nbsp;</td>
      <td width="10">&nbsp;</td>
    </tr>
    <tr>
      <td height="264">&nbsp;</td>
      <td valign="top"><table width="271" border="0" align="center"  class=txtContentBold>
        <tr valign=middle bgcolor=""> </tr>
        <tr bgcolor="">
          <td width="192" height="37"><div align="center" class="style1 style2"><font size="2">username</font></div></td>
          <td width="294" bgcolor=""><font size="2" face="MS Sans Serif, Tahoma, sans-serif">
            <input name="UserName2" type="text" class="input" id="UserName2" value=""    >
          </font></td>
        </tr>
        <tr bgcolor="">
          <td height="30" bgcolor=""><div align="center" class="style3"><font size="2">password</font></div></td>
          <td><font size="2" face="MS Sans Serif, Tahoma, sans-serif">
            <input name="password" type="password" class="input" id="password" >
          </font></td>
        </tr>
        <tr bgcolor="">
          <td height="25" colspan="2"><p align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">
            <input name="Submit_login" type="submit" class="button" id="Submit_login" value="ตกลง"  >
              <input name="cancel" type="reset" class="button" id="cancel" value="กรอกใหม่">
          </font></p></td>
        </tr>
      </table></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="61">&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
  <?php   } ?>
  <?php


if(   $Submit_login=='ตกลง')    {
$password=md5($password);
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
  register.`status` <> '0' and radcheck.Attribute ='MD5-Password'  
  and   register.UserName='$UserName2' 
  and   register.password='$password' ";
$user_db = mysql_query($query_user, $connect_db) or die(mysql_error());
$row_user = mysql_fetch_assoc($user_db);
$totalRows_user= mysql_num_rows($user_db);

if($totalRows_user >0)  {
mysql_select_db($database_edoc); mysql_query( "update  radacct  set AcctStopTime  ='$stop_time'  , AcctTerminateCause='User-Reset' where   UserName='$UserName2'   and  AcctStopTime='0000-00-00 00:00:00'  ");

##############  ดีด user ออกจากเน็ต หาก เค้าต่ออยู่
  
$filename = '/data/command.sh';
$somecontent = "#!/bin/sh \n  /bin/echo   User-Name=$UserName   |    /usr/bin/radclient     -x 127.0.0.1:3779 disconnect testing123 \n \necho '' >   /data/command.sh \n";
 
// Let's make sure the file exists and is writable first.
if (is_writable($filename)) {

    // In our example we're opening $filename in append mode.
    // The file pointer is at the bottom of the file hence
    // that's where $somecontent will go when we fwrite() it.
    if (!$handle = fopen($filename, 'w')) {
         echo "Cannot open file ($filename)";
         exit;
    }

    // Write $somecontent to our opened file.
    if (fwrite($handle, $somecontent) === FALSE) {
        echo "Cannot write to file ($filename)";
        exit;
    }

    echo "Success";
	//, wrote ($somecontent) to file ($filename)";

    fclose($handle);

} else {
 //   echo "The file $filename is not writable";
}

###########################################################################

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
</form>
</body>
</html>
