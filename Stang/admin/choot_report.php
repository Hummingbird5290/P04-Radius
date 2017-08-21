  <?php include("../include/chklogin.php");   ?>
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
</head>

<body>
<p align="left">โปรดเลือกรูปแบบการแสดงรายงาน แบบรายบุคคล </p>
<form action="report_login_word.php" method="get" enctype="application/x-www-form-urlencoded" name="form100" target="_blank">
  <table width="496" border="1" align="center" class="imagetable">
    <tr> 
      <th width="120" bgcolor="#FFFF99"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">แสดงแบบรายบุคคล</font></strong></th>
      <td width="265" bgcolor="#CCFFCC"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
        <input name="UserName" type="text" id="UserName"   readonly="yes">
        <?php echo "$data_detail"; ?> </textarea> <img src="images/investigacion.gif" width="25" height="24" border="0" align="baseline"> 
        <a href="#search" onClick="newwindow=window.open('choose_user.php','choose_user','height=400,width=500,left=10,top=100,scrollbars=1');newwindow.focus();"> 
        ค้นหา</a> &nbsp;&nbsp; </font></td>
    </tr>
    <tr> 
      <th bgcolor="#FFFF99"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">วันที่</font></strong></th>
      <td bgcolor="#CCFFCC"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
        <select name="day">
          <option value="00" selected>00</option>
          <option value="01">01</option>
          <option value="02">02</option>
          <option value="03">03</option>
          <option value="04">04</option>
          <option value="05">05</option>
          <option value="06">06</option>
          <option value="07">07</option>
          <option value="08">08</option>
          <option value="09">09</option>
          <option value="10">10</option>
          <option value="11">11</option>
          <option value="12">12</option>
          <option value="13">13</option>
          <option value="14">14</option>
          <option value="15">15</option>
          <option value="16">16</option>
          <option value="17">17</option>
          <option value="18">18</option>
          <option value="19">19</option>
          <option value="20">20</option>
          <option value="21">21</option>
          <option value="22">22</option>
          <option value="23">23</option>
          <option value="24">24</option>
          <option value="25">25</option>
          <option value="26">26</option>
          <option value="27">27</option>
          <option value="28">28</option>
          <option value="29">29</option>
          <option value="30">30</option>
          <option value="31">31</option>
        </select>
        *หากต้องการแสดงทั้งเดือนให้เลือก 00</font></td>
    </tr>
    <tr> 
      <th bgcolor="#FFFF99"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">เลือกเดือนที่จะแสดง</font></strong></th>
      <td bgcolor="#CCFFCC"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
        <select name="mount" id="mount">
          <option value="01" selected>มกราคม</option>
          <option value="02">กุมภาพันธ์</option>
          <option value="03">มีนาคม</option>
          <option value="04">เมษายน</option>
          <option value="05">พฤษภาคม</option>
          <option value="06">มิถุนายน</option>
          <option value="07">กรกฎาคม</option>
          <option value="08">สิงหาคม</option>
          <option value="09">กันยายน</option>
          <option value="10">ตุลาคม</option>
          <option value="11">พฤศจิกายน</option>
          <option value="12">ธันวาคม</option>
        </select>
        </font></td>
    </tr>
    <tr> 
      <th bgcolor="#FFFF99"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">เลือกปี</font></strong></th>
      <td bgcolor="#CCFFCC"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
<select name="year" id="year">
  
          <option value="2013">2013</option>
          <option value="2014">2014</option>
          <option value="2015">2015</option>
           <option value="2016">2016</option>
		    <option value="2017">2017</option>
        </select>
        </font></td>
    </tr>
    <tr> 
      <th bgcolor="#FFFF99">&nbsp;</th>
      <td bgcolor="#CCFFCC"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;</font>
        </td>
    </tr>
    <tr> 
      <th bgcolor="#FFFF99"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;</font></th>
      <td bgcolor="#CCFFCC"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
	  <input name="a" value="000" id="a" type="hidden">
        <input type="submit" name="Submit" value="แสดงรายงาน" class="styled-button-2"  >
        </font></td>
    </tr>
  </table>
</form>
<p>&nbsp;</p>
</body>
</html>
