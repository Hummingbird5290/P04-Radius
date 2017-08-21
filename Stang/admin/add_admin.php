 <?php
  include("../include/chklogin.php");   
  ?>
 <meta http-equiv="Content-Type" content="text/html; charset=windows-874">
 <?php
include("../Connections/dbconnect.php");

$tb="admin";

if($submit=="บันทึก") {
if($uname=='demo'){
      echo                  "<script type=text/javascript>";
		    echo                  "alert('ผู้ใช้ ทดสอบระบบ ไม่สามารถเพิ่มผู้ดูแลระบบได้ :P ')";
	        echo                  "</script>";  
echo "<meta http-equiv=refresh content=0;URL=index.php?case_i=12>";
exit();
}

$uname = htmlspecialchars("$uname", ENT_QUOTES);
$password = htmlspecialchars("$password", ENT_QUOTES);
$password=md5($password); // เข้ารหัส Md5
 $pattern = '/-/i';
$replacement = NULL;
$tel= preg_replace($pattern, $replacement, $tel);

$pattern = '/ /i';
$replacement = NULL;
$tel= preg_replace($pattern, $replacement, $tel);
 $tel = htmlspecialchars("$tel", ENT_QUOTES);
 $uname = htmlspecialchars("$uname", ENT_QUOTES);
 $email = htmlspecialchars("$email", ENT_QUOTES);
	 
  $query_Recordset1 = "SELECT   *   FROM admin  where   uname='$uname' ";
$Recordset1 = mysql_query($query_Recordset1, $connect_db) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);

if($row_Recordset1[uname] !=NULL) {
 	         echo                  "<script type=text/javascript>";
		    echo                  "alert(' ขออภัยไม่สามารถใช้ชื่อ $uname ได้')";
	        echo                  "</script>";  
			     echo "<meta http-equiv=refresh content=0;URL=index.php?case_i=12>"; 
exit(); 
}

$SQLADD="INSERT INTO  admin   (uname,password,types,domain,email,tel)
		      values('$uname','$password','admin','$domain_name','$email','$tel')";

$pattern = '/;/i';
$replacement = NULL;
$SQLADD= preg_replace($pattern, $replacement, $SQLADD);
	//print "$SQLADD";
	  
mysql_query($SQLADD) or    die ("Add ข้อมูลลง Table ไม่ได้ ");

}

if($edit=="1") {
if($uname=='demo'){
      echo                  "<script type=text/javascript>";
		    echo                  "alert('ผู้ใช้ ทดสอบระบบ ไม่สามารถลบข้อมูลได้ :P ')";
	        echo                  "</script>";  
echo "<meta http-equiv=refresh content=0;URL=index.php?case_i=12>";
exit();
}


$sql = "delete from $tb where uname='$iddel' and domain='$domain_name'  ";
$pattern = '/;/i';
$replacement = NULL;
$sql= preg_replace($pattern, $replacement, $sql);
$dbquery = mysql_select_db($database_edoc); 

mysql_query($sql);

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
<p align="center"><strong>เพิ่มผู้ดูแลระบบ</strong></p>

<form method="post" name="form1" action="<?php echo $editFormAction; ?>?case_i=12">
  <table width="435" align="center"    class="imagetable">
    <tr valign="baseline"> 
      <th align="right" nowrap bgcolor="#66CCFF"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong><span class="style5">Login 
        name::</span></strong></font></th>
      <td><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
        <input name="uname" type="text" id="uname" value="" size="32">
        </font></td>
    </tr>
    <tr valign="baseline"> 
      <th align="right" nowrap bgcolor="#66CCFF"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>Password::</strong></font></th>
      <td><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
        <input name="password" type="password" id="password" value="" size="32"><input name="types" id="types" value="admin" type="hidden" >
        </font></td>
    </tr>
    <tr valign="baseline"> 
 <!--     <td align="right" nowrap bgcolor="#66CCFF"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>ประเภท::</strong></font></td>
      <td><font size="2" face="MS Sans Serif, Tahoma, sans-serif">
      
        <select name="types" id="types">
          <option value="admin" selected>admin</option>
          <option value="moniter">moniter</option>
        </select>
        </font></td>
    </tr>-->
    <tr valign="baseline">
      <th align="right" nowrap bgcolor="#66CCFF"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong><span class="style5">E-mail::</span></strong></font></th>
      <td><font size="2" face="MS Sans Serif, Tahoma, sans-serif">
        <input name="email" type="text" id="email" value="" size="32">
      </font></td>
    </tr>
    <tr valign="baseline">
      <th align="right" nowrap bgcolor="#66CCFF"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong><span class="style5">เบอร์โทรศัพท์::</span></strong></font></th>
      <td><font size="2" face="MS Sans Serif, Tahoma, sans-serif">
        <input name="tel" type="text" id="tel" value="" size="32">
      </font></td>
    </tr>
    <tr valign="baseline"> 
      <th align="right" nowrap bgcolor="#66CCFF"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;</font></th>
      <td><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
        <input type="submit" value="บันทึก" name="submit"   class="styled-button-2"  >
        </font></td>
    </tr>
  </table>
 
</form>
<?php
mysql_free_result($Recordset1);
?>
<p>&nbsp;</p>
</body>
</html>

