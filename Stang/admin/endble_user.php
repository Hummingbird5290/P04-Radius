  <?php include("../include/chklogin.php");  
      ini_set('display_errors', 0);
   error_reporting(ALL);  ?>
 <meta http-equiv="Content-Type" content="text/html; charset=windows-874">

<?php
include("../Connections/dbconnect.php");

include("../include/function.php");
 include("sms.php");
$SENDSMSNAME='020000000';


$UserName = htmlspecialchars("$UserName", ENT_QUOTES);
$pattern = '/;/i';
$replacement = NULL;
$UserName= preg_replace($pattern, $replacement, $UserName);
     
$query_user = "select  *  from register   where UserName='$UserName'  ";
$user_db = mysql_query($query_user, $connect_db) or die(mysql_error());
$row_user = mysql_fetch_assoc($user_db);
$A_UserName=$row_user['UserName'];
$A_password=$row_user['password'];
$A_per=$row_user['per'];
$A_room=$row_user['room'];
$A_tel=$row_user['tel'];
$A_fullname=$row_user['fullname'];
$A_status="0";
$A_email=$row_user['email'];
 
 $pattern = '/-/i';
$replacement = NULL;
$A_tel= preg_replace($pattern, $replacement, $A_tel);

$pattern = '/ /i';
$replacement = NULL;
$A_tel= preg_replace($pattern, $replacement, $A_tel);
$pattern = '/;/i';
$replacement = NULL;
$A_tel= preg_replace($pattern, $replacement, $A_tel);


update("register","status ='1'","where UserName ='$UserName'");  

#############
@mysql_query("delete from   radcheck   where  UserName='$UserName' and  Attribute='MD5-Password'  ") or die(mysql_error());
mysql_query("INSERT INTO  radcheck     (UserName,Attribute ,op ,Value)
		                                                                          values('$UserName','MD5-Password',':=','$A_password')") or die(mysql_error());
@mysql_query("delete from   usergroup   where  UserName='$UserName'   ") or die(mysql_error());																				  
mysql_query("INSERT INTO  usergroup     (UserName,GroupName ,priority)
		                                                                          values('$UserName','defult','1')") or die(mysql_error());
																				  
$query_user = "select  *  from radcheck   where UserName='$UserName'  and Attribute='Expiration'  ";
$user_db = mysql_query($query_user, $connect_db) or die(mysql_error());
$row_user = mysql_fetch_assoc($user_db);

if($row_user[Attribute]  =='' ) {																			  
#กำหนดอายุการใช้งาน ให้หมดอายุก่อนรอ user มา acctive																				  
$Attribute="Expiration";

 
mysql_query("INSERT INTO  radcheck  (UserName,Attribute,op,Value)
		      values('$UserName', '$Attribute',':=','$data_datessss'   )") or    die ("Add ข้อมูลลง Table ไม่ได้ ");		
################# บังคับใช้งานคนเดียว
$Attribute="Simultaneous-Use";
 
mysql_query("INSERT INTO  radcheck  (UserName,Attribute,op,Value)
		      values('$UserName', '$Attribute',':=','1'   )") or    die ("Add ข้อมูลลง Table ไม่ได้ ");		 																				  
#################			   																				  
#################																				  
			}																  

																				  
$cccc="$domain_name  USER $UserName พร้อมใช้งานแล้ว  เติมบัตรชั่วโมงเน็ตได้เลย ";
$cccc=  iconv('TIS-620', 'UTF-8', $cccc);
if($A_tel !=NULL){
//@$sms->send( "$SENDSMSNAME", $A_tel, $cccc);		
print 		"$A_tel "; 															  
			}																	  
																				  
             echo                  "<script type=text/javascript>";
		    echo                  "alert('เปิดให้ใช้งานเรียบร้อยแล้ว ')";
	        echo                  "</script>";
           echo "<meta http-equiv=refresh content=0;URL=index.php?case_i=1>"; 
 
?>