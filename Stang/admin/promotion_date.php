 <?php
 
  include("../include/chklogin.php");   
  
   function re_name($mounts)
{
 
  if($mounts=='Jan') { $num_rows="ม.ค.";}
  if($mounts=='Feb') { $num_rows="ก.พ."; } 
  if($mounts=='Mar') { $num_rows="มี.ค."; } 
  if($mounts=='Apr') { $num_rows="เม.ย."; } 
  if($mounts=='May') { $num_rows="พ.ค."; } 
  if($mounts=='Jun') { $num_rows="มิ.ย."; } 
  if($mounts=='Jul') { $num_rows="ก.ค.";  } 
  if($mounts=='Aug') { $num_rows="ส.ค."; } 
  if($mounts=='Sep') { $num_rows="ก.ย."; } 
  if($mounts=='Oct') { $num_rows="ต.ค."; } 
  if($mounts=='Nov') { $num_rows="พ.ย.";} 
  if($mounts=='Dec') { $num_rows="ธ.ค.";} 
    return $num_rows;
}

  function date_to_thai($date_en)
{
     $date_thai_day = date('d',strtotime($date_en));
	 $date_thai_mont = date('m',strtotime($date_en));
	 $date_thai_year = date('Y',strtotime($date_en));
	 $date_thai_time = date('H:i',strtotime($date_en));
$date_thai_year =$date_thai_year +543;

if($date_thai_mont=="1"){ 	$date_thai_mont="ม.ค."; }
if($date_thai_mont=="2"){ 	$date_thai_mont="ก.พ."; }
if($date_thai_mont=="3"){ 	$date_thai_mont="มี.ค."; }
if($date_thai_mont=="4"){ 	$date_thai_mont="เม.ย."; }
if($date_thai_mont=="5"){ 	$date_thai_mont="พ.ค."; }
if($date_thai_mont=="6"){ 	$date_thai_mont="มิ.ย."; }
if($date_thai_mont=="7"){ 	$date_thai_mont="ก.ค."; }
if($date_thai_mont=="8"){ 	$date_thai_mont="ส.ค."; }
if($date_thai_mont=="9"){ 	$date_thai_mont="ก.ย."; }
if($date_thai_mont=="10"){ 	$date_thai_mont="ต.ค."; }
if($date_thai_mont=="11"){ 	$date_thai_mont="พ.ย."; }
if($date_thai_mont=="12"){ 	$date_thai_mont="ธ.ค."; }
	 
$time_thai=" $date_thai_day  $date_thai_mont  $date_thai_year เวลา  $date_thai_time นาที  ";
echo $time_thai;
}
  ?>
 <meta http-equiv="Content-Type" content="text/html; charset=windows-874">
 <?php
include("../Connections/dbconnect.php");


		
		
if($Expiration=="บันทึก") {			 
 if($_SESSION["adminpass"]=='demo'){
 
      echo                  "<script type=text/javascript>";
		    echo                  "alert('ผู้ใช้งาน ทดสอบระบบ ไม่สามารถ แก้ไขข้อมูลได้ ')";
	        echo                  "</script>";  
  echo "<meta http-equiv=refresh content=0;URL=index.php?case_i=2>";
 exit();
 
}
$Attribute="Expiration";
$data_date="$endday $endmount $endyear 23:50:00";
$a='CREATE TABLE IF NOT EXISTS `noute_data` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `texts` varchar(300) COLLATE tis620_bin DEFAULT NULL,
  `date_add` datetime DEFAULT NULL,
  `UserName` varchar(300) COLLATE tis620_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=tis620 COLLATE=tis620_bin AUTO_INCREMENT=1 ;';
@mysql_query("$a") ; 
$b=date("Y-m-d H:i:s");
$data_ads=$_SESSION[adminpass];

 $query_Recordset1 = "SELECT   *   FROM radcheck  where  UserName  = '$uedit'  and Attribute='Expiration'  ";
$Recordset1 = mysql_query($query_Recordset1, $connect_db) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$time_dateh=$row_Recordset1[Value];

$texts="ผู้ใช้งาน $uedit ถูก ปรับเวลาจาก $time_dateh เป็น   $data_date    ";


mysql_query("INSERT INTO  noute_data  (UserName,texts,date_add,admin,domain)
		      values('$uedit', '$texts','$b'  ,'$data_ads','$domain_name' )") or trigger_error(mysql_error(),E_USER_ERROR); 
			  
mysql_query("delete from  radcheck where  UserName='$uedit' and Attribute='Expiration' ") ; 
mysql_query("delete from  radcheck where  UserName='$uedit' and Attribute='Max-All-Session' ") ; 
			  
mysql_query("INSERT INTO  radcheck  (UserName,Attribute,op,Value)
		      values('$uedit', '$Attribute',':=','$data_date'   )") or trigger_error(mysql_error(),E_USER_ERROR); 

		
		      echo                  "<script type=text/javascript>";
		    echo                  "alert('บันทึกข้อมูลเสร็จสิ้นแล้ว ')";
	        echo                  "</script>";
           echo "<meta http-equiv=refresh content=0;URL=index.php?case_i=2>"; 
		   exit();
		}
		?>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
 <center>
 <b>
เปลียนวันหมดอายุของผู้ใช้งาน&nbsp;<?php print $uedit;?>
</b> เวลาหมดอายุในฐานข้อมูลปัจจุบัน &nbsp;
        <?   $query_user = "SELECT      *      FROM       radcheck   where UserName='$uedit'   and   Attribute = 'Expiration' ";
$user_db = mysql_query($query_user, $connect_db) or die(mysql_error());
$row_user = mysql_fetch_assoc($user_db);   ;  
 
    #ทำการแยกวันที่ เวลา จากตัวแปร  $date_db มาเป็น array
			  $a_time= explode(" ",$row_user[Value]) ;
			  $a_time[0];  //วัน
			 $a_time[1];  //เดือน
			  $a_time[2];  //ปี
			  $months= re_name($a_time[1]);
			  print   $a_time[0]."-".$months."-".$a_time[2]; 
			  ?>
<br>
</center>
<form method="post" name="form1" action="<?php echo $editFormAction; ?>?case_i=52">
<table align="center"  class="imagetable">
<th align="right" nowrap bgcolor="#99FFCC"><strong><font size="3" face="MS Sans Serif, Tahoma, sans-serif">วันหมดอายุการใช้งาน</font></strong></th>
      <td><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
        <select name="endday" id="endday">
          <option value="1" selected >1</option>
          <?php
		 $xDay = 2; 
   while ($xDay <= 31) { 
   if($xDay >10) { $xDay="$xDay"; }
      echo " <option value=$xDay >$xDay</option>\r\n";
      $xDay++; 
   }
   ?>
        </select>
        <select name="endmount" id="endmount">
          <option value="Jan" selected>มกราคม</option>
          <option value="Feb">กุมภาพันธ์</option>
          <option value="Mar">มีนาคม</option>
          <option value="Apr">เมษายน</option>
          <option value="May">พฤษภาคม</option>
          <option value="Jun">มิถุนายน</option>
          <option value="Jul">กรกฎาคม</option>
          <option value="Aug">สิงหาคม</option>
          <option value="Sep">กันยายน</option>
          <option value="Oct">ตุลาคม</option>
          <option value="Nov">พฤศจิกายน</option>
          <option value="Dec">ธันวาคม</option>
        </select>
        <select name="endyear" id="endyear">
          <option value="2013" selected>2013</option>
 
          <option value="2014">2014</option>
          <option value="2015">2015</option>
          <option value="2016">2016</option>
          <option value="2017">2017</option>
        </select>
        <input type="hidden" name="uedit" id="uedit" value="<?php print $uedit;?>" >
      </font></td>
 
 
  <td><font size="2" face="MS Sans Serif, Tahoma, sans-serif">
    <input type="submit" name="Expiration" value="บันทึก" id="Expiration"  class="styled-button-2"  >
  </font></td>
</table>
</form><br />
<table width="684" border="1" align="center"  class="imagetable">
  <tr>
    <th colspan="2"><div align="center"><strong><font size="3" face="MS Sans Serif">รายการการเพิ่มวันใช้งาน</font></strong></div></th>
  </tr>
  <tr>
    <th width="356"> <div align="center">วันที่บันทึกข้อมูล </div></th>
    <th width="318">  <div align="center">หมายเหตุ  </div></th>
  </tr>

    <?php 
  $query_Recordset1 = "SELECT   *   FROM noute_data  where UserName ='$uedit'  and domain='$domain_name' order by date_add desc  ";
$Recordset1 = mysql_query($query_Recordset1, $connect_db) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
 
if($row_Recordset1[date_add]!=NULL) {
  do { ?>
    <tr>
    <td>
      <div align="center">
        <?php     date_to_thai($row_Recordset1[date_add]);?>
        </div></td>
    <td><div align="left"><?php print $row_Recordset1[texts];?></div></td>
  </tr>
    <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1));  }?>
</table>

 
 
