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
 ### �ӹǹ��� ��ҹ�ѹ���
  $days=date("d");
 $mount=date("m");
 $year_gp=date("Y");
 $query_Max = "SELECT  count(RadAcctId )  As count_login       FROM   radacct     
                                                                         where       DAY(AcctStartTime)='$days'  and	   
                                                                                                           MONTH(AcctStartTime)='$mount'  and 	  YEAR(AcctStartTime)='$year_gp'       ";
$Recordset1_Max = mysql_query($query_Max, $connect_db) or die(mysql_error());
$row_Max = mysql_fetch_assoc($Recordset1_Max);
$count_login_today=$row_Max[count_login];

 ### �ӹǹ��� ��ҹ�ѹ�������
  $days=date("d")-1;
 $mount=date("m");
 $year_gp=date("Y");
 $query_Max = "SELECT  count(RadAcctId )  As count_login       FROM   radacct     
                                                                         where       DAY(AcctStartTime)='$days'  and	   
                                                                                                           MONTH(AcctStartTime)='$mount'  and 	  YEAR(AcctStartTime)='$year_gp'       ";
$Recordset1_Max = mysql_query($query_Max, $connect_db) or die(mysql_error());
$row_Max = mysql_fetch_assoc($Recordset1_Max);
$count_login_Yday=$row_Max[count_login];


 ### �ӹǹ��� ��ҹ��͹�������
 
 $mount=date("m")-1;
 $year_gp=date("Y");
 $query_Max = "SELECT  count(RadAcctId )  As count_login       FROM   radacct     
                                                                         where      	   
                                                                                                           MONTH(AcctStartTime)='$mount'  and 	  YEAR(AcctStartTime)='$year_gp'       ";
$Recordset1_Max = mysql_query($query_Max, $connect_db) or die(mysql_error());
$row_Max = mysql_fetch_assoc($Recordset1_Max);
$count_login_Ymonth=$row_Max[count_login];

 ### �ӹǹ Download �ѹ���
  $days=date("d");
 $mount=date("m");
 $year_gp=date("Y");
 $query_Max = "SELECT sum(AcctInputOctets) AS data_download       FROM   radacct     
                                                                         where       DAY(AcctStartTime)='$days'  and	   
                                                                                                           MONTH(AcctStartTime)='$mount'  and 	  YEAR(AcctStartTime)='$year_gp'       ";
$Recordset1_Max = mysql_query($query_Max, $connect_db) or die(mysql_error());
$row_Max = mysql_fetch_assoc($Recordset1_Max);
$data_download=$row_Max[data_download];


 ### �ӹǹ Upload �ѹ���
  $days=date("d");
 $mount=date("m");
 $year_gp=date("Y");
 $query_Max = "SELECT sum(AcctOutputOctets) AS data_download       FROM   radacct     
                                                                         where       DAY(AcctStartTime)='$days'  and	   
                                                                                                           MONTH(AcctStartTime)='$mount'  and 	  YEAR(AcctStartTime)='$year_gp'       ";
$Recordset1_Max = mysql_query($query_Max, $connect_db) or die(mysql_error());
$row_Max = mysql_fetch_assoc($Recordset1_Max);
$data_download2=$row_Max[data_download];


### �ӹǹ Download ������ҹ���
 $days=date("d")-1;
 $mount=date("m");
 $year_gp=date("Y");
 $query_Max = "SELECT sum(AcctInputOctets) AS data_download       FROM   radacct     
                                                                         where       DAY(AcctStartTime)='$days'  and	   
                                                                                                           MONTH(AcctStartTime)='$mount'  and 	  YEAR(AcctStartTime)='$year_gp'       ";
$Recordset1_Max = mysql_query($query_Max, $connect_db) or die(mysql_error());
$row_Max = mysql_fetch_assoc($Recordset1_Max);
$data_download3=$row_Max[data_download];


### �ӹǹ Upload ������ҹ���
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
    <td colspan="2" class="APLogoutBtn">ʶԵԡ�������ҹ</td>
  </tr>
  <tr>
    <td width="208" class="txtContent3_orange">�ѹ���</td>
    <td width="115" class="txtContent3_orange"><?php print number_format($count_login_today); ?>&nbsp;&nbsp;����</td>
  </tr>
  <tr>
    <td class="txtContent3_orange">�ѹ�������</td>
    <td class="txtContent3_orange"><?php print number_format($count_login_Yday); ?>&nbsp;&nbsp;����</td>
  </tr>
  <tr>
    <td class="txtContent3_orange">��͹�������</td>
    <td class="txtContent3_orange"><?php print number_format($count_login_Ymonth); ?>&nbsp;&nbsp;����</td>
  </tr>
  <tr>
    <td class="txtContent3_orange">&nbsp;</td>
    <td class="txtContent3_orange">&nbsp;</td>
  </tr>
  <tr>
    <td class="txtContent3_orange">Upload ������ �ѹ���</td>
    <td class="txtContent3_orange"><?php print   ConvertSize($data_download) ; ?></td>
  </tr>
  <tr>
    <td class="txtContent3_orange">Download ������ �ѹ���</td>
    <td class="txtContent3_orange"><?php print   ConvertSize($data_download2) ; ?></td>
  </tr>
  <tr>
    <td class="txtContent3_orange">&nbsp;</td>
    <td class="txtContent3_orange">&nbsp;</td>
  </tr>
  <tr>
    <td class="txtContent3_orange">Upload ������ �ѹ�������</td>
    <td class="txtContent3_orange"><?php print   ConvertSize($data_download3) ; ?></td>
  </tr>
  <tr>
    <td class="txtContent3_orange">Download ������ �ѹ�������</td>
    <td class="txtContent3_orange"><?php print   ConvertSize($data_download4) ; ?></td>
  </tr>
  <tr>
    <td class="txtContent3_orange">&nbsp;</td>
    <td class="txtContent3_orange">&nbsp;</td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
 