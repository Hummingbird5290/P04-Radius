 <?php include("../include/chklogin.php");   ?>
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">

<body>

<?php

include("../Connections/dbconnect.php");
include("../include/function.php");
//$user_id=$_SESSION["id_user_login"];


mysql_select_db($database_db, $connect_db);
$UserName = htmlspecialchars("$UserName", ENT_QUOTES);
$pattern = '/;/i';
$replacement = NULL;
$UserName= preg_replace($pattern, $replacement, $UserName);


$query_user = "SELECT * FROM   radcheck    where UserName='$UserName'   and Attribute ='MD5-Password'   ";
$user_db = mysql_query($query_user, $connect_db) or die(mysql_error());
$row_user = mysql_fetch_assoc($user_db);
$totalRows_user= mysql_num_rows($user_db);
if($totalRows_user==0)
{
mysql_query("INSERT INTO  radcheck     (UserName,Attribute ,op ,Value)
		                                                                          values('$UserName','MD5-Password',':=','1234')") or die(mysql_error());
}

if($Submit == "�ѹ�֡������"   and  $password !=''   ) {

 if($_SESSION["adminpass"]=='demo'){
 
      echo                  "<script type=text/javascript>";
		    echo                  "alert('�����ҹ ���ͺ�к� �������ö ��䢢������� ')";
	        echo                  "</script>";  
  echo "<meta http-equiv=refresh content=0;URL=index.php?case_i=2>";
 exit();
 
}

if($password!=$password2    ) {
                                             echo                  "<script type=text/javascript>";
                                             echo                  "alert('���ʼ�ҹ���١��ͧ  ')";
	                                         echo                  "</script>";
									         echo  "<meta http-equiv=refresh content=0;URL=index.php?case_i=1>";  
								                exit();
}  else {   
 $pdj=$password;
 
 $password = htmlspecialchars("$password", ENT_QUOTES);
$pattern = '/;/i';
$replacement = NULL;
$password= preg_replace($pattern, $replacement, $password);

 $password=md5($password);
 
update("radcheck","Value ='$password'"," where UserName='$UserName'   and Attribute ='MD5-Password'  "); 
update("register","password ='$password'  ,  pass_rec='$pdj'  "," where UserName='$UserName'    ");   
                                             echo                  "<script type=text/javascript>";
                                             echo                  "alert('�ѹ�֡������������� ')";
	                                         echo                  "</script>";
									         echo  "<meta http-equiv=refresh content=0;URL=index.php>";  
								                exit();
}
  
 

 

echo "<script type=text/javascript>";
echo "alert('�ѹ�֡���������º�������� ')";
 echo "</script>";


					  
 echo "<meta http-equiv=refresh content=0;URL=index.php>";

}
else {

?>
<form action="index.php?case_i=4" method="post" enctype="multipart/form-data" name="form1" onSubmit="return ch_blank();">



  <table width="58%" height="27" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#FF8282"   class="imagetable">
    <tr > 
      <th height="30" bgcolor="#FFCCCC"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp; 
        &nbsp; ���� Login</font></strong></th>
      <td width="75%" height="30" bgcolor="#FFF2F2"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
        &nbsp; 
        <input name="UserName" type="text" id="UserName" value="<?php echo $_GET[UserName];?>"  readonly="yes">
        </font></td>
    </tr>
    <tr> 
      <th height="30" bgcolor="#FFCCCC"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
        &nbsp; &nbsp; ���ʼ�ҹ </font></strong></th>
      <td height="30" bgcolor="#FFF2F2"> <font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
        &nbsp; 
        <input name="password" type="password" id="password" value="" >
        </font></td>
    </tr>
    <tr> 
      <th height="30" bgcolor="#FFCCCC"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
        &nbsp; &nbsp; ��������ʼ�ҹ�ա����</font></strong></th>
      <td height="30" bgcolor="#FFF2F2"> <font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
        &nbsp; 
        <input name="password2" type="password" id="password2" value="" >
        </font></td>
    </tr>
    <tr> 
      <th height="30" bgcolor="#FFCCCC"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;</font></th>
      <td height="30" bgcolor="#FFF2F2"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
 
        <input type="Submit" name="Submit" value="�ѹ�֡������"  class="styled-button-2"  >
        <input type="reset" name="Submit2" value="¡��ԡ"  class="styled-button-2"  >
        </font></td>
    </tr>
  </table>
</form>
<?php } 
mysql_close($connect_db);
?>
</body>
</html>
