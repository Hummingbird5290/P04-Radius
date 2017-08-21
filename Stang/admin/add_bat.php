  <?php include("../include/chklogin.php");     ?>
<link href="css/style.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="Carlendar/calendar.js"></script>
<link href="Carlendar/calendar-mos.css" rel="stylesheet" type="text/css">
<?php
include("../Connections/dbconnect.php");

include("../include/function.php");
 
function random_pasword($len){ 
 
 $ret_str=null;
for($gen_is=0; $gen_is <= $len; $gen_is++) { 
$ret_str.= mt_rand(0,$len); // ใช้ฟังชั่น rand() เข้ามาช่วยในการทำงาน 
} 
 
return $ret_str; 
} 

if($submit=="บันทึก"        ) {
if($uname=='demo'){
      echo                  "<script type=text/javascript>";
		    echo                  "alert('ผู้ใช้ ทดสอบระบบ ไม่สามารถเพิ่มข้อมูล :P ')";
	        echo                  "</script>";  
echo "<meta http-equiv=refresh content=0;URL=index.php?case_i=35>";
exit();
}

if($server_name==0 or $server_name==null){
		     echo                  "<script type=text/javascript>";
		    echo                  "alert('  จำนวนเวลา  ห้ามเป็น 0 ')";
	        echo                  "</script>"; 
						 echo "<meta http-equiv=refresh content=0;URL=index.php?case_i=35>"; 
}
 if($type_time=='ชั่วโมง')
 {
 $server_name=$server_name*60*60;
 }
  if($type_time=='นาที')
 {
 $server_name=$server_name*60;
 }
 for($x11=1; $x11 <= $numgid; $x11++) {     
 $idcard=random_pasword("10");
 $query_user1= "select  *  from card    where idcard='$idcard'  and domain='$domain_name'  ";
$type_db_user_gr = mysql_query($query_user1, $connect_db) or die(mysql_error());
$totalRows_user_group= mysql_num_rows($type_db_user_gr);
$build_time=date("Y-m-d"); 
if($totalRows_user_group =="0"  )  {  //  เช็คว่ามีใน db ป่าว  
               if($time_death=='') {  $time_death=date("Y")+2;  $time_death.="-01-01";  }
 $server_name = htmlspecialchars("$server_name", ENT_QUOTES);
// $type_time = htmlspecialchars("$type_time", ENT_QUOTES);
 $time_death = htmlspecialchars("$time_death", ENT_QUOTES);
 $cost = htmlspecialchars("$cost", ENT_QUOTES);
 $H_end = htmlspecialchars("$H_end", ENT_QUOTES);

$pattern = '/;/i';
$replacement = NULL;
$server_name= preg_replace($pattern, $replacement, $server_name);
$type_time= preg_replace($pattern, $replacement, $type_time);
$time_death= preg_replace($pattern, $replacement, $time_death);
$cost= preg_replace($pattern, $replacement, $cost);
$H_end= preg_replace($pattern, $replacement, $H_end);

						
mysql_query("INSERT INTO  card  (idcard,date_end,type_time,UserName,active,GroupName,time_death,cost,H_end,Time_build,domain)
		      values( '$idcard','$server_name','$type_time','0','0','$GroupName' ,'2020-07-31','$cost','$H_end','$build_time','$domian_name' )") or trigger_error(mysql_error(),E_USER_ERROR); 
 	  } // จบเช็คว่ามีใน db ป่าว  

  $x=$x+1; } // จบ iloop for			  
} // end  submit

if($edit=="1"   ) {
$tb="card";
   $server_id = htmlspecialchars("$server_id", ENT_QUOTES);
   $pattern = '/;/i';
$replacement = NULL;
$server_id= preg_replace($pattern, $replacement, $server_id);

$sql = "delete from $tb where idcard='$server_id'  and domain='$domain_name'   ";
 mysql_select_db($database_edoc); $dbquery =mysql_query($sql);

 

}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<style type="text/css">
<!--
.style1 {font-weight: bold}
-->
</style><head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">

 
</head>

<body class="style26">
<p align="left" class="style1 style2"><strong>จำนวนบัตรในระบบ ที่ยั้งไม่ได้ Acctive 
  </strong></p>
  
<table width="100%" border="1" align="center" cellpadding="0" cellspacing="0" class="imagetable">
  <tr bgcolor="#CCCCCC" class="style26"> 
    <th width="186" height="31" bgcolor="#66CCFF"><div align="center"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">ลำดับ</font></strong></div></th>
    <th width="607" bgcolor="#66CCFF"><div align="center"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">กรุ๊ป</font></strong></div></th>
    <th width="224" bgcolor="#66CCFF"><div align="center"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">จำนวน</font></strong></div></th>
  </tr>
  <?php 
  $query_Recordset1 = "SELECT   count(No)  As TCD, GroupName     FROM   card     where  active = '0'    and  domain='$domian_name'  group by  GroupName        ";
$Recordset1 = mysql_query($query_Recordset1, $connect_db) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
$num_i=0;
  do { 
 
 ?>
  <tr bgcolor="#FFFFFF" class="style26"> 
    <td height="23"><div align="right"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;<?php print  $num_i?>&nbsp;&nbsp;</font></div></td>
    <td><div align="left"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;<?php echo $row_Recordset1['GroupName']; ?>&nbsp;&nbsp;&nbsp;</font></div></td>
    <td><div align="right"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
        &nbsp;&nbsp; <?php echo $row_Recordset1['TCD']; ?> &nbsp;<strong>ใบ</strong>&nbsp;</font></div></td>
  </tr>
  <?php $num_i++; } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
</table>
<p>&nbsp;</p>
<p><strong>จำนวนบัตรในระบบ ที่ได้ Acctive </strong> </p>
<table width="100%" border="1" align="center" cellpadding="0" cellspacing="0" class="imagetable">
  <tr bgcolor="#CCCCCC" class="style26"> 
    <th width="186" height="31" bgcolor="#66CCFF"><div align="center"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">ลำดับ</font></strong></div></th>
    <th width="607" bgcolor="#66CCFF"><div align="center"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">กรุ๊ป</font></strong></div></th>
    <th width="224" bgcolor="#66CCFF"><div align="center"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">จำนวน</font></strong></div></th>
  </tr>
  <?php 
  $query_Recordset1 = "SELECT   count(No)  As TCD, GroupName     FROM   card     where  active = '1'    and domain='$domian_name'   group by  GroupName        ";
$Recordset1 = mysql_query($query_Recordset1, $connect_db) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
$num_i=0;
  do { 
 
 ?>
  <tr bgcolor="#FFFFFF" class="style26"> 
    <td height="23"><div align="right"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;<?php print  $num_i?>&nbsp;&nbsp;</font></div></td>
    <td><div align="left"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;<?php echo $row_Recordset1['GroupName']; ?>&nbsp;&nbsp;&nbsp;</font></div></td>
    <td><div align="right"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
        &nbsp;&nbsp; <?php echo $row_Recordset1['TCD']; ?> &nbsp;<strong>ใบ</strong>&nbsp;</font></div></td>
  </tr>
  <?php $num_i++; } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
</table>
<br>
<strong><br>
หมายเลขบัตร สิบหมายเลขล่าสุดที่ยั้งไม่ได้ Acctive </strong><br>
<table width="100%" border="1" align="center" cellpadding="0" cellspacing="0" class="imagetable">
  <tr bgcolor="#CCCCCC" class="style26"> 
    <th width="86" bgcolor="#66CCFF"><div align="center"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">ลำดับ</font></strong></div></th>
    <th width="192" bgcolor="#66CCFF"><div align="center"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">หมายเลขบัตร</font></strong></div></th>
    <th width="139" bgcolor="#66CCFF"><div align="center"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">จำนวน</font></strong></div></th>
    <th width="136" height="31" bgcolor="#66CCFF"><div align="center" class="style1 style2"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">ประเภท</font></strong></div></th>
    <th width="112" bgcolor="#66CCFF"><div align="center"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">ราคา</font></strong></div></th>
    <th width="215" bgcolor="#66CCFF"><div align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>วันที่สร้าง</strong></font></div></th>
    <th width="129" bgcolor="#66CCFF"><div align="center"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">ลบทิ้ง</font></strong></div></th>
  </tr>
  <?php 
  $query_Recordset1 = "SELECT   *   FROM   card     where  (active = '0'    or active = '' ) and domain='$domian_name'   order by No  DESC   limit 0,10  ";
$Recordset1 = mysql_query($query_Recordset1, $connect_db) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
$num_i=0;
  do { 
 
 ?>
  <tr bgcolor="#FFFFFF" class="style26"> 
    <td><div align="right"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;<?php echo $row_Recordset1['No']; ?>&nbsp;&nbsp;</font></div></td>
    <td><div align="right"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;<?php echo $row_Recordset1['idcard']; ?>&nbsp;&nbsp;&nbsp;</font></div></td>
    <td><div align="right"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
        &nbsp;&nbsp;
        <?php if($row_Recordset1[type_time]=="วัน")  {  print $row_Recordset1[date_end];  }  
		           if($row_Recordset1[type_time]=="ชั่วโมง")    {  $g=($row_Recordset1[date_end]/60)/60;   print $g;} 
				    if($row_Recordset1[type_time]=="นาที")    {  $g=($row_Recordset1[date_end]/60);   print $g;} ?>
        &nbsp;&nbsp;</font></div></td>
    <td height="23"><div align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><?php echo $row_Recordset1['type_time']; ?></font></div></td>
    <td><div align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><?php echo $row_Recordset1['cost']; ?></font></div></td>
    <td><div align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><?php date_to_thai($row_Recordset1['Time_build']);   ?></font></div></td>
    <td><div align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><a href="<?php echo $editFormAction; ?>?case_i=35&edit=1&server_id=<?php echo $row_Recordset1['idcard']; ?>" onClick="return cdelete(this)"><img src="dlete_xp_icon.png" width="35" height="35" border="0"></a></font></div></td>
  </tr>
  <?php $num_i++; } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
</table>
<p align="right"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong><a href="card_Active.php" target="_blank">หมายเลขบัตรที่ทำการ 
  Acctive แล้ว(แสดงรายงานเฉพาะเดือนปัจจุบัน)</a></strong></font></p>
<p align="right"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">
<a href="card_noActive.php" target="_blank">หมายเลขบัตรที่ยังไม่ได้ทำการ 
  Acctive </a></font></strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><br>
  <br>
  <strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">
   
   <form action="msword_idcard.php" method="post" enctype="multipart/form-data" name="form_card_to_Msword">
  พิมพ์ คูปองเติมเงิน    โปรดเลือกวันที่ ที่ท่านได้ทำการสร้างบัตร  <input name="Time_build" type="text" value="<?php print date("Y-m-d"); ?>"  id="Time_build" onClick="showCalendar('Time_build','YYYY-MM-DD')" size="20"   
              readonly="yes" > 
			  <input name="card_to_Msword"  id="card_to_Msword" type="submit" value="พิมพ์"   class="styled-button-2"  >
   </form>
   
   </font> </strong></p>
 
<form action="index.php?case_i=35" method="post" enctype="multipart/form-data" name="form2">
  <div align="left"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">ค้นหาหมายเลขบัตร</font></strong>&nbsp;&nbsp;&nbsp; 
    <input type="text" name="Finds">
    <input name="FindsBut" type="submit" id="Finds" value="ค้นหา"   class="styled-button-2"  >
  </div>
</form>
<br>
<form action="report_bat_acctive.php" method="post" enctype="multipart/form-data" name="form3">
  <div align="left"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">รายงานการใช้บัตรที่ใช้งานแล้ว</font></strong>&nbsp;&nbsp;&nbsp; 
   <input name="dstart" type="text" value=""  id="dstart" onClick="showCalendar('dstart','YYYY-MM-DD')" size="20"   readonly="yes" >
    <font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>ถึง</strong></font> 
   <input name="dstop" type="text" value=""  id="dstop" onClick="showCalendar('dstop','YYYY-MM-DD')" size="20"   readonly="yes" >
    <input name="FindsBut" type="submit" id="Finds" value="รายงาน"   class="styled-button-2"  >
  </div>
</form>
<br>
 
 
<?php
if($Finds  !=null){
?>
<table width="100%" border="1" align="center" cellpadding="0" cellspacing="0" class="imagetable">
  <tr bgcolor="#CCCCCC" class="style26"> 
    <th width="86" bgcolor="#66CCFF"><div align="center"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">ลำดับ</font></strong></div></th>
    <th width="191" bgcolor="#66CCFF"><div align="center"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">หมายเลขบัตร</font></strong></div></th>
    <th width="135" bgcolor="#66CCFF"><div align="center"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">จำนวน</font></strong></div></th>
    <th width="147" height="31" bgcolor="#66CCFF"><div align="center" class="style1 style2"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">ประเภท</font></strong></div></th>
    <th width="102" bgcolor="#66CCFF"><div align="center"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">ราคา</font></strong></div></th>
    <th width="219" bgcolor="#66CCFF"><div align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>วันที่สร้าง</strong></font></div></th>
    <th width="129" bgcolor="#66CCFF"><div align="center"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">ลบทิ้ง</font></strong></div></th>
  </tr>
  <?php 
    $Finds = htmlspecialchars("$Finds", ENT_QUOTES);
$pattern = '/;/i';
$replacement = NULL;
$Finds= preg_replace($pattern, $replacement, $Finds);

 $query_Recordset1 = "SELECT   *   FROM   card     where idcard='$Finds'  and domain='$domian_name' ";
$Recordset1 = mysql_query($query_Recordset1, $connect_db) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
$num_i=0;
  do { 
 
 ?>
  <tr bgcolor="#FFFFFF" class="style26"> 
    <td><div align="right"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;<?php echo $row_Recordset1['No']; ?>&nbsp;&nbsp;</font></div></td>
    <td><div align="right"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;<?php echo $row_Recordset1['idcard']; ?>&nbsp;&nbsp;&nbsp;</font></div></td>
    <td><div align="right"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
        &nbsp;&nbsp;
        <?php if($row_Recordset1[type_time]=="วัน")  {  print $row_Recordset1[date_end];  }  
		             if($row_Recordset1[type_time]=="ชั่วโมง") {  $g=($row_Recordset1[date_end]/60)/60;   print $g;}
					  if($row_Recordset1[type_time]=="นาที") {  $g=($row_Recordset1[date_end]/60);   print $g;}
																				   ?>
        &nbsp;&nbsp;</font></div></td>
    <td height="23"><div align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><?php echo $row_Recordset1['type_time']; ?></font></div></td>
    <td><div align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><?php echo $row_Recordset1['cost']; ?></font></div></td>
    <td><div align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><?php date_to_thai($row_Recordset1['Time_build']);   ?></font></div></td>
    <td><div align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><a href="<?php echo $editFormAction; ?>?case_i=35&edit=1&server_id=<?php echo $row_Recordset1['idcard']; ?>" onClick="return cdelete(this)"><img src="dlete_xp_icon.png" width="35" height="35" border="0"></a></font></div></td>
  </tr>
  <?php $num_i++; } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
</table>
<?
}
?>
<br><br><br><br>
<form method="post" name="form1" action="<?php echo $editFormAction; ?>?case_i=35">
  <table width="752" align="center" class="imagetable">
    <tr valign="baseline"> 
      <th align="right" nowrap bgcolor="#99FFCC"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">จำนวนบัตร::</font></strong></th>
      <td><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
        <input name="numgid" type="text" id="numgid" value="" size="10" >
        <strong><font color="#FF0000"> ใบ ใส่ตัวเลข ไม่มี ,</font></strong></font></td>
    </tr>
    <tr valign="baseline"> 
      <th align="right" nowrap bgcolor="#99FFCC"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">จำนวนเวลา::</font></strong></th>
      <td><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
        <input name="server_name" type="text" id="server_name" value="" size="10" >
        <strong><font color="#FF0000"> 
		<select name="type_time" id="type_time">
    <option value="ชั่วโมง" selected>ชั่วโมง</option> 
      <option value="วัน">วัน</option>
        </select> ใส่ตัวเลข ไม่มี ,</font></strong></font></td>
    </tr>
    <!--     <tr valign="baseline"> 
      <td width="241" align="right" nowrap bgcolor="#99FFCC"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><span class="style5">ประเภท::</span></font></strong></td>
      <td width="221"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
         <select name="type_time">
          <option value="ชั่วโมง" selected>ชั่วโมง</option>
          <option value="วัน">วัน</option>
        </select 
		
        </font></td>
    </tr> -->
	<?php /*
    <tr valign="baseline"> 
      <td align="right" nowrap bgcolor="#99FFCC"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>ประเภทเวลา</strong></font></td>
      <td>
      <select name="type_time" id="type_time">
      <option value="ชั่วโมง" selected>ชั่วโมง</option>
          <option value="นาที">นาที</option>
          <option value="วัน">วัน</option>
        </select></td>
    </tr>
	
    <tr valign="baseline">
      <td align="right" nowrap bgcolor="#99FFCC"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>จำนวนวันที่เล่นได้หลัง 
        login</strong></font></td>
      <td>
	 
	  <input name="H_end" type="text" id="H_end" size="15">
        <font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>หากกำหนดเป็นวันไม่ต้องเลือก</strong></font></td>
    </tr>
	*/?>
  <!--  <tr valign="baseline"> 
      <th align="right" nowrap bgcolor="#99FFCC"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">เวลาที่บัตรหมดอายุ</font></strong></th>
      <td><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
	   
        <input name="time_death" type="text" value=""  id="time_death" onClick="showCalendar('time_death','YYYY-MM-DD')" size="20"   readonly="yes" >
        <strong>วันหมดอายุของบัตรที่ไม่สามารถเอาหมายเลขมาใช้ได้</strong>
      </font></td>
    </tr>-->
    <tr valign="baseline"> 
      <th align="right" nowrap bgcolor="#99FFCC"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">ราคาบัตร</font></strong></th>
      <td><input name="cost" type="text" id="cost" size="20"> <strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">บาท 
        ห้ามใส่ , และ .</font></strong></td>
    </tr>
    <tr valign="baseline"> 
      <th align="right" nowrap bgcolor="#99FFCC"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">กลุ่มผู้ใช้</font></strong></th>
      <td><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
        <?php
	            $query_type = "SELECT *   FROM   radgroupreply   where  GroupName <> 'ลบทิ้ง'    and GroupName like '%@$domian_name'   group by GroupName order by  GroupName  DESC      ";
				$type_db = mysql_query($query_type, $connect_db) or die(mysql_error());
				$row_type = mysql_fetch_assoc($type_db);
				$totalRows_type= mysql_num_rows($type_db);
				

	  ?>
        <select name="GroupName" id="GroupName"      >
          <?php
												do {  
														  ?>
          <option value="<?php echo $row_type['GroupName']?>" ><?php echo $row_type['GroupName']?></option>
          <?php
								} while ($row_type = mysql_fetch_assoc($type_db));
								?>
        </select>
        </font></td>
    </tr>
	  
    <tr valign="baseline"> 
      <th align="right" nowrap bgcolor="#99FFCC"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;</font></strong></th>
      <td><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
        <input type="submit" value="บันทึก" name="submit"   class="styled-button-2"  >
        </font></td>
    </tr>
  </table>
 
</form>
<?php
mysql_free_result($Recordset1);
function  server_macaddress($lan) { 
  exec('/sbin/ifconfig eth1 |/bin/grep  HWaddr', $output_ifconfig, $rval);
            $output_ifconfig2 = explode(" ",$output_ifconfig[0]) ;
             return $output_ifconfig2[10]; 
         }  
  
  $mac_eth1=server_macaddress("eth1");
 
   update("server"," macaddress='$mac_eth1'   "," where ip='10.0.0.1'     ");   
  
  
?>

<p>&nbsp;</p>
</body>
</html>

