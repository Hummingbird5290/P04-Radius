<?php
error_reporting(0);
ini_set('date.timezone ', 'Asia/Bangkok');
extract($_POST);extract($_GET);extract($_REQUEST);
header("Content-type: image/gif");


    $fp = fsockopen($host, $port,$errno,$errstr, 4);
         if (!$fp){
             readfile('offline.gif');
         } else {
		readfile('online.gif');
             fclose($fp);
         }



?>
