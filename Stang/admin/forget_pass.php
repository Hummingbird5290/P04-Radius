
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<title>ลืมรหัสผ่าน</title>

<link href="main.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
body {
	background-color: #FFCC99;
}
-->
</style></head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="413" height="347" border="0" align="center" cellpadding="0" cellspacing="0"  background="forgotpassword.png">
  <tr>
    <td  ><table width="300" height="104" border="0" align="right" >
      <tr> </tr>
      <tr>
        <td><form action="sms_password.php?domain_name=<?php print $domain_name;?>" method="post"  enctype="multipart/form-data" >
            <table width="100%"  border="0" cellspacing="0" cellpadding="0">
              <tr> </tr>
              <tr>
                <td bgcolor="#FFFFFF"><div align="right"></div></td>
                <td bgcolor="#FFFFFF"><div align="center"><font size="3" face="MS Sans Serif, Tahoma, sans-serif"><span class="style25"> &nbsp;
                  <strong>กรุณาใส่ชื่อ เข้าใช้ระบบ ของคุณ                    </strong>
                  <input name="mail_send" type="text" class="input" id="mail_send" size="40"   >
                </span></font></div></td>
              </tr>
              <tr>
                <td colspan="2" bgcolor="#FFFFFF"><div align="center"><br>
                </div></td>
              </tr>
              <tr>
                <td colspan="2" bgcolor="#FFFFFF"><div align="center">ระบบ จะอนุญาติให้ส่ง sms ให้ท่าน เดือนล่ะสามครั้งเท่านั้น </div></td>
              </tr>
              <tr>
                <td colspan="2" bgcolor="#FFFFFF"><div align="center"> <font size="3" face="MS Sans Serif, Tahoma, sans-serif">
                    <input  name="sumbit" type="submit" class="button" id="sumbit" value="ส่ง sms">
                </font></div></td>
              </tr>
              <tr>
                <td colspan="2"></td>
              </tr>
            </table>
        </form></td>
      </tr>
    </table></td>
  </tr>
</table>
<br>
</p>
<p>&nbsp;</p>
</body>
</html>
