<?php    include("../include/chklogin.php");   ?> 
 <meta http-equiv="Content-Type" content="text/html; charset=windows-874">
 <?php
  include("../include/chklogin.php");   
include("../Connections/dbconnect.php");

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
$A_status=$row_user['status'];
$A_email=$email=$row_user['email'];

 


			  
 $tb="register";
$sql = "delete from $tb where UserName='$UserName'  ";
 mysql_select_db($database_edoc);  $dbquery =mysql_query($sql);
$tb="radcheck";
$sql = "delete from $tb where UserName='$UserName'  ";
 mysql_select_db($database_edoc); $dbquery = mysql_query($sql);
            echo                  "<script type=text/javascript>";
		    echo                  "alert('ลบออกเรียบร้อยแล้ว ')";
	        echo                  "</script>";
           echo "<meta http-equiv=refresh content=0;URL=index.php?case_i=1>"; 
 
 
?>