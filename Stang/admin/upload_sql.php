<?php
 include("../include/chklogin.php");    ?> 
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
</head>

<body>

<form action="index.php?case_i=58" method="post" enctype="multipart/form-data" name="form1">
  <table width="78%" border="0">
    <tr bgcolor="#66CCCC"> 
      <td height="30" colspan="2"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>
      Upload   ��� �ҹ������ ( <font color="#FF0000" size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong> ������ �ͧ Server ��繢ͧ������Ѿ��Ŵ�����ô���ѧ  </strong></font>)</strong></font></td>
    </tr>
    <tr bgcolor="#FFFFCC"> 
      <td width="14%"><div align="left"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">��� �ҹ������</font></strong></div></td>
      <td width="86%"><div align="left"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
          &nbsp;&nbsp; 
          <input type="file" name="files_name"  id="files_name">
          </font>��ͧ����Թ &nbsp;&nbsp; <?php echo ini_get('upload_max_filesize');  ?>&nbsp;</div></td>
    </tr>
    <tr bgcolor="#FFFFCC">
      <td><div align="left"></div></td>
      <td>
      
      <font size="2" face="MS Sans Serif, Tahoma, sans-serif">
      <input type="hidden" name="upload" id="upload" value="1" ><br>

     �ҡ������ ���ͧ������ ���ʡ�� .gz ��ҹ��ͧᵡ������ �� text file ���¡�͹</font></td>
    </tr>
    <tr bgcolor="#FFFFCC"> 
      <td><div align="left"> </div></td>
      <td><div align="left"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
          <input type="submit" name="Submit" value="Submit">
          </font></div></td>
    </tr>
  </table>
</form>
 
<p><a href="index.php?case_i=58&dumpmysql=1">��ԡ��������� Download ��� �����Ũҡ Server</a>&nbsp;&nbsp;&nbsp;<br>
�ҧ  ���������  �Ҩ�Т��˹�� text file ᷹����ҹ��ԡ Save As �� text files</p>
<?php
 
if($dumpmysql==1)
{
$www=$HTTP_HOST;
$File = $_SERVER['DOCUMENT_ROOT']."/admin/tmp/tlog.sql";  
@unlink($File);
 
$Results = shell_exec("/usr/bin/mysqldump -u$username_edoc  -p$password_edoc $database_edoc  > $File");
 	
echo "<meta http-equiv=refresh content=0;URL=http://$www/admin/tmp/tlog.sql>";
}


if($upload==1  and $_FILES['files_name']['tmp_name'] !=null) 
{
$www=$HTTP_HOST;
$File = $_FILES['files_name']['tmp_name']; 
$SQL="DROP TABLE  access_point ,  admin ,  arp ,  badusers ,  block_mac ,  block_web ,  card ,  client_online ,  config ,  datasize ,  delete_user ,  firewall ,  frox ,  login_fail ,  login_pass ,  logo ,  macauthen ,  mtotacct ,  nas ,  news ,  question ,  radacct ,  radcheck ,  radgroupcheck ,  radgroupreply ,  radippool ,  radpostauth ,  radreply ,  register ,  server ,  server_status ,  seting ,  squid ,  squid_limit_download ,  table_card_user ,  temp_login ,  totacct ,  usergroup ,  userinfo ;
";
include("../Connections/dbconnect.php");
mysql_query(" $SQL ") or    die (" �������öź�ҹ�������� ");

$Results = shell_exec("/usr/bin/mysql  -u$username_edoc  -p$password_edoc $database_edoc < $File ");
  	         echo                  "<script type=text/javascript>";
		    echo                  "alert(' �ѹ�֡������������� ')";
	        echo                  "</script>";  
		    echo "<meta http-equiv=refresh content=5;URL=index.php?case_i=58>"; 
		 	exit(); 
}
?>
</body>
</html>
