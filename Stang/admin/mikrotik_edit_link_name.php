<?php include("../include/chklogin.php"); 
 ini_set('date.timezone ', 'Asia/Bangkok');
 include("../Connections/conf.php");
 if($Submit=='Submit'){
 $query_Recordset1ccc = " update    mikrotik_link  set  link_name='$link_name' where     mk_id='$linkid' ";
 $Recordset1ccc = mysql_query($query_Recordset1ccc, $connect_db) or die(mysql_error());
 ?>
 <div align="center"><a href="#show" onClick="window.opener.document.getElementById('<?php print $linkid;?>').innerHTML='<? print $link_name;?>';window.close();">บันทึกข้อมูลแล้ว คลิกปิด</a></div>
 <?
 exit();
 }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
</head>
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
<body>
<?php
$query_Recordset1ccc = " Select  link_name  from  mikrotik_link  where     mk_id='$linkid' ";
$Recordset1ccc = mysql_query($query_Recordset1ccc, $connect_db) or die(mysql_error());
$row_Recordset1ccc = mysql_fetch_assoc($Recordset1ccc);
?>
<form action="mikrotik_edit_link_name.php?linkid=<?php print $linkid;?>" method="post">
<table width="256" border="0" align="center">
  <tr>
    <td><div align="center">
      <input name="link_name" type="text"  value="<?php print $row_Recordset1ccc[link_name];?>"/>
    </div></td>
  </tr>
  <tr>
    <td> 
      <div align="center">
      <input type="submit" name="Submit" value="Submit"  class="styled-button-2"  >
        </div>
    </td>
  </tr>
</table>
</form>
</body>
</html>
