<?php   
  include("../include/chklogin.php");    
 header("Content-Type: application/msword");    
 header("Content-Disposition: attachment; filename=คูปองเติมเงิน.doc") ;
 

 header("Pragma: no-cache");
 header("Expires: 0");
                include("../Connections/dbconnect.php");
				include("../include/function.php");
				mysql_select_db($database_db, $connect_db);
?>
<html>
<head>
<title>รายงานการ์ดที่ยังไม่มีการใช้งาน</title>
 


<body bgcolor="#FFFFFF" >

<div align="center">
  <p><font size="4" face="MS Sans Serif, Tahoma, sans-serif"><strong>คูปองเติมเงิน</strong> 
    </font></p>
  <p>&nbsp;</p>
</div>
 
 

<?php
     $Time_build = htmlspecialchars("$Time_build", ENT_QUOTES);
$query_user = "SELECT * FROM card    where      active='0'  and Time_build='$Time_build'  and domain='$domain_name' ";
$user_db = mysql_query($query_user, $connect_db) or die(mysql_error());
$totalRows_user= mysql_num_rows($user_db);
$start_card=$totalRows_user/3;
$start_card=round($start_card, 0);
 
$xxx=$totalRows_user+1000;
 
if($totalRows_user==0  or $totalRows_user==null) {
echo "ยังไม่มีข้อมูล หมายเลขการ์ดในระบบ ";
} else {

 $quids = "SELECT * FROM card    where      active='0'  and Time_build='$Time_build'  and domain='$domain_name'  order by No   ";
//print  $quids ;
 $user_card = mysql_query($quids, $connect_db) or die(mysql_error());
 $row_user254 = mysql_fetch_assoc($user_card);
 $ttc=0;
do{ 
 $pattern = '/@'.$domian_name.'/i';
$replacement = NULL;
$row_user254[GroupName]= preg_replace($pattern, $replacement, $row_user254[GroupName]);

 $idcard_p[$ttc] =$row_user254[idcard];
 $date_end_p[$ttc]=$row_user254[date_end];
 $type_time_p[$ttc]=$row_user254[type_time];
 $GroupName_p[$ttc]=$row_user254[GroupName];
  $ttc++;
 } while ($row_user254 = mysql_fetch_assoc($user_card));
$NUMLINE=1;
 ?> 
 <p style="text-indent:2px;"  >
<table width="720" border="0" align="center">
 <?php for ($i = 0; $i <=$xxx  ;) { 

 if($idcard_p[$i] !='') {
  ?>
  <tr>
    <td width="167" valign="top">
 
 
 
	<table width="150" height="80" border="1" align="left">
 
      <tr>
        <td width="162" valign="top"><font size="1" face="MS Sans Serif, Tahoma, sans-serif"><strong>CARD WIFi <br>
          หมายเลขบัตร &nbsp;<font color="#FF0000"><?php print  $idcard_p[$i]; ?></font>&nbsp;&nbsp;&nbsp;<br>
          <br>
          เวลาการใช้งาน <font color="#FF0000">
                        <?php if($type_time_p[$i]=="วัน")  {  print $date_end_p[$i];  }  
			          if($type_time_p[$i]=="ชั่วโมง") {  $g=($date_end_p[$i]/60)/60;   print $g;} 
					   if($type_time_p[$i]=="นาที") {  $g=($date_end_p[$i]/60);   print $g;}  ?>
            </font> &nbsp;&nbsp;<?php print $type_time_p[$i] ; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
          กลุ่มความเร็ว<font color="#FF0000"> <?php print   $GroupName_p[$i];?></font></strong></font></td>
      </tr>  
      </table>   	</td> <?php $i=$i+1; ?>
   
    <td width="171" valign="top">	 <?php // ช่องตาราง ที่ สอง ?>
	<?php  if($idcard_p[$i] !='') { ?>
	 
		<table width="150" height="80" border="1" align="left">
 
      <tr>
        <td width="216" valign="top"><font size="1" face="MS Sans Serif, Tahoma, sans-serif"><strong>CARD WIFi<br>
          หมายเลขบัตร &nbsp;<font color="#FF0000"><?php print  $idcard_p[$i]; ?></font>&nbsp;&nbsp;&nbsp;<br>
          <br>
          เวลาการใช้งาน <font color="#FF0000">
                        <?php if($type_time_p[$i]=="วัน")  {  print $date_end_p[$i];  }  
			          if($type_time_p[$i]=="ชั่วโมง") {  $g=($date_end_p[$i]/60)/60;   print $g;} 
					   if($type_time_p[$i]=="นาที") {  $g=($date_end_p[$i]/60);   print $g;}  ?>
            </font> &nbsp;&nbsp;<?php print $type_time_p[$i] ; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
          กลุ่มความเร็ว<font color="#FF0000"> <?php print   $GroupName_p[$i];?></font></strong></font></td>
      </tr>  
      </table>
    <?php } ?>	</td>
	<?php $i=$i+1; ?>
	
    <td width="173" valign="top"><?php // ช่องตาราง ที่ สอง ?>
	<?php  if($idcard_p[$i] !='') { ?>
	 
		<table width="150" height="80" border="1" align="left">
 
      <tr>
        <td width="216" valign="top"><font size="1" face="MS Sans Serif, Tahoma, sans-serif"><strong>CARD WIFi<br>
          หมายเลขบัตร &nbsp;<font color="#FF0000"><?php print  $idcard_p[$i]; ?></font>&nbsp;&nbsp;&nbsp;<br>
          <br>
          เวลาการใช้งาน <font color="#FF0000">
                        <?php if($type_time_p[$i]=="วัน")  {  print $date_end_p[$i];  }  
			          if($type_time_p[$i]=="ชั่วโมง") {  $g=($date_end_p[$i]/60)/60;   print $g;} 
					   if($type_time_p[$i]=="นาที") {  $g=($date_end_p[$i]/60);   print $g;}  ?>
            </font> &nbsp;&nbsp;<?php print $type_time_p[$i] ; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
          กลุ่มความเร็ว<font color="#FF0000"> <?php print   $GroupName_p[$i];?></font></strong></font></td>
      </tr>  
      </table>
    <?php } ?>	</td>
    <td width="315" valign="top">    <?php  $i=$i+1; // ช่อตาราง ที่ สาม ?>
	<?php  if($idcard_p[$i] !='') { ?>
	 
		<table width="150" height="80" border="1" align="left">
 
      <tr>
        <td width="216" valign="top"><font size="1" face="MS Sans Serif, Tahoma, sans-serif"><strong>CARD WIFi<br>
          หมายเลขบัตร &nbsp;<font color="#FF0000"><?php print  $idcard_p[$i]; ?></font>&nbsp;&nbsp;&nbsp;<br>
          <br>
          เวลาการใช้งาน <font color="#FF0000">
            <?php if($type_time_p[$i]=="วัน")  {  print $date_end_p[$i];  }  
			          if($type_time_p[$i]=="ชั่วโมง") {  $g=($date_end_p[$i]/60)/60;   print $g;} 
					   if($type_time_p[$i]=="นาที") {  $g=($date_end_p[$i]/60);   print $g;}  ?>
            </font> &nbsp;&nbsp;<?php print $type_time_p[$i] ; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
          กลุ่มความเร็ว<font color="#FF0000"> <?php print   $GroupName_p[$i];?></font></strong></font></td>
      </tr>  
      </table>
    <?php } ?>    </td>
  </tr> <? } // if  // ตารางใหญ่ ?>
  <?php $i++; } // Loop For ?>
</table>
<?php
if  ($NUMLINE==11);{
	print '<br><br><br><br>'; print '<br><br><br><br>';
	$NUMLINE=1;
	?>
	<table width="720" border="0" align="center" height="85">
	<tr><td></td></tr></table>
	<?
}
 
 } ?>
<br>

<? mysql_close($connect_db); ?>
</body>
</html>
