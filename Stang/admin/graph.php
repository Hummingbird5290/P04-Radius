  <?php include("../include/chklogin.php");   ?>
  <center>
  <iframe src ="open-flash-chart/flash-chart.php" width="500" height="600" > </iframe>
  </center>
<?php
include("../Connections/dbconnect.php");
$HOUR_ends=date("H");
$MINU_ends=date("i");
if($checkbox==1 and  $endhour !=''  and  $endmin !='' ) {  
 $time_HOUR="and  HOUR(radacct.AcctStartTime)   BETWEEN         '$endhour'  and  '$HOUR_ends' 
                              and    MINUTE(radacct.AcctStartTime)  BETWEEN     '$endmin'  and  '$MINU_ends'   "; 
							   } else {  $time_HOUR ='';}
function UData($name,$connect_db) {
 
     mysql_query("SET character_set_results=tis620");
    mysql_query("SET character_set_client=tis620");
    mysql_query("SET character_set_connection=tis620");
    mysql_query("SET collation_connection = tis620_thai_ci");
    mysql_query("SET collation_database = tis620_thai_ci");
    mysql_query("SET  collation_server = tis620_thai_ci");
$query_Max = "SELECT  *  from register  where   UserName='$name'     ";
 $Recordset1_Max = mysql_query($query_Max, $connect_db) or die(mysql_error());
$row_Max = mysql_fetch_assoc($Recordset1_Max);
return  $row_Max[site];
}

function UData_room($name,$connect_db) {
 
     mysql_query("SET character_set_results=tis620");
    mysql_query("SET character_set_client=tis620");
    mysql_query("SET character_set_connection=tis620");
    mysql_query("SET collation_connection = tis620_thai_ci");
    mysql_query("SET collation_database = tis620_thai_ci");
    mysql_query("SET  collation_server = tis620_thai_ci");
$query_Max = "SELECT  *  from register  where   UserName='$name'     ";
 $Recordset1_Max = mysql_query($query_Max, $connect_db) or die(mysql_error());
$row_Max = mysql_fetch_assoc($Recordset1_Max);
return  $row_Max[room];
}
$todays = date("d  F  Y");
if($dayData !="ทั้งหมด"  and   $dayData  !=null )  {
$conL="DAY(radacct.AcctStartTime) = '$dayData'   AND  ";}  else {  $conL=""; }
/*
if($dayData  ==null   )  {
$dayData= date("d");
$conL="DAY(radacct.AcctStartTime) = '$dayData'   AND  ";}
*/

if($mount=="1"){ 	$date_thai_mont="ม.ค."; }
if($mount=="2"){ 	$date_thai_mont="ก.พ."; }
if($mount=="3"){ 	$date_thai_mont="มี.ค."; }
if($mount=="4"){ 	$date_thai_mont="เม.ย."; }
if($mount=="5"){ 	$date_thai_mont="พ.ค."; }
if($mount=="6"){ 	$date_thai_mont="มิ.ย."; }
if($mount=="7"){ 	$date_thai_mont="ก.ค."; }
if($mount=="8"){ 	$date_thai_mont="ส.ค."; }
if($mount=="9"){ 	$date_thai_mont="ก.ย."; }
if($mount=="10"){ 	$date_thai_mont="ต.ค."; }
if($mount=="11"){ 	$date_thai_mont="พ.ย."; }
if($mount=="12"){ 	$date_thai_mont="ธ.ค."; }


  
function ConvertSize($bytes) 
    {
    $size = $bytes / 1024;
 
    if($size < 1024)
        {
        $size = number_format($size, 2);
 
       $size .= ' KB';
        } 
    else 
        {
        if($size / 1024 < 1024) 
            {
            $size = number_format($size / 1024, 2);
 
          $size .= ' MB';
            } 
        else if ($size / 1024 / 1024 < 1024)  
            {
            $size = number_format($size / 1024 / 1024, 2);
 
           $size .= ' GB';
            } 
        }
		 
    return $size;
    } 


?>
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
</head>

<body>
<p><strong></strong></p>
              <FORM action="index.php?case_i=23" method="post"  name="frm_graph">
  <font size="3" face="MS Sans Serif, Tahoma, sans-serif"><strong>เลือกวันรายงาน </strong></font><br>
                
  <TABLE width="100%" border=0 cellPadding=2 cellSpacing=0>
    <!--DWLayoutTable-->
    <TBODY>
      <TR align=middle vAlign=center> 
        <TD width="168" valign="top"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">วันที่</font></TD>
        <TD width="146" valign="top"><div align="left"> <font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
            <select name="dayData">
              <option value=ทั้งหมด selected>โปรดเลือก</option>
              <?php
		 $xDay = 1; 
   while ($xDay <= 31) { 
   if($xDay >10) { $xDay="$xDay"; }
      echo " <option value=$xDay >$xDay</option>\r\n";
      $xDay++; 
   }
   ?>
            </select>
            </font></div></TD>
        <TD width="116" height="29" valign="top"> <div align="left"> <font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
            <select name="mount">
              <option value="01" selected>มกราคม</option>
              <option value="02"  >กุมภาพันธ์</option>
              <option value="03"  >มีนาคม</option>
              <option value="04"  >เมษายน </option>
              <option value="05"  >พฤษภาคม</option>
              <option value="06"  >มิถุนายน</option>
              <option value= "07"  >กรกฏาคม</option>
              <option value= "08"  >สิงหาคม</option>
              <option value="09"  >กันยายน</option>
              <option value="10"  >ตุลาคม</option>
              <option value="11"  >พฤศจิกายน</option>
              <option value="12"  >ธันวาคม</option>
            </select>
            </font></div></TD>
        <TD width="144"> <div align="left"> <font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
            <select name="year_gp">
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
            </font></div></TD>
        <TD width="431" valign="top"> <div align="left"> </div></TD>
      </TR>
      <TR align=middle vAlign=center>
        <TD valign="middle"><div align="right">
            <input type="checkbox" name="checkbox" value="1">
          </div></TD>
        <TD valign="top"> <font size="2" face="MS Sans Serif, Tahoma, sans-serif">กำหนดเวลาเริ่มต้น</font></TD>
        <TD height="29" valign="top"><!--DWLayoutEmptyCell-->&nbsp;</TD>
        <TD valign="top"><!--DWLayoutEmptyCell-->&nbsp;</TD>
        <TD valign="top"><!--DWLayoutEmptyCell-->&nbsp;</TD>
      </TR>
      <TR align=middle vAlign=center> 
        <TD valign="top"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">เวลาเริ่มต้น</font></TD>
        <TD valign="top"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
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
          </font></TD>
        <TD height="29" valign="top"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
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
          </font></TD>
        <TD><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;
          <input name="graph" type="submit" id="graph2" value="ดูกราฟ">
          </font></TD>
        <TD valign="top"><!--DWLayoutEmptyCell-->&nbsp;</TD>
      </TR>
    </TBODY>
  </TABLE>
              </FORM>

<table width="85%" border="0">
  <tr bgcolor="#FFFF99"> 
    <td colspan="5"><div align="center"><strong><font size="3" face="MS Sans Serif, Tahoma, sans-serif">รายงานสรุป 
        TOP 20 Upload <br>
        <?php   if($mount !=null  and  $year_gp !=null   and  $dayData !="ทั้งหมด" )   
		           {echo "วันที่  $dayData    $date_thai_mont  ปี  $year_gp ";  $d="วันที่  $dayData    $date_thai_mont  ปี  $year_gp "; 
		                    } else   {  echo"ประจำเดือน  $mount  ";
	                                             	$d="ประจำเดือน  $mount  ";   }  ?>
													<?php if($checkbox ==1) {   print "<br>ระหว่าง เวลา  $endhour : $endmin นาที ถึง เวลาปัจจุบัน";  }?>
        </font></strong></div></td>
  </tr>
  <tr bgcolor="#FFFF99"> 
    <td width="17%"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">ชื่อผู้ใช้งาน</font></strong></td>
    <td width="17%"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong><?php echo "$siteDB"; ?></strong></font></td>
    <td width="17%"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong><?php echo "$roomsDB"; ?>&nbsp;</strong></font></td>
    <td width="45%"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">จำนวนการ 
      UPload</font></strong></td>
    <td width="5%"><div align="center"><strong><font size="1" face="Microsoft Sans Serif">Graph</font></strong></div></td>
  </tr>
  <?php 
  if($mount !=null  and  $year_gp !=null   ) 
             { $mdate_DAY="$year_gp-$mount";
			 } else 
			 { $year_gp = date("Y");
			   $mount=date("m");
			 }
			 
$query_Max = "SELECT 
max(radacct.AcctInputOctets)  As Max_sata
         FROM
              radacct  
                      where 
                      $conL
					   MONTH(radacct.AcctStartTime)='$mount'  and
					    YEAR(radacct.AcctStartTime)='$year_gp'   
						  $time_HOUR         ";
						
$Recordset1_Max = mysql_query($query_Max, $connect_db) or die(mysql_error());
$row_Max = mysql_fetch_assoc($Recordset1_Max);
 $totalRows_Max = mysql_num_rows($Recordset1_Max);

$datamax=$row_Max['Max_sata']; 
 if($datamax ==0  or $datamax==null) {
 echo "<script type=text/javascript>";
echo "alert('ไม่มีในฐานข้อมูล')";
 echo "</script>";
echo  "<meta http-equiv=refresh content=0;URL=index.php >";
print "$query_Max";
//exit();
 }


//$lang=strlen($datamax);
 

 

 $query_Recordset1 = "SELECT 
 
  radacct.UserName,
 
  radacct.AcctStartTime,
  sum(radacct.AcctInputOctets) AS data_download
FROM
  radacct
  
WHERE
$conL
  MONTH(radacct.AcctStartTime) = '$mount' AND 
  YEAR(radacct.AcctStartTime) = '$year_gp'
  and   radacct.UserName in (select UserName from    radcheck )
  $time_HOUR  
 group by 
  radacct.UserName
ORDER BY
  sum(radacct.AcctInputOctets) DESC
LIMIT 20 ";
													
$Recordset1 = mysql_query($query_Recordset1, $connect_db) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);


 
  do {  
 $uname=$row_Recordset1['UserName'];
  $query_Recordset2 = "SELECT 
                                                            sum(radacct.AcctInputOctets) AS data_download
                                                               FROM    radacct
                                               WHERE
                                                             $conL
                                                           MONTH(radacct.AcctStartTime) = '$mount' AND 
                                                          YEAR(radacct.AcctStartTime) = '$year_gp'    and 
                                                             radacct.UserName='$uname' 
															 $time_HOUR    ";
													
$Recordset2 = mysql_query($query_Recordset2, $connect_db) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
 
  $data=$row_Recordset2['data_download'];
  
//$percent = number_format(($data/$totalRows_Recordset1)*100,2,'.',',');
 
  $percent=$data*100/$datamax;
  $percent= $percent;
 
 if($percent > 200){ $percent=$percent-200; }
 
 ?>
  <tr> 
    <td bgcolor="#99FFFF"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
      <a href="#search" onClick="newwindow=window.open('detail_user.php?id_edit=<? print $row_Recordset1[UserName];?>','detail_user','height=400,width=500,left=10,top=100,scrollbars=1');newwindow.focus();"> 
      <?php echo $row_Recordset1['UserName'];     ?></a></font></td>
    <td bgcolor="#99FFFF"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><?php echo UData($row_Recordset1['UserName'],$connect_db);     ?></font></td>
    <td bgcolor="#FFCCFF"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><?php echo UData_room($row_Recordset1['UserName'],$connect_db);     ?></font></td>
    <td bgcolor="#FFCCFF"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
      <img src=image/ajax_progress2.gif width="<?php echo "$percent"; ?>"  height=14 > 
      <?php echo ConvertSize($data);?></font></td>
    <td bgcolor="#FFCCFF"><div align="center"><font size="2" face="Microsoft Sans Serif"><a href="open-flash-chart/flash-chart-detail-of-month.php?Sname=<?php print $row_Recordset1['UserName']; ?>" target="_blank"><img src="pic/graph.jpg" alt="ดูรายงานแบบกราฟรายวัน" width="25" height="20" border="0"></a></font></div></td>
  </tr>
  <tr> 
    <?php 

	} while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
    <td bgcolor="#99FFFF"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;</font></td>
    <td bgcolor="#99FFFF"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;</font></td>
    <td bgcolor="#FFCCFF"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;</font></td>
    <td bgcolor="#FFCCFF"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;</font></td>
    <td bgcolor="#FFCCFF">&nbsp;</td>
  </tr>
</table>
<br>
<?php #################################################################### ?>
<table width="85%" border="0">
  <tr bgcolor="#FFFF99"> 
    <td colspan="5"><div align="center"><strong><font size="3" face="MS Sans Serif, Tahoma, sans-serif">รายงานสรุป 
        TOP 20 Download<br>
        <?php echo "$d"; ?>
		 <?php if($checkbox ==1) {   print "<br>ระหว่าง เวลา  $endhour : $endmin นาที ถึง เวลาปัจจุบัน"; }?></font></strong></div></td>
  </tr>
  <tr bgcolor="#FFFF99"> 
    <td width="21%"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">ชื่อผู้ใช้งาน</font></strong></td>
    <td width="18%"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong><?php echo "$siteDB"; ?></strong></font></td>
    <td width="20%"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong><?php echo "$roomsDB"; ?>&nbsp;</strong></font></td>
    <td width="34%"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">จำนวนการ 
      Download</font></strong></td>
    <td width="7%"><strong><font size="1" face="Microsoft Sans Serif">Graph</font></strong></td>
  </tr>
  <?php 
  if($mount !=null  and  $year_gp !=null   ) 
             { $mdate_DAY="$year_gp-$mount";
			 } else 
			 { $year_gp = date("Y");
			   $mount=date("m");
			 }
			 
$query_Max = "SELECT 
max(radacct.AcctOutputOctets)  As Max_sata
         FROM
              radacct  
                      where 
                      $conL
					   MONTH(radacct.AcctStartTime)='$mount'  and
					    YEAR(radacct.AcctStartTime)='$year_gp'    
						  $time_HOUR     ";
						
$Recordset1_Max = mysql_query($query_Max, $connect_db) or die(mysql_error());
$row_Max = mysql_fetch_assoc($Recordset1_Max);
 $totalRows_Max = mysql_num_rows($Recordset1_Max);

$datamax=$row_Max['Max_sata']; 
 if($datamax ==0  or $datamax==null) {
 echo "<script type=text/javascript>";
echo "alert('ไม่มีในฐานข้อมูล')";
 echo "</script>";
 //echo  "<meta http-equiv=refresh content=0;URL=index.php >";

//exit();
 }


//$lang=strlen($datamax);
 

 

 $query_Recordset1 = "SELECT 
 
  radacct.UserName,
  
  radacct.AcctStartTime,
  sum(radacct.AcctOutputOctets ) AS data_download
FROM
  radacct
  
WHERE
$conL
  MONTH(radacct.AcctStartTime) = '$mount' AND 
  YEAR(radacct.AcctStartTime) = '$year_gp'
  and   radacct.UserName in (select UserName from    radcheck )  
  $time_HOUR  
 group by 
  radacct.UserName
ORDER BY
  sum(radacct.AcctOutputOctets ) DESC
LIMIT 20";
													
$Recordset1 = mysql_query($query_Recordset1, $connect_db) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);


 
  do {  
 $uname=$row_Recordset1['UserName'];
  $query_Recordset2 = "SELECT 
                                                            sum(radacct.AcctOutputOctets ) AS data_download
                                                               FROM    radacct
                                               WHERE
                                                             $conL
                                                           MONTH(radacct.AcctStartTime) = '$mount' AND 
                                                          YEAR(radacct.AcctStartTime) = '$year_gp'    and 
                                                             radacct.UserName='$uname'  
															 $time_HOUR   ";
													
$Recordset2 = mysql_query($query_Recordset2, $connect_db) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
 
  $data=$row_Recordset2['data_download'];
  
//$percent = number_format(($data/$totalRows_Recordset1)*100,2,'.',',');
 
  $percent=$data*100/$datamax;
   $percent= $percent ;
  if($percent > 200){ $percent=$percent-200; }
 
 ?>
  <tr> 
    <td bgcolor="#99FFFF"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
      <a href="#search" onClick="newwindow=window.open('detail_user.php?id_edit=<? print $row_Recordset1[UserName];?>','detail_user','height=400,width=500,left=10,top=100,scrollbars=1');newwindow.focus();"> 
      <?php echo $row_Recordset1['UserName'];     ?></a></font></td>
    <td bgcolor="#99FFFF"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><?php echo UData($row_Recordset1['UserName'],$connect_db);     ?></font></td>
    <td bgcolor="#FFCCFF"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><?php echo UData_room($row_Recordset1['UserName'],$connect_db);     ?></font></td>
    <td bgcolor="#FFCCFF"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
      <img src=image/ajax_progress2.gif width="<?php echo "$percent"; ?>"  height=14 > 
      <?php echo ConvertSize($data);?></font></td>
    <td bgcolor="#FFCCFF"><div align="center"><font size="2" face="Microsoft Sans Serif"><a href="open-flash-chart/flash-chart-detail-of-month.php?Sname=<?php print $row_Recordset1['UserName']; ?>" target="_blank"><img src="pic/graph.jpg" alt="ดูรายงานแบบกราฟรายวัน" width="25" height="20" border="0"></a></font></div></td>
  </tr>
  <tr> 
    <?php 

	} while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
    <td bgcolor="#99FFFF"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;</font></td>
    <td bgcolor="#99FFFF"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;</font></td>
    <td bgcolor="#FFCCFF">&nbsp;</td>
    <td bgcolor="#FFCCFF"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;</font></td>
    <td bgcolor="#FFCCFF">&nbsp;</td>
  </tr>
</table>
<br>
<p> <?php //echo " $query_Max";?> </p>
</body>
</html>
