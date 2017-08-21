<? 
  include("../include/chklogin.php");  
include("../Connections/dbconnect.php");
  include("../include/function.php");  
 //เรียกใช้ฐานข้อมูล syslog
 consyslog();

$tblog="log_".date("Ymd");
$query_server = "SELECT   host   FROM   $tblog   group by  host order by  host  DESC   ";
$Recordset_server = mysql_query($query_server, $connect_db) or die(mysql_error());
$row_Recordset_server = mysql_fetch_assoc($Recordset_server);
 
 $list_data_server="";
  do { 
 $list_data_server .="\n";
  $list_data_server .= "<option value=  ";
 $list_data_server .=  $row_Recordset_server['host'];
 $list_data_server .= "  >";
 $list_data_server .= $row_Recordset_server['host'];
 $list_data_server .= "</option>";
 
 } while ($row_Recordset_server = mysql_fetch_assoc($Recordset_server));   
 
  mysql_select_db($database_edoc);  //  or trigger_error(mysql_error(),E_USER_ERROR);
 ?><html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<link href="css/style.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="Carlendar/calendar.js"></script>
<link href="Carlendar/calendar-mos.css" rel="stylesheet" type="text/css">
<script language="Javascript" type="text/javascript" src="script/tooltip.js"></script>
<script language="Javascript" type="text/javascript" src="script/ajax.js"></script>
<style type="text/css">

#lyrtooltip {
     position:absolute;
     border:1px solid #FFA500;
     background-color: white;
     padding:3px;
     text-align:left;
}
</style>
<style type="text/css">
<!--
.style1 {
	color: #FFFFFF;
	font-weight: bold;
}
.style2 {color: #000000}
.style3 {color: #000000; font-weight: bold; }
-->
</style>
</head>

<body>
<form action="report_web_access_from_ip.php" method="post" name="form1" target="_blank">
  <table width="100%" border="1">
    <tr bgcolor="#66CCFF"> 
      <td colspan="2"><div align="center"><strong>รายงานการเข้าเว็บแบบค้นหาผู้เข้าเว็บ</strong></div></td>
    </tr>
    <tr> 
      <td width="25%" bgcolor="#FFFF99"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>ชื่อเว็บไซต์</strong></font></td>
      <td width="75%" bgcolor="#CCFFCC"><input name="ip" type="text" id="ip"></td>
    </tr>
    <tr> 
      <td bgcolor="#FFFF99"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>ช่วงเวลา</strong></font></td>
      <td bgcolor="#CCFFCC"><select name="time1">
          <option value="00:00" selected>00:00</option>
          <option value="01:00">01:00</option>
          <option value="02:00">02:00</option>
          <option value="03:00">03:00</option>
          <option value="04:00">04:00</option>
          <option value="05:00">05:00</option>
          <option value="06:00">06:00</option>
          <option value="07:00">07:00</option>
          <option value="08:00">08:00</option>
          <option value="09:00">09:00</option>
          <option value="10:00">10:00</option>
          <option value="11:00">11:00</option>
          <option value="12:00">12:00</option>
          <option value="13:00">13:00</option>
          <option value="14:00">14:00</option>
          <option value="15:00">15:00</option>
          <option value="16:00">16:00</option>
          <option value="17:00">17:00</option>
          <option value="18:00">18:00</option>
          <option value="19:00">19:00</option>
          <option value="20:00">20:00</option>
          <option value="21:00">21:00</option>
          <option value="22:00">22:00</option>
          <option value="23:00">23:00</option>
        </select>
        ถึง 
        <select name="time2">
          <option value="00:00" selected>00:00</option>
          <option value="01:00">01:00</option>
          <option value="02:00">02:00</option>
          <option value="03:00">03:00</option>
          <option value="04:00">04:00</option>
          <option value="05:00">05:00</option>
          <option value="06:00">06:00</option>
          <option value="07:00">07:00</option>
          <option value="08:00">08:00</option>
          <option value="09:00">09:00</option>
          <option value="10:00">10:00</option>
          <option value="11:00">11:00</option>
          <option value="12:00">12:00</option>
          <option value="13:00">13:00</option>
          <option value="14:00">14:00</option>
          <option value="15:00">15:00</option>
          <option value="16:00">16:00</option>
          <option value="17:00">17:00</option>
          <option value="18:00">18:00</option>
          <option value="19:00">19:00</option>
          <option value="20:00">20:00</option>
          <option value="21:00">21:00</option>
          <option value="22:00">22:00</option>
          <option value="23:00">23:00</option>
		  <option value="23:59">23:59</option>
        </select></td>
    </tr>
    <tr> 
      <td bgcolor="#FFFF99"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>วันที่</strong></font></td>
      <td bgcolor="#CCFFCC"><input name="date_view" type="text" id="date_view" onClick="showCalendar('date_view','YYYY-MM-DD')" size="20"   readonly="yes" ></td>
    </tr>
    <tr> 
      <td bgcolor="#FFFF99"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">จาก 
        Server</font></strong></td>
      <td bgcolor="#CCFFCC"> <font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
        <select name="host">
          <option value="" selected>โปรดเลือก</option>
          <?php echo  "$list_data_server"; ?> 
        </select>
        </font></td>
    </tr>
    <tr> 
      <td bgcolor="#FFFF99"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">เลือกรูปแบบ 
        OUTPUT</font></strong></td>
      <td bgcolor="#CCFFCC"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;</font> 
        <table width="200">
          <tr> 
            <td><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
              <label> 
              <input type="radio" name="a" value="word">
              Microsoft Word</label>
              </font></strong></td>
          </tr>
          <tr> 
            <td><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
              <label> 
              <input type="radio" name="a" value="excel">
              Microsoft Excel</label>
              </font></strong></td>
          </tr>
          <tr> 
            <td><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
              <input type="radio" name="a" value="000">
              HTML</font></strong></td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td bgcolor="#FFFF99">&nbsp;</td>
      <td bgcolor="#CCFFCC"> <input type="submit" name="Submit" value="Submit"> 
      </td>
    </tr>
  </table>
</form>
</body>
</html>
