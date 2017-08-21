 <?php include("../include/chklogin.php"); 
 if($_SESSION["adminpass"]=='demo'){
      echo                  "<script type=text/javascript>";
		    echo                  "alert('ผู้ใช้ ทดสอบระบบ ไม่สามารถแก้ไขข้อมูลได้ :P ')";
	        echo                  "</script>";  
  echo "<meta http-equiv=refresh content=0;URL=index.php?case_i=16>";
 exit();
 
}
  ?>
<html>
<head>
<title>แก้ไขผู้ใช้งาน</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">

<body>

<?php

include("../Connections/dbconnect.php");
include("../include/function.php");
//$user_id=$_SESSION["id_user_login"];


mysql_select_db($database_db, $connect_db);
 
  $GroupName = htmlspecialchars("$GroupName", ENT_QUOTES);
  $pattern = '/;/i';
$replacement = NULL;
$GroupName= preg_replace($pattern, $replacement, $GroupName);

$query_user = "SELECT   *   FROM   radgroupreply  where Attribute='WISPr-Bandwidth-Max-Down' and   GroupName='$GroupName' ";
$user_db = mysql_query($query_user, $connect_db) or die(mysql_error());
$row_user = mysql_fetch_assoc($user_db);

 
if($Submit == "บันทึกข้อมูล"      ) {

  if($GroupName2s !=NULL){
    $GroupName2s = htmlspecialchars("$GroupName2s", ENT_QUOTES);
	  $pattern = '/;/i';
$replacement = NULL;
$GroupName2s= preg_replace($pattern, $replacement, $GroupName2s);
$query_Expirations = "delete FROM   radgroupreply       where Attribute='WISPr-Redirection-URL' and   GroupName='$GroupName' ";
mysql_query($query_Expirations, $connect_db) or die(mysql_error());
mysql_query("INSERT INTO  radgroupreply  (GroupName,Attribute,op,Value)
		      values('$GroupName', 'WISPr-Redirection-URL',':=','$GroupName2s'   )") or    die ("Add ข้อมูลลง Table ไม่ได้ ");		
			  }  
			   if($GroupName2s =='-'){
$query_Expirations = "delete FROM   radgroupreply       where Attribute='WISPr-Redirection-URL' and   GroupName='$GroupName' ";
mysql_query($query_Expirations, $connect_db) or die(mysql_error());
 	  }  
  $Value = htmlspecialchars("$Value", ENT_QUOTES);
  $Value2 = htmlspecialchars("$Value2", ENT_QUOTES);
  $timelogin = htmlspecialchars("$timelogin", ENT_QUOTES);
  	  $pattern = '/;/i';
$replacement = NULL;
$Value= preg_replace($pattern, $replacement, $Value);
$Value2= preg_replace($pattern, $replacement, $Value2);
$timelogin= preg_replace($pattern, $replacement, $timelogin);

update("radgroupreply","Value ='$Value'"," where GroupName='$GroupName'  and Attribute='WISPr-Bandwidth-Max-Down'      ");   
update("radgroupreply","Value ='$Value2'"," where GroupName='$GroupName'  and Attribute='WISPr-Bandwidth-Max-Up'      ");   
update("radgroupreply","Value ='$timelogin'"," where GroupName='$GroupName'  and Attribute='Session-Timeout'      ");   

			   if($Simultaneous <>''){
$query_Expirations = "update  radgroupcheck set  Value ='$Simultaneous'    where Attribute='Simultaneous-Use' and   GroupName='$GroupName' ";
mysql_query($query_Expirations, $connect_db) or die(mysql_error());
 	  }  
	  
 if($IdleTimeout<>'')
 {
	$Attribute="Idle-Timeout";			  
mysql_query("update radgroupreply  set 	Value='$IdleTimeout' 	  where Attribute='$Attribute' and   GroupName='$GroupName'   ") or    die ("Add ข้อมูลลง Table ไม่ได้ ");	
	
}			  
# หมดอายุใช้งาน  Expiration
if($Expiration=="1") {
$query_Expiration = "SELECT   *   FROM   radgroupcheck  where Attribute='Expiration' and   GroupName='$GroupName' ";
$user_Expiration= mysql_query($query_Expiration, $connect_db) or die(mysql_error());
$totalRows_Expiration= mysql_num_rows($user_Expiration);
$Attribute="Expiration";
$data_date="$endday $endmount $endyear $endhour:$endmin:00";
if($totalRows_Expiration =="0") {			 

mysql_query("INSERT INTO  radgroupcheck  (GroupName,Attribute,op,Value)
		      values('$GroupName', '$Attribute',':=','$data_date'   )") or    die ("Add ข้อมูลลง Table ไม่ได้ ");		 
		} //if($totalRows_Expiration ==0) {
		  else  {   update("radgroupcheck","Value ='$data_date'"," where GroupName='$GroupName'  and Attribute='Expiration'     "); 
		                 }	
		
		}
		

                                             echo                  "<script type=text/javascript>";
                                             echo                  "alert('บันทึกข้อมูลเสร็จสิ้น ')";
	                                         echo                  "</script>";
 echo "<meta http-equiv=refresh content=0;URL=index.php?case_i=16>";
								                exit();
 
  
}
else {

?>
<form action="index.php?case_i=17" method="post" enctype="multipart/form-data" name="form1" onSubmit="return ch_blank();">

  <table width="70%" height="276" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#FF8282">
    <tr > 
      <td width="54%" height="30" bgcolor="#FFCCCC"><div align="left"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">ชื่อ 
          กลุ่ม</font></strong></div></td>
      <td width="46%" height="30" bgcolor="#FFF2F2"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
        &nbsp; 
        <input name="GroupName" type="text" id="GroupName" value="<?php echo $row_user['GroupName'];?>"  readonly="yes">
        </font></td>
    </tr>
    <tr> 
      <td height="30" bgcolor="#FFCCCC"><div align="left"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
          ความเร็ว &nbsp;Download</font></strong></div></td>
      <td height="30" bgcolor="#FFF2F2"> <font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
        &nbsp; 
       <select name="Value">
	    <option value="101943040" selected>100M</option>
		 <option value="91943040" >90M</option>
		 <option value="81943040" >80M</option>
		 <option value="71943040" >70M</option>
		 <option value="61943040" >60M</option>
		 <option value="51943040" >50M</option>
		<option value="41943040" >40M</option>
		<option value="31457280"  >30M</option>
		<option value="15728640"  >15M</option>
		<option value="10485760"  >10M</option>
		<option value="9437184"  >9M</option>
		 <option value="8388608"  >8M</option>
		  <option value="7340032"  >7M</option>
          <option value="6291456"  >6M</option>
          <option value="5242880"  >5M</option>
          <option value="4194304"  >4.5M</option>
          <option value="4096000"  >4M</option>
          <option value="3670016">3.5M</option>
          <option value="3145728">3M</option>
          <option value="2516582">2.5M</option>
          <option value="2097152">2M</option>
          <option value="1572864">1.5M</option>
          <option value="1048576">1M</option>
          <option value="800000">800k</option>
          <option value="512000">512k</option>
          <option value="300000">300k</option>
          <option value="256000">256k</option>
          <option value="150000">150k</option>
          <option value="128000">128k</option>
          <option value="100000">100k</option>
          <option value="80000">80k</option>
          <option value="64000">64k</option>
          <option value="32000">32k</option>
          <option value="16000">16k</option>
          <option value="8000">8k</option>
        </select>
        </font></td>
    </tr>
    <tr> 
      <td height="30" bgcolor="#FFCCCC"><div align="left"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
          ความเร็ว&nbsp;Upload</font></strong></div></td>
      <td height="30" bgcolor="#FFF2F2"> <font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
        &nbsp; 
     <select name="Value2">
		<option value="41943040" selected>40M</option>
		<option value="31457280"  >30M</option>
		<option value="15728640"  >15M</option>
		<option value="10485760"  >10M</option>
		<option value="9437184"  >9M</option>
		 <option value="8388608"  >8M</option>
		  <option value="7340032"  >7M</option>
          <option value="6291456"  >6M</option>
          <option value="5242880"  >5M</option>
          <option value="4194304"  >4.5M</option>
          <option value="4096000"  >4M</option>
          <option value="3670016">3.5M</option>
          <option value="3145728">3M</option>
          <option value="2516582">2.5M</option>
          <option value="2097152">2M</option>
          <option value="1572864">1.5M</option>
          <option value="1048576">1M</option>
          <option value="800000">800k</option>
          <option value="512000">512k</option>
          <option value="300000">300k</option>
          <option value="256000">256k</option>
          <option value="150000">150k</option>
          <option value="128000">128k</option>
          <option value="100000">100k</option>
          <option value="80000">80k</option>
          <option value="64000">64k</option>
          <option value="32000">32k</option>
          <option value="16000">16k</option>
          <option value="8000">8k</option>
        </select>
        </font></td>
    </tr>
    <tr valign="baseline">
      <td align="right" nowrap bgcolor="#FFCCCC"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><span class="style5">ระยะเวลา Auto Logout เมื่อผู้ใช้งานไม่ได้ใช้งานอินเตอร์เน็ต:</span></font></strong></td>
      <td><font size="2" face="MS Sans Serif, Tahoma, sans-serif">
 
        <select name="IdleTimeout" id="IdleTimeout">
 <option value="600" selected>10 นาที</option>
		 <option value="1200" >20 นาที</option>
		<option value="1800"  >30 นาที</option>
		<option value="3600"  >60 นาที</option>
		<option value="3600"  >60 นาที</option>
			<option value="600000"  >ไม่จำกัด</option>
	    </select>
      </font></td>
    </tr>
    <tr valign="baseline"> 
      <td align="right" nowrap bgcolor="#FFCCCC"><div align="left"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>ระยะเวลาในการ 
          Login ต่อครั้ง</strong></font></div></td>
      <td bgcolor="#FFF2F2"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
        <select name="timelogin" id="timelogin">
      
          <?php  $x = 1;
       while ($x <= 24) {
	   $timel=$x*3600;
      echo "<option value=\"$timel\">$x  ชั่วโมง</option>";
      $x++;
   }
   ?>
        </select>
        </font></td>
    </tr>
	 <?php 
   $query_Expiration = "SELECT   *   FROM   radgroupcheck  where Attribute='Simultaneous-Use' and   GroupName='$GroupName' ";
$user_Expiration= mysql_query($query_Expiration, $connect_db) or die(mysql_error());
 $row_Recordset1ww = mysql_fetch_assoc($user_Expiration);
?>
     <tr bordercolor="#FF8282">
      <td height="30" bgcolor="#FFCCCC"><div align="left"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;<strong>สามารถใช้ไอดี Login เดียวพร้อมๆ กัน </strong></font></div></td>
      <td height="30" bgcolor="#FFF2F2"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">
        <input name="Simultaneous" type="text" id="Simultaneous"  size="5"  value="<?php print  $row_Recordset1ww[Value];?>">
		
       * เครื่อง </font></td>
    </tr>
    <tr valign="baseline"> 
      <td align="right" nowrap bgcolor="#FFCCCC"><div align="left"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">กำหนดเวลาหมดอายุการใช้งาน</font></strong></div></td>
      <td bgcolor="#FFF2F2"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
        <input name="Expiration" type="checkbox" id="Expiration" value="1">
        </font></td>
    </tr>
    <tr valign="baseline"> 
      <td align="right" nowrap bgcolor="#FFCCCC"><div align="left"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">วันหมดอายุการใช้งาน</font></strong></div></td>
      <td bgcolor="#FFF2F2"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
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
          <option value="2008" selected>2008</option>
          <option value="2009">2009</option>
          <option value="2010">2010</option>
          <option value="2011">2011</option>
          <option value="2012">2012</option>
          <option value="2013">2013</option>
          <option value="2014">2014</option>
          <option value="2015">2015</option>
          <option value="2016">2016</option>
          <option value="2017">2017</option>
        </select>
        </font></td>
    </tr>
    <tr valign="baseline"> 
      <td align="right" nowrap bgcolor="#FFCCCC"><div align="left"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;<strong>ชั่วโมงนาที</strong></font></div></td>
      <td bgcolor="#FFF2F2"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
        <select name="endhour" id="endhour">
          <?php
		 $xDay = 1; 
   while ($xDay <= 23) { 
   if($xDay >10) { $xDay="$xDay"; }
      echo " <option value=$xDay >$xDay</option>\r\n";
      $xDay++; 
   }
   ?>
        </select>
        <select name="endmin">
          <?php
		 $xDay = 1; 
   while ($xDay <= 59) { 
   if($xDay >10) { $xDay="$xDay"; }
      echo " <option value=$xDay >$xDay</option>\r\n";
      $xDay++; 
   }
   ?>
        </select>
        </font></td>
    </tr>
    <tr>
      <td height="30" bgcolor="#FFCCCC"><div align="left"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;<strong>URL ที่ให้เข้าหลัง login </strong></font></div></td>
 <?php 
   $query_Expiration = "SELECT   *   FROM   radgroupreply  where Attribute='WISPr-Redirection-URL' and   GroupName='$GroupName' ";
$user_Expiration= mysql_query($query_Expiration, $connect_db) or die(mysql_error());
 $row_Recordset1ww = mysql_fetch_assoc($user_Expiration);
?>
      <td height="30" bgcolor="#FFF2F2"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">
        <input name="GroupName2s" type="text" id="GroupName2s" value="<?php print $row_Recordset1ww[Value];?>"   >
        <br>
        * ใส่ http:// ด้วย    </font></td>
    </tr>
    <tr> 
      <td height="30" bgcolor="#FFCCCC"><div align="left"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;</font></div></td>
      <td height="30" bgcolor="#FFF2F2"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
        <input type="Submit" name="Submit" value="บันทึกข้อมูล">
        <input type="reset" name="Submit2" value="ยกเลิก">
        </font></td>
    </tr>
  </table>
</form>
<?php } 
mysql_close($connect_db);
?>
</body>
</html>
