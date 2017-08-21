
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<title>ส่ง Email ถึงผู้ใช้</title>
 <link href="../css/style.css" rel="stylesheet" type="text/css">
<link href="../main.css" rel="stylesheet" type="text/css">
</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
 
		<form action="mail_send_OK.php" method="post"  enctype="multipart/form-data" name="form100">
            <table width="642"  border="0" cellspacing="0" cellpadding="0"  class="imagetable">
             
              <tr>
                <th> 
 <span class="scimenu"><font size="3" face="MS Sans Serif, Tahoma, sans-serif"> 
 ข้อความ Email                               
 </font></span></th>
              </tr>
              <tr>
                <td><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
        <input name="UserName" type="text" id="UserName"   readonly="yes">
         <img src="../images/investigacion.gif" width="25" height="24" border="0" align="baseline"> 
        <a href="#search" onClick="newwindow=window.open('choose_user.php','choose_user','height=400,width=500,left=10,top=100,scrollbars=1');newwindow.focus();"> 
        ค้นหาสมาชิกที่ต้องการส่ง</a> &nbsp;&nbsp; </font></td>
              </tr>
              <tr>
                <td>   <input type="checkbox" name="alluser" id="alluser" value="1">
                 
                คลิกส่งเมลถึงทุกคนในระบบ</td>
              </tr>
              <tr>
                <td><div align="center"><font size="3" face="MS Sans Serif, Tahoma, sans-serif"><span class="style25">
                  <textarea name="data_detail" cols="80" rows="7" wrap="virtual" class="sciIntro"></textarea>
                </span></font> 
                </div></td>
              </tr>
              <tr>
                <td><div align="center"> <font size="3" face="MS Sans Serif, Tahoma, sans-serif">
                    <input  name="sumbit" type="submit"   id="sumbit" value="ส่งเมลล์" class="styled-button-2"  >
                </font></div></td>
              </tr>
              <tr>
                <td></td>
              </tr>
          </table>
        </form> 
</body>
</html>
