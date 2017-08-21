  <?php include("../include/chklogin.php");   ?>
<?php
include("../Connections/dbconnect.php");

include("../include/function.php");
 


if($submit=="บันทึก"        ) {
 
$pattern = '/:/i';
$replacement = '-';
$macaddress=preg_replace($pattern, $replacement, $macaddress);
$macaddress=strtoupper ($macaddress);

$query_user1= "select  *  from server   where macaddress='$macaddress'    ";

$type_db_user_gr = mysql_query($query_user1, $connect_db) or die(mysql_error());

$totalRows_user_group= mysql_num_rows($type_db_user_gr);
 
if($totalRows_user_group ==0  )  {  //  เช็คว่ามีใน db ป่าว  
mysql_query("INSERT INTO  server  (ip,macaddress,server_name)
		      values( '$ip','$macaddress','$server_name'  )") or    die ("Add ข้อมูลลง Table ไม่ได้ ");

  } // จบเช็คว่ามีใน db ป่าว  
			  
}

if($edit=="1"   ) {
$tb="server";
$sql = "delete from $tb where server_id='$server_id'  ";
 mysql_select_db($database_edoc); $dbquery =mysql_query($sql);

 

}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">

 
</head>

<body class="style26">
<div align="right"></div>
<p align="left" class="style1 style2"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
  </font></strong></p>
<table width="100%" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr bgcolor="#CCCCCC" class="style26"> 
    <td width="438" bgcolor="#66CCFF"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>Vlan ID</strong></font></td>
    <td width="438" bgcolor="#66CCFF"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>IP Address for Access point </strong></font></td>
    <td width="507" height="31" bgcolor="#66CCFF"><div align="center" class="style1 style2"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>MacAddress</strong></font></div></td>
    <td width="72" bgcolor="#66CCFF"><div align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>Edit</strong></font></div></td>
    <td width="72" bgcolor="#66CCFF"><div align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>ลบทิ้ง</strong></font></div></td>
  </tr>
  <?php 
  $query_Recordset1 = "SELECT   *   FROM   server     order by  server_name  DESC   ";
$Recordset1 = mysql_query($query_Recordset1, $connect_db) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

  do { 
 
 ?>
  <tr bgcolor="#FFFFFF" class="style26"> 
    <td><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><?php echo $row_Recordset1['server_name']; ?></font></td>
    <td><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> <?php echo $row_Recordset1['ip']; ?> 
      </font></td>
    <td height="23"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><?php echo $row_Recordset1['macaddress']; ?></font></td>
    <td><div align="center"><a href=index.php?case_i=22&server_id=<?php echo $row_Recordset1['server_id']; ?>><img src="../images/icon_sturegis_small.gif" width="16" height="16" border="0"></a></div></td>
    <td><div align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><a href="<?php echo $editFormAction; ?>?case_i=20&edit=1&server_id=<?php echo $row_Recordset1['server_id']; ?>"   onClick="return cdelete(this)"><img src="../images/delete.gif" width="16" height="16" border="0"></a></font></div></td>
  </tr>
  <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
</table>
<p><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><br>
  </font></p>
<p><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> </font><br>
  
</p><br>
<form method="post" name="form1" action="<?php echo $editFormAction; ?>?case_i=20">
  <table width="619" align="center">
    <tr valign="baseline">
      <td align="right" nowrap bgcolor="#99FFCC"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">VLAN ID </font></strong></td>
      <td><font size="2" face="MS Sans Serif, Tahoma, sans-serif">
        <input name="server_name" type="text" id="server_name" value="" >
        </font></td>
    </tr>
    <tr valign="baseline"> 
<td align="right" nowrap bgcolor="#99FFCC"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">IP Address for Access point</font></strong></td>
      <td width="221"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
        <input name="ip" type="text" id="ip" value="" >
        </font></td>
    </tr>
    <tr valign="baseline"> 
      <td align="right" nowrap bgcolor="#99FFCC"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">Mac Address eth</font></strong></td>
      <td><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
        <input name="macaddress" type="text" id="macaddress" value="" >
        <strong><font color="#FF0000">*00-1F-29-C3-B2-3F</font></strong></font></td>
    </tr>
    <tr valign="baseline"> 
      <td align="right" nowrap bgcolor="#99FFCC"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;</font></td>
      <td><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
        <input type="submit" value="บันทึก" name="submit">
        </font></td>
    </tr>
  </table>
 
</form>
<?php
mysql_free_result($Recordset1);
function  server_macaddress($lan) { 
  exec('/sbin/ifconfig eth0 |/bin/grep  HWaddr', $output_ifconfig, $rval);
            $output_ifconfig2 = explode(" ",$output_ifconfig[0]) ;
             return $output_ifconfig2[10]; 
         }  
  /*
$mac_eth1=server_macaddress("eth1");
 $mac_eth1 = preg_match_replace(":","-",$mac_eth1);   	
  $mac_eth1= strtoupper($mac_eth1);
 $serv_name= $_SERVER["SERVER_NAME"];
 update("server"," macaddress='$mac_eth1'   "," where server_name='$serv_name'     "); 
*/
?>
<p>&nbsp;</p>
</body>
</html>

