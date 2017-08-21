  <?php include("../include/chklogin.php");  
  include("../Connections/dbconnect.php");
 
 $sql_data=" CREATE TABLE `gp_login_time` (
`daygp` VARCHAR( 300 ) NOT NULL ,
`mountgp` VARCHAR( 300 ) NOT NULL ,
`year_gp` VARCHAR( 300 ) NOT NULL  
) ENGINE = MYISAM ;";
							 
 $Recordset_sqldaa = mysql_query($sql_data, $connect_db) ;
 mysql_query("TRUNCATE TABLE  `gp_login_time`") ;
			   
 mysql_query("INSERT INTO  gp_login_time  (daygp,mountgp,year_gp)
		      values('$daygp','$mountgp','$year_gp')") ;
	if($daygp !=''){		  
  ?>
  <center>
  <iframe src ="open-flash-chart/login-count-chart_time.php" width="800" height="400" > </iframe>
  </center>
<?php
 }
?>
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
</head>

<body>
 <link href="../css/style.css" rel="stylesheet" type="text/css">
<p><strong></strong></p>
              <FORM action="index.php?case_i=62" method="post"  name="frm_graph">
  <font size="3" face="MS Sans Serif, Tahoma, sans-serif"><strong>เลือกวันรายงาน </strong></font><br>
                
  <TABLE width="100%" border=0 cellPadding=2 cellSpacing=0>
    <!--DWLayoutTable-->
    <TBODY>
      <TR align=middle vAlign=center> 
        <TD width="168" valign="top"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">วันที่ต้องการดูรายงาน</font></TD>
        <TD width="146" valign="top"><div align="left"> <font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
            <select name="daygp" id="daygp">
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
            <select name="mountgp">
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
        <TD width="431" valign="top"> <div align="left"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">
          <input name="graph" type="submit" id="graph2" value="ดูกราฟ">
        </font> </div></TD>
      </TR>
      <TR align=middle vAlign=center> 
        <TD valign="top"><!--DWLayoutEmptyCell-->&nbsp;</TD>
        <TD valign="top"><!--DWLayoutEmptyCell-->&nbsp;</TD>
        <TD height="29" valign="top"><!--DWLayoutEmptyCell-->&nbsp;</TD>
        <TD><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;</font></TD>
        <TD valign="top"><!--DWLayoutEmptyCell-->&nbsp;</TD>
      </TR>
    </TBODY>
  </TABLE>
              </FORM>



<p> <?php //echo " $query_Max";?> </p>
</body>
</html>
