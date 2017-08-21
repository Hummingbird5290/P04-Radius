  <?php include("../include/chklogin.php");   ?> 
<?php
include("../Connections/dbconnect.php");
$chk_g=base64_encode("defult");
include("../include/function.php");
//กันไว้ส่วนอื่นอัพเดทระบบพลาด
update("radgroupcheck","op =':='  "," where Attribute='Simultaneous-Use'      ");   
update("radcheck","op =':='  "," where      Attribute='MD5-Password'      ");   
update("radcheck","op ='=='  "," where      Attribute='Calling-Station-Id'      ");   
////////////////////////////////////////////////
if($move_user =="ย้ายกลุ่ม")  {
 
update("usergroup", "GroupName='$GroupName2'  "," where GroupName='$GroupName1' and domain='$doname_login'   "); 
update("card", "GroupName='$GroupName2'  "," where GroupName='$GroupName1'  and domain='$doname_login'   "); 
}


if($submit=="บันทึก"   and  $GroupName !=NULL   and    $GroupName !="bit"  and  $groupid !=$chk_g     and   $GroupName !="limitDownload"   and   $doname_login !=NULL   ) {
  $GroupName = htmlspecialchars("$GroupName", ENT_QUOTES);
  $GroupName2s= htmlspecialchars("$GroupName2s", ENT_QUOTES);
  $pattern = '/;/i';
$replacement = NULL;
$GroupName= preg_replace($pattern, $replacement, $GroupName);
$GroupName2s= preg_replace($pattern, $replacement, $GroupName2s);

$GroupName="$GroupName@$doname_login";
 if(preg_match ("/[[:punct:]]/",$UserName))  {  
 
   	         echo                  "<script type=text/javascript>";
		    echo                  "alert('   ชื่อกลุ่ม   ห้ามมีตัวอักษรพิเศษ และใช้ภาษา ENG  ')";
	        echo                  "</script>";  
		  //  echo "<meta http-equiv=refresh content=0;URL=index.php?a=200>"; 
		 	exit();  
}



$query_user1= "select  *  from radgroupreply   where GroupName='$GroupName'    ";

$type_db_user_gr = mysql_query($query_user1, $connect_db) or die(mysql_error());

$totalRows_user_group= mysql_num_rows($type_db_user_gr);
 
if($totalRows_user_group ==0  )  {  //  เช็คว่ามีใน db ป่าว  
$Attribute="WISPr-Bandwidth-Max-Down";
$op=":=";
mysql_query("INSERT INTO  radgroupreply  (GroupName,Attribute,op,Value)
		      values('$GroupName', '$Attribute','$op','$Value'   )") or    die ("Add ข้อมูลลง Table ไม่ได้ ");

$Attribute="WISPr-Bandwidth-Max-Up";			  
mysql_query("INSERT INTO  radgroupreply  (GroupName,Attribute,op,Value)
		      values('$GroupName', '$Attribute','$op','$Value2'   )") or    die ("Add ข้อมูลลง Table ไม่ได้ ");
			  
$Attribute="Service-Type";			  
mysql_query("INSERT INTO  radgroupreply  (GroupName,Attribute,op,Value)
		      values('$GroupName', '$Attribute','$op','Login-User'   )") or    die ("Add ข้อมูลลง Table ไม่ได้ ");			  

 $Attribute="Session-Timeout";			  
mysql_query("INSERT INTO  radgroupreply  (GroupName,Attribute,op,Value)
		      values('$GroupName', '$Attribute','$op','$timelogin'   )") or    die ("Add ข้อมูลลง Table ไม่ได้ ");		  
 
 #เมื่อทิ้งไว้ไม่เล่นระบบจะดีด ออก 600 10 นาที
	$Attribute="Idle-Timeout";			  
mysql_query("INSERT INTO  radgroupreply  (GroupName,Attribute,op,Value)
		      values('$GroupName', '$Attribute',':=','$IdleTimeout'   )") or    die ("Add ข้อมูลลง Table ไม่ได้ ");		
			  			  
#### (Simultaneous-Use := 1 กำหนดให้นักเรียนเข้าใช้งานได้เพียง 1 คนต่อ 1 login ไม่มีการแอบใช้ร่วมกัน)
#จำนวนที่ login ซ้ำได้
$Attribute="Simultaneous-Use";
if($Simultaneous==''){ $Simultaneous='1';}
mysql_query("INSERT INTO  radgroupcheck  (GroupName,Attribute,op,Value)
		      values('$GroupName', '$Attribute',':=','$Simultaneous'   )") or    die ("Add ข้อมูลลง Table ไม่ได้ ");
			  			
	#Acct-Interim-Interval เพิ่มในตาราง radreply เพื่อให้ NAS ส่ง ข้อมูลการใช้มาที่ radius serve	 600 =10 นาที	  
$Attribute="Acct-Interim-Interval";			  
mysql_query("INSERT INTO  radgroupreply  (GroupName,Attribute,op,Value)
		      values('$GroupName', '$Attribute','$op','600'   )") or    die ("Add ข้อมูลลง Table ไม่ได้ ");	

//ตารางไว้ เช็คว่ากลุ่ม นี้ ของ แอดมินท่านใด
 mysql_query("INSERT INTO  radgroup_domain  (GroupName,domain)
		      values('$GroupName', '$doname_login'  )") or    die ("Add ข้อมูลลง Table ไม่ได้ ");			
	//URL หลัง login		  	    			
 if($GroupName2s !=NULL){
 
$query_Expirations = "delete FROM   radgroupreply       where Attribute='WISPr-Redirection-URL' and   GroupName='$GroupName' ";
mysql_query($query_Expirations, $connect_db) or die(mysql_error());
mysql_query("INSERT INTO  radgroupreply  (GroupName,Attribute,op,Value)
		      values('$GroupName', 'WISPr-Redirection-URL',':=','$GroupName2s'   )") or    die ("Add ข้อมูลลง Table ไม่ได้ ");		
			  }  
 if($GroupName2s =='-'){
$query_Expirations = "delete FROM   radgroupreply       where Attribute='WISPr-Redirection-URL' and   GroupName='$GroupName' ";
mysql_query($query_Expirations, $connect_db) or die(mysql_error());
 	  }  
	  			 
# หมดอายุใช้งาน  Expiration
if($Expiration=="1") {			 
$Attribute="Expiration";
$data_date="$endday $endmount $endyear $endhour:$endmin:00";
mysql_query("INSERT INTO  radgroupcheck  (GroupName,Attribute,op,Value)
		      values('$GroupName', '$Attribute','$op','$data_date'   )") or    die ("Add ข้อมูลลง Table ไม่ได้ ");		 
 	}
			  }  // จบเช็คว่ามีใน db ป่าว  
			  else {
		 
             echo                  "<script type=text/javascript>";
		    echo                  "alert('กรุณาตั้งชื่อกลุ่มใหม่')";
	        echo                  "</script>";
			echo  "<meta http-equiv=refresh content=0;URL=index.php?case_i=16>";
exit();
			  } //ถ้าชื่อซ้ำก็แจ้งเตือนบอก
			  
}

//ลบ กลุ่มทิ้ง
if($edit=="1" and  $groupid !=$chk_g     ) {
  $groupid= htmlspecialchars("$groupid", ENT_QUOTES);
  $pattern = '/;/i';
$replacement = NULL;
$groupid= preg_replace($pattern, $replacement, $groupid);

$groupid=base64_decode($groupid);
if(  $groupid !="defult@$doname_login" and  $groupid !="ลบทิ้ง@$doname_login" and  $groupid !="2M@$doname_login")  {
$sql = "delete from radgroupreply  where GroupName='$groupid'  ";
 mysql_select_db($database_edoc); $dbquery = mysql_query($sql) or die(mysql_error());

$sql = "delete from radgroupcheck where GroupName='$groupid'  ";
 mysql_select_db($database_edoc);$dbquery = mysql_query($sql) or die(mysql_error());
 
 $sql = "delete from radgroup_domain where GroupName='$groupid'  and domain='$doname_login'  ";
 mysql_select_db($database_edoc);$dbquery = mysql_query($sql) or die(mysql_error());
}
if($all==1 and $groupid !="defult@$doname_login" and  $groupid !="ลบทิ้ง@$doname_login" and  $groupid !="2M@$doname_login") // ลบ user  พร้อม กรุ๊ป  ออกด้วย defult
{
$sql = "delete from register      where UserName  in  (  select  UserName  from  usergroup  where  GroupName='$groupid'   )  ";
 mysql_select_db($database_edoc); $dbquery = mysql_query($sql) or die(mysql_error());

$sql = "delete from radcheck      where UserName  in  (  select  UserName  from  usergroup  where  GroupName='$groupid'   )  ";
 mysql_select_db($database_edoc); $dbquery = mysql_query($sql) or die(mysql_error());

$sql = "delete from radacct      where UserName  in  (  select  UserName  from  usergroup  where  GroupName='$groupid'   )  ";
 mysql_select_db($database_edoc); $dbquery = mysql_query($sql) or die(mysql_error());
 
             echo                  "<script type=text/javascript>";
		    echo                  "alert('เรียบร้อยแล้ว  User ที่อยู่ในกลุ่ม $groupid  ถูก  ลบทิ้ง')";
	        echo                  "</script>";

}
update("usergroup", "GroupName='ลบทิ้ง@$doname_login'  "," where GroupName='$groupid'    "); 
update("card", "GroupName='defult@$doname_login'  "," where GroupName='$groupid'    "); 
      
	  if($all !=1) {      echo                  "<script type=text/javascript>";
		                          echo                  "alert('เรียบร้อยแล้ว  User ที่อยู่ในกลุ่ม $groupid จะย้ายไปกลุ่ม  ลบทิ้ง')";
	                             echo                  "</script>";  }
 echo  "<meta http-equiv=refresh content=0;URL=index.php?case_i=16 >";
 exit;
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">

 
<style type="text/css">
<!--
.style1 {font-weight: bold}
.style2 {font-weight: bold}
.style3 {color: #FF0000}
-->
</style>
</head>

<body class="style26">
<p align="center" class="style1 style2"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">คลิกที่ชื่อกลุ่มเพื่อดูรายชื่อผู้ใช้งานภายในกลุ่ม</font></strong> 
  <br>
หากคลิกที่ ลบถาวร <span class="style3">ระบบจะลบ ชื่อ User ออกจากระบบไปด้วย </span></p>
<table width="100%" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr bgcolor="#CCCCCC" class="style26"> 
    <td width="193" bgcolor="#66CCFF"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>กลุ่ม</strong></font></td>
    <td height="31" colspan="2" bgcolor="#66CCFF"><div align="center" class="style1 style2"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>Attribute</strong></font></div></td>
    <td width="78" bgcolor="#66CCFF"><div align="center" class="style5"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>แก้ไข</strong></font></div></td>
    <td width="64" bgcolor="#66CCFF"><div align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>ลบทิ้ง</strong></font></div></td>
    <td width="144" bgcolor="#66CCFF"><div align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>ลบถาวร</strong></font></div></td>
  </tr>
  <?php 
  $query_Recordset1 = "SELECT   *   FROM   radgroupreply       where    GroupName !='ลบทิ้ง@$doname_login'  
  and GroupName like '%$doname_login'   group by GroupName order by  GroupName  DESC ,Attribute DESC  ";
$Recordset1 = mysql_query($query_Recordset1, $connect_db) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
//$totalRows_Recordset1 = mysql_num_rows($Recordset1);

  do { 
  
   
 ?>
  <tr bgcolor="#FFFFFF" class="style26"> 
    <td rowspan="6"  valign="top"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> <a href=index.php?case_i=19&GroupName=<?php echo $row_Recordset1['GroupName']; ?>><strong><b>&nbsp;<?php echo $row_Recordset1['GroupName']; ?></b></strong></a></font></td>

    <td width="542" bgcolor="<?php print "$AGC";?>"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> &nbsp; 
      ความเร็ว Download&nbsp;</font></td>
    <td width="265" height="23"><div align="center" class="style3"> 
        <div align="left"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
          &nbsp; 
          <?php     $datas=     getdata($row_Recordset1['GroupName'],"WISPr-Bandwidth-Max-Down",$connect_db) ;
		   print formatBytes($datas);?> 
          </font></div>
      </div></td>
    <td><div align="center" class="style3"><font size="1" face="MS Sans Serif, Tahoma, sans-serif"><a href="index.php?case_i=17&GroupName=<?php echo $row_Recordset1['GroupName']; ?>"><img src="../images/test.gif" width="16" height="16" border="0"></a></font></div></td>
        
		<td><div align="center"><font size="1" face="MS Sans Serif, Tahoma, sans-serif"> 
        <a href="<?php echo $editFormAction; ?>?case_i=16&all=0&edit=1&groupid=<?php   print base64_encode($row_Recordset1['GroupName']);   ?>" onClick="return cdelete(this)"><img src="../images/delete.gif" width="16" height="16" border="0"></a></font></div></td>
		
    <td><div align="center"><font size="1" face="MS Sans Serif, Tahoma, sans-serif"> <a href="<?php echo $editFormAction; ?>?case_i=16&all=1&edit=1&groupid=<?php   print base64_encode($row_Recordset1['GroupName']);   ?>" onClick="return cdelete(this)"><img src="dlete_xp_icon.png" width="35" height="35" border="0"></a></font></div></td>
  </tr>
  <tr bgcolor="#FFFFFF" class="style26">
    <td bgcolor="<?php print "$AGC";?>"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> &nbsp; 
      ความเร็ว Upload</font></td>
    <td height="23"><div align="center" class="style3">
        <div align="left"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> &nbsp;
              <?php    $datas =getdata($row_Recordset1['GroupName'],"WISPr-Bandwidth-Max-Up",$connect_db);
			   print formatBytes($datas);?> 
        </font></div>
    </div></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr bgcolor="#FFFFFF" class="style26">
    <td bgcolor="<?php print "$AGC";?>"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> &nbsp; ระยะเวลาในการ      Login ต่อครั้ง </font></td>
    <td height="23"><div align="center" class="style3">
        <div align="left"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> &nbsp;
              <?php   // print    gmdate("H:i:s", getdata($row_Recordset1['GroupName'],"Session-Timeout",$connect_db)); 
		print	  gettimess(getdata($row_Recordset1['GroupName'],"Session-Timeout",$connect_db));
			  ?> &nbsp; 
			  
        </font></div>
    </div></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr bgcolor="#FFFFFF" class="style26">
    <td bgcolor="<?php print "$AGC";?>">&nbsp; <font size="2" face="MS Sans Serif, Tahoma, sans-serif">Auto Logout เมื่อผู้ใช้งานไม่ได้ใช้งานอินเตอร์เน็ต</font></td>
        <td height="23"><div align="center" class="style3">
        <div align="left"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> &nbsp;
              <?php   	print	  gettimess(getdata($row_Recordset1['GroupName'],"Idle-Timeout",$connect_db));
			  ?> &nbsp; 
			  
        </font></div>
    </div></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr bgcolor="#FFFFFF" class="style26">
    <td bgcolor="<?php print "$AGC";?>">&nbsp;</td>
    <td height="23">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr bgcolor="#FFFFFF" class="style26">
    <td bgcolor="<?php print "$AGC";?>">&nbsp;</td>
    <td height="23">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
</table>
<br>
<table width="100%" border="1" align="center" bordercolor="#000000">
  <tr bordercolor="#000000" bgcolor="#66CCFF"  class="style26"> 
    <td width="144"><div align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>กลุ่ม</strong></font></div></td>
    <td width="493"><div align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>รายละเอียด</strong></font></div></td>
    <td width="374"><div align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>ค่า</strong></font></div></td>
  </tr> 
   <?php 
  $query_Recordset1 = "SELECT   *   FROM   radgroupreply        where      Attribute ='WISPr-Redirection-URL'
   and GroupName in ( select   GroupName  from radgroup_domain where domain='$doname_login')  
    order by  GroupName ";
$Recordset1 = mysql_query($query_Recordset1, $connect_db) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

  do { 
  
   
 ?>
  
  <tr bordercolor="#000000"> 
    <td><div align="left"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;<?php echo $row_Recordset1['GroupName']; ?></font></div></td>
    <td><div align="left"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;<?php echo $row_Recordset1['Attribute']; ?>&nbsp;</font></div></td>
    <td><div align="left"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;<?php echo $row_Recordset1['Value']; ?></font></div></td>
  </tr>
  <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
</table>
<p><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><br>
  </font></p>
<table width="100%" border="0">
  <tr> 
    <td width="46%"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>WISPr-Bandwidth-Max-Up&nbsp;&nbsp;&nbsp;</strong></font></td>
    <td width="54%"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>คือ&nbsp;&nbsp;&nbsp;ความเร็วในการ 
      UPLOAD</strong></font></td>
  </tr>
  <tr> 
    <td><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>WISPr-Bandwidth-Max-Down&nbsp;</strong></font></td>
    <td><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>คือ&nbsp;&nbsp;&nbsp;ความเร็วในการ 
      อัพโหลด DOWNLOAD </strong></font></td>
  </tr>
  <tr> 
    <td><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>Session-Timeout 
      &nbsp;</strong></font></td>
    <td><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>คือ &nbsp;ระยะเวลาในการ 
      Login ต่อครั้ง</strong></font></td>
  </tr>
  <tr> 
    <td><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>Expiration</strong> 
      </font></td>
    <td><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>คือ &nbsp;วันหมดอายุการใช้งาน</strong></font></td>
  </tr>
  <tr> 
    <td colspan="2"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;</font></td>
  </tr>
  <tr> 
    <td colspan="2"><font color="#FF0000" size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>หากทำการลบกลุ่มผู้ใช้งาน 
      ผู้ใช้งานที่อยู่ในกลุ่มนั้นจะย้ายไปอยู่ในกลุ่ม&nbsp;defult </strong></font></td>
  </tr>
</table>
<p><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> </font><br>
  
</p><br>

<table width="100%" border="0">
  <tr bgcolor="#CCCCFF"> 
    <td width="46%"><div align="center"><strong><font color="#0000FF" size="2" face="MS Sans Serif, Tahoma, sans-serif">ชื่อกลุ่ม</font></strong></div></td>
    <td colspan="2"><div align="center"><strong><font color="#0000FF" size="2" face="MS Sans Serif, Tahoma, sans-serif">จำนวนผู้ใช้งานในกลุ่ม</font></strong></div></td>
  </tr>
  <?php 
  $query_Recordset1_count_Group = "SELECT *   FROM   radgroupreply    where GroupName in ( select   GroupName  from radgroup_domain where domain='$doname_login')   and  GroupName like '%@$doname_login%'  group by GroupName order by  GroupName  DESC    ";
$Recordset1_g = mysql_query($query_Recordset1_count_Group, $connect_db) or die(mysql_error());
$row_Recordset1_g = mysql_fetch_assoc($Recordset1_g);
$totalRows_Recordset1_g = mysql_num_rows($Recordset1_g);

  do { 
$gName= $row_Recordset1_g['GroupName']; 
$query_Recordset1_count_Group2 = "SELECT   GroupName  FROM   usergroup   where  GroupName='$gName'   
and  UserName in  (  select UserName  from  register  where status='1' )";
$Recordset1_g2 = mysql_query($query_Recordset1_count_Group2, $connect_db) or die(mysql_error());
$totalRows_Recordset1_g2 = mysql_num_rows($Recordset1_g2);
?>
  <tr> 
    <td bgcolor="#FFCCFF"><div align="left"><font size="2"><font face="MS Sans Serif, Tahoma, sans-serif"><font color="#0000FF"><a href=index.php?case_i=19&GroupName=<?php echo $row_Recordset1_g['GroupName']; ?>><?php print  $row_Recordset1_g['GroupName'];?></a></font></font></font></div></td>
    <td width="26%" bgcolor="#99CCFF"><div align="center"><font size="2"><font face="MS Sans Serif, Tahoma, sans-serif"><font color="#0000FF"><?php print  $totalRows_Recordset1_g2;?></font></font></font></div></td>
    <td width="28%" bgcolor="#99CCFF"><div align="center"><font color="#0000FF" size="2" face="MS Sans Serif, Tahoma, sans-serif">คน</font></div></td>
  </tr>
  <?php } while ($row_Recordset1_g = mysql_fetch_assoc($Recordset1_g)); ?>
</table><br>

<form method="post" name="formmove_user" action="<?php echo $editFormAction; ?>?case_i=16">
  <table width="100%" border="0" align="center">
    <tr valign="top" bgcolor="#FFFFCC"> 
      <td colspan="4"><div align="center"><font color="#0000FF" size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>ย้ายกลุ่มผู้ใช้งาน</strong></font></div></td>
    </tr>
    <tr bgcolor="#FFCCCC"> 
      <td width="21%"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>ย้ายผู้ใช้จากกลุ่ม</strong></font></td>
      <td width="20%"> <font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
        <?php
	            $query_type = "SELECT *   FROM   radgroupreply   where   GroupName in ( select   GroupName  from radgroup_domain where domain='$doname_login')   
			and	 GroupName like '%@$doname_login%'     group by GroupName     ";
				$type_db = mysql_query($query_type, $connect_db) or die(mysql_error());
				$row_type = mysql_fetch_assoc($type_db);
				$totalRows_type= mysql_num_rows($type_db);
	  ?>
        <select name="GroupName1" id="GroupName1"      >
		   <option value="defult" >defult</option>
       
          <?php
												do {  
														  ?>
          <option value="<?php echo $row_type['GroupName']?>" ><?php echo $row_type['GroupName']?></option>
          <?php
								} while ($row_type = mysql_fetch_assoc($type_db));
								?>
        </select>
        </font></td>
      <td width="25%" bordercolor="#FFFF99"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>ไปยังกลุ่ม</strong></font></td>
      <td width="34%"> <font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
        <?php
	            $query_type = "SELECT *   FROM   radgroupreply   where GroupName in ( select   GroupName  from radgroup_domain where domain='$doname_login')  
				and  GroupName like '%@$doname_login%' group by GroupName     ";
				$type_db = mysql_query($query_type, $connect_db) or die(mysql_error());
				$row_type = mysql_fetch_assoc($type_db);
				$totalRows_type= mysql_num_rows($type_db);
	  ?>
        <select name="GroupName2" id="GroupName2"      >
     
          <?php
												do {  
														  ?>
          <option value="<?php echo $row_type['GroupName']?>" ><?php echo $row_type['GroupName']?></option>
          <?php
								} while ($row_type = mysql_fetch_assoc($type_db));
								?>
        </select>
        </font></td>
    </tr>
    <tr bgcolor="#CCFFFF"> 
      <td><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;</font></td>
      <td><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;</font></td>
      <td><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;
        <input name="move_user" type="submit" id="move_user" value="ย้ายกลุ่ม">
        </font></td>
      <td><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;</font></td>
    </tr>
  </table>

</form>
<br>

<form method="post" name="form1" action="<?php echo $editFormAction; ?>?case_i=16">
  <table width="740" align="center">
    <tr valign="baseline"> 
      <td width="362" align="right" nowrap bgcolor="#99FFCC"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><span class="style5">ชื่อกลุ่ม:</span></font></strong></td>
      <td width="315"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
        <input name="GroupName" type="text" id="GroupName" value="" >
        *ภาษา eng ห้ามมีช่องว่าง </font></td>
    </tr>
    <tr valign="baseline"> 
      <td align="right" nowrap bgcolor="#99FFCC"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">ความเร็ว&nbsp;Download</font></strong></td>
      <td><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
         <select name="Value">
		 <option value="101943040" selected>100M</option>
		 <option value="91943040"  >90M</option>
		 <option value="81943040"  >80M</option>
		 <option value="71943040"  >70M</option>
		 <option value="61943040" >60M</option>
		 <option value="51943040" >50M</option>
		<option value="41943040" >40M</option>
		<option value="31457280"  >30M</option>
		<option value="15728640"  >15M</option>
		<option value="10485760"  >10M</option>
		<option value="9437184"  >9M</option>
		 <option value="8388608"  >8M</option>
		  <option value="7340032"  >7M</option>
          <option value="6291456"  >6M</option>
          <option value="5242880"  >5M</option>
          <option value="4194304"  >4.5M</option>
          <option value="4096016"  >4M</option>
          <option value="3670016">3.5M</option>
          <option value="3145728">3M</option>
          <option value="2516582">2.5M</option>
          <option value="2097152">2M</option>
          <option value="1572864">1.5M</option>
          <option value="1048576">1M</option>
          <option value="800000">800k</option>
          <option value="512000">512k</option>
          <option value="300000">300k</option>
          <option value="256000">256k</option>
          <option value="150000">150k</option>
          <option value="128000">128k</option>
          <option value="100000">100k</option>
          <option value="80000">80k</option>
          <option value="64000">64k</option>
          <option value="32000">32k</option>
          <option value="16000">16k</option>
          <option value="8000">8k</option>
        </select>
        </font></td>
    </tr>
    <tr valign="baseline"> 
      <td align="right" nowrap bgcolor="#99FFCC"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">ความเร็ว&nbsp;Upload</font></strong></td>
      <td><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
         <select name="Value2">
		<option value="41943040" selected>40M</option>
		<option value="31457280"  >30M</option>
		<option value="15728640"  >15M</option>
		<option value="10485760"  >10M</option>
		<option value="9437184"  >9M</option>
		 <option value="8388608"  >8M</option>
		  <option value="7340032"  >7M</option>
          <option value="6291456"  >6M</option>
          <option value="5242880"  >5M</option>
          <option value="4194304"  >4.5M</option>
          <option value="4096016"  >4M</option>
          <option value="3670016">3.5M</option>
          <option value="3145728">3M</option>
          <option value="2516582">2.5M</option>
          <option value="2097152">2M</option>
          <option value="1572864">1.5M</option>
          <option value="1048576">1M</option>
          <option value="800000">800k</option>
          <option value="512000">512k</option>
          <option value="300000">300k</option>
          <option value="256000">256k</option>
          <option value="150000">150k</option>
          <option value="128000">128k</option>
          <option value="100000">100k</option>
          <option value="80000">80k</option>
          <option value="64000">64k</option>
          <option value="32000">32k</option>
          <option value="16000">16k</option>
          <option value="8000">8k</option>
        </select>
        </font></td>
    </tr>
    <?php // ?>
    <tr valign="baseline">
      <td align="right" nowrap bgcolor="#99FFCC"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><span class="style5">ระยะเวลา Auto Logout เมื่อผู้ใช้งานไม่ได้ใช้งานอินเตอร์เน็ต:</span></font></strong></td>
      <td><font size="2" face="MS Sans Serif, Tahoma, sans-serif">
 
        <select name="IdleTimeout" id="IdleTimeout">
 <option value="600" selected>10 นาที</option>
		 <option value="1200" >20 นาที</option>
		<option value="1800"  >30 นาที</option>
		<option value="3600"  >60 นาที</option>
		<option value="3600"  >60 นาที</option>
			<option value="600000"  >ไม่จำกัด</option>
	    </select>
      </font></td>
    </tr>
    <tr valign="baseline"> 
      <td align="right" nowrap bgcolor="#99FFCC"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">ระยะเวลาในการ 
        Login ต่อครั้ง</font></strong></td>
      <td><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
        <select name="timelogin" id="timelogin">
         
           <?php  $x = 1;
       while ($x <= 24) {
	   $timel=$x*3600;
      echo "<option value=\"$timel\">$x  ชั่วโมง</option>";
      $x++;
   }
   ?>
        </select>
        </font></td>
    </tr>
    <tr bordercolor="#FF8282">
      <td height="30" bgcolor="#FFCCCC"><div align="right"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;<strong>สามารถใช้ไอดี Login เดียวพร้อมๆ กัน </strong></font></div></td>
      <td height="30" bgcolor="#FFF2F2"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">
        <input name="Simultaneous" type="text" id="Simultaneous"  size="5" value="1" >
        * เครื่อง </font></td>
    </tr>
    <tr valign="baseline"> 
      <td align="right" nowrap bgcolor="#99FFCC"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">กำหนดเวลาหมดอายุการใช้งาน</font></strong></td>
      <td><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
        <input name="Expiration" type="checkbox" id="Expiration" value="1">
        </font></td>
    </tr>
    <tr valign="baseline"> 
      <td align="right" nowrap bgcolor="#99FFCC"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">วันหมดอายุการใช้งาน</font></strong></td>
      <td><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
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
        </font></td>
    </tr>
    <tr valign="baseline"> 
      <td align="right" nowrap bgcolor="#99FFCC"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>ชั่วโมง:นาที</strong>&nbsp;</font></td>
      <td><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
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
        </font></td>
    </tr>
    <tr bordercolor="#FF8282">
      <td height="30" bgcolor="#FFCCCC"><div align="right"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;<strong>URL ที่ให้เข้าหลัง login </strong></font></div></td>
      <td height="30" bgcolor="#FFF2F2"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">
        <input name="GroupName2s" type="text" id="GroupName2s"  >
      * ใส่ http:// ด้วย    </font></td>
    </tr>
    <tr valign="baseline"> 
      <td align="right" nowrap bgcolor="#99FFCC"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;</font></td>
      <td><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
        <input type="submit" value="บันทึก" name="submit" class="styled-button-2"  >
        </font></td>
    </tr>
  </table>
 
</form>
<?php
mysql_free_result($Recordset1);

function getdata($GroupName,$Attribute,$connect_db){
  $query_Recordset1 = "SELECT   *   FROM   radgroupreply         where   Attribute ='$Attribute'  and  GroupName='$GroupName' ";
$Recordset1 = mysql_query($query_Recordset1, $connect_db) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
return $row_Recordset1[Value];
}

function gettimess($init){
 
$hours = floor($init / 3600);
$minutes = floor(($init / 60) % 60);
$seconds = $init % 60;
if($hours=='0') { $h=NULL;} else { return  "$hours ชั่วโมง";}
if($minutes=='0') { $m=NULL;} else { return "$minutes นาที";}
 
}
function formatBytes($bytes, $precision = 2)
{  
    $kilobyte = 1024;
    $megabyte = $kilobyte * 1024;
    $gigabyte = $megabyte * 1024;
    $terabyte = $gigabyte * 1024;
   
    if (($bytes >= 0) && ($bytes < $kilobyte)) {
        return $bytes . ' B';
 
    } elseif (($bytes >= $kilobyte) && ($bytes < $megabyte)) {
        return round($bytes / $kilobyte, $precision) . ' KB';
 
    } elseif (($bytes >= $megabyte) && ($bytes < $gigabyte)) {
        return round($bytes / $megabyte, $precision) . ' MB';
 
    } elseif (($bytes >= $gigabyte) && ($bytes < $terabyte)) {
        return round($bytes / $gigabyte, $precision) . ' GB';
 
    } elseif ($bytes >= $terabyte) {
        return round($bytes / $terabyte, $precision) . ' TB';
    } else {
        return $bytes . ' B';
    }
}
 
?>
<p>&nbsp;</p>
</body>
</html>

