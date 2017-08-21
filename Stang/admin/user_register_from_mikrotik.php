<?php
ob_start();
@session_start(); 
 extract($_POST);extract($_GET);extract($_REQUEST);
//if($_SERVER['SERVER_PORT'] != 443) {
//    header("HTTP/1.1 301 Moved Permanently");
//    header("Location: https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
//    exit();

//}

//  print_r($_POST);
 // print '<br>';
//  print_r($_GET);
//if($_GET[domain_name]==NULL){
//exit();
//}

$SENDSMSNAME='020000000';
include("../Connections/dbconnect.php");
include("../include/function.php");
//unset($_SESSION[chk_mobiles]);	
//print_r($_SESSION);

 //if($_SESSION[chk_mobiles]==$_POST[mobiles]  and  $_POST['uhz']=='OK') {   //กรณี ป้อนรหัสยืนยัน
 if( $_GET['uhz']=='OK') {   //กรณี ป้อนรหัสยืนยัน
 if($domain_name ==NULL)
{
echo "<meta http-equiv=refresh content=0;URL=http://www.google.co.th>"; 
exit();
}
 
 update("register","status ='1'","where UserName ='$UserName'");  
 mysql_query("INSERT INTO  radcheck     (UserName,Attribute ,op ,Value)
		                                                                          values('$UserName','MD5-Password',':=','$password')") or die(mysql_error());
mysql_query("INSERT INTO  usergroup     (UserName,GroupName ,priority,domain)
		                                                                          values('$UserName','defult','1','$domain_name')") or die(mysql_error());
																				  
		if($domain_name=='mitsix'   or  $domain_name=='tabsala' ) {$data_datessss='01 Dec 2020 00:00:00'; }	
																			  
 mysql_query("INSERT INTO  radcheck  (UserName,Attribute,op,Value)
		      values('$UserName', 'Expiration',':=','$data_datessss'   )") or    die ("Add ข้อมูลลง Table ไม่ได้ ");		
			  
// mysql_query("INSERT INTO  radcheck  (UserName,Attribute,op,Value)
//		      values('$UserName', 'Auth-Type',':=','Local'   )") or    die ("Add ข้อมูลลง Table ไม่ได้ ");		 	 																				  
################# บังคับใช้งานคนเดียว
/*
mysql_query("INSERT INTO  radcheck  (UserName,Attribute,op,Value)
		      values('$UserName', 'Simultaneous-Use',':=','1'   )") or    die ("Add ข้อมูลลง Table ไม่ได้ ");		 	
	*/		  
			  unset($_SESSION[chk_mobiles]);																			  
#################

if($domain_name=='mitsix'   or  $domain_name=='tabsala' ) {
 	            echo                  "<script type=text/javascript>";
 		    echo                  "alert('สมัครสำเร็จแล้ว  ')";
         echo                  "</script>";
		  echo "<meta http-equiv=refresh content=0;URL=http://www.google.co.th"; 
		 exit();
}
	if($domain_name !='mitsix') {
 	            echo                  "<script type=text/javascript>";
 		    echo                  "alert('$text30  โปรดเติมเวลาการใช้งาน  ')";
         echo                  "</script>";
		 }
		 if($_GET[domain_name] !='huzzun') {
		       echo "<meta http-equiv=refresh content=0;URL=http://www.stangwifi.com/active.php?domain_name=$_GET[domain_name]>&per=$UserName"; 
			   }
			   else {
			     echo "<meta http-equiv=refresh content=0;URL=http://www.stangwifi.com/huzzun_card_active.php?domain_name=$_GET[domain_name]>&per=$UserName"; 
			   }
		 	exit();  
		  
}  //จบ //กรณี ป้อนรหัสยืนยัน
?>
<HTML>
<HEAD>
<TITLE>REGISTER ONLINE</TITLE>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<link href="main.css" rel="stylesheet" type="text/css">
<script src="selectuser.js"></script>
<style type="text/css">
<!--
.style2 {font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;}
.style8 {font-size: 12px; font-family: Verdana, Arial, Helvetica, sans-serif; }
.style2 {font-size: 12px}
.style11 {font-family: Verdana, Arial, Helvetica, sans-serif}
.style13 {font-size: 12px; font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; }
-->
</style>
</HEAD>


<BODY leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" >
<?php

function randomPasswordsystem($len) {
    {
	srand((double)microtime()*10000000);
	$chars = "123456789";
	$ret_str = "";
	$num = strlen($chars);
	for($i = 0; $i < $len; $i++)
	{
		$ret_str.= $chars[rand()%$num];
		$ret_str.=""; 
	}
	return $ret_str; 
}
}


if($_SESSION["langs"]=='') {
$_SESSION["langs"]="th.php";
} 
$ll=$_SESSION["langs"];

include("../lang/$ll");


if($submit=="Save" and $Submit =="") {  //กรอกขอมูล การสมัคร
   require('PHPMailer/class.phpmailer.php');
 require('PHPMailer/class.smtp.php');

  if($domain_name ==NULL)
{
echo "<meta http-equiv=refresh content=0;URL=http://www.google.co.th>"; 
exit();
}
$pattern = '/-/i';
$replacement = NULL;
$tel= preg_replace($pattern, $replacement, $tel);

$pattern = '/ /i';
$replacement = NULL;
$tel= preg_replace($pattern, $replacement, $tel);

$query_user = "select  *  from register     where               tel='$tel'                      ";
$type_db = mysql_query($query_user, $connect_db) or die(mysql_error());
$totalRows_user= mysql_num_rows($type_db);
if(    $totalRows_user > 0 ) 
{   //ตรวจสอบว่า มี userlogin นี้อยุ่หรือไม่
            echo                  "<script type=text/javascript>";
		    echo                  "alert('มีการใช้เบอร์ $tel นี้แล้วใน ระบบ ')";
	        echo                  "</script>";
		        echo "<meta http-equiv=refresh content=0;URL=user_register_from_mikrotik.php?domain_name=$domain_name>"; 
		 	exit();
}  //ตรวจสอบว่า มี userlogin นี้อยุ่หรือไม่

if($password=="")
	{
	  unset($_SESSION[chk_mobiles]);		
  	         echo                  "<script type=text/javascript>";
		    echo                  "alert('$text23 ')";
	        echo                  "</script>";  
		    echo "<meta http-equiv=refresh content=0;URL=user_register_from_mikrotik.php?domain_name=$domain_name>"; 
		 	exit();  	
}
if($password2  != $password)
{
  unset($_SESSION[chk_mobiles]);		
  	         echo                  "<script type=text/javascript>";
		    echo                  "alert('$text24  ')";
	        echo                  "</script>";  
		    echo "<meta http-equiv=refresh content=0;URL=user_register_from_mikrotik.php?domain_name=$domain_name>"; 
		 	exit();  	
}

//iรหัสผ่านสองครั้งตรงกัน
  $UserName = htmlspecialchars("$UserName", ENT_QUOTES);
 $password = htmlspecialchars("$password", ENT_QUOTES);
 $room = htmlspecialchars("$room", ENT_QUOTES);
 $fullname = htmlspecialchars("$fullname", ENT_QUOTES);
 $email = htmlspecialchars("$email", ENT_QUOTES);
 $tel = htmlspecialchars("$tel", ENT_QUOTES);
 $site = htmlspecialchars("$site", ENT_QUOTES);
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

 
if($UserName ==""  or $password==""     or $fullname==""   or $strID=="")  {
  unset($_SESSION[chk_mobiles]);		
  	         echo                  "<script type=text/javascript>";
		    echo                  "alert('กรุณา กรอกข้อมูล  ชื่อ นามสกุล  หมายเลขบัตรประชาชน             ')";
	        echo                  "</script>";  
		    echo "<meta http-equiv=refresh content=0;URL=user_register_from_mikrotik.php?domain_name=$domain_name>"; 
		 	exit();  
			}
			

 
 if(preg_match ("/[[:punct:]]/",$UserName))  {  
 
   	         echo                  "<script type=text/javascript>";
		    echo                  "alert('   $text26  ')";
	        echo                  "</script>";  
		  echo "<meta http-equiv=refresh content=0;URL=user_register_from_mikrotik.php?domain_name=$domain_name>"; 
		 	exit();  
}
  
$query_user = "select  *  from register     where               UserName='$UserName'      and domain='$domain_name'                  ";
$type_db = mysql_query($query_user, $connect_db) or die(mysql_error());
$totalRows_user= mysql_num_rows($type_db);

if(    $totalRows_user > 0 ) 
{   //ตรวจสอบว่า มี userlogin นี้อยุ่หรือไม่
  unset($_SESSION[chk_mobiles]);		
            echo                  "<script type=text/javascript>";
		    echo                  "alert('$text29 ')";
	        echo                  "</script>";
		       echo "<meta http-equiv=refresh content=0;URL=user_register_from_mikrotik.php?domain_name=$domain_name>"; 
		 	exit();
}  else 
{      


$query_user = "select  *  from radcheck       where               UserName='$UserName'            ";

$type_db = mysql_query($query_user, $connect_db) or die(mysql_error());

$totalRows_user= mysql_num_rows($type_db);

if(    $totalRows_user > 0 ) 
{   //ตรวจสอบว่า มี userlogin นี้อยุ่หรือไม่
  unset($_SESSION[chk_mobiles]);		
            echo                  "<script type=text/javascript>";
		    echo                  "alert('$text29 ')";
	        echo                  "</script>";
		    echo "<meta http-equiv=refresh content=0;URL=user_register_from_mikrotik.php?domain_name=$domain_name>"; 
		 	exit();
} 

 
$register_day=date("Y-m-d H:i:s");
$passsystem=$password;
$password=md5($password);
mysql_query("INSERT INTO  register    (UserName,password,per,room,tel,fullname,status,email,site,register_day,idstd,domain,pass_rec)
		      values('$UserName','$password','$strID','$room','$tel','$fullname','0','$email','$site','$register_day','$idstd','$domain_name','$passsystem')") or die(mysql_error());
 
  
// ส่ง sms ยืนยัน + email
$data_detail="$domain_name <br> wifi user = $UserName <br> pass = $password";
$data_detail= iconv( 'TIS-620', 'UTF-8', "$data_detail");
$query_gmail= " SELECT   gmail_user,gmail_pass FROM seting   ";
$subject="REGISTER FOR $domain_name";
$gmails_qr= mysql_query($query_gmail, $connect_db) or die(mysql_error());
$row_gmail = mysql_fetch_assoc($gmails_qr);
$gmail_user=$row_gmail['gmail_user'];
$gmail_pass=$row_gmail['gmail_pass'];

###################
$mail=new PHPMailer();
$mail->IsSMTP();
$mail->IsHTML(true);
$mail->SMTPAuth = "true";
$mail->SMTPSecure = "ssl";
$mail->Host ="smtp.gmail.com";
$mail->Port = 465;
$mail->CharSet = 'utf-8';
$mail->Username = "$gmail_user";
$mail->Password = "$gmail_pass";
 $mail->AddAddress("$email");
$mail->AddAddress("admin@thaigqsoft.com");
$mail->Send();
$mail->Subject = "$subject ";
$mail->AltBody = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

$mail->MsgHTML("$data_detail");
//include("sms.php");
#sms เสียข้ามขั้นตอนยืนยันไปก่อน
    echo "<meta http-equiv=refresh content=0;URL=user_register_from_mikrotik.php?domain_name=$domain_name&uhz=OK&UserName=$UserName&password=$password>"; 
exit();
?>
<hr>
<form name="chkmobile"  method="post" action="user_register_from_mikrotik.php?domain_name=<?php print  $domain_name;?>">
<table width="652" border="0" align="center">
  <tr>
    <td width="295">โปรดกรอกรหัสเลขยืนยันที่ได้รับจากข้อความ SMS ที่เบอร์&nbsp; <?php print $tel;?><br>
Please enter confirmation code number to receive SMS messages from the phone&nbsp;<?php print $tel;?>.</td>
    <td width="159">
         <input type="text" name="mobiles" >
	     <input type="hidden" name="uhz" value="OK">
         <input type="hidden" name="UserName" value="<?php print $UserName;?>">
		<input type="hidden" name="password" value="<?php print $password;?>">
		<input type="hidden" name="domain_name" value="<?php print $_GET[domain_name];?>">
 	</td>
    <td width="132"><input type="submit" name="Submit" value="Submit"></td>
  </tr>
</table>

</form>
<hr>
<?php
  	$SMSSQL = " SELECT   * from sms_seting where domain='$domain_name'    ";
	$Recordsetsms= mysql_query($SMSSQL, $connect_db) or die(mysql_error());
	$row_sms = mysql_fetch_assoc($Recordsetsms);
	
 $sms = new thsms();
$sms->username   = $row_sms[users];
$sms->password   = $row_sms[pass];
$textarea=randomPasswordsystem(4);
$_SESSION[chk_mobiles]=$textarea;
$cccc="$domain_name หมายเลขการสมัครเล่นอินเตอร์เน็ตคือ $textarea";
$cccc=  iconv('TIS-620', 'UTF-8', $cccc);
$b = $sms->send( "$SENDSMSNAME", $tel, $cccc);
 
 $texts="ส่ง sms ยืนยันการสมัคร ไอดี ไปที่เบอร์ $tel ";
 
$bdate=date("Y-m-d H:i:s");
mysql_query("INSERT INTO  noute_data  (UserName,texts,date_add,admin,domain)
		      values('$idcard', '$texts','$bdate'  ,'system','$domain_name' )") or trigger_error(mysql_error(),E_USER_ERROR);     

		   
}

 


}



if($_SESSION[chk_mobiles]==NULL){
?>
<br>
 

<form action="user_register_from_mikrotik.php?domain_name=<?php print $_GET['domain_name'];?>" method="post" enctype="multipart/form-data" name="form1" onSubmit="return chkIDCard()">
  <table width="800" height="397" border="0" align="center" cellpadding="0" cellspacing="0" background="oo.jpg">
  <tr>
    <td width="511" height="800"> 
      <table width="800" height="394" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="17" height="394" valign="top"><br></td>
        <td width="492" valign="top"><table width="493" height="70" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
              <td bgcolor="#FFFF99"><div align="center"><span class="style13">
  <br>
 กรุณา กรอกเลขเบอร์โทรศัพท์ มือถือที่ใช้งานได้เพราะระบบจะใช้ส่งข้อความการยืนยันเป็นขั้นตอนสุดท้าย
  <br>Please enter your phone number. Mobile applications because the system will send a confirmation message to the last step. <br>
  <?php print $text31;?></span></div></td>
            </tr>
          </table>
              <table width="800" height="447" border="0" align="left" cellpadding="1" cellspacing="1">
                <tr valign="baseline"> 
                  <td width="298" align="right" nowrap bgcolor="#C2E860" class="style8"><div align="left"><strong><font color="#333333">ชื่อเข้าใช้งาน  /User login:
                <span class="style11">:</span></font></strong></div><br></td>
                  <td bgcolor="#E6F5BA" class="style2"><strong><font color="#333333" size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
                    <input name="UserName" type="text" class="input" id="UserName" size="25"  onKeyUp="showUser(this.value)">
                    *  <?php print $text32;?><br>
                    <div id="txtHint"> </div>
                    </font></strong></td>
                  <td bgcolor="#C2E860" class="style2"><div align="center"></div></td>
                </tr>
                <tr valign="baseline"> 
                  <td align="right" nowrap bgcolor="#C2E860" class="style2"><div align="left"><strong><span class="style2"><font color="#333333">รหัสผ่าน / Password</font></span></strong></div></td>
                  <td bgcolor="#E6F5BA" class="style2"><strong><font color="#333333" size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
                    <input name="password" type="password" class="input" id="password" value="" size="25">
                    * </font></strong></td>
                  <td bgcolor="#C2E860" class="style2"> </td>
                </tr>
                <tr valign="baseline">
                  <td align="right" nowrap bgcolor="#C2E860" class="style2"><div align="left"><strong><font color="#333333">ยันยัน รหัสผ่าน / Re Password </font></strong></div> </td>
                  <td bgcolor="#E6F5BA" class="style2"><input name="password2" type="password" class="input" id="password2" value="" size="25">
                  <strong><font color="#333333" size="2" face="MS Sans Serif, Tahoma, sans-serif"> *</font></strong></td>
                  <td bgcolor="#C2E860" class="style2">&nbsp;</td>
                </tr>
                <tr valign="baseline"> 
                  <td align="right" nowrap bgcolor="#C2E860" class="style2"><div align="left"><strong><span class="style2">
                  <font color="#333333">ชื่อนามสกุล / Full Name .</font></span></strong></div></td>
                  <td bgcolor="#E6F5BA" class="style2"><strong><font color="#333333" size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
                    <input name="fullname" type="text" class="input" id="fullname" value="" size="25">
                    * </font></strong></td>
                  <td bgcolor="#C2E860" class="style2"><div align="center"><span class="style8"><font color="#0000CC">
                  <font color="#333333"> <?php print $text36;?></font></font></span></div></td>
                </tr>
  <?php      if($_GET['domain_name'] =='bx28') {     ?>
             <tr valign="baseline"> 
                  <td height="22" align="right" nowrap bgcolor="#C2E860" class="style2"><div align="left"><strong><font color="#333333">ตำแหน่ง / Position.</font></strong></div></td>
                  <td colspan="2" bgcolor="#E6F5BA" class="style2"><strong><font color="#333333" size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
                    <input name="room" type="text" class="input" id="room" value="" size="25">
                    * ไม่มีไม่ต้องใส่ </font></strong></td>
                </tr>
				<?php } else { 
				if( $_GET['domain_name'] =='tabsala' ) {  $aaaa='ชั้นปี. ' ;} else {  $aaaa='เลขที่ห้องพัก / Number of rooms.'; }?>
	             <tr valign="baseline"> 
                  <td height="22" align="right" nowrap bgcolor="#C2E860" class="style2"><div align="left"><strong><font color="#333333"> <?php print $aaaa; ?></font></strong></div></td>
                  <td colspan="2" bgcolor="#E6F5BA" class="style2"><strong><font color="#333333" size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
                    <input name="room" type="text" class="input" id="room" value="" size="25">
                    * ไม่มีไม่ต้องใส่ </font></strong></td>
                </tr>
				<?php } ?>		
				 <?php      if($_GET['domain_name'] =='bx28' or $_GET['domain_name'] =='tabsala'  ) {     ?>	
                <tr valign="baseline"> 
                  <td align="right" nowrap bgcolor="#C2E860" class="style8"><div align="left"><strong><font color="#333333">สังกัดส่วนงาน /Under the segment.</font></strong></div></td>
                  <td colspan="2" bgcolor="#E6F5BA" class="style2"><strong><font color="#333333" size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
                    <input name="site" type="text" class="input" id="site" value="" size="25">
                    * ไม่มีไม่ต้องใส่ </font></strong></td>
                </tr>
					<?php } else { ?>
					                <tr valign="baseline"> 
                  <td align="right" nowrap bgcolor="#C2E860" class="style8"><div align="left"><strong><font color="#333333">หอพัก / Apartment Name / Site name</font></strong></div></td>
                  <td colspan="2" bgcolor="#E6F5BA" class="style2"><strong><font color="#333333" size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
                    <input name="site" type="text" class="input" id="site" value="" size="25">
                    * ไม่มีไม่ต้องใส่  </font></strong></td>
                </tr>
					<?php } ?>	
                <tr valign="baseline"> 
 
 <td align="right" nowrap bgcolor="#C2E860" class="style8"><div align="left"><strong><span class="style2">
                  <font color="#333333">เลขประจำตัวประชาชน / Passport number.</font></span></strong></div></td>
				  
                  <td colspan="2" bgcolor="#E6F5BA" class="style2"><strong><font color="#333333" size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
                    <input name="strID" type="text" class="input" id="strID" value="" size="25" onKeyUp="showper(this.value)">
                    *   <div id="txtHint2"> </div></font></strong></td>
                </tr>
                <tr valign="baseline"> 
                  <td align="right" nowrap bgcolor="#C2E860" class="style8"><div align="left"><strong><span class="style2">
                  <font color="#333333">รหัสประจำตัวนักศึกษา / Student ID.</font></span></strong></div></td>
                  <td bgcolor="#E6F5BA" class="style2"><strong><font color="#333333" size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
                    <input name="idstd" type="text" class="input" id="idstd" value="" size="25">
                  </font><font color="#333333">
                    ex 314100484617</font><font color="#333333" size="2" face="MS Sans Serif, Tahoma, sans-serif"><br>
                 
                    </font></strong></td>
                  <td bgcolor="#C2E860" class="style8"><div align="center"><font color="#333333"> ไม่มีใส่ - แทน 
                      </font></div></td>
                </tr>
                <tr valign="baseline"> 
                  <td height="34" align="right" nowrap bgcolor="#C2E860" class="style2"><div align="left"><strong><span class="style2"><font color="#333333">TEL</font></span></strong></div></td>
                  <td bgcolor="#E6F5BA" class="style2"><strong><font color="#333333" size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
                    <input name="tel" type="text" class="input" id="tel" value="" size="25">
                    * </font></strong></td>
                  <td bgcolor="#C2E860" class="style8"><div align="center"><font color="#0000CC"><font color="#333333"><?php print $text38;?> 
                      </font></font></div></td>
                </tr>
                <tr valign="baseline"> 
                  <td align="right" nowrap bgcolor="#C2E860" class="style8"><div align="left"><strong><font color="#333333">E-Mail</font></strong></div></td>
                  <td bgcolor="#E6F5BA" class="style2"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><font color="#333333"> 
                    <input name="email" type="text" class="input" id="email" value="" size="25"  onKeyUp="showemail(this.value)">
                   
                    </font></font></strong><strong><font color="#333333" size="2" face="MS Sans Serif, Tahoma, sans-serif"> * </font></strong><br>
<div id="txtHint3"> </div></td>
                  <td bgcolor="#C2E860" class="style8"><div align="center"><font color="#333333"> Ex admin@domain.com</font></div></td>
                </tr>
                <tr valign="baseline"> </tr>

                <tr valign="baseline"> 
                  <td align="right" nowrap bgcolor="#C2E860" class="style8"><div align="left"><strong><font color="#333333">*คือจำเป็นต้องกรอก/Is required.</font></strong></div></td>
                  <td width="305" bgcolor="#E6F5BA"><div align="center"> <font color="#333333"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
                      <input type="submit" value="Save" name="submit"    >
                  </font></strong></font></div></td>
                  <td width="187" bgcolor="#C2E860"><font color="#333333">&nbsp;</font></td>
                </tr>
            </table></td>
      </tr>
    </table></td>
  </tr>
</table>
<br>
</form>
<?php } ?>
</BODY>
</HTML>
