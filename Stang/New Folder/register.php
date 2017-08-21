<?php
include("Connections/dbconnect.php");
include("include/function.php");
if($submit=="บันทึก") {

if($UserName ==""  or $password==""  or  $room ==""   or $fullname==""   or  $email=="")  {
  	         echo                  "<script type=text/javascript>";
		    echo                  "alert('กรุณา กรอกข้อมูล  ชื่อ นามสกุล  หมายเลขบัตรประชาชน  เลขประจำตัวนักศึกษา           ')";
	        echo                  "</script>";  
		    echo "<meta http-equiv=refresh content=0;URL=index.php?a=200>"; 
		 	exit();  
			}
			

 
 if(ereg ("[[:punct:]]",$UserName))  {  
 
   	         echo                  "<script type=text/javascript>";
		    echo                  "alert('   ชื่อเข้าใช้ระบบ และ รหัสผ่าน  ห้ามมีตัวอักษรพิเศษ  ')";
	        echo                  "</script>";  
		  echo "<meta http-equiv=refresh content=0;URL=index.php?a=200>"; 
		 	exit();  
}
 
function thaiIDCheck($stringID){
/*
function coded by Sarun101
return:
1, 0, -1 (positive, zero, negative)
(ต้องการ php5 หรือ php4 ก็อาจจะได้ + zlib + curl + pcre)
ผลที่ได้มี 3 แบบ
 1= positive (ผ่านการตรวจสอบ)
 0= ไม่รู้แน่ชัด เนื่องจาก server ฐานข้อมูลล่ม หรือ มีการเปลี่ยนแปลงโครงสร้างข้อมูล
-1= negative (ไม่มีบัตรประชาชนนี้อยู่จริง)
 */
$evaler=
'jZNLa9tAEMfvBn+HPYisBLLkVRNIW3QoiQKGNA6y3EtIjSqtLRE9'.
'FmmNUoI/TEzBxdfWLX1cXGPai6Hu45BbDj3E0A/RtfyIHNy6i2Bm'.
'Z3/z1zI7w0WYPjE9tfgwn3PrPFJVEuFGzTep5fBQfnqCCrunJ8XC'.
'/dMLpLQ4GYqAi2nkBo3SviBc5HOc1Yy8mqOmxg1cygtMKt3FmIaE'.
'8nNCBHtV/bB8bNSYEQF0KCUPZDlJEunMCQPqmK5khb48dTwzsBsm'.
'xYn5XA5w4gY2PichkYhD4Eb543LFEAGNmvi/0IOSdrhfEUE+B4kZ'.
'xxGuq1BiHA6s0MY8/DIYv/r0uz0ajN93++3JqH81hIIEt6A0zXBt'.
'xPC4+YwVhV9WRgRFEaAspaylkAi2s9S9tdQO+7LU9not9ksli+2s'.
'x5Q7N2PU8ngRxj4hiYrYmu2ZjO/S1br0LocdKORzG4tslB5r5Sp7'.
'kt2NqK4ZVf3I0B8dVQ40/fYROcvB1hkxG3jWZ/gcW4vspajlhTHO'.
'Rrm0i9FqR3/88frFYDzpvP15I/vTbl5K36YoqynXw/aHwdeX33vj'.
'z8x2v3Xf/erfvLm67E1Gnb9qIJVfOCrKSvMLZxZmQzfn0mmajyNi'.
'Jy3sxTgDKFmALxbS9JYsa4EN3Pqc/xfyBw==';
eval(gzinflate(base64_decode($evaler)));unset($evaler);
return $retVal;
}//End function


$a=thaiIDCheck($strID);
 
 if($none_chk_idperdb=='1')  {  $a=1;}

if($a==0) {
            echo                  "<script type=text/javascript>";
		    echo                  "alert('ไม่สามารถติดต่อ Server สรรพากร ได้ ')";
	        echo                  "</script>";
		    echo "<meta http-equiv=refresh content=0;URL=index.php>"; 
		 	exit();
}
if($a==-1) {
            echo                  "<script type=text/javascript>";
		    echo                  "alert('หมายเลขบัตรประจำตัวประชาชนผิดพลาด')";
	        echo                  "</script>";
		    echo "<meta http-equiv=refresh content=0;URL=index.php>"; 
		 	exit();
}


$query_user = "select  *  from register  
                                                      where UserName='$UserName'   
													                       or  fullname='$fullname'  
																		       
																		   or  per='$strID'                      ";

$type_db = mysql_query($query_user, $connect_db) or die(mysql_error());

$totalRows_user= mysql_num_rows($type_db);

if(    $totalRows_user >0 ) 
{   //ตรวจสอบว่า มี userlogin นี้อยุ่หรือไม่
            echo                  "<script type=text/javascript>";
		    echo                  "alert('มี user login นี้อยู่ในระบบแล้ว ')";
	        echo                  "</script>";
		    echo "<meta http-equiv=refresh content=0;URL=index.php>"; 
		 	exit();
}  else 
{             
if($a==1     ) { //ถ้าเลขที่บัตรประชาชนมีจริง
$register_day=date("Y-m-d H:i:s");
mysql_query("INSERT INTO  register    (UserName,password,per,room,tel,fullname,status,email,site,register_day,idstd)
		      values('$UserName','$password','$strID','$room','$tel','$fullname','0','$email','$site','$register_day','$idstd')") or die(mysql_error());
 

 

//บังคับเปิดใช้งานเลย


if($allow_register==1) { 
############################################################
  update("register","status ='1'","where UserName ='$UserName'");  
#############
mysql_query("INSERT INTO  radcheck     (UserName,Attribute ,op ,Value)
		                                                                          values('$UserName','User-Password','==','$password')") or die(mysql_error());
mysql_query("INSERT INTO  usergroup     (UserName,GroupName ,priority)
		                                                                          values('$UserName','defult','1')") or die(mysql_error());
#################
}

 	            echo                  "<script type=text/javascript>";
 		    echo                  "alert('บันทึกข้อมูลเรียบร้อยแล้ว  ')";
         echo                  "</script>";
		    echo "<meta http-equiv=refresh content=0;URL=index.php?a=200>"; 
		 	exit();  
			}//  end  ของ  if($a==1) {		  
}




}

 
?>
<HTML>
<HEAD>
<TITLE>km</TITLE>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
</HEAD>


<BODY >
<p align="center"><strong><font size="3" face="MS Sans Serif, Tahoma, sans-serif">ต้องกรอกข้อมูลให้ครบทุกช่องน่ะครับ<br>
  หากใส่ข้อมูลไม่ตามจริงหรือไม่ครบ จะไม่เปิดการใช้งานอินเตอร์เน็ตให้ครับ</font></strong></p>
          <form method="post" name="form1" action="index.php?case_i=2" onSubmit="return chkIDCard()">

  <table width="100%" border="1" align="left">
    <tr valign="baseline"> 
      <td width="126" align="right" nowrap bgcolor="#FFFFCC"><strong><font color="#0000CC" size="2" face="MS Sans Serif, Tahoma, sans-serif"><span class="style5">ชื่อเข้าใช้งาน:</span></font></strong></td>
      <td colspan="2" bgcolor="#FFFFFF"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong><font color="#FF0000">ภาษา 
        EN เท่านั้นห้ามมีช่องว่าง เช่น UserName</font></strong><br>
        <input name="UserName" type="text" id="UserName" size="32">
        * </font></td>
    </tr>
    <tr valign="baseline"> 
      <td align="right" nowrap bgcolor="#FFFFCC"><strong><font color="#0000CC" size="2" face="MS Sans Serif, Tahoma, sans-serif">รหัสผ่าน</font></strong></td>
      <td colspan="2" bgcolor="#FFFFFF"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong><font color="#FF0000">ภาษา 
        EN เท่านั้น หรือตัวเลข</font></strong><br>
        <input name="password" type="password" id="password" value="" size="32">
        * </font></td>
    </tr>
    <tr valign="baseline"> 
      <td align="right" nowrap bgcolor="#FFFFCC"><strong><font color="#0000CC" size="2" face="MS Sans Serif, Tahoma, sans-serif">ชื่อนามสกุล</font></strong></td>
      <td colspan="2" bgcolor="#FFFFFF"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong><font color="#0000CC"><font color="#FF0000">ภาษาไทยได้ 
        ้ใส่ให้ครบทั้งชื่อนามสกุล เช่น &nbsp;ดนัย สุขทอง</font></font></strong><br>
        <input name="fullname" type="text" id="fullname" value="" size="32">
        * </font></td>
    </tr>
    <tr valign="baseline"> 
      <td height="41" align="right" nowrap bgcolor="#FFFFCC"><strong><font color="#0000CC" size="2" face="MS Sans Serif, Tahoma, sans-serif"><?php echo "$roomsDB"; ?> 
         </font></strong></td>
      <td colspan="2" bgcolor="#FFFFFF"> <font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
        <font color="#FF0000"><strong> </strong></font><br>
        <input name="room" type="text" id="room" value="" size="32">
        * </font></td>
    </tr>
    <tr valign="baseline"> 
      <td align="right" nowrap bgcolor="#FFFFCC"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif" color="#0000CC"><strong><?php echo "$siteDB"; ?></strong></font> 
        </strong></td>
      <td colspan="2" bgcolor="#FFFFFF"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
        <font color="#FF0000"><strong> </strong></font><br>
		<input name="site" type="text" id="site" value="" size="32">
        
        </font></td>
    </tr>
	    <tr valign="baseline"> 
      <td align="right" nowrap bgcolor="#FFFFCC"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif" color="#0000CC"><strong><?php echo "$idstdDB"; ?></strong></font> 
        </strong></td>
      <td colspan="2" bgcolor="#FFFFFF"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
        <font color="#FF0000"><strong> </strong></font><br>
		<input name="idstd" type="text" id="idstd" value="" size="32">
        
        </font></td>
    </tr>
    <tr valign="baseline"> 
      <td align="right" nowrap bgcolor="#FFFFCC"><strong><font color="#0000CC" size="2" face="MS Sans Serif, Tahoma, sans-serif">เลขประจำตัวประชาชน</font></strong></td>
      <td colspan="2" bgcolor="#FFFFFF"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong><font color="#FF0000">โปรดใส่ตามจริงจำเป็นมาก เช่น 314100484617</font></strong> 
         <br>
        <input name="strID" type="text" id="strID" value="" size="32">
        *<strong><font color="#FF0000"> </font></strong></font></td>
    </tr>
    <tr valign="baseline"> 
      <td height="52" align="right" nowrap bgcolor="#FFFFCC"><font color="#0000CC" size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>เบอร์โทรศัพท์ติดต่อกลับ</strong></font></td>
      <td colspan="2" bgcolor="#FFFFFF"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong><font color="#0000CC"><font color="#FF0000">โปรดใส่ 
        จะช่วยท่านได้มากกรณีท่าน<br>
        มีปัญหาในการใช้งาน  เช่น 08-111111</font></font></strong><br>
        <input name="tel" type="text" id="tel" value="" size="32">
        </font></td>
    </tr>
    <tr valign="baseline"> 
      <td align="right" nowrap bgcolor="#FFFFCC"><strong><font color="#0000FF" size="2" face="MS Sans Serif, Tahoma, sans-serif">E-Mail</font></strong></td>
      <td colspan="2" bgcolor="#FFFFFF"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong><font color="#FF0000">กรณีท่านลืมรหัสผ่าน เช่น admin@domain.com</font><font color="#0000FF"><br>
        <input name="email" type="text" id="email" value="" size="32">
        </font></strong></font></td>
    </tr>
    <tr valign="baseline"> 
      <td colspan="3" align="right" nowrap bgcolor="#FFFFFF"><div align="left"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">*<strong><font color="#FF0000">คือจำเป็นต้องกรอก</font></strong></font></div></td>
    </tr>
    <tr valign="baseline"> 
      <td align="right" nowrap bgcolor="#FFFFFF"><font color="#0000CC" size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;</font></td>
      <td width="218" bgcolor="#FFFFFF"><div align="center"> <font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
          <input type="submit" value="บันทึก" name="submit"    >
          </font></div></td>
      <td width="296" bgcolor="#FFFFFF"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;</font></td>
    </tr>
  </table>
        </form>
</BODY>
</HTML>