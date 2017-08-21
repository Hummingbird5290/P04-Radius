<?php   
include("../Connections/dbconnect.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
</head>

<body>
<?php
$UserName=$_GET[UserName];
$query_user = "SELECT 
  usergroup.GroupName,
  radgroupreply.Attribute  ,
  radgroupreply.Value  As banwith,
  radgroupreply.op,
  register.`status`,
  register.UserName,
  register.password,
  register.fullname,
  register.per,
  register.room,
  register.tel,
   register.pic_user,
  register.email,
  register.site,
   register.msg,
  register.idstd,
   register.vpn,
 register.domain
 FROM
  register
  INNER JOIN usergroup ON (register.UserName = usergroup.UserName)
  INNER JOIN radgroupreply ON (usergroup.GroupName = radgroupreply.GroupName)
     where register.UserName='$UserName'                      ";
$type_db = mysql_query($query_user, $connect_db) or die(mysql_error());
 $row_data_iuser = mysql_fetch_assoc($type_db);
 $domain_name=$row_data_iuser[domain];
?>
<table width="453" border="0" align="center">
  <tr>
    <td colspan="2" bgcolor="#FFFF99"><div align="center">ยินดีต้อนรับ  <?php print $row_data_iuser[fullname];?></div></td>
  </tr>
  <tr>
    <td width="161">ท่านได้รับความเร็ว</td>
    <td width="200">(<?php echo  number_format(get_BWT($row_data_iuser['GroupName'],$connect_db)/1000000,2);?>)M</td>
  </tr>
  <tr>
    <td>วันหมดอายุการใช้งานคือ</td>
    <td><?php print UDataCHK($row_data_iuser['UserName'],$connect_db);     ?></td>
  </tr>
  <tr>
    <td><a href="edit_user_pass_mk.php">เปลี่ยนรหัสผ่านคลิกที่นี่</a></td>
    <td><a href="http://t-voip0.zapto.org:81/problem.php?domain_name=<?php print $domain_name;?>" target="_blank">แจ้งปัญหาการใช้งานคลิกที่นี่ </a></td>
  </tr>
   
</table>
<?php
##########ค้นหาวันเวลาหมดอายุของแอคเค้า

  
  function get_BWT($UserName,$connect_db) {
  $query_user = "SELECT *   FROM   radgroupreply   where GroupName='$UserName'         and Attribute='WISPr-Bandwidth-Max-Down'              ";
$type_db = mysql_query($query_user, $connect_db) or die(mysql_error());
 $row_data_iuser = mysql_fetch_assoc($type_db);
 return  $row_data_iuser[Value];
  }
  
  function UDataCHK($name,$connect_db) {
 
     mysql_query("SET character_set_results=tis620");
    mysql_query("SET character_set_client=tis620");
    mysql_query("SET character_set_connection=tis620");
    mysql_query("SET collation_connection = tis620_thai_ci");
    mysql_query("SET collation_database = tis620_thai_ci");
    mysql_query("SET  collation_server = tis620_thai_ci");
	
$query_Max = "SELECT  *  from radcheck  where   UserName ='$name'  and Attribute='Expiration'   ";
 $Recordset1_Max = mysql_query($query_Max, $connect_db) or die(mysql_error());
$row_Max = mysql_fetch_assoc($Recordset1_Max);
  
return $times=$row_Max[Value];

}
 
  ?>
</body>
</html>
