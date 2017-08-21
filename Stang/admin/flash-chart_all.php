<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
</head>

<body>
<?php
$uuri=   $_SERVER['REQUEST_URI'];
$uuri = preg_replace("/flash-chart_all.php/i",null,$uuri);
 
 include 'php-ofc-library/open_flash_chart_object.php';
   open_flash_chart_object( 1024, 260, "$uuri/data_downloads_detail_all.php" );
 echo "<br>";
 
 
 
?>
</body>
</html>
