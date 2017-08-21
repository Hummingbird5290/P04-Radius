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
  <iframe src ="open-flash-chart/login-count-chart_week.php" width="800" height="400" > </iframe>
  </center>
<?php
 }
?>
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
</head>
 <link href="../css/style.css" rel="stylesheet" type="text/css">
<body>
<p><strong></strong></p>
              <FORM action="index.php?case_i=63" method="post"  name="frm_graph">
  <font size="3" face="MS Sans Serif, Tahoma, sans-serif"><strong>เลือกเดือนที่ต้องการดูรายงานแบบสัปดาห์ </strong></font><br>
                
  <TABLE width="100%" border=0 cellPadding=2 cellSpacing=0>
    <!--DWLayoutTable-->
    <TBODY>
      <TR align=middle vAlign=center> 
        <TD width="167" valign="top"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">วันที่ต้องการดูรายงาน</font></TD>
        <TD width="70" valign="top"><div align="left"></div></TD>
        <TD width="188" height="29" valign="top"> <div align="left"> <font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
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
        <TD width="142"> <div align="left"> <font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
            <select name="year_gp">
       <option value="2013" selected>2013</option>
              <option value="2014">2014</option>
              <option value="2015">2015</option>
              <option value="2016">2016</option>
              <option value="2017">2017</option>
            </select>
            </font><font size="2" face="MS Sans Serif, Tahoma, sans-serif">
            <input type="hidden" value="00" name="daygp" id="daygp">
            </font></div></TD>
        <TD width="426" valign="top"> <div align="left"> </div></TD>
      </TR>
      <TR align=middle vAlign=center> 
        <TD valign="top"><!--DWLayoutEmptyCell-->&nbsp;</TD>
        <TD valign="top"><!--DWLayoutEmptyCell-->&nbsp;</TD>
        <TD height="29" valign="top"><!--DWLayoutEmptyCell-->&nbsp;</TD>
        <TD><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;
          <input name="graph" type="submit" id="graph2" value="ดูกราฟ">
          </font></TD>
        <TD valign="top"><!--DWLayoutEmptyCell-->&nbsp;</TD>
      </TR>
    </TBODY>
  </TABLE>
              </FORM>



<p> <?php //echo " $query_Max";?> </p>
</body>
</html>
