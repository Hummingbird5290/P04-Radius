<?php  
 session_start(); 
include("Connections/dbconnect.php");
 if($Submit_login !=null   and  $chk_num !=$code1 )  { 
 
  	         echo                  "<script type=text/javascript>";
		    echo                  "alert('��س� ��͡������ �����ѡ�Ҥ�����ʹ������ç�Ѻ�ٻ�Ҿ            ')";
	        echo                  "</script>";  
			     echo "<meta http-equiv=refresh content=0;URL=edit_user.php>"; 
				
		 	exit();  		
 

 }
 function randomToken($len) { 
srand( date("s") ); 
//$chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ"; 
$chars ="ABCDEFGHIJKLM";
//$chars.= "1234567890"; // ��˹��ѡ��з��й��� random ����� 
$ret_str = ""; 
$num = strlen($chars); 
for($i=0; $i < $len; $i++) { 
$ret_str.= $chars[rand()%$num]; // ��ѧ��� rand() ����Ҫ���㹡�÷ӧҹ 
} 
return $ret_str; 
}  


?>
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">

<body background="images/bg1.gif">
<?php if($Submit_login==null )  { ?>
<form action="edit_user.php" method="post" enctype="application/x-www-form-urlencoded" name="form_login">
  <table width="407" border="0" align="center"  class=txtContentBold>
    <tr valign=middle bgcolor="#ECFFFF"> 
      <td colspan="3" bgcolor="#EBF3FF"><div align="left"><strong><font color="#FFFFFF" size="2"><font color="#0066CC"> 
          <font face="MS Sans Serif, Tahoma, sans-serif">&nbsp; </font></font></font><font color="#0066CC" face="MS Sans Serif, Tahoma, sans-serif"> 
          ��䢢�������ǹ����ô������ʼ�ҹ</font></strong><br>
          <img src="images/horz_3.gif" width="250" height="1"></div></td>
    </tr>
    <tr valign=middle bgcolor="#ECFFFF"> 
      <th colspan="3" bgcolor="#FBFCFE">&nbsp;</th>
    </tr>
    <tr bgcolor="#F5F5F5"> 
      <td width="88" bgcolor="#FBFCFE"><div align="right"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong><font color="#333333">username</font></strong></font></div></td>
      <td width="309" bgcolor="#FBFCFE"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
        <input name="UserName" type="text" id="UserName" value=""    >
        </font></td>
    </tr>
    <tr bgcolor="#F5F5F5"> 
      <td bgcolor="#FBFCFE"><div align="right"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong><font color="#333333">password</font></strong></font></div></td>
      <td bgcolor="#FBFCFE"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
        <input name="password" type="password" id="password" >
        </font></td>
    </tr>
    <tr bgcolor="#F5F5F5">
      <td bgcolor="#FBFCFE">&nbsp;</td>
      <td bgcolor="#FBFCFE"><?php   $ran_str = randomToken(3);    ?>
                      <img src="pic_text.php?str=<?=$ran_str?>" width="100" height="30" align="bottom">&nbsp; </td>
    </tr>
    <tr bgcolor="#F5F5F5"> 
      <td bgcolor="#FBFCFE"><div align="right"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>�����ѡ�Ҥ�����ʹ���</strong></font></div></td>
      <td bgcolor="#FBFCFE"><input name="code1" type="text" id="code1" size="10" /> <input name="chk_num"  type="hidden" id="chk_num" value="<?php echo "$ran_str"; ?>"  />&nbsp;</td>
    </tr>
    <tr bgcolor="#ECFFFF"> 
      <td height="45" colspan="2" bgcolor="#FBFCFE"> <p align="center"> <font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
          <input name="Submit_login" type="submit" id="Submit_login" value="�������к�"  >
          <input name="cancel" type="reset" id="cancel" value="��͡����">
          </font></p>
        <p align="center">&nbsp;</p></td>
    </tr>
  </table>
    </form>
<?php exit(); } ?>
<?php

mysql_select_db($database_db, $connect_db);

if($Submit=="��䢢�������Ҫԡ"     and $Submit_login=="true"   )    {

 
 if($pass225 ==null   )  { 
 
  	         echo                  "<script type=text/javascript>";
		    echo                  "alert('��س� ��͡���ʼ�ҹ ������� �����׹�ѹ�����䢢�����       ')";
	        echo                  "</script>";  
			     echo "<meta http-equiv=refresh content=0;URL=edit_user.php>"; 
				
		 	exit();  		
 

 }
include("include/function.php");

$pass225=md5($pass225);
$query_user = "SELECT   *   FROM    register  WHERE   UserName='$UserName'  and password='$pass225' ";
$user_db = mysql_query($query_user, $connect_db) or die(mysql_error());
$row_user = mysql_fetch_assoc($user_db);
$totalRows_user= mysql_num_rows($user_db);
if($totalRows_user >0) {

update("register","fullname ='$fullname',room='$room',site='$site',email='$email' "," where UserName='$UserName'    and  status  <> '0' "); 

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
 
$new_name = preg_replace("/$Fname/i", "$new_name", $Upload_name); // ����¹���� ��� ���ѹ���Ѩ�غѹ
 
  
 
$new_name2="pic_user/$new_name";
$chk_copy=copy($Path_Upload_server,"pic_user/$new_name");
if($chk_copy){
                              update("register","pic_user ='$new_name2'  "," where   UserName='$UserName'    "); 
                           }     else { print "�������ö  �Ѿ��Ŵ�ٻ�Ҿ��"; }
}


 
if( $pass  !='')
{
$pass=md5($pass);
update("register","fullname ='$fullname',room='$room',site='$site',email='$email' ,password='$pass' "," where UserName='$UserName'    and  status  <> '0' "); 
update("radcheck","Value ='$pass'  "," where UserName='$UserName'  and   Attribute='MD5-Password'  "); 
####�Ѵ����ٻ��� upload �����

}
echo "<script type=text/javascript>";
echo "alert('�ѹ�֡���������º�������� ')";
echo "</script>";
// echo "<meta http-equiv='refresh' content='0; url=edit_user.php'>" ;  
print "<center><h1>�ͺ�س������ԡ��</h1></center>";
exit();
}
}

$password=md5($password);

$query_user = "SELECT 
  register.`status`,
  register.UserName,
  register.password,
  register.fullname,
  register.per,
    register.pic_user,
  register.room,
  register.tel,
  register.site,
  register.email,
  radcheck.id,
  radcheck.UserName,
  radcheck.Attribute ,
  radcheck.op,
  radcheck.Value  As pass
FROM
  register
  INNER JOIN radcheck ON (register.UserName = radcheck.UserName)
WHERE
  register.`status` <> '0' and radcheck.Attribute ='MD5-Password'  
  and   register.UserName='$UserName' 
  and   register.password='$password' ";
$user_db = mysql_query($query_user, $connect_db) or die(mysql_error());
$row_user = mysql_fetch_assoc($user_db);
$totalRows_user= mysql_num_rows($user_db);


 
?><br>
<form action="edit_user.php" method="post" enctype="multipart/form-data" name="form1" >
  <table width="708" border="0" align="center">
    <tr bgcolor="#00AA00" > 
      <td colspan="2"><div align="center"><strong><font size="3" face="MS Sans Serif, Tahoma, sans-serif">��������´ 
          �����ҹ</font></strong></div></td>
    </tr>
    <tr > 
      <td width="32%" height="22" bgcolor="#59FF59"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>���� 
        Login</strong></font></td>
      <td width="68%" height="22" bgcolor="#CEFFCE"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
        &nbsp;&nbsp;&nbsp; 
        <input name="UserName"   type="text"  id="UserName" value="<?php echo $row_user['UserName']?>"  readonly="yes">
        *�������ö�����</font></td>
    </tr>
    <tr> 
      <td height="22" bgcolor="#59FF59"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>���ʼ�ҹ����</strong></font></td>
      <td height="22" bgcolor="#CEFFCE"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
        &nbsp;&nbsp;&nbsp; 
        <input name="pass"   type="password"  id="pass" value=""  >
        *�ҡ����ͧ�������¹�������ҧ���</font></td>
    </tr>
    <tr> 
      <td height="22" bgcolor="#59FF59"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
        <strong>����-���ʡ��</strong> </font></td>
      <td height="22" bgcolor="#CEFFCE"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;&nbsp;&nbsp; 
        <input name="fullname"   type="text"  id="fullname" value="<?php echo $row_user['fullname']?>" >
        </font></td>
    </tr>
    <tr> 
      <td height="22" bgcolor="#59FF59"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
        <strong><?php echo "$roomsDB"; ?></strong> </font></td>
      <td height="22" bgcolor="#CEFFCE"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;&nbsp;&nbsp; 
        <input name="room"   type="text"  id="room" value="<?php echo $row_user['room']?>" >
        </font></td>
    </tr>
    <tr> 
      <td height="22" bgcolor="#59FF59"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
        <strong><?php echo "$siteDB"; ?></strong> </font></td>
      <td height="22" bgcolor="#CEFFCE"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;&nbsp;&nbsp; 
        <input name="site"   type="text"  id="tel" value="<?php echo $row_user['site']?>">
        </font></td>
    </tr>
    <tr> 
      <td height="22" bgcolor="#59FF59"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
        <strong>E-mail</strong> </font></td>
      <td height="22" bgcolor="#CEFFCE"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;&nbsp;&nbsp; 
        <input name="email"   type="text"  id="email" value="<?php echo $row_user['email']?>">
        </font></td>
    </tr>
    <tr valign="baseline"> 
      <td align="right" nowrap bgcolor="#66FF66" class="style8"><div align="left"><font color="#000000" size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>�ٻ���Һѵû�ЪҪ�</strong></font></div></td>
      <td bgcolor="#E6F5BA" class="style2"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><font color="#333333"> 
        <input name="files_name" type="file" class="input" id="files_name" value="" size="32">
        </font></font></strong></td>
    </tr>
    <tr> 
      <td height="22" bgcolor="#59FF59"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
        <strong>�Ţ��Шӵ�ǻ�ЪҪ�</strong></font></td>
      <td height="22" bgcolor="#CEFFCE"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;&nbsp;&nbsp; 
        <?php echo $row_user['per']?></font></td>
    </tr>
    <tr> 
      <td height="22" bgcolor="#59FF59"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>���ʼ�ҹ��������׹�ѹ</strong></font></td>
      <td height="22" bgcolor="#CEFFCE">&nbsp;&nbsp;&nbsp;<font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
        <input name="pass225"   type="password"  id="pass225" value=""  >
        <font color="#FF0000"><strong>*��ҷ�ҹ��ͧ�����䢢����š�س���������׹�ѹ 
        </strong></font></font></td>
    </tr>
    <tr> 
      <td height="22" bgcolor="#59FF59">&nbsp;</td>
      <td height="22" bgcolor="#CEFFCE"><img src="<?php print $row_user['pic_user'];?>" width="357" height="131" ></td>
    </tr>
    <tr> 
      <td height="22" bgcolor="#59FF59"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;</font> 
      </td>
      <td height="22" bgcolor="#CEFFCE"> <font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
        <input type="hidden" name="Submit_login" value="true" >
        <input type="submit" name="Submit" value="��䢢�������Ҫԡ">
        </font></td>
    </tr>
  </table>
</form>
<?php  
mysql_close($connect_db);
?>
</body>
</html>
