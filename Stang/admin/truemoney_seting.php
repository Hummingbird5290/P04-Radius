 <?php
  include("../include/chklogin.php");   
  ?>
 <meta http-equiv="Content-Type" content="text/html; charset=windows-874">
 <?php
include("../Connections/dbconnect.php");

$tb="truemonet_setup";

if($submit=="บันทึก"  ) {
 
 
$dbquery = mysql_select_db($database_edoc); mysql_query($sql);
 
		  $idtruemoney = htmlspecialchars("$idtruemoney", ENT_QUOTES);
 $d50 = htmlspecialchars("$d50", ENT_QUOTES);
 $d90 = htmlspecialchars("$d90", ENT_QUOTES);
 $d150 = htmlspecialchars("$d150", ENT_QUOTES);
 $d300 = htmlspecialchars("$d300", ENT_QUOTES);
 $tel = htmlspecialchars("$tel", ENT_QUOTES);
		  
mysql_query( "delete from $tb where   domain='$domain_name'  ") or    die ("Add ข้อมูลลง Table ไม่ได้ 1");
mysql_query("INSERT INTO  $tb  (idtruemoney,domain,d50,d90,d150,d300,tel)
		      values('$idtruemoney','$domain_name','$d50','$d90','$d150','$d300','$tel')") or    die ("Add ข้อมูลลง Table ไม่ได้  2 ");

}

 
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<style type="text/css">
<!--
.style1 {font-weight: bold}
.style2 {font-weight: bold}
.style3 {font-weight: bold}
.style4 {
	font-family: "Courier New", Courier, monospace;
	font-size: 14px;
}
-->
</style>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">

 
</head>

<body class="style26">
<div align="center">
  <h1><img src="logo_truemoney.png" width="157" height="40"><br>
  ตั้งค่าระบบตัดบัตร Truemoney</h1>
</div>
<p align="center" class="style1 style2">&nbsp;</p>
<table width="707" border="0" align="center">
  <tr>
    <td> <span class="style4">ข้อตกลงการเชื่อมระบบกับ Truemoney <br>
ระบบจะโอนเงินเข้าบัญชีธนาคารกรุงไทยของท่านทุก ๆ วันที่ 15 และ 30 ของทุกเดือน <br>
1. โดยหลังจากโอน จะแจ้ง sms ให้ท่านทราบโดยทันที<br>
2. หากท่านไม่ตั้งค่าราคาหน้าบัตรทรู และบัญชีธนาคาร ระบบจะไม่เปิดให้สามารถเติมเวลาเล่นอินเตอร์เน็ตจากบัตรทรูได้<br>
3. ระบบจะหักค่าบริการ ในการเติมบัตร 11% จากราคาหน้าบัตรทรูที่ลูกค้าท่านเป็นค่าดำเนินการเชื่อมต่อกับ Truemoney</span></td>
  </tr>
</table>
<p align="center" class="style1 style2">&nbsp;</p>
<table width="412" border="1" align="center" cellpadding="0" cellspacing="0" class="imagetable">
  <tr bgcolor="#CCCCCC" class="style26"> 
    <th width="862" height="31" bgcolor="#66CCFF"><div align="center"><font size="3" face="MS Sans Serif, Tahoma, sans-serif">เลขบัญชี ธนาคารกรุงไทย </font></div></th>
  </tr>
  <?php 
  $query_Recordset1 = "SELECT   *   FROM truemonet_setup  where   domain='$domain_name' ";
$Recordset1 = mysql_query($query_Recordset1, $connect_db) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

  ?>
  <tr bgcolor="#FFFFFF" class="style26"> 
    <td height="23"><div align="center" class="style3"> 
        <div align="left"><font size="3" face="MS Sans Serif, Tahoma, sans-serif"><?php echo $row_Recordset1['idtruemoney']; ?></font></div>
      </div></td>
  </tr>
 
</table>
<p align="center">ไอดีท่าน จะมีเลขบัญชี ธนาคาร ได้ 1 บัญชีเท่านั้น </p>

<form method="post" name="form1" action="<?php echo $editFormAction; ?>?case_i=74">
  <table width="490" align="center" class="imagetable">
    <tr valign="baseline"> 
      <th align="right" nowrap bgcolor="#66CCFF"><font size="3" face="MS Sans Serif, Tahoma, sans-serif"><font size="3" face="MS Sans Serif, Tahoma, sans-serif">เลขบัญชี </font></font><font size="3" face="MS Sans Serif, Tahoma, sans-serif">ธนาคารกรุงไทย</font><font size="3" face="MS Sans Serif, Tahoma, sans-serif"><font size="3" face="MS Sans Serif, Tahoma, sans-serif"> </font>::</font></th>
      <td><font size="3" face="MS Sans Serif, Tahoma, sans-serif"> 
        <input name="idtruemoney" type="text" id="idtruemoney" value="<?php echo $row_Recordset1['idtruemoney']; ?>" size="32">
 
        </font></td>
    </tr>
    <tr valign="baseline">
      <th align="right" nowrap bgcolor="#66CCFF"><font size="3" face="MS Sans Serif, Tahoma, sans-serif">เบอร์โทรศัพย์สำหรับรับแจ้งการโอนเงิน ::</font></th>
      <td><font size="3" face="MS Sans Serif, Tahoma, sans-serif">
        <input name="tel" type="text" id="tel" value="<?php echo $row_Recordset1['tel']; ?>" size="32">
      </font></td>
    </tr>
    <tr valign="baseline">
      <th align="right" nowrap bgcolor="#66CCFF"><font size="3" face="MS Sans Serif, Tahoma, sans-serif">ราคาหน้าบัตรทรู::</font></th>
      <th><font size="3" face="MS Sans Serif, Tahoma, sans-serif">จำนวนวันอินเตอร์เน็ต</font></td>
    </tr>
    <tr valign="baseline">
      <th align="right" nowrap bgcolor="#66CCFF"><font size="3" face="MS Sans Serif, Tahoma, sans-serif"><font size="3" face="MS Sans Serif, Tahoma, sans-serif">บัตรราคา 50 BATH </font>::</font></th>
      <td><font size="2" face="MS Sans Serif, Tahoma, sans-serif">
        <input name="d50" type="text" id="d50" value="<?php echo $row_Recordset1['d50']; ?>" size="5">
&nbsp;<font size="3" face="MS Sans Serif, Tahoma, sans-serif">วัน   </font> </font></td>
    </tr>
 
 
    <tr valign="baseline">
      <th align="right" nowrap bgcolor="#66CCFF"><font size="3" face="MS Sans Serif, Tahoma, sans-serif"><font size="3" face="MS Sans Serif, Tahoma, sans-serif">บัตรราคา 90 BATH </font>::</font></th>
      <td><font size="3" face="MS Sans Serif, Tahoma, sans-serif">
        <input name="d90" type="text" id="d90" value="<?php echo $row_Recordset1['d90']; ?>" size="5">
&nbsp;<font size="3" face="MS Sans Serif, Tahoma, sans-serif">วัน </font></font></td>
    </tr>
    <tr valign="baseline">
      <th align="right" nowrap bgcolor="#66CCFF"><font size="3" face="MS Sans Serif, Tahoma, sans-serif"><font size="3" face="MS Sans Serif, Tahoma, sans-serif">บัตรราคา 150 BATH </font>::</font></th>
      <td><font size="3" face="MS Sans Serif, Tahoma, sans-serif">
        <input name="d150" type="text" id="d150" value="<?php echo $row_Recordset1['d150']; ?>" size="5">
&nbsp;<font size="3" face="MS Sans Serif, Tahoma, sans-serif">วัน </font></font></td>
    </tr>
    <tr valign="baseline">
      <th align="right" nowrap bgcolor="#66CCFF"><font size="3" face="MS Sans Serif, Tahoma, sans-serif"><font size="3" face="MS Sans Serif, Tahoma, sans-serif">บัตรราคา 300 BATH </font>::</font></th>
      <td><font size="3" face="MS Sans Serif, Tahoma, sans-serif">
        <input name="d300" type="text" id="d300" value="<?php echo $row_Recordset1['d300']; ?>" size="5">
&nbsp;<font size="3" face="MS Sans Serif, Tahoma, sans-serif">วัน </font></font></td>
    </tr>
    <tr valign="baseline"> 
      <th align="right" nowrap bgcolor="#66CCFF">&nbsp;</th>
      <td><font size="3" face="MS Sans Serif, Tahoma, sans-serif"> 
        <input type="submit" value="บันทึก" name="submit" class="styled-button-2"  >
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

