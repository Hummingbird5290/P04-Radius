<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>รายงานสรุปกราฟ แบบรายชื่อ</title>
</head>

<body>
<?php
 
$uuri= $_SERVER['SCRIPT_NAME'];

$uuri = preg_replace("/flash-chart-detail-of-month.php/i",null,$uuri);
 
 include 'php-ofc-library/open_flash_chart_object.php';
 echo "<b>ปริมาณการใช้งานการ Download ทั้งหมด ประจำเดือนปัจจุบัน </b><br>";
  open_flash_chart_object( 1050, 260, "$uuri/data_downloads_detail_all.php" );
  echo "<br>";
  echo "<b>ปริมาณการใช้งานการ Download ทั้งหมด ประจำเดือนปัจจุบัน  ของ  $Sname </b><br>";
  open_flash_chart_object( 1050, 260, "$uuri/data_downloads_detail.php?Sname=$Sname" );
 echo "<br>";
   echo "<b>ปริมาณการใช้งานการ Download ทั้งหมด ประจำเดือนที่แล้ว  ของ  $Sname </b><br>";
   open_flash_chart_object( 1050, 260, "$uuri/data_downloads_detail2.php?Sname=$Sname" );
 echo "<br>";
    echo "<b>ปริมาณการใช้งานการ Download ทั้งหมด ประจำสองเดือนที่แล้ว  ของ  $Sname </b><br>";
    open_flash_chart_object( 1050, 260, "$uuri/data_downloads_detail3.php?Sname=$Sname" );
 echo "<br>";

?>
</body>
</html>
