   <?php include("../include/chklogin.php");    
//if($_SERVER['SERVER_PORT'] != 443) {
//    header("HTTP/1.1 301 Moved Permanently");
//    header("Location: https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
//    exit();

//}

include("../Connections/dbconnect.php");
include("../include/function.php");
if($submit=="�ѹ�֡") {
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
  
   if($_SESSION["adminpass"]=='demo'){
 $bb=   "����� ���ͺ�к�  �������ö���ҧ�����ҹ�� :P ";
      echo                  "<script type=text/javascript>";
		    echo                  "alert('$bb ')";
	        echo                  "</script>";  
  echo "<meta http-equiv=refresh content=0;URL=index.php?case_i=2>";
 exit();
 
}


$a=1;
$query_user = "select  UserName  from register   where UserName='$UserName'     ";
$type_db = mysql_query($query_user, $connect_db) or die(mysql_error());
$totalRows_user= mysql_num_rows($type_db);

if($totalRows_user !=null  or $totalRows_user >0 ) 
{   //��Ǩ�ͺ��� �� userlogin ��������������
            echo                  "<script type=text/javascript>";
		    echo                  "alert('�� user login ���������к����� ')";
	        echo                  "</script>";
		    echo "<meta http-equiv=refresh content=0;URL=index.php>"; 
		 	exit();
}  else 
{  
           
if($a==1  and  $password!=''  ) { //����Ţ���ѵû�ЪҪ��ը�ԧ
$password_rec =$password;
$password =md5($password);
$register_day=date("Y-m-d H:i:s");

$pattern = '/-/i';
$replacement = NULL;
$tel= preg_replace($pattern, $replacement, $tel);

$pattern = '/ /i';
$replacement = NULL;
$tel= preg_replace($pattern, $replacement, $tel);
if($fullname==''){$fullname=$UserName; }
$chk_data_insert=mysql_query("INSERT INTO  register    (UserName,password,per,room,tel,fullname,status,email,site,register_day,idstd,domain,pass_rec)
		      values('$UserName','$password','$strID','$room','$tel','$fullname','0','$email','$site','$register_day','$idstd','$domain_name','$password_rec')") or die(mysql_error());
			  

if($chk_data_insert==1) {

 update("register","status ='1'","where UserName ='$UserName'  ");  
#############
mysql_query("INSERT INTO  radcheck     (UserName,Attribute ,op ,Value)
		                                                                          values('$UserName','MD5-Password',':=','$password')") or die(mysql_error());
	 mysql_query("INSERT INTO  radcheck  (UserName,Attribute,op,Value)
		      values('$UserName', 'Auth-Type',':=','Local'   )") or    die ("Add ������ŧ Table ����� ");	
			  
			  																			  
mysql_query("INSERT INTO  usergroup     (UserName,GroupName ,priority)
		                                                                          values('$UserName','defult','1')") or die(mysql_error());
																				  
																				  
################# �ѧ�Ѻ��ҹ������
/*
$Attribute="Simultaneous-Use";

mysql_query("INSERT INTO  radcheck  (UserName,Attribute,op,Value)
		      values('$UserName', '$Attribute',':=','1'   )") or    die ("Add ������ŧ Table ����� ");		 																				  
*/
#################		
#��˹����ء����ҹ ���������ء�͹�� user �� acctive																				  
$Attribute="Expiration";
 
mysql_query("INSERT INTO  radcheck  (UserName,Attribute,op,Value)
		      values('$UserName', '$Attribute',':=','$data_datessss'   )") or    die ("Add ������ŧ Table ����� ");		

#################

####�Ѵ����ٻ��� upload �����
if (    $_FILES['files_name']['name'] != ""      )  

  {   
  $filename=$_FILES['files_name']['name'];
 $filetype=$_FILES['files_name']['type'];
 $filename = strtolower($filename);
 $filetype = strtolower($filetype); 
  $pos = strpos($filename,'php');
 if(!($pos === false)) {
  die('error');
  exit();
 }
 $pos = strpos($filetype,'image');
 if($pos === false) {
  die('error 1');
    exit();
 }
 
                                  $path = "/var/www/html/mk/admin/pic_user" ; // ��Ǩ�ͺ�����Folder pic_user ������� �������ա����ҧ�����
				                           if(!is_dir($path)){
									        	mkdir($path,0777) ;   }
$Upload_name=$_FILES['files_name']['name'];//��Ҫ���������Ѿ��Ŵ�����㹵����  $Upload_name
$Upload_Type=$_FILES['files_name']['type']; //���=��Դ ������Ѿ��Ŵ�����㹵����  $Upload_Type
$Path_Upload_server=$_FILES['files_name']['tmp_name']; //�������� tmp �� server
$lang_name=strlen($Upload_name); //�Ҥ�����ǵ���ѡ�÷�����
$new_name = date("d-m-Y-H-i-s");  //�֧���һѨ�غѹ����ҵ����
$Fname = substr($Upload_name,0,strpos($Upload_name,"."));  //�Ѵ�������� �����੾�й��ʡ����� ���ͧ�ҡ�������¹ ���������ѹ����Ѿ��Ŵ᷹
 
$new_name = preg_replace("/$Fname/i", "$new_name", $Upload_name);
$new_name2="pic_user/$new_name.png";
copy($Path_Upload_server,"/var/www/html/mk/admin/$new_name2");
mysql_query("update   register  set   pic_user= '$new_name2' where  UserName='$UserName'  " ) or    die ("��� ������ŧ Table ����� ");
}
 
 

            echo                  "<script type=text/javascript>";
		    echo                  "alert('�ѹ�֡�������������')";
	        echo                  "</script>";
		    echo "<meta http-equiv=refresh content=0;URL=index.php>"; 
 
		 	exit();  
			} else 
			{
		    echo                  "<script type=text/javascript>";
		    echo                  "alert('�к��������ö�ѹ�֡��������')";
	        echo                  "</script>";
		    echo "<meta http-equiv=refresh content=0;URL=index.php>"; 
 
		 	exit();  
			}
			}//   
}




}

 
?>
<HTML>
<HEAD>
<TITLE>km</TITLE>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
</HEAD>


<BODY >
          <p align="center"><strong><font size="3" face="MS Sans Serif, Tahoma, sans-serif">��ͧ��͡���������ú�ء��ͧ��Ф�Ѻ</font></strong></p>
          <form action="index.php?case_i=18" method="post" enctype="multipart/form-data" name="form1" >

  <table width="74%" border="1" align="left" class="imagetable">
    <tr valign="baseline"> 
      <th width="245" align="right" nowrap bgcolor="#FFFFCC"><strong><font color="#0000FF" size="2" face="MS Sans Serif, Tahoma, sans-serif"><span class="style5">���������ҹ:</span></font></strong></th>
      <td valign="top" bgcolor="#FFFFFF"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong><font color="#FF0000">���� 
        EN ��ҹ�������ժ�ͧ��ҧ</font></strong><br>
        <input name="UserName" type="text" id="UserName" value="" size="32">
        </font></td>
    </tr>
    <tr valign="baseline"> 
      <th align="right" nowrap bgcolor="#FFFFCC"><strong><font color="#0000FF" size="2" face="MS Sans Serif, Tahoma, sans-serif">���ʼ�ҹ</font></strong></th>
      <td valign="top" bgcolor="#FFFFFF"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong><font color="#FF0000">���� 
        EN ��ҹ�� ���͵���Ţ</font></strong><br>
        <input name="password" type="password" id="password" value="" size="32">
        </font></td>
    </tr>
    <tr valign="baseline"> 
      <th height="69" align="right" nowrap bgcolor="#FFFFCC"><strong><font color="#0000FF" size="2" face="MS Sans Serif, Tahoma, sans-serif">���͹��ʡ��</font></strong></th>
      <td valign="top" bgcolor="#FFFFFF"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong><font color="#0000CC"><font color="#FF0000">��������<br>
        ������ú��駪��͹��ʡ��</font></font></strong><br>
        <input name="fullname" type="text" id="fullname" value="" size="32">
        </font></td>
    </tr>
    <tr valign="baseline"> 
      <th height="41" align="right" nowrap bgcolor="#FFFFCC"><strong><font color="#0000FF" size="2" face="MS Sans Serif, Tahoma, sans-serif"><?php echo "$roomsDB"; ?></font></strong></th>
      <td valign="top" bgcolor="#FFFFFF"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
        <input name="room" type="text" id="room" value="" size="32">
        </font></td>
    </tr>
    <tr valign="baseline"> 
      <th align="right" nowrap bgcolor="#FFFFCC"><strong><font color="#0000FF" size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
        <?php echo "$siteDB"; ?></font> </strong></th>
      <td valign="top" bgcolor="#FFFFFF"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
        <input name="site" type="text" id="site" size="32" >
        </font></td>
    </tr></tr>
    <tr valign="baseline"> 
      <th align="right" nowrap bgcolor="#FFFFCC"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif" color="#0000CC"><strong><?php echo "$idstdDB"; ?></strong></font> 
        </strong></th>
      <td bgcolor="#FFFFFF"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
        <font color="#FF0000"><strong> </strong></font><br>
        <input name="idstd" type="text" id="idstd" value="" size="32">
        </font></td>
    </tr>
    <tr valign="baseline"> 
      <th align="right" nowrap bgcolor="#FFFFCC"><strong><font color="#0000FF" size="2" face="MS Sans Serif, Tahoma, sans-serif">�Ţ��Шӵ�ǻ�ЪҪ�</font></strong></th>
      <td valign="top" bgcolor="#FFFFFF"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong><font color="#FF0000">�������� 
        000000 </font></strong><br>
        <input name="strID" type="text" id="strID" value="" size="32">
        </font></td>
    </tr>
    <tr valign="baseline"> 
      <th height="52" align="right" nowrap bgcolor="#FFFFCC"><strong><font color="#0000FF" size="2" face="MS Sans Serif, Tahoma, sans-serif">�������Ѿ��Դ��͡�Ѻ</font></strong></th>
      <td valign="top" bgcolor="#FFFFFF"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong><font color="#0000CC"><font color="#FF0000">�ô��� 
        �Ъ��·�ҹ���ҡ�óշ�ҹ<br>
        �ջѭ��㹡����ҹ </font></font></strong><br>
        <input name="tel" type="text" id="tel" value="" size="32">
        </font></td>
    </tr>
    <tr valign="baseline"> 
      <th align="right" nowrap bgcolor="#FFFFCC"><strong><font color="#0000FF" size="2" face="MS Sans Serif, Tahoma, sans-serif">E-Mail</font></strong></th>
      <td valign="top" bgcolor="#FFFFFF"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong><font color="#FF0000">�óշ�ҹ������ʼ�ҹ</font><font color="#0000FF"><br>
        <input name="email" type="text" id="email" value="" size="32">
        </font></strong></font></td>
    </tr>
    <tr valign="baseline"> 
      <th align="right" nowrap bgcolor="#FFFFCC" class="style8"><div align="right"><font color="#0000FF" size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>�ٻ���Һѵû�ЪҪ�</strong></font></div></th>
      <td bgcolor="#E6F5BA" class="style2"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><font color="#333333"> 
        <input name="files_name" type="file" class="input" id="files_name" value="" size="32"    >
        </font></font></strong></td>
    </tr>
    <tr valign="baseline"> 
      <th align="right" nowrap bgcolor="#FFFFCC"><strong><font color="#0000FF" size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;</font></strong></th>
      <td valign="top" bgcolor="#FFFFFF"><div align="center"> <font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
          <input type="submit" value="�ѹ�֡" name="submit"   class="styled-button-2"  >
      </font></div>        <font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;</font></td>
    </tr>
  </table>
        </form>
</BODY>
</HTML>
