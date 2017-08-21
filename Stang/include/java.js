// Created 17/09/2002 by KAK : EBO Company  :

function showlayer (id) {
  var id,obj;
  obj = document.getElementById(id);
  obj=obj.style;
  obj.visibility="visible";
  
}
function hidelayer (id) {
  var id,obj;
  obj = document.getElementById(id);
  obj=obj.style;
  obj.visibility="hidden";
}
function hl_on_menu (id) {
   var id,obj;
  obj = document.getElementById(id);
  obj=obj.style;
  obj.backgroundColor = "#FF0000";
  obj.color = "#FFFFFF";
  obj.cursor = "hand";
}

function hl_off_menu (id) {
   var id,obj;
   obj = document.getElementById(id);
   obj=obj.style;
   obj.backgroundColor = "#FFFFFF";
   obj.color = "#000000";
}
function gotourl(url) {document.location = url;}

 function new_win_def_prot(mypage, myname, w, h, scroll,fullscreen) { //Show center screen,focus page in use
				var winl = (screen.width - w) / 2;
				var wint = (screen.height - h) / 2;
				winprops = 'height='+h+',width='+w+',top='+wint+',left='+winl+',scrollbars='+scroll+',fullscreen='+fullscreen+',resizable,toolbar=no,location=no,status=no,menubar=no'
				win = window.open(mypage, myname, winprops)
				if (parseInt(navigator.appVersion) >= 4) { win.window.focus(); }
}
 function new_win_def_prot1(mypage, myname, w, h, scroll,fullscreen) { //Show center screen,focus page in use
				var winl = (screen.width - w) / 2;
				var wint = (screen.height - h) / 2;
				winprops = 'height='+h+',width='+w+',top='+wint+',left='+winl+',scrollbars='+scroll+',fullscreen='+fullscreen+',resizable,toolbar=no,location=no,status=no,menubar=no'
				win = window.open(mypage, myname, winprops)
				if (parseInt(navigator.appVersion) >= 4) { win.window.focus(); }
}

 function new_win_def_prot2(mypage, myname, w, h, scroll,fullscreen) { //Show center screen,focus page in use
				var winl = (screen.width - w) / 2;
				var wint = (screen.height - h) / 2;
				winprops = 'height='+h+',width='+w+',top='+wint+',left='+winl+',scrollbars='+scroll+',fullscreen='+fullscreen+',resizable,toolbar=no,location=no,status=no,menubar=no'
				win = window.open(mypage, myname, winprops)
				if (parseInt(navigator.appVersion) >= 4) { win.window.focus(); }
}
function chkEmail (str) 
	{
	    var num_as = str.lastIndexOf("@");
		var num_poin = str.lastIndexOf(".");
	    if (num_as == -1 || num_poin ==-1) 
		{
		     return false; 
	    }else
		{
		   return true;
		}
   }
function isBlank(val) {
if (val=="") {
		return true;		
	}
	return false;
}

 function isNum (charCode) 
   {
       if (charCode >= 48 && charCode <= 57 )
	       return true;
      else
	     return false;
   }
   function isAtoZ (charCode) 
   {
       if (charCode >= 65 && charCode <= 90 )
	       return true;
      else
	     return false;
   }
   function isaToz (charCode)
   {
      if (charCode >= 97 && charCode <= 122 )
	       return true;
      else
	     return false;
   }
    function  chkFormatThai (str) { // Not A-Z,a-z
        strlen = str.length;
       for (i=0;i<strlen;i++)
      {
            var charCode = str.charCodeAt(i);
			if (isAtoZ(charCode) || isaToz(charCode))
			   return false;
	  }//for
        return true;
	}

/* function chkFormatThai (str) {// Thai alphabet , Sa-Ra , Wan-Na-Yuk 
  strlen = str.length;
  for (i=0;i<strlen;i++)
  {
      var charCode = str.charCodeAt(i);
	  if (!isThaiAlphabet (charCode) &&  !isSRWNY (charCode) && !isNum (charCode)) { 
		  return false;
	  }
   }
   return true;
}*/
function isThaiAlphabet (charCode) {
	if (charCode >=3585 && charCode <=3630) // ?-?
	     return true;
    else
		return false;
	
}

function isSRWNY (charCode) { //  Sa-Ra , Wan-Na-Yuk ** Don't work 100% 11/06/04
	if (charCode >=3631 && charCode <=3670) 
	     return true;
    else
		return false;
	
}
   
 function chkFormatNaA (str) {//0-9,a-z,A-Z
  strlen = str.length;
  for (i=0;i<strlen;i++)
  {
      var charCode = str.charCodeAt(i);
	  if (!isNum(charCode) && !isAtoZ(charCode) && !isaToz(charCode)) {
		  return false;
	  }
   }
   return true;
}

 function chkFormatNam (str) {//0-9
  strlen = str.length;
  for (i=0;i<strlen;i++)
  {
      var charCode = str.charCodeAt(i);
	  if (!isNum(charCode)) {
		  return false;
	  }
   }
   return true;
}

function chkLen (str,numLen)
{
        var  strLen = str.length;
      	if (strLen < numLen) {
		    return false;
		}
     return true;
}

function new_win_def_point(mypage, myname, l, t, w, h, scroll,fullscreen) { //Show center screen,focus page in use
				winprops = 'height='+h+',width='+w+',top='+t+',left='+l+',scrollbars='+scroll+',fullscreen='+fullscreen+',resizable,toolbar=no,location=no,status=yes,menubar=no'
				win = window.open(mypage, myname, winprops)
				if (parseInt(navigator.appVersion) >= 4) { win.window.focus(); }
}
function hl_on_menu (id) {
   var id,obj;
  obj = document.getElementById(id);
  obj=obj.style;
  obj.backgroundColor = "#FFEEDD";
  obj.color = "#FF9933";
  obj.cursor = "hand";
}

function hl_off_menu (id) {
   var id,obj;
   obj = document.getElementById(id);
   obj=obj.style;
   obj.backgroundColor = "#FFDCB9";
   obj.color = "#000000";
}
function auto_close () {
	 setTimeout("closeWin()",3000);
 }
 function closeWin() {
                self.close();
}
function resizeWin(w,h) {
if (window.screen) {
     window.resizeTo(w, h);
   }
}
function maximizeWin() {
	if (window.screen) {
		var aw = screen.availWidth;
		var ah = screen.availHeight;
		window.moveTo(0, 0);
		window.resizeTo(aw, ah);
   }
}
function alertSave (stus) {
   if (stus == "Y")
	    alert ('Process data complete......');
}

/* Checkbox*/
      function ToggleAll(e,f,elementName)
    {
	if (e.checked) {
	    CheckAll(f,elementName);
	}
	else {
	    ClearAll(f,elementName);
	}
    }

    function Check(e)
    {
	e.checked = true;
    }

    function Clear(e)
    {
	e.checked = false;
    }

    function CheckAll(ml,elementName)
    {
	var len = ml.elements.length;
	for (var i = 0; i < len; i++) {
	    var e = ml.elements[i];
	    if (e.name == elementName) {
		    Check(e);
	    }
	}
	ml.toggleAll.checked = true;
    }

    function ClearAll(ml,elementName)
    {
	var len = ml.elements.length;
	for (var i = 0; i < len; i++) {
	    var e = ml.elements[i];
	    if (e.name == elementName) {
		Clear(e);
	    }
	}
	ml.toggleAll.checked = false;
    }
	/* End checkbox*/
	 function hightLightOn (obj) {
       cRef = obj.style.backgroundColor;
           if (cRef != "#59acff") // ????? Mark
           {
                obj.style.backgroundColor = "#D2E9FF";
           }
	 }

	  function hightLightOff (obj) {
       cRef = obj.style.backgroundColor;
           if (cRef != "#59acff")  // ????? Mark
           {
                obj.style.backgroundColor = "#FFFFFF";
           }
	 }

	 function hightLightMark (obj) {
		 var  cRef = obj.style.backgroundColor;
		 var  c1 = "#59acff";  // ????? Mark
         var c2 = "#FFFFFF";   // ????? Mark ???

			if (cRef == c1){
			    obj.style.backgroundColor = c2;
			}else{
			    obj.style.backgroundColor = c1;
			}
	 }

	 function convToCurrency (num,digit_decimal) {
		  
		  if (isBlank(digit_decimal))
		       digit_decimal =2; // Default 2 digit

           var str = roundFloat(num, digit_decimal)+''; // ??????+Convert number to string
		   var t =0;
		   var decimal=textFormat= '';
		   var num_poin = str.lastIndexOf(".");// Find decimal
           var str_len    = str.length;
		   if (num_poin != -1){  // found decimal
		        decimal = str.substring(num_poin,str_len);
				str_len -= decimal.length; 
			}

		  if (str_len != 0){
			for (var k =str_len-1; k>=0 ; k--) {		
			t++;
			if (t % 3 == 0)
			    textFormat = "," + str.substr(k,1) + textFormat; 
			else 
               textFormat =  str.substr(k,1) + textFormat;
		 }//for
	 } 
   
  if (isBlank(decimal))
	   decimal = ".00";

     if (textFormat.substr(0,1) == ",")
         return textFormat.substr(1,textFormat.length-1)+decimal;
    else  
        return textFormat+decimal;
 }

 function roundFloat(fltValue, intDecimal) {
               return Math.round(fltValue * Math.pow(10, intDecimal)) / Math.pow(10, intDecimal)
 }

 function antiChar (str,tragetChar) {
  var strLen = str.length;
  var newStr="";
  for (i=0;i<strLen;i++)
  {
      var thisChar = str.charAt(i);
	  if (thisChar != tragetChar) {
		  newStr += thisChar
	  }
   }
   return newStr;
}
// Jump to target field when character equal digitJump
 function jumpField (obj,digitJump,targetJump) {
        	if (obj.value.length >= digitJump)
			    targetJump.focus();	
	}
// Create new window bo border
function openFrameless(windowW,windowH,urlPop, title){

//Set center  screen
//   var windowX = (screen.width - windowW) / 2;
//   var windowY = (screen.height - windowH) / 2;
var windowY = windowX = 0;
// var debug = ",status=yes";// Debug error

   windowH=windowH+37;
   windowW=windowW+10;
   
   
   s = "width="+windowW+",height="+windowH+",scrollbars=no";
   var beIE = document.all?true:false
   
// set this to true if the popup should close
// upon leaving the launching page; else, false

var autoclose = true
   
  if (beIE){
    //NFW = window.open("","popFrameless","fullscreen,"+s)     
	NFW = window.open("","popFrameless",s)
    NFW.blur()
    window.focus()       
    NFW.resizeTo(windowW,windowH)
    NFW.moveTo(windowX,windowY)
    var frameString=""+
"<html>"+
"<head>"+
"<title>"+title+"</title>"+
"</head>"+
"<frameset rows='*,0' framespacing=0 border=0 frameborder=0>"+
"<frame name='top' src='"+urlPop+"' scrolling=auto>"+
"<frame name='bottom' src='about:blank' scrolling='no'>"+
"</frameset>"+
"</html>"
    NFW.document.open();
    NFW.document.write(frameString)
    NFW.document.close()
  } else {
    NFW=window.open(urlPop,"popFrameless","scrollbars,"+s)
    NFW.blur()
    window.focus() 
    NFW.resizeTo(windowW,windowH)
    NFW.moveTo(windowX,windowY)
  }   
  NFW.focus()   
  if (autoclose){
    window.onunload = function(){NFW.close()}
  }
}

function setErrorFocus (e) {
	   e.style.borderColor='#FF0000';
	   e.style.borderStyle='dashed';
	   e.focus ();
}
function maximizeWindow() {
 if (parseInt(navigator.appVersion)>3) {
  if (navigator.appName=="Netscape") {
   if (top.screenX>0 || top.screenY>0) top.moveTo(0,0);
   if (top.outerWidth < screen.availWidth)
      top.outerWidth=screen.availWidth;
   if (top.outerHeight < screen.availHeight) 
      top.outerHeight=screen.availHeight;
  }
  else {
   top.moveTo(-4,-4);
   top.resizeTo(screen.availWidth+8,screen.availHeight+8);
  }
 }
}
 function newWinDefProt(mypage, myname, winprops) { //Show center screen,focus page in use
				//winprops = 'height='+h+',width='+w+',top='+wint+',left='+winl+',scrollbars='+scroll+',fullscreen='+fullscreen+',resizable,toolbar=no,location=no,status=1,menubar=no'
				win = window.open(mypage, myname, winprops)
				if (parseInt(navigator.appVersion) >= 4) { win.window.focus(); }
}

function number_format(amount)
{
var i = parseFloat(amount);
if(isNaN(i)) { i = 0.00; }
var minus = '';
if(i < 0) { minus = '-'; }
i = Math.abs(i);
i = parseInt((i + .005) * 100);
i = i / 100;
s = new String(i);
if(s.indexOf('.') < 0) { s += '.00'; }
if(s.indexOf('.') == (s.length - 2)) { s += '0'; }
s = minus + s;
return s;
} 

function CommaFormatted(amount)
{
	var delimiter = ","; // replace comma if desired
	var a = amount.split('.',2)
	var d = a[1];
	var i = parseInt(a[0]);
	if(isNaN(i)) { return ''; }
	var minus = '';
	if(i < 0) { minus = '-'; }
	i = Math.abs(i);
	var n = new String(i);
	var a = [];
	while(n.length > 3)
	{
		var nn = n.substr(n.length-3);
		a.unshift(nn);
		n = n.substr(0,n.length-3);
	}
	if(n.length > 0) { a.unshift(n); }
	n = a.join(delimiter);
	if(d.length < 1) { amount = n; }
	else { amount = n + '.' + d; }
	amount = minus + amount;
	return amount;
}

function currency_format (amount) {
  amount = number_format(amount);
  return CommaFormatted(amount);
}

	function chkme(name,number){
			var input_name=name;
			var input_length=input_name.length;
			var sub_colum=input_name.substr(input_length-2);
			var sub_line=input_name.substr(input_length-5,3);
			var sub_name=input_name.substr(0,input_length-5);
			
			var int_colum=parseFloat(sub_colum);
			var int_line=parseFloat(sub_line);
			var t_colum='';
			var colum_str='';
			//alert('name='+name+'   sub_line='+sub_line+'    sub_colum='+sub_colum+'   sub_name='+sub_name);
			
			for(i=1;i<=number;i++){
					colum_str='00'+i;
					t_colum=colum_str.substr(colum_str.length-2);
					if(int_colum!=i){
						document.getElementById(sub_name+sub_line+t_colum).checked=false;
					}
			}
	}