<?php

function randomToken($len) { 
srand( date("s") ); 
//$chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ"; 
$chars = "123456789"; // ��˹��ѡ��з��й��� random ����� 
$ret_str = ""; 
$num = strlen($chars); 
for($i=0; $i < $len; $i++) { 
$ret_str.= $chars[rand()%$num]; // ��ѧ��� rand() ����Ҫ���㹡�÷ӧҹ 
} 
return $ret_str; 
}  

?>
<html>
<head>
<title>ʶҹ����Ҽ����</title>
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
		setTimeout('Ajax()',10000);
	}
}
xmlHttp.open("GET","chk_one_login_ddwrt.php?mac=<?php print $mac; ?>&UserName=<?php print $UserName; ?>",true);
xmlHttp.send(null);
}

window.onload=function(){
	setTimeout('Ajax()',1000);
}
</script>

 
</head>

<body   >
 <center><div id="ReloadThis">...</div><center>
</body>
</html>
