<table width="100%" border="0" align="center" cellpadding="1" cellspacing="1" class="imagetable">
    
    <tr bgcolor="#FFFF99"> 
      <td colspan="5"> <div align="center" class="style1 style2"><font size="3" face="MS Sans Serif, Tahoma, sans-serif"><strong>รายการปัญหาที่ยังไม่ได้รับการแก้ไข</strong></font></div></td>
    </tr>
    <tr bgcolor="#FFFF99"> 
      <td width="9%"> <div align="center" class="style3"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>ลำดับ</strong></font></div></td>
      <td width="47%" align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>ชื่อผู้แจ้ง</strong></font></td>
      <td width="33%" align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>Time 
        </strong></font></td>
      <td width="11%" align="center"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">ลบ</font></strong></td>
      <td width="11%" align="center"><div align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>บันทึกแก้ไขแล้ว</strong></font></div></td>
    </tr>
     
	<?php
$hostname_edoc = "192.168.10.100";
$database_edoc = "radius";
$username_edoc = "thaigqsoft";
$password_edoc = "tlogsystem";
$connect_db2= mysql_connect ($hostname_edoc, $username_edoc, $password_edoc);
if(!$connect_db2){
 echo 'ไม่สามารถเชือมต่อฐานข้อมูลได้ ';
 exit();
}
   mysql_query("SET character_set_results=tis620", $connect_db2) or die(mysql_error());
    mysql_query("SET character_set_client=tis620", $connect_db2) or die(mysql_error());
    mysql_query("SET character_set_connection=tis620", $connect_db2) or die(mysql_error());
    mysql_query("SET collation_connection = tis620_thai_ci", $connect_db2) or die(mysql_error());
    mysql_query("SET collation_database = tis620_thai_ci", $connect_db2) or die(mysql_error());
    mysql_query("SET  collation_server = tis620_thai_ci", $connect_db2) or die(mysql_error());
	 mysql_select_db($database_edoc, $connect_db2)  or trigger_error(mysql_error(),E_USER_ERROR);
	 
 
 $query_Recordset101PQ = "SELECT   *   FROM noute_data  where domain='$domain_name'   order by date_add desc   limit 0,10 ";
 $Recordset10QPR = mysql_query($query_Recordset101PQ, $connect_db2) or die(mysql_error());
 $row_RecordsetPR = mysql_fetch_assoc($Recordset10QPR);
$i=0;
 
 do { 
 	    ?>
    <tr bgcolor="<?php echo "$cli"; ?>" > 
      <td height="21" align="center"> <font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
        <?=($offset + $i);?>
        .</font></td>
      <td><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><a href=detail_problem.php?id=<? print $row_RecordsetPR[id];?> target="_blank"><? print $result_data[name];?></a></font></td>
      <td><div align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><? print  date_to_thai($row_RecordsetPR[time_q]);?></font></div></td>
        <td><div align="center"><a href="index.php?case_i=8&chk_delete=1&id=<? print $row_RecordsetPR[id];?>"><img src="../images/delete.gif" width="16" height="16" border="0"></a></div></td>
      <td><div align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><a href="clear_problem.php?id=<?echo $result_data[id] ;?>&delete=1" ><img src="../images/icon_infon.jpg" width="13" height="13" border="0"></a></font></div></td>
    </tr>
    <?
			$i++;
  } while ($row_RecordsetPR = mysql_fetch_assoc($Recordset10QPR));  ?>
 
  </table>