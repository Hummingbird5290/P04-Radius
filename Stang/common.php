<?php
 
function tmtopupconnect($tmuser,$tmpassword,$trueuser,$truepassword,$ip,$session,$idcard,$action,$uid,$capchar){
	$url="http://tmtopup.thaighost.net/tmtopup.php";
 
$data="username=$tmuser&password=$tmpassword&tmnumber=$trueuser&truepassword=$truepassword&ip=$ip&session=$session&idcard=$idcard&action=$action&uid=$uid&capchar=$capchar";
	$ch = curl_init("$url");
	curl_setopt($ch,CURLOPT_POST,1);
	@curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
 
	return curl_exec($ch);
}

function capchar($ip,$tmuser){
	return md5($tmuser.$ip);
}

function my_ip(){
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
      $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
      $ip=$_SERVER['REMOTE_ADDR'];
    }
   return  $ip;
 
}
?>