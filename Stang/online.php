<?php
error_reporting(0);
ini_set('date.timezone ', 'Asia/Bangkok');
extract($_POST);extract($_GET);extract($_REQUEST);
header("Content-type: image/gif");

extract($_POST);extract($_GET);extract($_REQUEST);


    $fp = fsockopen($host, $port,$errno,$errstr, 4);
//echo $fp;
         if (!$fp){
               readfile('offline.gif');
			// @system(' /usr/bin/sudo /bin/sh /data/chk_ppp.sh ', $retval);
         } else {
		readfile('online.gif');
             fclose($fp);
         }



?>
