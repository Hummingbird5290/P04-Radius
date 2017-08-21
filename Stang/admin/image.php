<?php
error_reporting(0);

header("Content-type: image/gif");
ini_set('date.timezone ', 'Asia/Bangkok');
extract($_POST);extract($_GET);extract($_REQUEST);

    $fp = fsockopen($host, $port,$errno,$errstr, 4);
         if (!$fp){
             readfile('offline.gif');
         } else {
		readfile('online.gif');
             fclose($fp);
         }



?>
