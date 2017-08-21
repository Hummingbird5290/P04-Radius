<?php 
ob_start();
session_start();
//if ( ! isset($_SERVER['HTTPS'])) {
//   header('Location: https://' . $_SERVER["SERVER_NAME"] . $_SERVER['REQUEST_URI']);
//}

// print   $_SERVER["REQUEST_URI"];
extract($_POST);extract($_GET);extract($_REQUEST);
//print_r($_SESSION);
$www=$HTTP_HOST;
$doname_login=$_SESSION["domain"];
$domian_name=$_SESSION["domain"];
$domain_name=$_SESSION["domain"];
  $chk_moniter=preg_match( "/admin/", $_SERVER["REQUEST_URI"]);
   //print $_SESSION['adminpass'];
if (empty($_SESSION['adminpass']))   // ตรวจสอบว่าผ่านการ login หรือไม่
     {
   
   header('location:login.php');
       echo"คุณยังไม่ได้ Login  ";
       exit();  
     }  
	 
 
?>
