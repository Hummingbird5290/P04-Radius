<?php include("../include/chklogin.php");    
include("../Connections/dbconnect.php");
include("../include/function.php");
if($submit=="บันทึก") {
  
$a=1;
 
$pattern = '/-/i';
$replacement = ':';
$UserName= preg_replace($pattern, $replacement, $UserName);
$UserName=strtoupper ($UserName);
   $UserName = htmlspecialchars("$UserName", ENT_QUOTES);
     $fullname = htmlspecialchars("$fullname", ENT_QUOTES);
	 
	 
$CHK_ADD= mysql_query("INSERT INTO  macauthen     (macid,domain,mk_id) values('$UserName','$domain_name','$mk_id')") ;
	if($CHK_ADD)		{	
 $query_Recordset1ccc = " Select  *  from  mikrotik_link  where domain='$domian_name'  and mk_id='$mk_id' order  by mk_id desc";
$Recordset1ccc = mysql_query($query_Recordset1ccc, $connect_db) or die(mysql_error());
$row_Recordset1ccc = mysql_fetch_assoc($Recordset1ccc);

  $ipmk=$row_Recordset1ccc[ip_vpn];
$usermk=$row_Recordset1ccc[user];
$pmk=$row_Recordset1ccc[pass];
$API = new routeros_api();
$API->debug = false;
if ($API->connect($ipmk,$usermk ,$pmk )) {
$API->comm('/ip/hotspot/ip-binding/add', array(
           "mac-address"     => "$UserName",
           "type"  => "bypassed",
));
   $API->disconnect();

}   //if API
																	  
            echo                  "<script type=text/javascript>";
		    echo                  "alert('บันทึกข้อมูลเสร็จสิ้น')";
	        echo                  "</script>";
 echo '<h2>ระบบกำลังอัพเดทฐานข้อมูลกรุณารอสักครู่ </h2>';
 echo "<meta http-equiv=refresh content=2;URL=index.php?case_i=53>"; 
 		                     	exit();  
		                          	}
 }
 
?>
<HTML>
<HEAD>
<TITLE>km</TITLE>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
</HEAD>


<BODY >
          <p align="center"><strong><font size="3" face="MS Sans Serif, Tahoma, sans-serif">Register Mac address</font></strong></p>
          <p align="center">(Mac address ที่บันทึกลงระบบในส่วนนี้จะไม่มีการเข้าหน้า Login ระบบจะอนุมัติให้เล่น Internet ได้เลยทันที)<br>
          </p>
          <table width="800" border="0">
            <tr>
              <td>
			  <form action="index.php?case_i=53" method="post" enctype="multipart/form-data" name="form1" >
                <table width="100%" border="1" align="left" class="imagetable">
                  <tr valign="baseline">
                    <th width="269" align="right" nowrap bgcolor="#FFFFCC"><strong><font color="#0000FF" size="2" face="MS Sans Serif, Tahoma, sans-serif">Mac ID</font></strong></th>
                    <td width="979" valign="top" bgcolor="#FFFFFF"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong><font color="#FF0000">รูปแบบ 00-18-41-B9-F6-66
                      อักษรตัวใหญ่</font></strong><br>
              <input name="UserName" type="text" id="UserName" value="" size="32">
              <input name="password" type="hidden" id="password" value="password" size="32">
                    </font></td>
                  </tr>
                  <tr valign="baseline">
                    <th height="69" align="right" nowrap bgcolor="#FFFFCC"><strong><font color="#0000FF" size="2" face="MS Sans Serif, Tahoma, sans-serif">ชื่อเครื่อง</font></strong></th>
                    <td valign="top" bgcolor="#FFFFFF"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong><font color="#0000CC"><font color="#FF0000">ภาษาไทยได้<br>
                      ใส่ให้ครบทั้งชื่อนามสกุล</font></font></strong><br>
                      <input name="fullname" type="text" id="fullname" value="" size="32">
                      <input name="room" type="hidden"  id="room" value="0000" size="32">
                      <input name="site" type="hidden" id="site" size="32"  value="0000" >
                      <input name="idstd" type="hidden" id="idstd" value="0000" size="32">
                      <input name="strID" type="hidden" id="strID" value="0000" size="32">
                    </font></td>
                  </tr>
                  <tr valign="baseline">
                    <th height="69" align="right" nowrap bgcolor="#FFFFCC"><strong><font color="#0000FF" size="2" face="MS Sans Serif, Tahoma, sans-serif">Zone ที่จะอนุมัติ </font></strong></th>
                    <td valign="top" bgcolor="#FFFFFF"><select name="mk_id"  >
                        <option value="00">โปรดเลือก</option>
                        <?php
 mysql_select_db($database_edoc, $connect_db)  or trigger_error(mysql_error(),E_USER_ERROR);
 $query_server_HOST = "SELECT   *   FROM   mikrotik_link  where domain='$domain_name'  ";
 $Recordset_server_HOST = mysql_query($query_server_HOST, $connect_db) or trigger_error(mysql_error(),E_USER_ERROR); 
$row_Recordset_server_HOST = mysql_fetch_assoc($Recordset_server_HOST);
do {
?>
                        <option value="<?php print $row_Recordset_server_HOST[mk_id];?>"><?php print $row_Recordset_server_HOST[link_name];?></option>
                        <?php  }   while ($row_Recordset_server_HOST = mysql_fetch_assoc($Recordset_server_HOST));    ?>
                    </select></td>
                  </tr>
                  <tr valign="baseline">
                    <td colspan="2" align="right" nowrap bgcolor="#FFFFCC"><strong><font color="#0000FF" size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;</font></strong>                      <div align="center"> <font size="2" face="MS Sans Serif, Tahoma, sans-serif">
                        <input type="submit" value="บันทึก" name="submit"    class="styled-button-2"  >
                    </font></div></td>
                  </tr>
                  <tr valign="baseline">
                    <td colspan="2" align="right" nowrap bgcolor="#FFFFCC"><div align="center"><strong><font color="#FF0000">หลังจากบันทึกแล้วเพื่อให้ Mac Address ใช้งานได้จำเป็นต้อง เครื่อง ปิดสัญญาณ เน็ตแล้วต่อใหม่  เปิด ปิดไวเลส ของมืถือแล้วเปิดใหม่</font></strong></div></td>
                  </tr>
                  <tr valign="baseline">
                    <td colspan="2" align="right" nowrap bgcolor="#FFFFCC"></td>
                  </tr>
                </table>
             </form>
              </td>
            </tr>
            <tr>
              <td><table width="400" border="1" align="center" cellpadding="0" cellspacing="0" class="imagetable">
                <tr bgcolor="#CCCCCC" class="style26">
                  <th width="445" height="31" bgcolor="#66CCFF"><div align="center" class="style1 style2"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">รายการ MAc ในระบบ</font></strong></div></th>
                  <th width="55" bgcolor="#66CCFF"><div align="center" class="style5"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>ลบทิ้ง</strong></font></div></th>
                </tr>
                <?php 
 
 
  $query_Recordset1 = "SELECT   *   FROM macauthen where domain='$domain_name' ";
$Recordset1 = mysql_query($query_Recordset1, $connect_db) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

  do { ?>
                <tr bgcolor="#FFFFFF" class="style26">
                  <td height="23"><div align="center" class="style3">
                      <div align="left"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><?php echo $row_Recordset1['macid']; ?></font></div>
                  </div></td>
                  <td><div align="center" class="style3"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><a href="<?php echo $editFormAction; ?>?case_i=53&edit=1&iddel=<?php echo $row_Recordset1['macid']; ?>" ><img src="dlete_xp_icon.png" width="35" height="35" border="0"></a></font></div></td>
                </tr>
                <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
              </table></td>
            </tr>
          </table>
          <p align="center">&nbsp;</p>
         
            <br>
            <br>
 
          </BODY>
</HTML>
