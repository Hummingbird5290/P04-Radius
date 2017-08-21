<?php  include("../include/chklogin.php");  
include("../Connections/dbconnect.php");
?>
<html>
<head>
<title>รายล่ะเอียดผู้ใช้งาน</title>
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


include("../include/function.php");

function UDataCHK($name,$connect_db,$domain_name) {
 
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


$query_sum_t = "
SELECT 
sum(card.date_end) as tcard
FROM
  table_card_user
  INNER JOIN card ON (table_card_user.idcard = card.idcard)
  
  where   card.UserName='$name'   
                   and  table_card_user.active='0'   and table_card_user.domain='$domain_name'";
$user_time_end = mysql_query($query_sum_t, $connect_db) or die(mysql_error());
$row_tt_time= mysql_fetch_assoc($user_time_end);
### ดึงเวลาหมดอายุในระบบมาเพื่อ แจ้ง user
$date_dbs=$row_tt_time[tcard];
    #ทำการแยกวันที่ เวลา จากตัวแปร  $date_db มาเป็น array
			  $a_time= explode(" ",$times) ;
			  $a_time[0];  //วัน
			 $a_time[1];  //เดือน
			  $a_time[2];  //ปี
		  #แปลง เดือน เป็น ตัวเลข 
			 $a_time[1]=re_name($a_time[1]);
			 $date_db="$a_time[0]-$a_time[1]-$a_time[2]";

$dds1= explode("-",$date_db) ;
if($date_dbs=='') { $ttiomes='' ;} else {  
$ttiomes="<br>และที่เติมใหม่อีก  $date_dbs วัน ที่ยังไม่ใช้งาน";   }
$ftime=re_name4("$dds1[0]/$dds1[1]/$dds1[2]");
$dds2 ="   $ftime $ttiomes";
if($dds1[0]==''  and  $dds1[1]==''  and  $dds1[2]==''){
$dds2="ไม่มีรายการเติมบัตร";
}
return  $dds2;
}
  //ฟังชั่นคำนวนเวลา
//

function dateDiv($t1,$t2){ // ส่งวันที่ที่ต้องการเปรียบเทียบ ในรูปแบบ มาตรฐาน 2006-03-27 21:39:12

    $t1Arr=splitTime($t1);
    $t2Arr=splitTime($t2);
   
    $Time1=mktime($t1Arr["h"], $t1Arr["m"], $t1Arr["s"], $t1Arr["M"], $t1Arr["D"], $t1Arr["Y"]);
    $Time2=mktime($t2Arr["h"], $t2Arr["m"], $t2Arr["s"], $t2Arr["M"], $t2Arr["D"], $t2Arr["Y"]);
    $TimeDiv=abs($Time2-$Time1);

    $Time["D"]=intval($TimeDiv/86400); //  จำนวนวัน
    $Time["H"]=intval(($TimeDiv%86400)/3600); // จำนวน ชั่วโมง
    $Time["M"]=intval((($TimeDiv%86400)%3600)/60); // จำนวน นาที
    $Time["S"]=intval(((($TimeDiv%86400)%3600)%60)); // จำนวน วินาที
 return $Time;
}

 

function splitTime($time){ // เวลาในรูปแบบ มาตรฐาน 2006-03-27 21:39:12
 $timeArr["Y"]= substr($time,2,2);
 $timeArr["M"]= substr($time,5,2);
 $timeArr["D"]= substr($time,8,2);
 $timeArr["h"]= substr($time,11,2);
 $timeArr["m"]= substr($time,14,2);
    $timeArr["s"]= substr($time,17,2);
 return $timeArr;
}



##########ค้นหาวันเวลาหมดอายุของแอคเค้า
function utimes($UserName,$connect_db,$domain_name) {
 //ค้นหา เวลาหมดอายุ กรณี เป็นชั่วโมง
$chk_Max_All_Session=mysql_query("SELECT Value   FROM  radcheck     WHERE Attribute='Max-All-Session'  and UserName='$UserName' ", $connect_db) or die(mysql_error());
$row_All_Session= mysql_fetch_assoc($chk_Max_All_Session);
$totalMax_All_Session = mysql_num_rows($chk_Max_All_Session);
if($totalMax_All_Session >0){
 $year_gp= date("Y");  
 $query_user = "SELECT 
  TIMESTAMPDIFF ( SECOND ,  radacct.AcctStartTime ,radacct.AcctStopTime)   AS timeloginM
 FROM radacct
    where    UserName='$UserName'   	and 	YEAR(radacct.AcctStartTime)='$year_gp'    
	    ";  
$user_db = mysql_query($query_user, $connect_db) or die(mysql_error());
$row_user = mysql_fetch_assoc($user_db);
$ttttt=0;
do{
$ttttt=$row_user[timeloginM]+$ttttt;
 } while ($row_user = mysql_fetch_assoc($user_db)); 

#ชั่วโมงใช้งาน  ที่เหลือ
$dayta_times=$row_All_Session[Value]-$ttttt;
 
 
 if($dayta_times > 3600){
$dayta_times=$dayta_times/60;
$dayta_times=$dayta_times/60;
 $ustime="ชั่วโมง";
}else{
$dayta_times=$dayta_times/60;
 $ustime="นาที";
}
$dayta_times=round($dayta_times, 0);
 if( $dayta_times < 0 ) { $dayta_times =0; }
##################
$bat_time= "เหลือชั่วโมงใช้งาน  $dayta_times  $ustime "; 

} else

{
$bat_time= "หมดอายุวันที่   ".UDataCHK($UserName,$connect_db,$domain_name);
}
  return $bat_time;
  }
  
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
//print $date_dbs;
    #ทำการแยกวันที่ เวลา จากตัวแปร  $date_db มาเป็น array
			  $a_time= explode(" ",$times) ;
			  $a_time[0];  //วัน
			 $a_time[1];  //เดือน
			  $a_time[2];  //ปี
		  #แปลง เดือน เป็น ตัวเลข 
			 $a_time[1]=re_name($a_time[1]);
			 $date_db="$a_time[0]-$a_time[1]-$a_time[2]";

$dds1= explode("-",$date_db) ;
if($date_dbs=='') { $ttiomes='' ;} else {  $ttiomes="<br>และที่เติมใหม่อีก  $date_dbs วัน ที่ยังไม่ใช้งาน";   }
$dds2 ="  บัตรปัจจุบันที่ใช้อยู่  $dds1[0]/$dds1[1]/$dds1[2]  (วัน/เดือน/ปี)  $ttiomes";
return  $dds2;
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
   <?php if($row_user['UserName']!='') { ?>
<form action="edit_user.php" method="post" enctype="multipart/form-data" name="form1" onSubmit="return ch_blank();">
 
  <table width="440" border="0" align="center" class="imagetable">
    <tr bgcolor="#00AA00" > 
      <th colspan="2"><div align="center"><strong><font size="3" face="MS Sans Serif, Tahoma, sans-serif">รายละเอียด 
          ผู้ใช้งาน</font></strong></div></th>
    </tr>
    <tr > 
      <th width="40%" height="22" bgcolor="#59FF59"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">ชื่อ 
        Login</font></strong></th>
      <td width="60%" height="22" bgcolor="#CEFFCE"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
        &nbsp;&nbsp;&nbsp;<?php echo $row_user['UserName']?></font></td>
    </tr>
    <tr>
      <th height="22" bgcolor="#59FF59">รหัสผ่าน</th>
      <td height="22" bgcolor="#CEFFCE">
	  <? $udate_name=  $row_user['UserName'];
     $query_password = " SELECT    *, pass  as upass FROM  radpostauth   WHERE user = '$udate_name'     and reply='Access-Accept'   order by date DESC  limit 1  ";
	$Recordset1_password = mysql_query($query_password, $connect_db) or die(mysql_error());
	$row_password = mysql_fetch_assoc($Recordset1_password);
print	$row_password[upass];
	   ?></td>
    </tr>
    <tr> 
      <th height="22" bgcolor="#59FF59"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
        ชื่อ-นามสกุล </font></strong></th>
      <td height="22" bgcolor="#CEFFCE"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;&nbsp;&nbsp;<?php echo $row_user['fullname'];?></font></td>
    </tr>
    <tr> 
      <th height="22" bgcolor="#59FF59"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>สมัครใช้งานวันที่</strong></font></th>
      <td height="22" bgcolor="#CEFFCE"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;&nbsp;&nbsp;
	<?php   date_to_thai($row_user['register_day']);?></font></td>
    </tr>
    <tr> 
      <th height="22" bgcolor="#59FF59"><strong><font size="2"><font face="MS Sans Serif, Tahoma, sans-serif">เลขที่ห้องพัก / Number of rooms.</font></font></strong></th>
      <td height="22" bgcolor="#CEFFCE"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;&nbsp;&nbsp;<?php echo $row_user['room'];?></font></td>
    </tr>
    <tr> 
      <th height="22" bgcolor="#59FF59"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">รหัสนักศึกษา</font></strong></th>
      <td height="22" bgcolor="#CEFFCE"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;&nbsp;&nbsp;<?php echo $row_user['idstd'];?></font></td>
    </tr>
    <tr> 
      <th height="22" bgcolor="#59FF59"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
        เบอร์ที่ติดต่อได้ </font></strong></th>
      <td height="22" bgcolor="#CEFFCE"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;&nbsp;&nbsp;<?php echo $row_user['tel'];?></font></td>
    </tr>
    <tr> 
      <th height="22" bgcolor="#59FF59"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
        E-mail </font></strong></th>
      <td height="22" bgcolor="#CEFFCE"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;&nbsp;&nbsp;<?php echo $row_user['email'];?></font></td>
    </tr>
    <tr> 
      <th height="22" bgcolor="#59FF59"><strong><font size="2"><font face="MS Sans Serif, Tahoma, sans-serif">เลขประจำตัวประชาชน / Passport number</font></font></strong></th>
      <td height="22" bgcolor="#CEFFCE"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;&nbsp;&nbsp;<?php echo $row_user['per'];?></font></td>
    </tr>
    <tr> 
      <th height="22" bgcolor="#59FF59"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">หอพัก / Apartment Name / Site name</font></strong></th>
      <td height="22" bgcolor="#CEFFCE"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;&nbsp;&nbsp;<?php echo $row_user['site'];?></font></td>
    </tr>
    <tr> 
      <th height="22" bgcolor="#59FF59"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">อยู่ในกลุ่ม</font></strong></th>
      <td height="22" bgcolor="#CEFFCE"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;&nbsp;&nbsp;<?php echo $row_user['GroupName'];?></font></td>
    </tr>
    <tr> 
      <th height="22" bgcolor="#59FF59"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">ความเร็วที่ได้รับ</font></strong></th>
      <td height="22" bgcolor="#CEFFCE"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;&nbsp; 
        <?php $quit_net=($row_user['banwith'])/1000;   echo  "$quit_net";?>
        &nbsp;K</font></td>
    </tr>
    <tr> 
      <th height="22" bgcolor="#59FF59"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>MAC 
        Address <br>
        ที่ต้องการ lock</strong></font></th>
      <td height="22" bgcolor="#CEFFCE">&nbsp;&nbsp;<font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
        <?php echo $row_mac['Value']?> </font></td>
    </tr>
	<?php /*
    <tr> 
      <td height="22" bgcolor="#59FF59"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>รูปบัตรประชาชน</strong></font></td>
      <td height="22" bgcolor="#CEFFCE"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">
	      <? if($row_user['pic_user'] !='')  { ?> <a href="../<?php print $row_user['pic_user'];?>" target="_blank">คลิก</a> <?php  } else { print "ยังไม่มีข้อมูล"; }?>
		   </font></td>
    </tr>
	*/
	?>
    <tr>
      <th height="22" bgcolor="#59FF59"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>วันหมดอายุของบัตร</strong></font></th>
      <td height="22" bgcolor="#CEFFCE"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
	   <?php $unday=utimes($row_user[UserName],$connect_db,$domain_name);  print  $unday;   ?></font></strong></td>
    </tr>
    <tr>
      <th height="22" bgcolor="#59FF59"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>แสดงรายการใช้บัตรเติมเงิน</strong></font></th>
      <td height="22" bgcolor="#CEFFCE"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">
      <a href="list_card_user_active.php?UserName=<?php print $row_user[UserName]; ?>" target="_blank">คลิก</a></font></td>
    </tr>

    <tr> 
      <th height="22" bgcolor="#59FF59"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp; 
        <input type="hidden" name="id_edit" value="<?php echo $row_user['UserName']?>" ?>
        </font></strong></th>
      <td height="22" bgcolor="#CEFFCE"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
     <input type="submit" name="Submit" value="แก้ไขข้อมูล" class="styled-button-2"  >
        </font></td>
    </tr>
  </table> 
</form>

  <?php  
mysql_close($connect_db);
?>
  <?php } else { ?><div align="center">
  <input type="button" name="dr" value="User  Trial Test internet " class="styled-button-2"  >
  </div>
  <? } ?>

</body>
</html>
