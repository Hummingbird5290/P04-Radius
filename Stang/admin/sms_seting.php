 <?php
  include("../include/chklogin.php");   
  
  ?>
 <meta http-equiv="Content-Type" content="text/html; charset=windows-874">
 <?php
include("../Connections/dbconnect.php");
 
$tb="sms_seting";

if($submit=="บันทึก"  ) {
 
 
$dbquery = mysql_select_db($database_edoc); mysql_query($sql);
 
	$pattern = '/ /i';
$replacement = NULL;
$users= preg_replace($pattern, $replacement, $users);
$pass= preg_replace($pattern, $replacement, $pass);
 


mysql_query( "delete from $tb where   domain='$domain_name'  ") or    die ("Add ข้อมูลลง Table ไม่ได้ 1");
mysql_query("INSERT INTO  $tb  (users,domain,pass )
		      values('$users','$domain_name','$pass')") or    die ("Add ข้อมูลลง Table ไม่ได้  2 ");

}

 
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<style type="text/css">
<!--
.style1 {font-weight: bold}
.style2 {font-weight: bold}
.style3 {font-weight: bold}
-->
</style>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">

 
</head>

<body class="style26">
<div align="center">
  <h1><img src="logo_sms.png" width="161" height="80"><br>
  <strong>ท่านต้อง สมัคร ID กับ <a href="http://thsms.com" target="_blank">http://thsms.com</a> เสียก่อน</h1>
</div>
<p align="center" class="style1 style2">&nbsp; </p>
<table width="421" border="1" align="center" cellpadding="0" cellspacing="0"   class="imagetable">
  <tr bgcolor="#CCCCCC" class="style26">
    <th height="31" colspan="2" bgcolor="#66CCFF"><div align="center"><strong><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">เลขบัญชี thsms.com </font></strong></strong></div></th> 
  </tr>
  <?php 
 $idomain= $_SESSION["domain"];
  $query_Recordset1 = "SELECT   *   FROM sms_seting  where   domain='$idomain' ";
$Recordset1 = mysql_query($query_Recordset1, $connect_db) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

  ?>
  <tr bgcolor="#FFFFFF" class="style26">
    <th width="155"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">USER</font></th>
   
    <td width="260" height="23"> 
        <div align="left">&nbsp;&nbsp;<?php echo $row_Recordset1['users']; ?></div>
   </td>
  </tr>
  <tr bgcolor="#FFFFFF" class="style26">
    <th><font size="2" face="MS Sans Serif, Tahoma, sans-serif">PASS</font></th> 
    <td height="23"> 
        <div align="left">&nbsp;&nbsp;<?php echo $row_Recordset1['pass']; ?></div>
      </td>
    </tr>
<?php
if($row_Recordset1['users'] !=''){
 $usernamesms=$row_Recordset1[users];
 $passwordsms= $row_Recordset1[pass];
 
$ch = curl_init("http://www.thsms.com/api/rest?method=credit&username=$usernamesms&password=$passwordsms&from=0000");
	curl_setopt($ch,CURLOPT_POST,1);
	@curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$server_true_ip=curl_exec($ch);
$pattern = '/success/i';
$replacement = NULL;
$server_true_ip= preg_replace($pattern, $replacement, $server_true_ip);
 
// $mysongs = simplexml_load_file("http://www.thsms.com/api/rest?method=credit&username=$usernamesms&password=$passwordsms&from=0000");
  //  $server_true_ip= $mysongs->credit->credit;
}
?>	
  <tr bgcolor="#FFFFFF" class="style26">
    <th>เหลือ เครดิต   </th>
    <td height="23">&nbsp;&nbsp;<?php print $server_true_ip;?>&nbsp;sms</td>
  </tr>
</table>
 
<p align="center"><strong>ไอดีท่าน จะมีเลขบัญชี  ได้ 1 บัญชีเท่านั้น </strong></p>

<form method="post" name="form1" action="<?php echo $editFormAction; ?>?case_i=75">
  <table width="435" align="center"    class="imagetable">
    <tr valign="baseline"> 
      <th align="right" nowrap bgcolor="#66CCFF"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">user login</font><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> thsms </font>::</font></strong></th>
      <td><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
        <input name="users" type="text" id="users" value="<?php echo $row_Recordset1['users']; ?>" size="32">
 
        </font></strong></td>
    </tr>
    <tr valign="baseline">
      <th align="right" nowrap bgcolor="#66CCFF"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">password::</font></strong></th>
      <td><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">
        <input name="pass" type="text" id="pass" value="<?php echo $row_Recordset1['pass']; ?>" size="32">
      </font></strong></td>
    </tr>
    <tr valign="baseline"> 
      <th align="right" nowrap bgcolor="#66CCFF">&nbsp;</th>
      <td><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
        <input type="submit" value="บันทึก" name="submit" class="styled-button-2"  >
        </font></strong></td>
    </tr>
  </table>
 
</form>
<?php
mysql_free_result($Recordset1);
?>
<p>&nbsp;</p>
</body>
</html>

