<?php  include("../include/chklogin.php");  
include("../Connections/dbconnect.php");
include("../include/function.php");
?>
<html>
<head>
<title>รายล่ะเอียดปัญหา</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<style type="text/css">
.styled-button-2 {
	-webkit-box-shadow:rgba(0,0,0,0.2) 0 1px 0 0;
	-moz-box-shadow:rgba(0,0,0,0.2) 0 1px 0 0;
	box-shadow:rgba(0,0,0,0.2) 0 1px 0 0;
	border-bottom-color:#333;
	border:1px solid #61c4ea;
	background-color:#7cceee;
	border-radius:5px;
	-moz-border-radius:5px;
	-webkit-border-radius:5px;
	color:#333;
	font-family:'Verdana',Arial,sans-serif;
	font-size:14px;
	text-shadow:#b2e2f5 0 1px 0;
	padding:5px
}
</style>
<style type="text/css">

table.imagetable {
	font-family: verdana,arial,sans-serif;
	font-size:11px;
	color:#333333;
	border-width: 1px;
	border-color: #999999;
	border-collapse: collapse;
}
table.imagetable th {
	background:#b5cfd2 url('cell-blue.jpg');
	border-width: 1px;
	padding: 8px;
	border-style: solid;
	border-color: #999999;
}
table.imagetable td {
	background:#dcddc0 url('cell-grey.jpg');
	border-width: 1px;
	padding: 8px;
	border-style: solid;
	border-color: #999999;
}
</style>
<body background="images/bg1.gif">
<?php
if($Submit=="Submit"){
$repare = htmlspecialchars("$repare", ENT_QUOTES);
$pattern = '/;/i';
$replacement = NULL;
$repare= preg_replace($pattern, $replacement, $repare);
update("question","repare ='$repare',status='$status' "," where id='$id'    ");   
echo " <center>  บันทึกข้อมูลเสร็จสิ้น  </center> <br>";
}
?>

<?php



 

mysql_select_db($database_db, $connect_db);
$id = htmlspecialchars("$id", ENT_QUOTES);
$query_user = "SELECT *  FROM    question   where id='$id' ";
$user_db = mysql_query($query_user, $connect_db) or die(mysql_error());
$row_user = mysql_fetch_assoc($user_db);
$totalRows_user= mysql_num_rows($user_db);


 
?>
 
  
<table width="450" border="0" align="center" class="imagetable">
  <tr bgcolor="#00AA00" > 
    <th colspan="2"><div align="center"><strong><font size="3" face="MS Sans Serif, Tahoma, sans-serif">รายละเอียด 
        ปัญหาที่แจ้ง </font></strong></div></th>
  </tr>
  <tr > 
    <th width="34%" height="22" bgcolor="#59FF59"><font size="2" face="MS Sans Serif"><strong>ชื่อ 
      ผู้แจ้ง </strong></font></th>
    <td width="66%" height="22" bgcolor="#CEFFCE"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
      &nbsp;&nbsp;&nbsp;<?php echo $row_user['name']?></font></td>
  </tr>
  <tr> 
    <th height="22" bgcolor="#59FF59"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>รายล่ะเอียด</strong></font></th>
    <td height="22" bgcolor="#CEFFCE"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;&nbsp;&nbsp;<?php echo $row_user['question']?></font></td>
  </tr>
  <tr> 
    <th height="22" bgcolor="#59FF59"><font size="2" face="Microsoft Sans Serif, MS Sans Serif, sans-serif"> 
      <strong>เบอร์โทรติดต่อกลับ</strong></font></th>
    <td height="22" bgcolor="#CEFFCE"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;&nbsp;&nbsp;<?php echo $row_user['tel']?></font></td>
  </tr>
  <tr> 
    <th height="22" bgcolor="#59FF59"><font size="2" face="Microsoft Sans Serif, MS Sans Serif, sans-serif"> 
      <strong>ip </strong></font></th>
    <td height="22" bgcolor="#CEFFCE"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;&nbsp;&nbsp;<?php echo $row_user['ip']?></font></td>
  </tr>
  <tr> 
    <th height="22" bgcolor="#59FF59"><font size="2" face="Microsoft Sans Serif, MS Sans Serif, sans-serif"> 
      <strong>เวลาที่แจ้ง</strong> </font></th>
    <td height="22" bgcolor="#CEFFCE"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;&nbsp;&nbsp;<?php echo $row_user['time_q']?></font></td>
  </tr>
  <tr> 
    <th height="22" bgcolor="#59FF59"><font size="2" face="Microsoft Sans Serif, MS Sans Serif, sans-serif"> 
      <strong>status</strong> </font></th>
    <td height="22" bgcolor="#CEFFCE"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;&nbsp;&nbsp; 
      <?php   if($row_user['status']==0)  { echo "ยังไม่ได้รับการแก้ไข"; } else {echo "ได้รับการแก้ไขแล้ว"; }?>
      </font></td>
  </tr>
  <tr>
    <th height="22" bgcolor="#59FF59"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">การแก้ไขปัญหา</font></strong></th>
    <td height="22" bgcolor="#CEFFCE">&nbsp;&nbsp;&nbsp;<font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
     <?php echo $row_user['repare']?>
      </font></td>
  </tr>
</table>
 
<form name="form1" method="post" action="detail_problem.php">
  <table width="450" border="0" align="center"  class="imagetable">
    <tr> 
      <th height="22" valign="top" bgcolor="#59FF59"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">การแก้ไขปัญหา</font></strong></th>
      <td height="22" bgcolor="#CEFFCE"> <textarea name="repare" cols="50" rows="7" wrap="VIRTUAL" id="repare"></textarea> 
      </td>
    </tr>
    <tr>
      <td height="22" bgcolor="#59FF59"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>แก้ไขแล้ว</strong></font></td>
      <td height="22" bgcolor="#CEFFCE"><table width="200">
          <tr> 
            <td><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
              <label> 
              <input name="status" type="radio" value="1" checked>
              แก้ไขแล้ว </label>
              </font></td>
          </tr>
          <tr> 
            <td><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
              <label> 
              <input type="radio" name="status" value="0">
              ยังไม่ได้รับการแก้ไข</label>
              </font></td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td height="22" bgcolor="#59FF59"><input  type="hidden" name="id" value="<?php echo $row_user['id']?>" >
        &nbsp;</td>
      <td height="22" bgcolor="#CEFFCE"><input type="submit" name="Submit" value="Submit" class="styled-button-2"  >
        <input type="reset" name="Submit2" value="Reset" class="styled-button-2"  ></td>
    </tr>
  </table>
  </form>
  <p>&nbsp;</p>

<?php  
mysql_close($connect_db);
?></body>
</html>
