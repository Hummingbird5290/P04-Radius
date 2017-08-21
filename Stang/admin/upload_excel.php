<?php
 include("../include/chklogin.php");    ?> 
<html>
<head>
<title>Excel upload der</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
</head>

<body>

<form action="import_excel.php" method="post" enctype="multipart/form-data" name="form1">
  <table width="71%" border="0"  class="imagetable">
    <tr bgcolor="#66CCCC"> 
      <th height="30" colspan="2"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>Upload 
        ไฟล์ Excel (รองรับ เวอร์ชั่น 91 ,2000, 2003 )</strong></font></th>
    </tr>
    <tr bgcolor="#FFFFCC"> 
      <th width="39%"><div align="left"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">ไฟล์ 
      Excel</font></strong></div></th>
      <td width="61%"><div align="left"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
          &nbsp;&nbsp; 
          <input type="file" name="files_name"  id="files_name">
      </font></div></td>
    </tr>
    <tr bgcolor="#FFFFCC"> 
      <th> <div align="left"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;หอพัก / Apartment Name / Site name</font></strong></div></th>
      <td><div align="left"> <font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
          &nbsp;&nbsp; 
		  <input name="site" type="text" id="site" value="" size="32">
           
          </font></div></td>
    </tr>
    <tr bgcolor="#FFFFCC"> 
      <th><div align="left"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">ให้อยู่ในกลุ่มความเร็ว</font></strong></div></th>
      <td><div align="left"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;&nbsp;&nbsp; 
          <?php
	                 	include("../Connections/dbconnect.php");
	            $query_type = "SELECT *   FROM   radgroupreply    where GroupName !='ลบทิ้ง'  and GroupName like '%@$domain_name'  group by GroupName order by  GroupName  DESC      ";
				$type_db = mysql_query($query_type, $connect_db) or die(mysql_error());
				$row_type = mysql_fetch_assoc($type_db);
				$totalRows_type= mysql_num_rows($type_db);
				

	  ?>
          <select name="GroupName" id="GroupName"      >
            <?php
												do {  
														  ?>
            <option value="<?php echo $row_type['GroupName']?>" ><?php echo $row_type['GroupName']?></option>
            <?php
								} while ($row_type = mysql_fetch_assoc($type_db));
								?>
          </select>
          </font></div></td>
    </tr>
    <tr bgcolor="#FFFFCC">
      <th><div align="left"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">วันหมดอายุ</font></strong></div></th>
      <td>
      
      <font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
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
          <option value="2013">2013</option>
          <option value="2014">2014</option>
          <option value="2015">2015</option>
          <option value="2016">2016</option>
          <option value="2017">2017</option>
          <option value="2018">2018</option>
          <option value="2019">2019</option>
          <option value="2020">2020</option>
          <option value="2021">2021</option>
          <option value="2022">2022</option>
          <option value="2023">2023</option>
        </select>
        <input type="hidden" name="uedit" id="uedit" value="<?php print $uedit;?>" >
      </font>
      
      </td>
    </tr>
    <tr bgcolor="#FFFFCC"> 
      <th><div align="left"> </div></th>
      <td><div align="left"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
          <input type="submit" name="Submit" value="Submit">
          </font></div></td>
    </tr>
  </table>
</form>
<p><font color="#FF0000" size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>ระบบจะทำการเพิ่มข้อมูลเริ่มจาก 
  แถวที่ 2 ในไฟล์ excel</strong></font></p>
<p><a href="user.xls">Download ไฟล์ Excel ตัวอย่าง</a></p>
</body>
</html>
