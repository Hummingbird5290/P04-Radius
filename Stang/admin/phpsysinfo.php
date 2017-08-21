<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>

<style type="text/css">
<!--
.style3 {font-family: "Microsoft Sans Serif";    font-size: 10px; }
.style4 {font-family: "Microsoft Sans Serif"; font-weight: bold; font-size: 10px; }
-->
</style>
 
<?php
function ByteSize($bytes)  
    { 
    $size = $bytes / 1024; 
    if($size < 1024) 
        { 
        $size = number_format($size, 2); 
        $size .= ' KB'; 
        }  
    else  
        { 
        if($size / 1024 < 1024)  
            { 
            $size = number_format($size / 1024, 2); 
            $size .= ' MB'; 
            }  
        else if ($size / 1024 / 1024 < 1024)   
            { 
            $size = number_format($size / 1024 / 1024, 2); 
            $size .= ' GB'; 
            }  
        } 
    return $size; 
    } 

function gen_uptime($time = 0)
{
$days = (int)floor($time/86400);
$hours = (int)floor($time/3600)%24;
$minutes = (int)floor($time/60)%60;

if($days==1) { $uptime = "$days day, "; } else if($days>1) { $uptime = "$days days, "; }
if($hours==1) { $uptime .= "$hours hour"; } else if($hours>1) { $uptime .= "$hours hours"; }
if($uptime && $minutes>0 && $seconds>0) { $uptime .= ", "; } else if($uptime && $minutes>0 & $seconds==0) { $uptime .= " and "; }
($minutes>0) ? $uptime .= "$minutes minute" . ( ($minutes>1) ? "s" : NULL ) : NULL;

return $uptime;
}

 
	$dom = new DOMDocument("1.0");
	$ipserver_load=$_SERVER["HTTP_HOST"];
	//$dom->load("http://$ipserver_load/phpsysinfo/xml.php");
	$dom->load("http://127.0.0.1/phpsysinfo/xml.php");
	$title = $dom->getElementsByTagName("Hostname")->item(0)->textContent;
	$CPU = $dom->getElementsByTagName("Model")->item(0)->textContent;
	$Cpuspeed = $dom->getElementsByTagName("Cpuspeed")->item(0)->textContent;
	$Number = $dom->getElementsByTagName("Number")->item(0)->textContent;
	
	$Distro = $dom->getElementsByTagName("Distro")->item(0)->textContent;
	$Uptime = $dom->getElementsByTagName("Uptime")->item(0)->textContent;
	$Uptime =gen_uptime($Uptime);
?><span class="style4">
<?	
	echo "<b>Hostname</b> ".$title."<br>\n";
	echo "<b>CPU </b>".$CPU."&nbsp;&nbsp; $Cpuspeed Mhz &nbsp;  $Number Unit<br>\n";
	echo "<b>Distro </b>".$Distro."<br>\n";
    echo "<b>Uptime</b> ".$Uptime."<br><br>\n";
 ?>   
 </span>
     <table width="424" height="62" border=\"1\"> 
	 <tr> 
<td colspan="3" align=\"center\" bgcolor="#FFFFCC"><span class="style4">Memory Usage</span> </td>
	 </tr>  
      <tr> 
	 <td align=\"center\" bgcolor="#FFFFCC"><div align="center"><span class="style4">Free</span></div></td> 
	 <td align=\"center\" bgcolor="#FFFFCC"><div align="center"><span class="style4">Used</span></div></td> 
	 <td align=\"center\" bgcolor="#FFFFCC"><div align="center"><span class="style4">Total</span></div></td> 
	 </tr>  
 <tr>  
 <? 
  $data = $dom->getElementsByTagName("Memory");
	foreach($data as $theData)
	{
           echo "<tr>";
         $theData->getElementsByTagName("Memory");
        
		 
       
	 	$itemsNamememfree = $theData->getElementsByTagName("Free");
	 	                 foreach($itemsNamememfree as $theItemmemfree)
	 	                        {    $memfree=($theItemmemfree->nodeValue)/1024 ;  $memfree= number_format( $memfree,2);
								       echo "<td><span class=\"style3\"><div align=\"right\">".$memfree." MB </dev></span></td>\n";  }//Name
			   
	   $itemsmameUsed= $theData->getElementsByTagName("Used");
		                    foreach($itemsmameUsed as $theitemsmameUsed)
		                         {  $memuser= ($theitemsmameUsed->nodeValue)/1024   ; $memuser= number_format( $memuser,2);
								        echo "<td><span class=\"style3\"><div align=\"right\">".$memuser." MB</dev> </span></td>\n"; }	

	   $itemsTotalmem= $theData->getElementsByTagName("Total");
		                    foreach($itemsTotalmem as $theitemsTotalmem)
		                         { $Totalmem= ($theitemsTotalmem->nodeValue)/1024 ; $Totalmem= number_format( $Totalmem,2);
								        echo "<td><span class=\"style3\"><div align=\"right\">".$Totalmem." MB</dev></span></td>\n"; }	
 
echo "</tr>";	
 
		
	}  
	?>
	 </tr> 
</table> 
     <br>
<?php /// ifconfig ?>
<table width="422" height="33" border=\"1\"> 
	 <tr> 
<td colspan="5" align=\"center\" bgcolor="#FFFFCC"><span class="style4">Network</span> </td>
	 </tr>  
      <tr> 
	 <td align=\"center\" bgcolor="#FFFFCC"><div align="center"><span class="style4">Device</span></div></td> 
	 <td align=\"center\" bgcolor="#FFFFCC"><div align="center"><span class="style4">Received</span></div></td> 
	 <td align=\"center\" bgcolor="#FFFFCC"><div align="center"><span class="style4">Sent</span></div></td> 
	 <td align=\"center\" bgcolor="#FFFFCC"><div align="center"><span class="style4">Err</span></div></td> 
     <td align=\"center\" bgcolor="#FFFFCC"><div align="center"><span class="style4">Drop</span></div></td> 
	 </tr>  
 <tr>  
 <? 
  $data = $dom->getElementsByTagName("NetDevice");
	foreach($data as $theData)
	{
           echo "<tr>";
         $theData->getElementsByTagName("NetDevice");
        
		 
       
	 	$itemsName = $theData->getElementsByTagName("Name");
	 	                 foreach($itemsName as $theItemName)
	 	                        {    echo "<td><span class=\"style3\">".$theItemName->nodeValue."</span></td>\n";  }//Name
			   
	   $itemsRxBytes = $theData->getElementsByTagName("RxBytes");
		                    foreach($itemsRxBytes as $theItemitemsRxBytes)
		                         {  $RxBytes=ByteSize($theItemitemsRxBytes->nodeValue) ;
								        echo "<td><span class=\"style3\"><div align=\"right\">".$RxBytes."</dev></span></td>\n"; }	

	   $itemsTxBytes = $theData->getElementsByTagName("TxBytes");
		                    foreach($itemsTxBytes as $theItemitemsTxBytes)
		                         { $TxBytes=ByteSize($theItemitemsTxBytes->nodeValue) ;
								        echo "<td><span class=\"style3\"><div align=\"right\">".$TxBytes."</dev></span></td>\n"; }	

	   $itemsErr = $theData->getElementsByTagName("Err");
		                    foreach($itemsErr as $theItemitemsErr)
		                         {  $Err_s=ByteSize($theItemitemsErr->nodeValue) ;
								        echo "<td><span class=\"style3\"><div align=\"right\">".$Err_s."</dev></span></td>\n"; }										 	  

	   $itemsDrops = $theData->getElementsByTagName("Drops");
		                    foreach($itemsDrops as $theItemitemsDrops)
		                         {  $Drops=ByteSize($theItemitemsDrops->nodeValue) ;
								        echo "<td><span class=\"style3\"><div align=\"right\">".$Drops."</dev></span></td>\n"; }	
echo "</tr>";	
 
		
	}  
	?>
  </tr> 
</table> 
<br />
<?php //mount disk ?>
<table width="419" height="62" border=\"1\"> 
	 <tr> 
<td colspan="7" align=\"center\" bgcolor="#FFFFCC"><span class="style4">Mounted Filesystems</span> </td>
	 </tr>  
      <tr> 
	 <td align=\"center\" bgcolor="#FFFFCC"><div align="center"><span class="style4">MountPoint</span></div></td> 
	  <td align=\"center\" bgcolor="#FFFFCC"><div align="center"><span class="style4">Device</span></div></td> 
	   <td align=\"center\" bgcolor="#FFFFCC"><div align="center"><span class="style4">Type</span></div></td>
	 <td align=\"center\" bgcolor="#FFFFCC"><div align="center"><span class="style4">Used</span></div></td> 
	 <td align=\"center\" bgcolor="#FFFFCC"><div align="center"><span class="style4">Free</span></div></td> 
  <td align=\"center\" bgcolor="#FFFFCC"><div align="center"><span class="style4">size</span></div></td> 
   <td align=\"center\" bgcolor="#FFFFCC"><div align="center"><span class="style4">%</span></div></td> 
	 </tr>  
 <tr>  
 <? 
  $data = $dom->getElementsByTagName("Mount");
	foreach($data as $theData)
	{
           echo "<tr>";
         $theData->getElementsByTagName("Mount");
    	$itemsMountPoint = $theData->getElementsByTagName("MountPoint");
	 	                 foreach($itemsMountPoint as $theItemMountPoint)
	 	                        {    $theItemMountPoint_data=($theItemMountPoint->nodeValue);
								       echo "<td><span class=\"style3\">".$theItemMountPoint_data." </span></td>\n";  }//Name
	if($theItemMountPoint_data !=null) {
	   $itemsmameDevice= $theData->getElementsByTagName("Device");
		                    foreach($itemsmameDevice as $theitemsnameDevice)
		                         {  $Device_data= ($theitemsnameDevice->nodeValue)    ;  
								        echo "<td><span class=\"style3\"><div align=\"right\">".$Device_data."  </dev></span></td>\n"; }	

	   $itemsmameDevice= $theData->getElementsByTagName("Type");
		                    foreach($itemsmameDevice as $theitemsnameDevice)
		                         {  $Device_data= ($theitemsnameDevice->nodeValue)    ;  
								        echo "<td><span class=\"style3\"><div align=\"right\">".$Device_data."  </dev></span></td>\n"; }	
	   $itemsUsed= $theData->getElementsByTagName("Used");
		                    foreach($itemsUsed as $theUsed)
		                         {  $Device_theUsed= ($theUsed->nodeValue)    ;  $Device_theUsed=  ByteSize($Device_theUsed) ;
								        echo "<td><span class=\"style3\"><div align=\"right\">".$Device_theUsed."</dev> </span></td>\n"; }		 

	   $itemsUsed= $theData->getElementsByTagName("Free");
		                    foreach($itemsUsed as $theUsed)
		                         {  $Device_theUsed= ($theUsed->nodeValue)    ;  $Device_theUsed=  ByteSize($Device_theUsed) ;
								        echo "<td><span class=\"style3\"><div align=\"right\">".$Device_theUsed."</dev> </span></td>\n"; }	
										
	   $itemsUsed= $theData->getElementsByTagName("Size");
		                    foreach($itemsUsed as $theUsed)
		                         {  $Device_theUsed= ($theUsed->nodeValue)    ;  $Device_theUsed=  ByteSize($Device_theUsed) ;
								        echo "<td><span class=\"style3\"><div align=\"right\">".$Device_theUsed." </dev></span></td>\n"; }	
												
	   $itemsUsed= $theData->getElementsByTagName("Percent");
		                    foreach($itemsUsed as $theUsed)
		                         {  $Device_theUsed= ($theUsed->nodeValue)    ;  
								        echo "<td><span class=\"style3\"><div align=\"right\">".$Device_theUsed." %</dev></span></td>\n"; }																						  
} //if $theItemMountPoint_data
echo "</tr>";	
 
		
	}  
	?>
  </tr> 
</table>
</body>
</html>
