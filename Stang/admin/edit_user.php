<?php  include("../include/chklogin.php");  
include("../Connections/dbconnect.php");
?>
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
 <style type="text/css">
.styled-button-2 {
	-webkit-box-shadow:rgba(0,0,0,0.2) 0 1px 0 0;
	-moz-box-shadow:rgba(0,0,0,0.2) 0 1px 0 0;
	box-shadow:rgba(0,0,0,0.2) 0 1px 0 0;
	border-bottom-color:#333;
	border:1px solid #61c4ea;
	background-color:#7cceee;
	border-radius:5px;
	-moz-border-radius:5px;
	-webkit-border-radius:5px;
	color:#333;
	font-family:'Verdana',Arial,sans-serif;
	font-size:14px;
	text-shadow:#b2e2f5 0 1px 0;
	padding:5px
}
</style>
<style type="text/css">

table.imagetable {
	font-family: verdana,arial,sans-serif;
	font-size:11px;
	color:#333333;
	border-width: 1px;
	border-color: #999999;
	border-collapse: collapse;
}
table.imagetable th {
	background:#b5cfd2 url('cell-blue.jpg');
	border-width: 1px;
	padding: 8px;
	border-style: solid;
	border-color: #999999;
}
table.imagetable td {
	background:#dcddc0 url('cell-grey.jpg');
	border-width: 1px;
	padding: 8px;
	border-style: solid;
	border-color: #999999;
}
</style>
<body background="images/bg1.gif">
<?php
  include("FCKeditor/fckeditor.php") ;  
mysql_select_db($database_db, $connect_db);
if($Submit=="แก้ไขข้อมูลสมาชิก") {
if($_SESSION["adminpass"]=='demo'){
      echo                  "<script type=text/javascript>";
		    echo                  "alert('ผู้ใช้ ทดสอบระบบ ไม่สามารถแก้ไขข้อมูลได้ :P ')";
	        echo                  "</script>";  
 
exit();
}

  $id_edit = htmlspecialchars("$id_edit", ENT_QUOTES);
 $password = htmlspecialchars("$password", ENT_QUOTES);
 $room = htmlspecialchars("$room", ENT_QUOTES);
 $fullname = htmlspecialchars("$fullname", ENT_QUOTES);
 $email = htmlspecialchars("$email", ENT_QUOTES);
 $tel = htmlspecialchars("$tel", ENT_QUOTES);
  $site = htmlspecialchars("$site", ENT_QUOTES);
   $strID = htmlspecialchars("$strID", ENT_QUOTES);
      $macaddress = htmlspecialchars("$macaddress", ENT_QUOTES);
   $strID = htmlspecialchars("$strID", ENT_QUOTES);
$pattern = '/;/i';
$replacement = NULL;
$UserName= preg_replace($pattern, $replacement, $UserName);
$password= preg_replace($pattern, $replacement, $password);
$room= preg_replace($pattern, $replacement, $room);
$fullname= preg_replace($pattern, $replacement, $fullname);
$email= preg_replace($pattern, $replacement, $email);
$tel= preg_replace($pattern, $replacement, $tel);
$site= preg_replace($pattern, $replacement, $site);
$strID= preg_replace($pattern, $replacement, $strID);
$macaddress= preg_replace($pattern, $replacement, $macaddress);

include("../include/function.php");
update("radcheck","op ='=='  "," where      Attribute='Calling-Station-Id'      ");   

$pattern = '/ /i';
$replacement =NULL;
$macaddress= preg_replace($pattern, $replacement, $macaddress);
 if($macaddress =="0")  {   
 $sql = "delete  from  radcheck  where  Attribute ='Calling-Station-Id'     and   UserName='$id_edit'  ";
$dbquery = mysql_select_db($database_edoc); mysql_query($sql) or trigger_error(mysql_error(),E_USER_ERROR); 
$macaddress =null;
 }
 
update("register","fullname ='$fullname',per='$per',room='$room',tel='$tel',email='$email'  ,site='$site' ,idstd='$idstd'   , msg='$msg',vpn='$vpn' "," where UserName='$id_edit'    "); 

if($toall =='toall' ){  update("register"," msg='$msg' "," where UserName !=''    ");   }

update("usergroup", "GroupName='$GroupName' ,domain='$domain_name' "," where UserName='$id_edit'    "); 
if($macaddress !='')  {  
				$query_mac = "SELECT  *   FROM   radcheck   where Attribute ='Calling-Station-Id'    and   UserName='$id_edit' ";
				$type_mac = mysql_query($query_mac, $connect_db) or die(mysql_error());
				$row_mac= mysql_fetch_assoc($type_mac);
                $totalRows_mac= mysql_num_rows($type_mac);
				if($totalRows_mac >0) {  update("radcheck", "Value ='$macaddress'  "," where Attribute ='Calling-Station-Id'    
				                                                    and   UserName='$id_edit'    ");   } //if($totalRows_mac >0) 
				
				if($totalRows_mac ==0 or $totalRows_mac ==null ) {   
				                    mysql_query("INSERT INTO  radcheck   (UserName,Attribute,op,Value  )
		                                                                     values('$id_edit','Calling-Station-Id','==','$macaddress' )  ")  or trigger_error(mysql_error(),E_USER_ERROR); 
				   } //if($totalRows_mac ==0 or $totalRows_mac ==null )
 }
 
####จัดการรูปที่ upload เข้ามา
if (    $_FILES['files_name']['name'] != ""      )  

  {    
                                  $path = "/var/www/pic_user" ; // ตรวจสอบว่ามีFolder pic_user หรือไม่ ถ้าไม่มีก็สร้างขึ้นมา
				                           if(!is_dir($path)){
									        	mkdir($path,0777) ;   }
$Upload_name=$_FILES['files_name']['name'];//เอาชื่อไฟล์ที่อัพโหลดมาใส่ในตัวแปร  $Upload_name
$Upload_Type=$_FILES['files_name']['type']; //เอา=ชนิด ไฟล์ที่อัพโหลดมาใส่ในตัวแปร  $Upload_Type
$Path_Upload_server=$_FILES['files_name']['tmp_name']; //ที่เก็บไฟล์ tmp บน server
$lang_name=strlen($Upload_name); //หาความยาวตัวอักษรทั้งหมด
$new_name = date("d-m-Y-H-i-s");  //ดึงเวลาปัจจุบันใส่ค่าตัวแปร
$Fname = substr($Upload_name,0,strpos($Upload_name,"."));  //ตัดชื่อไฟลล์ เอามาเฉพาะนามสกุลไฟล์ เนื่องจากจะไปเปลี่ยน ชื่อไฟลเป็นวันที่อัพโหลดแทน
 
$new_name = preg_replace("/$Fname/i", "$new_name", $Upload_name); // เปลี่ยนชื่อ ไฟล์ เป็นวันที่ปัจวันที่ปัจจุบัน
$new_name2="pic_user/$new_name";
copy($Path_Upload_server,"/var/www/$new_name2");
mysql_query("update   register  set   pic_user= '$new_name2' where  UserName='$id_edit'  " ) or    die ("แก้ไข ข้อมูลลง Table ไม่ได้ ");
}
echo "<center><b>Edit Data Ok....</b></center>";
if($logout==1)
           {

############## รัน chilli ใหม่
echo '<pre>';

// Outputs all the result of shellcommand "ls", and returns
// the last output line into $last_line. Stores the return value
// of the shell command in $retval.
$last_line = system("/usr/bin/sudo   /bin/echo   User-Name=$id_edit    |   /usr/bin/radclient     -x 127.0.0.1:3779 disconnect testing123", $retval);

// Printing additional info
echo '
</pre>
<hr />Last line of the output: ' . $last_line . '
<hr />Return value: ' . $retval;
###################
                }
}

$query_user = "SELECT 
  usergroup.GroupName,
  radgroupreply.Attribute  ,
  radgroupreply.Value  As banwith,
  radgroupreply.op,
  register.`status`,
  register.UserName,
  register.password,
  register.fullname,
  register.per,
  register.room,
  register.tel,
   register.pic_user,
  register.email,
  register.site,
   register.msg,
  register.idstd,
   register.vpn
FROM
  register
  INNER JOIN usergroup ON (register.UserName = usergroup.UserName)
  INNER JOIN radgroupreply ON (usergroup.GroupName = radgroupreply.GroupName)
     where register.UserName='$id_edit' ";
$user_db = mysql_query($query_user, $connect_db) or die(mysql_error());
$row_user = mysql_fetch_assoc($user_db);
$totalRows_user= mysql_num_rows($user_db);

				$query_mac = "SELECT  *   FROM   radcheck   where Attribute ='Calling-Station-Id'    and   UserName='$id_edit' ";
				$type_mac = mysql_query($query_mac, $connect_db) or die(mysql_error());
				$row_mac= mysql_fetch_assoc($type_mac);
 
?><br>
<form action="edit_user.php" method="post" enctype="multipart/form-data" name="form1" >
  <table width="377" border="0" align="center"  class="imagetable">
    <tr bgcolor="#00AA00" > 
      <th colspan="2"><div align="center"><strong><font size="3" face="MS Sans Serif, Tahoma, sans-serif">รายละเอียด 
          ผู้ใช้งาน</font></strong></div></th>
    </tr>
    <tr > 
      <th width="38%" height="22" bgcolor="#59FF59"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">ชื่อ 
        Login</font></strong></th>
      <td width="62%" height="22" bgcolor="#CEFFCE"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
        &nbsp;&nbsp;&nbsp; 
        <input name="id_edit"   type="text"  id="id_edit" value="<?php echo $row_user['UserName']?>" >
      </font></td>
    </tr>
    <tr> 
      <th height="22" bgcolor="#59FF59"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
        ชื่อ-นามสกุล </font></strong></th>
      <td height="22" bgcolor="#CEFFCE"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;&nbsp;&nbsp; 
        <input name="fullname"   type="text"  id="fullname" value="<?php echo $row_user['fullname']?>" >
        </font></td>
    </tr>
    <tr> 
      <th height="22" bgcolor="#59FF59"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
        เลขที่ห้องพัก </font></strong></th>
      <td height="22" bgcolor="#CEFFCE"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;&nbsp;&nbsp; 
        <input name="room"   type="text"  id="room" value="<?php echo $row_user['room']?>" >
        </font></td>
    </tr>
    <tr> 
      <th height="22" bgcolor="#59FF59"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
        </font><font size="2" face="MS Sans Serif, Tahoma, sans-serif">รหัสนักศึกษา</font></strong></th>
      <td height="22" bgcolor="#CEFFCE"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;&nbsp;&nbsp; 
        <input name="idstd"   type="text"  id="idstd" value="<?php echo $row_user['idstd']?>" >
        </font></td>
    </tr>
    <tr> 
      <th height="22" bgcolor="#59FF59"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
        เบอร์ที่ติดต่อได้ </font></strong></th>
      <td height="22" bgcolor="#CEFFCE"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;&nbsp;&nbsp; 
        <input name="tel"   type="text"  id="tel" value="<?php echo $row_user['tel']?>">
        </font></td>
    </tr>
    <tr> 
      <th height="22" bgcolor="#59FF59"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
        E-mail </font></strong></th>
      <td height="22" bgcolor="#CEFFCE"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;&nbsp;&nbsp; 
        <input name="email"   type="text"  id="email" value="<?php echo $row_user['email']?>">
        </font></td>
    </tr>
    <tr> 
      <th height="22" bgcolor="#59FF59"><strong><font size="2"><font face="MS Sans Serif, Tahoma, sans-serif">เลขประจำตัวประชาชน</font></font></strong></th>
      <td height="22" bgcolor="#CEFFCE"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;&nbsp;&nbsp; 
        <input name="per"   type="text"  id="per" value="<?php echo $row_user['per']?>">
        </font></td>
    </tr>
    <tr> 
      <th height="22" bgcolor="#59FF59"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> หอพัก / Apartment Name / Site name</font></strong></th>
      <td height="22" bgcolor="#CEFFCE"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;&nbsp; 
        <input name="site"   type="text"  id="site" value="<?php echo $row_user['site']?>">
        </font></td>
    </tr>
    <tr> 
      <th height="22" bgcolor="#59FF59"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">อยู่ในกลุ่ม</font></strong></th>
      <td height="22" bgcolor="#CEFFCE"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;&nbsp;&nbsp; 
        <?php
	            $query_type = "SELECT *   FROM   radgroupreply   where  GroupName like '%@$domain_name' group by GroupName order by  GroupName  DESC      ";
				$type_db = mysql_query($query_type, $connect_db) or die(mysql_error());
				$row_type = mysql_fetch_assoc($type_db);
				$totalRows_type= mysql_num_rows($type_db);
				

	  ?>
        <select name="GroupName" id="GroupName"      >
          <option value="<?php echo $row_user['GroupName']?>" ><?php echo $row_user['GroupName']?></option>
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
   <?php /*
    <tr> 
      <td height="22" bgcolor="#59FF59"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>MAC 
        Address <br>
        ที่ต้องการ lock</strong></font></td>
      <td height="22" bgcolor="#CEFFCE">&nbsp;&nbsp;<font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
        <input name="macaddress"   type="text"  id="macaddress" value="<?php echo $row_mac['Value']?>">
        <br>
        <strong>เช่น 00-1D-72-18-A8-0C<br>
        กรณี จะลบ mac ให้ใส่ 0 ตัวเดียวแทน</strong></font></td>
    </tr>
	*/
	?>
    <tr> 
      <th height="22" bgcolor="#59FF59"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>รูปบัตรประชาชน</strong></font></th>
      <td height="22" bgcolor="#CEFFCE"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><a href="../<?php print $row_user['pic_user'];?>" target="_blank">คลิก</a></font></td>
    </tr>
       
    
	<?php /* 
    <tr> 
      <td height="22" bgcolor="#59FF59"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>ส่งข้อความถึง 
        ผู้ใช้งาน</strong></font></td>
      <td height="22" bgcolor="#CEFFCE"><input name="toall" type="checkbox" id="toall" value="toall">
        <font color="#FF0000" size="2" face="MS Sans Serif, Tahoma, sans-serif">ส่งข้อความนี้ถึงทุกคน</font>      </td>
    </tr>
    <tr> 
      <td height="22" colspan="2" bgcolor="#59FF59"><div align="center">
          
		     <?php
 
							$FCKeditor = new FCKeditor('msg') ;
							//$FCKeditor->Config['CustomConfigurationsPath'] = "FCKeditor/fckeditor.js" ;
							 $FCKeditor->ToolbarSet ="Basic" ;
							$FCKeditor->BasePath = "FCKeditor/";
							$FCKeditor->Width = '260';
							$FCKeditor->Height = '60';
							$FCKeditor->Value =$row_user[msg];
							$FCKeditor->Create() ;
							
							
                ?>
        </div></td>
    </tr>
 */
 ?>
    <tr> 
      <th height="22" bgcolor="#59FF59"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>MAC 
        Address <br>
        ที่ต้องการ lock</strong></font></th>
      <td height="22" bgcolor="#CEFFCE">&nbsp;&nbsp;<font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
        <input name="macaddress"   type="text"  id="macaddress" value="<?php echo $row_mac['Value']?>">
        <br>
        <strong>เช่น 00-1D-72-18-A8-0C<br>
        กรณี จะลบ mac ให้ใส่ 0 ตัวเดียวแทน</strong></font></td>
    </tr>
    <tr> 
      <td height="22" bgcolor="#59FF59">&nbsp;</td>
      <td height="22" bgcolor="#CEFFCE"> <font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
        <input type="submit" name="Submit" value="แก้ไขข้อมูลสมาชิก"  class="styled-button-2"  >
        </font></td>
    </tr>
  </table>
   
</form>
<?php  
mysql_close($connect_db);
?>
<p align="center">
    <font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong># หากกำหนด  MAC Address 
    user นี้จะได้เฉพาะ mac ที่กำหนดเท่านั้น#</strong></font></p>
  <p align="center"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">หากต้องการลบ 
    option นี้ให้ลบข้อความในช่อง Mac Address ออก <br>
    User นี้จะสามารถ login จากเครื่องอื่นได้ตามปกติ</font></strong></p></body>
</html>
