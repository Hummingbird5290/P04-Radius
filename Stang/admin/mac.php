<?php
function  server_macaddress($lan) { 
   exec('/sbin/ifconfig eth1 |/bin/grep  HWaddr', $output_ifconfig, $rval);
            $output_ifconfig2 = explode(" ",$output_ifconfig[0]) ;
             return $output_ifconfig2[10]; 
         }

function  lan_macaddress($client_id) { 

   exec('sudo /usr/bin/tail -n 1000 syslog |/bin/grep  MAC= |/bin/grep IP=$client_id', $output_ifconfig, $rval);
   
   $last_line = system("sudo /usr/bin/tail -n 1000 syslog |/bin/grep  MAC= |/bin/grep IP=$client_id", $retval);
//$retval = explode(" ",$retval) ;
print $retval[0]."<br>";
print $retval[1]."<br>";
print $retval[2]."<br>";
print $retval[3]."<br>";
print $retval[4]."<br>";
print $retval[5]."<br>";
print $retval[6]."<br>";
print $retval[7]."<br>";
print $retval[8]."<br>";
print $retval[9]."<br>";
print $retval[10]."<br>";
print $retval[11]."<br>";
print $retval[12]."<br>";
print $retval[13]."<br>";
print $retval[14]."<br>";			
			
echo '
 
<hr />Last line of the output: ' . $last_line . '
<hr />Return value: ' . $retval;	
			// return $output_ifconfig2[10]; 
         }  
//echo server_macaddress("eth1");
$client_id=$_SERVER["REMOTE_ADDR"]; 
lan_macaddress($client_id); 
 



?>
