 <?php 
 header("Content-Type: force-download");    header("Content-Disposition: attachment; filename=mac.bat") ;

function  server_macaddress() { 
   exec('/sbin/ifconfig eth1 |/bin/grep  HWaddr', $output_ifconfig, $rval);
            $output_ifconfig2 = explode(" ",$output_ifconfig[0]) ;
		     $word=	$output_ifconfig2[10];
			$word = str_replace(":","-" ,$word);

             return $word;
         }
 $mac_server_eth1=server_macaddress();
 print "arp -d \r\n";
 print "arp -s 10.0.0.1  $mac_server_eth1 \r\n ";
?>
 