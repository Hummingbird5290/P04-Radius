<?php
error_reporting(0);

header("Content-type: image/gif");


    $fp = fsockopen($host, $port,$errno,$errstr, 4);
         if (!$fp){
               readfile('offline.gif');
			// @system(' /usr/bin/sudo /bin/sh /data/chk_ppp.sh ', $retval);
         } else {
		readfile('online.gif');
             fclose($fp);
         }



?>