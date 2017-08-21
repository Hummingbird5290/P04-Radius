<?php
function  server_macaddress($lan) { 
   exec('/sbin/ifconfig $lan |/bin/grep  $lan', $output_ifconfig, $rval);
            $output_ifconfig2 = explode(" ",$output_ifconfig[0]) ;
             return $output_ifconfig2[10]; 
         }

echo  server_macaddress("eth0");

?>
