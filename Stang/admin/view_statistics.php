 <?php include("../include/chklogin.php");   
 include("../Connections/dbconnect.php");
 
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
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<link href="../css/style.css" rel="stylesheet" type="text/css">
 

<body>
 <?php
 ### จำนวนที่ ใช้งานวันนี้
  $days=date("d");
 $mount=date("m");
 $year_gp=date("Y");
 $query_Max = "SELECT  count(RadAcctId )  As count_login       FROM   radacct     
                                                                         where       DAY(AcctStartTime)='$days'  and	   
                                                                                                           MONTH(AcctStartTime)='$mount'  and 	  YEAR(AcctStartTime)='$year_gp'       ";
$Recordset1_Max = mysql_query($query_Max, $connect_db) or die(mysql_error());
$row_Max = mysql_fetch_assoc($Recordset1_Max);
$count_login_today=$row_Max[count_login];

 ### จำนวนที่ ใช้งานวันที่แล้ว
  $days=date("d")-1;
 $mount=date("m");
 $year_gp=date("Y");
 $query_Max = "SELECT  count(RadAcctId )  As count_login       FROM   radacct     
                                                                         where       DAY(AcctStartTime)='$days'  and	   
                                                                                                           MONTH(AcctStartTime)='$mount'  and 	  YEAR(AcctStartTime)='$year_gp'       ";
$Recordset1_Max = mysql_query($query_Max, $connect_db) or die(mysql_error());
$row_Max = mysql_fetch_assoc($Recordset1_Max);
$count_login_Yday=$row_Max[count_login];


 ### จำนวนที่ ใช้งานเดือนที่แล้ว
 
 $mount=date("m")-1;
 $year_gp=date("Y");
 $query_Max = "SELECT  count(RadAcctId )  As count_login       FROM   radacct     
                                                                         where      	   
                                                                                                           MONTH(AcctStartTime)='$mount'  and 	  YEAR(AcctStartTime)='$year_gp'       ";
$Recordset1_Max = mysql_query($query_Max, $connect_db) or die(mysql_error());
$row_Max = mysql_fetch_assoc($Recordset1_Max);
$count_login_Ymonth=$row_Max[count_login];

 ### จำนวน Download วันนี้
  $days=date("d");
 $mount=date("m");
 $year_gp=date("Y");
 $query_Max = "SELECT sum(AcctInputOctets) AS data_download       FROM   radacct     
                                                                         where       DAY(AcctStartTime)='$days'  and	   
                                                                                                           MONTH(AcctStartTime)='$mount'  and 	  YEAR(AcctStartTime)='$year_gp'       ";
$Recordset1_Max = mysql_query($query_Max, $connect_db) or die(mysql_error());
$row_Max = mysql_fetch_assoc($Recordset1_Max);
$data_download=$row_Max[data_download];


 ### จำนวน Upload วันนี้
  $days=date("d");
 $mount=date("m");
 $year_gp=date("Y");
 $query_Max = "SELECT sum(AcctOutputOctets) AS data_download       FROM   radacct     
                                                                         where       DAY(AcctStartTime)='$days'  and	   
                                                                                                           MONTH(AcctStartTime)='$mount'  and 	  YEAR(AcctStartTime)='$year_gp'       ";
$Recordset1_Max = mysql_query($query_Max, $connect_db) or die(mysql_error());
$row_Max = mysql_fetch_assoc($Recordset1_Max);
$data_download2=$row_Max[data_download];


### จำนวน Download เมื่อวานนี้
 $days=date("d")-1;
 $mount=date("m");
 $year_gp=date("Y");
 $query_Max = "SELECT sum(AcctInputOctets) AS data_download       FROM   radacct     
                                                                         where       DAY(AcctStartTime)='$days'  and	   
                                                                                                           MONTH(AcctStartTime)='$mount'  and 	  YEAR(AcctStartTime)='$year_gp'       ";
$Recordset1_Max = mysql_query($query_Max, $connect_db) or die(mysql_error());
$row_Max = mysql_fetch_assoc($Recordset1_Max);
$data_download3=$row_Max[data_download];


### จำนวน Upload เมื่อวานนี้
 $days=date("d")-1;
 $mount=date("m");
 $year_gp=date("Y");
 $query_Max = "SELECT sum(AcctOutputOctets) AS data_download       FROM   radacct     
                                                                         where       DAY(AcctStartTime)='$days'  and	   
                                                                                                           MONTH(AcctStartTime)='$mount'  and 	  YEAR(AcctStartTime)='$year_gp'       ";
$Recordset1_Max = mysql_query($query_Max, $connect_db) or die(mysql_error());
$row_Max = mysql_fetch_assoc($Recordset1_Max);
$data_download4=$row_Max[data_download];

 ?>
<table width="469" border="1" align="center" bordercolor="#0000FF">
  <tr>
    <td colspan="2" class="APLogoutBtn">สถิติการเข้าใช้งาน</td>
  </tr>
  <tr>
    <td width="208" class="txtContent3_orange">วันนี้</td>
    <td width="115" class="txtContent3_orange"><?php print number_format($count_login_today); ?>&nbsp;&nbsp;ครั้ง</td>
  </tr>
  <tr>
    <td class="txtContent3_orange">วันที่แล้ว</td>
    <td class="txtContent3_orange"><?php print number_format($count_login_Yday); ?>&nbsp;&nbsp;ครั้ง</td>
  </tr>
  <tr>
    <td class="txtContent3_orange">เดือนที่แล้ว</td>
    <td class="txtContent3_orange"><?php print number_format($count_login_Ymonth); ?>&nbsp;&nbsp;ครั้ง</td>
  </tr>
  <tr>
    <td class="txtContent3_orange">&nbsp;</td>
    <td class="txtContent3_orange">&nbsp;</td>
  </tr>
  <tr>
    <td class="txtContent3_orange">Upload ทั้งหมด วันนี้</td>
    <td class="txtContent3_orange"><?php print   ConvertSize($data_download) ; ?></td>
  </tr>
  <tr>
    <td class="txtContent3_orange">Download ทั้งหมด วันนี้</td>
    <td class="txtContent3_orange"><?php print   ConvertSize($data_download2) ; ?></td>
  </tr>
  <tr>
    <td class="txtContent3_orange">&nbsp;</td>
    <td class="txtContent3_orange">&nbsp;</td>
  </tr>
  <tr>
    <td class="txtContent3_orange">Upload ทั้งหมด วันที่แล้ว</td>
    <td class="txtContent3_orange"><?php print   ConvertSize($data_download3) ; ?></td>
  </tr>
  <tr>
    <td class="txtContent3_orange">Download ทั้งหมด วันที่แล้ว</td>
    <td class="txtContent3_orange"><?php print   ConvertSize($data_download4) ; ?></td>
  </tr>
  <tr>
    <td class="txtContent3_orange">&nbsp;</td>
    <td class="txtContent3_orange">&nbsp;</td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
 