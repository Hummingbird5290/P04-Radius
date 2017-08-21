<?php
    ini_set('display_errors', 1);
   error_reporting(All); 

$variablee = include "http://admin:010464088@192.168.74.115:88/goform/WIAUSSDSend?idPort0=0&CurrentPort=0&MsgInfo=*121#&Send&Send"; 
echo $variablee;

exit();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta   http-equiv="Expires"   CONTENT="0">  
<meta   http-equiv="pragma" content="no-cache">
<meta   http-equiv="Cache-Control"   CONTENT="no-cache">  
<meta   http-equiv="Cache-Control"   CONTENT="no-store"> 
<title>USSD</title>
<link href="css/main.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/JavaScript" src="common/func.htm"></script>
<script language="javascript" type="text/javascript">
function MM_callJS(USSDEnable,FxoPortNum,FxsPortNum,FxoMap,Port) 
{
	var totalPort = parseInt(FxoPortNum) + parseInt(FxsPortNum);
	
	document.forms[0].CurrentPort.value = Port;
	
	var sel = document.getElementById("CurrentPort");
	var idSel0 = document.getElementById("idPort0");
	var idSel1 = document.getElementById("idPort1");
	var idSel2 = document.getElementById("idPort2");
	var idSel3 = document.getElementById("idPort3");
	var idSel4 = document.getElementById("idPort4");
	var idSel5 = document.getElementById("idPort5");
	var idSel6 = document.getElementById("idPort6");
	var idSel7 = document.getElementById("idPort7");
	var idSel8 = document.getElementById("idPort8");
	var idSel9 = document.getElementById("idPort9");
	var idSel10 = document.getElementById("idPort10");
	var idSel11 = document.getElementById("idPort11");
	var idSel12 = document.getElementById("idPort12");
	var idSel13 = document.getElementById("idPort13");
	var idSel14 = document.getElementById("idPort14");
	var idSel15 = document.getElementById("idPort15");
				
	for(var i=0; i<16; i++)
	{
		if (i >= totalPort || (FxoMap & (0x1<<i))==0)
		{
			eval("sel.remove(idSel"+i+".index);");				
		}
	}		
		
	if (USSDEnable == 1)
	{
		document.forms[0].CurrentPort.disabled=true;
		document.getElementById("frm_ussd").src="MsgUSSD.htm";
	}
}

function USSDCancel()
{
	if(confirm("Exit USSD session?"))
	{  
		document.forms[0].action="/goform/WIAUSSDCancel";
		return true;
	}
	return false;
}

function onRefresh()
{		
	var goformVal;

	goformVal = "/goform/WIAUSSDGoto" + document.forms[0].CurrentPort.value;
	document.forms[0].action = goformVal;
	document.forms[0].submit();	
}

function form_check()
{
	if (document.forms[0].MsgInfo.value.length == 0
	|| document.forms[0].MsgInfo.value.length > 60)
	{
		alert("ÓÃ»§ÊäÈë²»ÄÜÎª¿Õ£¬ÇÒ²»ÄÜ´óÓÚ60×Ö½Ú!");
		document.forms[0].MsgInfo.select();
		return false;
	}
	
	document.forms[0].action="http://admin:010464088@ais.t-voip0.zapto.org:81/goform/WIAUSSDSend";
	return true;
}
</script>
</head>
<body  onLoad="MM_callJS('0','1','0','1','0')">
<form action="http://admin:010464088@ais.t-voip0.zapto.org:81/goform/WIAUSSDSend" method="post" name="WIAUSSDSend" id="WIAUSSDSend">
<table width="600px" border=0 align="center" cellpadding=0 cellspacing=0>
 <tr class="title">
  <td width="1%"><img src="image/subarc_l.gif" alt="subarc_left" align="left"></td>
  <td>USSD</td>
  <td width="1%"><img src="image/subarc_r.gif" alt="subarc_right" align="right"></td>
 </tr>
</table>
<table width="600px" align="center" class="TB" cellpadding="0" cellspacing="0">
  <tr>
   <td width="5%">&nbsp;</td>
   <td width="90%">
     <table width="100%" cellspacing="0" cellpadding="0">
       <tr>
         <td width="12%">&nbsp;</td>
         <td width="88%">&nbsp;</td>
       </tr>  
           
       <tr>
         <td class="td_title">Port</td>
         <td>
          <select name="CurrentPort" class="list" id="CurrentPort" onChange="onRefresh()">
           <option id="idPort0" value="0">Port 0</option>
           <option id="idPort1" value="1">Port 1</option>
           <option id="idPort2" value="2">Port 2</option>
           <option id="idPort3" value="3">Port 3</option>
           <option id="idPort4" value="4">Port 4</option>
           <option id="idPort5" value="5">Port 5</option>
           <option id="idPort6" value="6">Port 6</option>
           <option id="idPort7" value="7">Port 7</option>
           <option id="idPort8" value="8">Port 8</option>
           <option id="idPort9" value="9">Port 9</option>
           <option id="idPort10" value="10">Port 10</option>
           <option id="idPort11" value="11">Port 11</option>
           <option id="idPort12" value="12">Port 12</option>
           <option id="idPort13" value="13">Port 13</option>
           <option id="idPort14" value="14">Port 14</option>
           <option id="idPort15" value="15">Port 15</option>		  
          </select>		   
         </td>             
       </tr>
       <tr>
         <td>&nbsp;</td>
         <td>&nbsp;</td>
       </tr>        
       <tr>
         <td valign="top" class="td_title">Display</td>
         <td align="right">
           <textarea name="USSDInfo" style="width:100%" rows="10" readonly="readonly" id="USSDInfo"></textarea>
          </td>
       </tr>
       <tr>
         <td valign="top" class="td_title">Input</td>
         <td>
           <textarea name="MsgInfo" id="MsgInfo" style="width:100%" rows="4"></textarea>
	     </td>
       </tr>   
       <tr>
         <td>&nbsp;</td>
         <td>&nbsp;</td>
       </tr>             
     </table>     
   </td>  
   <td width="5%">&nbsp;</td>
  </tr>
</table>
<iframe style="display:none" height="0" width="0" id="frm_ussd" name="frm_ussd"></iframe>
<p></p>
<table width="600px" align="center" cellpadding="0" cellspacing="0">
  <tr align="center">
   <td class="notes">NOTE:&nbsp;If you do nothing within 90s, connection will be disconnected.</td>
  </tr> 
</table>
<p align="center">
  <input name="Send"  class="button" type="submit" id="Send" value="Send"onClick="return form_check();">
  &nbsp;&nbsp;&nbsp;&nbsp;
  <input name="Cancel" class="button" type="submit" id="Cancel" value="Exit" onClick="return USSDCancel();"> 
</p>
</form>
</body>
</html
