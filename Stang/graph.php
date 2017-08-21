<?php
include("Connections/dbconnect.php");
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


function ConvertSize($fs) 
{ 
     if ($fs >= 1073741824) 
      $fs = round($fs / 1073741824 * 100) / 100 . " Gb"; 
     elseif ($fs >= 1048576) 
      $fs = round($fs / 1048576 * 100) / 100 . " Mb"; 
     elseif ($fs >= 1024) 
      $fs = round($fs / 1024 * 100) / 100 . " Kb"; 
     else 
      $fs = $fs . " b"; 
     return $fs; 
}  

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
</head>

<body>
<table width="85%" border="0">
  <tr bgcolor="#FFFF99"> 
    <td colspan="2"><div align="center"><strong><font size="3" face="MS Sans Serif, Tahoma, sans-serif">รายงานสรุป 
        TOP 5 Upload ประจำวัน<br>
        <font size="2"> </font></font></strong></div></td>
  </tr>
  <tr bgcolor="#FFFF99"> 
    <td width="8%"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">ชื่อผู้ใช้งาน</font></strong></td>
    <td width="53%"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">จำนวนการ 
      UPload</font></strong></td>
  </tr>
  <?php 
  if($mount !=null  and  $year_gp !=null   ) 
             { $mdate_DAY="$year_gp-$mount";
			 } else 
			 { $year_gp = date("Y");
			   $mount=date("m");
			 }
			 
	$todays1 = date("d");
	$todays2 = date("m");
    $todays3 = date("Y");			 
$query_Max = "SELECT 
max(radacct.AcctInputOctets)  As Max_sata
         FROM
              radacct  
                      where 
                      DAY(radacct.AcctStartTime) = '$todays1'   AND
					   MONTH(radacct.AcctStartTime)='$todays2'  and
					    YEAR(radacct.AcctStartTime)='$todays3'   
						        ";
						
$Recordset1_Max = mysql_query($query_Max, $connect_db) or die(mysql_error());
$row_Max = mysql_fetch_assoc($Recordset1_Max);
 $totalRows_Max = mysql_num_rows($Recordset1_Max);

$datamax=$row_Max['Max_sata']; 
 if($datamax ==0  or $datamax==null) {
 echo "<script type=text/javascript>";
echo "alert('ไม่มีในฐานข้อมูล')";
 echo "</script>";
 echo  "<meta http-equiv=refresh content=0;URL=index.php >";

 exit();
 }


//$lang=strlen($datamax);
 

 

 $query_Recordset1 = "SELECT 
 
  radacct.UserName,
 
  radacct.AcctStartTime,
  sum(radacct.AcctInputOctets) AS data_download
FROM
  radacct
  
WHERE
                      DAY(radacct.AcctStartTime) = '$todays1'   AND
					   MONTH(radacct.AcctStartTime)='$todays2'  and
					    YEAR(radacct.AcctStartTime)='$todays3'   
  and   radacct.UserName in (select UserName from    radcheck )
 
 group by 
  radacct.UserName
ORDER BY
  sum(radacct.AcctInputOctets) DESC
LIMIT 5 ";
													
$Recordset1 = mysql_query($query_Recordset1, $connect_db) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);


 
  do {  
 $uname=$row_Recordset1['UserName'];
  $query_Recordset2 = "SELECT 
                                                            sum(radacct.AcctInputOctets) AS data_download
                                                               FROM    radacct
                                               WHERE
                      DAY(radacct.AcctStartTime) = '$todays1'   AND
					   MONTH(radacct.AcctStartTime)='$todays2'  and
					    YEAR(radacct.AcctStartTime)='$todays3'   
						and
                                                             radacct.UserName='$uname' 
															    ";
													
$Recordset2 = mysql_query($query_Recordset2, $connect_db) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
 
  $data=$row_Recordset2['data_download'];
  
//$percent = number_format(($data/$totalRows_Recordset1)*100,2,'.',',');
 
  $percent=$data/$datamax;
 
$percent=$percent*15;
 
 ?>
  <tr> 
    <td bgcolor="#99FFFF"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
       
      <?php echo $row_Recordset1['UserName'];     ?> </font></td>
    <td bgcolor="#FFCCFF"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
      <img src=admin/image/ajax_progress2.gif width="<?php echo "$percent"; ?>"  height=14 > 
      <?php echo ConvertSize($data);?></font></td>
  </tr>
  <tr> 
    <?php 

	} while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
    <td bgcolor="#99FFFF"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;</font></td>
    <td bgcolor="#FFCCFF"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;</font></td>
  </tr>
</table>
<br>
<?php #################################################################### ?>
<table width="85%" border="0">
  <tr bgcolor="#FFFF99"> 
    <td colspan="2"><div align="center"><strong><font size="3" face="MS Sans Serif, Tahoma, sans-serif">รายงานสรุป 
        TOP 5 Download&nbsp;ประจำวัน<br>
        <font size="2"> </font></font></strong></div></td>
  </tr>
  <tr bgcolor="#FFFF99"> 
    <td width="9%"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">ชื่อผู้ใช้งาน</font></strong></td>
    <td width="53%"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">จำนวนการ 
      Download</font></strong></td>
  </tr>
  <?php 

			 
$query_Max = "SELECT 
max(radacct.AcctOutputOctets)  As Max_sata
         FROM
              radacct  
                      where 
                      DAY(radacct.AcctStartTime) = '$todays1'   AND
					   MONTH(radacct.AcctStartTime)='$todays2'  and
					    YEAR(radacct.AcctStartTime)='$todays3'       ";
						
$Recordset1_Max = mysql_query($query_Max, $connect_db) or die(mysql_error());
$row_Max = mysql_fetch_assoc($Recordset1_Max);
 $totalRows_Max = mysql_num_rows($Recordset1_Max);

$datamax=$row_Max['Max_sata']; 
 if($datamax ==0  or $datamax==null) {
 echo "<script type=text/javascript>";
echo "alert('ไม่มีในฐานข้อมูล')";
 echo "</script>";
 echo  "<meta http-equiv=refresh content=0;URL=index.php >";

exit();
 }


//$lang=strlen($datamax);
 

 

 $query_Recordset1 = "SELECT 
 
  radacct.UserName,
  
  radacct.AcctStartTime,
  sum(radacct.AcctOutputOctets ) AS data_download
FROM
  radacct
  
WHERE
                      DAY(radacct.AcctStartTime) = '$todays1'   AND
					   MONTH(radacct.AcctStartTime)='$todays2'  and
					    YEAR(radacct.AcctStartTime)='$todays3'   
  and   radacct.UserName in (select UserName from    radcheck )  
 
 group by 
  radacct.UserName
ORDER BY
  sum(radacct.AcctOutputOctets ) DESC
LIMIT 5";
													
$Recordset1 = mysql_query($query_Recordset1, $connect_db) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);


 
  do {  
 $uname=$row_Recordset1['UserName'];
  $query_Recordset2 = "SELECT 
                                                            sum(radacct.AcctOutputOctets ) AS data_download
                                                               FROM    radacct
                                               WHERE
                          DAY(radacct.AcctStartTime) = '$todays1'   AND
					   MONTH(radacct.AcctStartTime)='$todays2'  and
					    YEAR(radacct.AcctStartTime)='$todays3'   and
                                                             radacct.UserName='$uname'  
															";
													
$Recordset2 = mysql_query($query_Recordset2, $connect_db) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
 
  $data=$row_Recordset2['data_download'];
  
//$percent = number_format(($data/$totalRows_Recordset1)*100,2,'.',',');
 
  $percent=$data/$datamax;
 
$percent=$percent*15;
 
 ?>
  <tr> 
    <td bgcolor="#99FFFF"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
       
      <?php echo $row_Recordset1['UserName'];     ?> </font></td>
    <td bgcolor="#FFCCFF"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
      <img src=admin/image/ajax_progress2.gif width="<?php echo "$percent"; ?>"  height=14 > 
      <?php echo ConvertSize($data);?></font></td>
  </tr>
  <tr> 
    <?php 

	} while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
    <td bgcolor="#99FFFF"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;</font></td>
    <td bgcolor="#FFCCFF"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;</font></td>
  </tr>
</table>
<p> 
  <?php //echo " $query_Max";?>
</p>
</body>
</html>
