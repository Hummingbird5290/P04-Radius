  <?php include("../include/chklogin.php");   ?>
 <meta http-equiv="Content-Type" content="text/html; charset=windows-874">
 <?php
include("../Connections/dbconnect.php");

 include("../include/function.php");   

$query_user = "select  *  from register    where UserName='$UserName'  ";
$user_db = mysql_query($query_user, $connect_db) or die(mysql_error());
$row_user = mysql_fetch_assoc($user_db);
$A_UserName=$row_user['UserName'];
$A_password=$row_user['password'];
$A_per=$row_user['per'];
$A_room=$row_user['room'];
$A_tel=$row_user['tel'];
$A_fullname=$row_user['fullname'];
$A_status=$row_user['status'];
$A_email=$email=$row_user['email'];
$A_site=$email=$row_user['site'];
 

	update("register","status ='1'  "," where UserName='$UserName'    "); 
  
  mysql_query("INSERT INTO  radcheck     (UserName,Attribute ,op ,Value)
		                                                                          values('$A_UserName','MD5-Password',':=','$pass')") or die(mysql_error());
 
 $query_user = "select  *  from radcheck   where UserName='$UserName'  and Attribute='Expiration'  ";
$user_db = mysql_query($query_user, $connect_db) or die(mysql_error());
$row_user = mysql_fetch_assoc($user_db);

if($row_user[Attribute]  =='' ) {
 #��˹����ء����ҹ ���������ء�͹�� user �� acctive																				  
$Attribute="Expiration";
 
mysql_query("INSERT INTO  radcheck  (UserName,Attribute,op,Value)
		      values('$UserName', '$Attribute',':=','$data_datessss'   )") or    die ("Add ������ŧ Table ����� ");		 																				  
#################																				  
	}
	
 $query_user = "select  *  from radcheck   where UserName='$UserName'  and Attribute='Simultaneous-Use'  ";
$user_db = mysql_query($query_user, $connect_db) or die(mysql_error());
$row_user = mysql_fetch_assoc($user_db);

if($row_user[Attribute]  =='' ) {
 #��˹����ء����ҹ ���������ء�͹�� user �� acctive																				  
$Attribute="Simultaneous-Use";
 
mysql_query("INSERT INTO  radcheck  (UserName,Attribute,op,Value)
		      values('$UserName', '$Attribute',':=','1'   )") or    die ("Add ������ŧ Table ����� ");		 		 																				  
#################																				  
	}																				  
																				  
            echo                  "<script type=text/javascript>";
		    echo                  "alert('�Ŵ��ͤ  �͡���º�������� ')";
	        echo                  "</script>";
           echo "<meta http-equiv=refresh content=0;URL=index.php?case_i=2>"; 
 
 
?>