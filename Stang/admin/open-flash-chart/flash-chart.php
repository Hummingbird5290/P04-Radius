<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
</head>

<body>
<div align="center">
  <?php
$uuri=   $_SERVER['REQUEST_URI'];
$uuri = preg_replace("/flash-chart.php/i",null,$uuri);
 
 include 'php-ofc-library/open_flash_chart_object.php';
 open_flash_chart_object( 450, 260, "$uuri/data_upload.php" );
 echo "<br> ";
  open_flash_chart_object( 450, 260, "$uuri/data_downloads.php" );
 echo "<br>";
 
 
 
?>
  <a href="flash-chart_all.php"   target="_blank">ดูรายการ Download ทั้งหมดของเดือนที่แล้ว</a>
</div>
</body>
</html>
