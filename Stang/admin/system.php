 <?php    include("../include/chklogin.php");  
 exit(); ?> 
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
</head>
<link href="../css/style.css" rel="stylesheet" type="text/css">
<body>
<form name="form1" method="post" action="shutdown.php">
  <table width="100%" border="0" align="center">
    <tr bgcolor="#66FFFF"> 
      <td colspan="3"><div align="center"  >
        <h2 class="scimenu"><strong>System Control    </strong></h2>
      </div></td>
    </tr>
    <tr>
      <td width="8%" bgcolor="#FFFFCC"><img src="../images/restart.png" alt="รีบู๊ตระบบใหม่" width="47" height="43"></td>
      <td width="25%" bgcolor="#FFFFCC" class="scimenu"><input type="radio" name="init" value="3">
        Reboot</td>
      <td width="67%" bgcolor="#FFFFCC" class="scimenu">รีบูตระบบ</td>
    </tr>
    <tr>
      <td bgcolor="#FFFFCC"><img src="../images/shutdown.png" alt="ปิดเครื่อง" width="47" height="43"></td>
      <td bgcolor="#FFFFCC" class="scimenu"><input type="radio" name="init" value="0">
        Shutdown </td>
      <td bgcolor="#FFFFCC" class="scimenu">ปิดเครื่อง</td>
    </tr>
    <tr>
      <td bgcolor="#FFFFCC"><img src="../images/proxy.gif" width="47" height="43" alt="Proxy Restart"></td>
      <td bgcolor="#FFFFCC" class="scimenu"><input type="radio" name="init" value="2">
      Restart Proxy </td>
      <td bgcolor="#FFFFCC" class="scimenu">รัน ระบบ  Proxy ใหม่ (กรณีระบบมีปัญหาไม่สามารถเข้าหน้าเว็บได้) </td>
    </tr>
    <tr>
      <td bgcolor="#FFFFCC"><img src="../images/dhcp.png" alt="Restart chilli" width="47" height="43"></td>
      <td bgcolor="#FFFFCC" class="scimenu"><input type="radio" name="init" value="20">
      Restart Chilli </td>
      <td bgcolor="#FFFFCC" class="scimenu">รันระบบ Chilli ใหม่</td>
    </tr>
    <tr>
      <td colspan="3" bgcolor="#FFFFCC">&nbsp;</td>
    </tr>
    <tr> 
      <td colspan="3"><div align="center">
          <input type="submit" name="Submit" value="Submit">
        </div></td>
    </tr>
    <tr bgcolor="#66FFFF"> 
      <td colspan="3"> <div align="center"> </div></td>
    </tr>
  </table>
</form>
</body>
</html>
