<?php  //include("../include/chklogin.php");  
include("../Connections/dbconnect.php");
?>
<html>
<head>
<title>รายล่ะเอียดผู้ใช้งาน</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">

<body background="images/bg1.gif">
<?php
include("../include/function.php");
function UData($name,$connect_db) {
    mysql_query("SET character_set_results=tis620");
    mysql_query("SET character_set_client=tis620");
    mysql_query("SET character_set_connection=tis620");
    mysql_query("SET collation_connection = tis620_thai_ci");
    mysql_query("SET collation_database = tis620_thai_ci");
    mysql_query("SET  collation_server = tis620_thai_ci");
$query_Max = "SELECT  *  from radcheck  where   UserName ='$name'  and Attribute='Expiration'   ";
 $Recordset1_Max = mysql_query($query_Max, $connect_db) or die(mysql_error());
$row_Max = mysql_fetch_assoc($Recordset1_Max);
  
$times=$row_Max[Value];
print  "1=".$times."<br>";
$query_sum_t = "
SELECT  sum(card.date_end) as tcard
              FROM
                       table_card_user
                        INNER JOIN card ON (table_card_user.idcard = card.idcard)
                     where   card.UserName='$name'   
                                and  table_card_user.active='0'   ";
$user_time_end = mysql_query($query_sum_t, $connect_db) or die(mysql_error());
$row_tt_time= mysql_fetch_assoc($user_time_end);
### ดึงเวลาหมดอายุในระบบมาเพื่อ แจ้ง user
$date_dbs=$row_tt_time[tcard];
print "2=".$date_dbs."<br";
    #ทำการแยกวันที่ เวลา จากตัวแปร  $date_db มาเป็น array
			  $a_time= explode(" ",$times) ;
			  $a_time[0];  //วัน
			 $a_time[1];  //เดือน
			  $a_time[2];  //ปี
		  #แปลง เดือน เป็น ตัวเลข 
			 $a_time[1]=re_name($a_time[1]);
			 $date_db="$a_time[2]-$a_time[1]-$a_time[0]";
			 
$date_end_login=date('Y-m-d', mktime(0,0,0, $a_time[1],$a_time[0]+ $date_dbs,$a_time[2]));		
	 $a_time= explode("-",$date_end_login) ;
print 	"11111=".$date_end_login."<br>";
$dds1 ="  $a_time[2]/$a_time[1]/$a_time[0] (วัน/เดือน/ปี) ";
return  $dds1;
} 

mysql_select_db($database_db, $connect_db);

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
                                  register.email,
                                  register.site,
                                  register.pic_user,
                                  register.register_day,
                                  register.idstd
FROM
  register
  INNER JOIN usergroup ON (register.UserName = usergroup.UserName)
  INNER JOIN radgroupreply ON (usergroup.GroupName = radgroupreply.GroupName)
     where register.UserName='$id_edit' 
	and  radgroupreply.Attribute='WISPr-Bandwidth-Max-Down' ";
$user_db = mysql_query($query_user, $connect_db) or die(mysql_error());
$row_user = mysql_fetch_assoc($user_db);
$totalRows_user= mysql_num_rows($user_db);

				$query_mac = "SELECT  *   FROM   radcheck   where Attribute ='Calling-Station-Id'    and   UserName='$id_edit' ";
				$type_mac = mysql_query($query_mac, $connect_db) or die(mysql_error());
				$row_mac= mysql_fetch_assoc($type_mac);
 
?>
<form action="edit_user.php" method="post" enctype="multipart/form-data" name="form1" onSubmit="return ch_blank();">
  <table width="505" border="0" align="center">
    <tr bgcolor="#00AA00" > 
      <td colspan="2"><div align="center"><strong><font size="3" face="MS Sans Serif, Tahoma, sans-serif">รายละเอียด 
          ผู้ใช้งาน</font></strong></div></td>
    </tr>
    <tr > 
      <td width="40%" height="22" bgcolor="#59FF59"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">ชื่อ 
        Login</font></strong></td>
      <td width="60%" height="22" bgcolor="#CEFFCE"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
        &nbsp;&nbsp;&nbsp;<?php echo $row_user['UserName']?></font></td>
    </tr>
    <tr> 
      <td height="22" bgcolor="#59FF59"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
        ชื่อ-นามสกุล </font></strong></td>
      <td height="22" bgcolor="#CEFFCE"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;&nbsp;&nbsp;<?php echo $row_user['fullname'];?></font></td>
    </tr>
    <tr> 
      <td height="22" bgcolor="#59FF59"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>สมัครใช้งานวันที่</strong></font></td>
      <td height="22" bgcolor="#CEFFCE"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;&nbsp;&nbsp;<?php echo $row_user['register_day'];?></font></td>
    </tr>
    <tr> 
      <td height="22" bgcolor="#59FF59"><strong><font size="2"><font face="MS Sans Serif, Tahoma, sans-serif"><?php echo "$roomsDB"; ?></font></font></strong></td>
      <td height="22" bgcolor="#CEFFCE"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;&nbsp;&nbsp;<?php echo $row_user['room'];?></font></td>
    </tr>
    <tr> 
      <td height="22" bgcolor="#59FF59"><strong><font size="2"><font face="MS Sans Serif, Tahoma, sans-serif"><?php echo "$idstdDB"; ?></font></font></strong></td>
      <td height="22" bgcolor="#CEFFCE"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;&nbsp;&nbsp;<?php echo $row_user['idstd'];?></font></td>
    </tr>
    <tr> 
      <td height="22" bgcolor="#59FF59"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
        เบอร์ที่ติดต่อได้ </font></strong></td>
      <td height="22" bgcolor="#CEFFCE"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;&nbsp;&nbsp;<?php echo $row_user['tel'];?></font></td>
    </tr>
    <tr> 
      <td height="22" bgcolor="#59FF59"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
        E-mail </font></strong></td>
      <td height="22" bgcolor="#CEFFCE"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;&nbsp;&nbsp;<?php echo $row_user['email'];?></font></td>
    </tr>
    <tr> 
      <td height="22" bgcolor="#59FF59"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
        เลขประจำตัวประชาชน</font></strong></td>
      <td height="22" bgcolor="#CEFFCE"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;&nbsp;&nbsp;<?php echo $row_user['per'];?></font></td>
    </tr>
    <tr> 
      <td height="22" bgcolor="#59FF59"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><?php echo "$siteDB"; ?></font></strong></td>
      <td height="22" bgcolor="#CEFFCE"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;&nbsp;&nbsp;<?php echo $row_user['site'];?></font></td>
    </tr>
    <tr> 
      <td height="22" bgcolor="#59FF59"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">อยู่ในกลุ่ม</font></strong></td>
      <td height="22" bgcolor="#CEFFCE"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;&nbsp;&nbsp;<?php echo $row_user['GroupName'];?></font></td>
    </tr>
    <tr> 
      <td height="22" bgcolor="#59FF59"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">ความเร็วที่ได้รับ</font></strong></td>
      <td height="22" bgcolor="#CEFFCE"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;&nbsp; 
        <?php $quit_net=($row_user['banwith'])/1000;   echo  "$quit_net";?>
        &nbsp;K</font></td>
    </tr>
    <tr> 
      <td height="22" bgcolor="#59FF59"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>MAC 
        Address <br>
        ที่ต้องการ lock</strong></font></td>
      <td height="22" bgcolor="#CEFFCE">&nbsp;&nbsp;<font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
        <?php echo $row_mac['Value']?> </font></td>
    </tr>
    <tr> 
      <td height="22" bgcolor="#59FF59"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>รูปบัตรประชาชน</strong></font></td>
      <td height="22" bgcolor="#CEFFCE"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">
	      <? if($row_user['pic_user'] !='')  { ?> <a href="../<?php print $row_user['pic_user'];?>" target="_blank">คลิก</a> <?php  } else { print "ยังไม่มีข้อมูล"; }?>
		   </font></td>
    </tr>
    <tr>
      <td height="22" bgcolor="#59FF59"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>วันหมดอายุของบัตร</strong></font></td>
      <td height="22" bgcolor="#CEFFCE"><strong><font size="1" face="MS Sans Serif, Tahoma, sans-serif"> <br> <?php print "3=";  print UData($row_user[UserName],$connect_db); ?></font></strong></td>
    </tr>
    <tr>
      <td height="22" bgcolor="#59FF59"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>แสดงรายการใช้บัตรเติมเงิน</strong></font></td>
      <td height="22" bgcolor="#CEFFCE"><font size="1" face="MS Sans Serif, Tahoma, sans-serif">
      <a href="list_card_user_active.php?UserName=<?php print $row_user[UserName]; ?>" target="_blank">คลิก</a></font></td>
    </tr>
    <tr> 
      <td height="22" bgcolor="#59FF59"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp; 
        <input type="hidden" name="id_edit" value="<?php echo $row_user['UserName']?>" ?>
        </font></strong></td>
      <td height="22" bgcolor="#CEFFCE"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
        <input type="submit" name="Submit" value="แก้ไขข้อมูล">
        </font></td>
    </tr>
  </table>
</form>
<?php  
mysql_close($connect_db);
?>
<div align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">
<strong>#หากกำหนด   MAC Address user นี้จะได้เฉพาะ mac ที่กำหนดเท่านั้น#</strong></font> </div>
</body>
</html>
