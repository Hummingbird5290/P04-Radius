<?php
$VLANIP_SERVER=$_SERVER['SERVER_ADDR'] ;
function randomToken($len) { 
srand( date("s") ); 
//$chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ"; 
$chars = "123456789"; // กำหนดอักขษะที่จะนำมา random แก้ได้นะ 
$ret_str = ""; 
$num = strlen($chars); 
for($i=0; $i < $len; $i++) { 
$ret_str.= $chars[rand()%$num]; // ใช้ฟังชั่น rand() เข้ามาช่วยในการทำงาน 
} 
return $ret_str; 
}  

?>
<html>
<head>
<title>สถานะเวลาผู้ใช้</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<script type="text/javascript">
function Ajax(){
var xmlHttp;
	try{	
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		}
		catch (e){
		    try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e){
				alert("No AJAX!?");
				return false;
			}
		}
	}

xmlHttp.onreadystatechange=function(){
	if(xmlHttp.readyState==4){
		document.getElementById('ReloadThis').innerHTML=xmlHttp.responseText;
		setTimeout('Ajax()',50000);
	}
}
xmlHttp.open("GET","chk_one_login.php?mac=<?php print $mac; ?>&UserName=<?php print $UserName; ?>",true);
xmlHttp.send(null);
}

window.onload=function(){
	setTimeout('Ajax()',5000);
}
delete xmlHttp;
delete XMLHttpRequest;
delete ActiveXObject;
</script>

 
</head>

<body   >
 <center><div id="ReloadThis">...</div><center>
</body>
</html>
