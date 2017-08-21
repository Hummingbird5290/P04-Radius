 <?php
  include("../include/chklogin.php");   
  if ($_SERVER['HTTP_CLIENT_IP']) { 
$IP = $_SERVER['HTTP_CLIENT_IP'];
} elseif (preg_match("/[0-9]/",$_SERVER["HTTP_X_FORWARDED_FOR"] )) { 
$IP = $_SERVER["HTTP_X_FORWARDED_FOR"];
} else { 
$IP = $_SERVER["REMOTE_ADDR"];
}
  ?>
 <meta http-equiv="Content-Type" content="text/html; charset=windows-874">
 <?php
include("../Connections/dbconnect.php");

$tb="admin";

if($submit=="แก้ไข" and $password !='' ) {
if($_SESSION["adminpass"]=='demo'){
      echo                  "<script type=text/javascript>";
		    echo                  "alert('ผู้ใช้ ทดสอบระบบ เปลี่ยนรหัสผ่านไม่ได้ครับ :P ')";
	        echo                  "</script>";  
echo "<meta http-equiv=refresh content=0;URL=index.php?case_i=12>";
exit();
}
 $pattern = '/-/i';
$replacement = NULL;
$tel= preg_replace($pattern, $replacement, $tel);

 $pattern = '/;/i';
$replacement = NULL;
$tel= preg_replace($pattern, $replacement, $tel);

$pattern = '/ /i';
$replacement = NULL;
$tel= preg_replace($pattern, $replacement, $tel);
$password = htmlspecialchars("$password", ENT_QUOTES);
$password=md5($password); // เข้ารหัส Md5

 
 $password = htmlspecialchars("$password", ENT_QUOTES);
 $uname = htmlspecialchars("$uname", ENT_QUOTES);
	 $email = htmlspecialchars("$email", ENT_QUOTES);
	  $tel = htmlspecialchars("$tel", ENT_QUOTES);
	  
$pattern = '/;/i';
$replacement = NULL;
$password= preg_replace($pattern, $replacement, $password);
$uname= preg_replace($pattern, $replacement, $uname);
$email= preg_replace($pattern, $replacement, $email);
$tel= preg_replace($pattern, $replacement, $tel);

mysql_query("update     $tb   set   password= '$password',email='$email' ,tel='$tel' where  uname='$uname' and domain='$domain_name' " ) or    die ("แก้ไข ข้อมูลลง Table ไม่ได้ ");
mysql_query("INSERT INTO history_admin  (noute) values('ผู้ดูแลระบบ เปลี่ยนรหัสผ่าน ไอดี $uname  จากเครื่องรีโมท หมายเลขไอพี  $IP')") ;
echo "<meta http-equiv=refresh content=0;URL=index.php?case_i=12>";
exit();
}

if($submit=="แก้ไข"   ) {

if($_SESSION["adminpass"]=='demo'){
      echo                  "<script type=text/javascript>";
		    echo                  "alert('ผู้ใช้ ทดสอบระบบ เปลี่ยนรหัสผ่านไม่ได้ครับ :P ')";
	        echo                  "</script>";  
echo "<meta http-equiv=refresh content=0;URL=index.php?case_i=12>";
exit();
}

 $pattern = '/-/i';
$replacement = NULL;
$tel= preg_replace($pattern, $replacement, $tel);

$pattern = '/ /i';
$replacement = NULL;
$tel= preg_replace($pattern, $replacement, $tel);
 
  $password = htmlspecialchars("$password", ENT_QUOTES);
 $uname = htmlspecialchars("$uname", ENT_QUOTES);
	 $email = htmlspecialchars("$email", ENT_QUOTES);
	  $tel = htmlspecialchars("$tel", ENT_QUOTES);
	$pattern = '/;/i';
$replacement = NULL;
$password= preg_replace($pattern, $replacement, $password);
$uname= preg_replace($pattern, $replacement, $uname);
$email= preg_replace($pattern, $replacement, $email);
$tel= preg_replace($pattern, $replacement, $tel);  
mysql_query("update     $tb   set   email='$email' ,tel='$tel' where  uname='$uname' and domain='$domain_name' " ) or    die ("แก้ไข ข้อมูลลง Table ไม่ได้ ");
 echo "<meta http-equiv=refresh content=0;URL=index.php?case_i=12>";
exit();
}
if($edit=="1") {
if($_SESSION["adminpass"]=='demo'){
      echo                  "<script type=text/javascript>";
		    echo                  "alert('ผู้ใช้ ทดสอบระบบ เปลี่ยนรหัสผ่านไม่ได้ครับ :P ')";
	        echo                  "</script>";  
echo "<meta http-equiv=refresh content=0;URL=index.php?case_i=12>";
exit();
}
 $iddel = htmlspecialchars("$iddel", ENT_QUOTES);
 $pattern = '/;/i';
$replacement = NULL;
$iddel= preg_replace($pattern, $replacement, $iddel);
$sql = "delete from $tb where uname='$iddel' and domain='$domain_name'  ";
$dbquery = mysql_select_db($database_edoc); mysql_query($sql);
echo "<meta http-equiv=refresh content=0;URL=index.php?case_i=12>";
exit();
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">

 
</head>

<body class="style26">
<p align="center" class="style1 style2">&nbsp; </p>
<table width="802" border="1" align="center" cellpadding="0" cellspacing="0"    class="imagetable">
  <tr bgcolor="#CCCCCC" class="style26"> 
    <th width="233" height="31" bgcolor="#66CCFF"><div align="center" class="style1 style2"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>รายนามผู้ดูแลระบบ</strong></font></div></th>
    <th width="143" bgcolor="#66CCFF"><div align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>E-mail</strong></font></div></th>
    <th width="143" bgcolor="#66CCFF"><div align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>TEL</strong></font></div></th>
    <th width="143" bgcolor="#66CCFF"><div align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>Type</strong></font></div></th>
    <th width="48" bgcolor="#66CCFF"><div align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>แก้ไข</strong></font></div></th>
    <th width="38" bgcolor="#66CCFF"><div align="center" class="style5"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>ลบทิ้ง</strong></font></div></th>
  </tr>
  <?php 
  $query_Recordset1 = "SELECT   *   FROM admin  where   domain='$domain_name' ";
$Recordset1 = mysql_query($query_Recordset1, $connect_db) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

  do { ?>
  <tr bgcolor="#FFFFFF" class="style26"> 
    <td height="23"><div align="center" class="style3"> 
        <div align="left"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><?php echo   htmlspecialchars($row_Recordset1['uname'], ENT_QUOTES);?>
	</font></div>
      </div></td>
    <td><div align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><?php echo $row_Recordset1['email']; ?></font></div></td>
    <td><div align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><?php echo $row_Recordset1['tel']; ?></font></div></td>
    <td><div align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><?php echo $row_Recordset1['types']; ?></font></div></td>
    <td><div align="center">
	<a href="index.php?case_i=26&idedit2=<?php echo   htmlspecialchars($row_Recordset1['uname'], ENT_QUOTES);?>"><img src="../images/test.gif" width="16" height="16" border="0"></a></div></td>
    <td><div align="center" class="style3"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">
	<a href="<?php echo $editFormAction; ?>?case_i=12&edit=1&iddel=<?php echo 	  htmlspecialchars($row_Recordset1['uname'], ENT_QUOTES);?>"  onClick="return cdelete(this)"><img src="../images/delete.gif" width="16" height="16" border="0"></a></font></div></td>
  </tr>
  <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
</table>
<p align="right"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><a href="index.php?case_i=12">แก้ไขรหัสผ่านผู้ดูแลระบบ</a></font></p>
<p>&nbsp;</p>
  
<?php 
  $query_Recordset12 = "SELECT   *   FROM admin  where uname  ='$idedit2'  and domain='$domain_name' ";
$Recordset12 = mysql_query($query_Recordset12, $connect_db) or die(mysql_error());
$row_Recordset12 = mysql_fetch_assoc($Recordset12);
 
?>
<div align="center"><strong>แก้ไขรหัสผ่านผู้ดูแลระบบ</strong> </div>
<form method="post" name="form1" action="<?php echo $editFormAction; ?>?case_i=26">
  <table width="652" align="center"   class="imagetable">
    <tr valign="baseline"> 
      <th width="125" align="right" nowrap bgcolor="#66CCFF"><strong><span class="style5">Login 
        name::</span></strong></th>
      <td width="477"><input name="uname" type="text" id="uname" value="<?php print  $row_Recordset12[uname];?>" readonly="yes" size="32"></td>
    </tr>
    <tr valign="baseline"> 
      <th align="right" nowrap bgcolor="#66CCFF"><strong>Password::</strong></th>
      <td><input name="password" type="password" id="password" value="" size="32">
      *หากไม่ต้องการเปลี่ยนรหัส่านเดิมให้ว่างไว้</td>
    </tr>
    <tr valign="baseline">
      <th align="right" nowrap bgcolor="#66CCFF"><strong>E-mail::</strong></th>
      <td><font size="2" face="MS Sans Serif, Tahoma, sans-serif">
        <input name="email" type="text" id="email" value="<?php print  $row_Recordset12[email];?>" size="32">
      </font></td>
    </tr>
    <tr valign="baseline">
      <th align="right" nowrap bgcolor="#66CCFF"><strong>เบอร์โทรศัพท์::</strong></th>
      <td><font size="2" face="MS Sans Serif, Tahoma, sans-serif">
        <input name="tel" type="text" id="tel" value="<?php print  $row_Recordset12[tel];?>" size="32">
      </font></td>
    </tr>
    
    <tr valign="baseline"> 
      <th align="right" nowrap bgcolor="#66CCFF">&nbsp;</th>
      <td><input type="submit" value="แก้ไข" name="submit"   class="styled-button-2"  ></td>
    </tr>
  </table>
 
</form>
<?php
mysql_free_result($Recordset1);
?>
<p>&nbsp;</p>
</body>
</html>

