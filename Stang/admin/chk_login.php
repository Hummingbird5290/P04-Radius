<?php @session_start();
extract($_POST);extract($_GET);extract($_REQUEST);

   // ini_set('display_errors', 1);
  // error_reporting(E_ALL);
 
 ?>

<meta http-equiv="Content-Type" content="text/html; charset=windows-874">

<?
 include("../Connections/dbconnect.php");

 
 
if ($_SERVER['HTTP_CLIENT_IP']) { 
$IP = $_SERVER['HTTP_CLIENT_IP'];
} elseif (preg_match("/[0-9]/",$_SERVER["HTTP_X_FORWARDED_FOR"] )) { 
$IP = $_SERVER["HTTP_X_FORWARDED_FOR"];
} else { 
$IP = $_SERVER["REMOTE_ADDR"];
}

//�ó� ��ҼԴ�Թ ��Ҥ��� �к� �к��ͤ �;չ�鹷�駷ѹ��
$DDTS=date("Y-m-d");
   $query_user_chk_login = "select  count(userdb_user) as t  from login_fail      where ip='$IP'  and  time_login  like '%$DDTS%'  "; 
$type_dblogon = mysql_query($query_user_chk_login, $connect_db) or die(mysql_error());
$row_chk_login = mysql_fetch_assoc($type_dblogon);

if($row_chk_login[t] == 4){	


   $b=date("Y-m-d H:i:s");
mysql_query("INSERT INTO  blockip  (ip,dates)
		      values('$IP', '$b' )") or trigger_error(mysql_error(),E_USER_ERROR);      
 
}

if($row_chk_login[t] > 4){	
 $texts="�к����ͤ $IP ⴹ���ͤ�ҡ�к����ͧ�ҡ��͡���ʼ�ҹ�Դ ���˹�Ҵ����к� �Թ 5 ���� ";
 $b=date("Y-m-d H:i:s");
mysql_query("INSERT INTO  noute_data  (UserName,texts,date_add,admin,domain)
		      values('system', '$texts','$b'  ,'system','$domain_name' )") or trigger_error(mysql_error(),E_USER_ERROR);      



			  
			  
  	         echo                  "<script type=text/javascript>";
		    echo                  "alert('IP ADDRESS $IP ⴹ���ͤ�ҡ�к����ͧ�ҡ��͡���ʼ�ҹ�Դ���˹�Ҽ������к��Թ��Ҥ��� ')";
	        echo                  "</script>";  
 
   echo "<meta http-equiv=refresh content=0;URL=http://www.google.co.th>"; 
				
		 	exit();  		
}






if($username==NULL or $password ==NULL)

{
  	         echo                  "<script type=text/javascript>";
		    echo                  "alert('��س� ��͡������              ')";
	        echo                  "</script>";  
	 
		  echo "<meta http-equiv=refresh content=0;URL=login.php>"; 
				
		 	exit();  		
}
//$username=htmlspecialchars($username, ENT_QUOTES);
$username = htmlspecialchars("$username", ENT_QUOTES);
$password = htmlspecialchars("$password", ENT_QUOTES);

$pattern = '/;/i';
$replacement = NULL;
$username= preg_replace($pattern, $replacement, $username);
$password= preg_replace($pattern, $replacement, $password);
 


$passworddb= $password ;
$password=md5($password); // ������� Md5
  $query_user = "select  * from admin where uname='$username' and password='$password'    ";
$type_db = mysql_query($query_user, $connect_db) or die(mysql_error());
$row_user = mysql_fetch_assoc($type_db);
$totalRows_user= mysql_num_rows($type_db);
$nameadmin=$row_user['user'];
$domain=$row_user['domain'];

if(empty($totalRows_user)     ) 
{
 
echo "<script type=text/javascript>";
echo "alert('�ô��͡���ʼ�ҹ����')";
 echo "</script>";

###�ҡ login �Դ���ѹ�֡�к����
 $passworddb=base64_encode($passworddb);
mysql_query("INSERT INTO login_fail   (userdb_user, password,ip,domain) values('$username','$passworddb' ,'$IP','$domain')") or trigger_error(mysql_error(),E_USER_ERROR); 
	 
 echo  "<meta http-equiv=refresh content=0;URL=login.php >";
exit();
}
else

{
 if($domain==NULL){
 echo "<script type=text/javascript>";
echo "alert('�ô��͡���ʼ�ҹ����')";
 echo "</script>";
 echo  "<meta http-equiv=refresh content=0;URL=login.php >";
 
 exit();
 }
$_SESSION["adminpass"]=$username;
$_SESSION["domain"]=$domain;
$_SESSION["domain_name"]=$domain;
###�ҡ login ��ҹ���ѹ�֡�к����
 $b=date("Y-m-d");
 
mysql_query("INSERT INTO login_pass  (userdb_user, password,ip,domain) values('$username','$passworddb' ,'$IP','$domain')") or    
	  trigger_error(mysql_error(),E_USER_ERROR); 
  $b=date("Y-m-d H:i:s"); 
$texts="$_SESSION[domain]: �������к� $username ����к� �ҡ�;� $IP $b";	
mysql_query("INSERT INTO  noute_data  (UserName,texts,date_add,admin,domain)
		      values('system', '$texts','$b'  ,'system','$domain' )") or trigger_error(mysql_error(),E_USER_ERROR);      
			  
 
 if($_SESSION["adminpass"]=='tlog'  or $_SESSION["domain_name"] =='rx25' ){
  echo  "<meta http-equiv=refresh content=0;URL=index.php>";
 }else {
 echo  "<meta http-equiv=refresh content=0;URL=index.php>";
}
exit();
 
 
}

?>


