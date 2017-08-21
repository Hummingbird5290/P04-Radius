<? 
  include("../include/chklogin.php");  
  //    ini_set('display_errors', 1);
  // error_reporting(E_ALL);
  include("../Connections/dbconnect.php");
  include("../include/function.php");  
$Dsearch=$date_view;
if($Dsearch1=='')
                { $Dsearch1="$date_view $shour:$sdmin";  $Dsearch2="$date_view $ehour:$emin";   $MM="( datetime  between  '$Dsearch1' 	and '$Dsearch2')"; 
				$MM= base64_encode ( $MM ); }
else
             {   }

 

 
 

// consyslog();
//print " $hostname_syslog, $username_syslog, $password_syslog ";
 $connect_db_syslog= mysql_connect ($hostname_syslog, $username_syslog, $password_syslog);
mysql_select_db($database_syslog, $connect_db_syslog)  or trigger_error(mysql_error(),E_USER_ERROR);
 
 include("../Connections/class.php");
include("class.php");
if(mdate1=="")  { $mdate1 = date("Y-m-d");  }
 if($tb==""){
     if($date_view !=null   ) { 
	 
	 $date_view = preg_replace("/-/i", "", $date_view);
	 $tb="$date_view";  } else {$tb = date("Ymd"); }

$tb ="log_$tb";
}
//check  ว่า  tbl มีจริงหรือไม่ 
if (!mysql_is_table($tb))  {

                                             echo                  "<script type=text/javascript>";
                                             echo                  "alert('ไม่มีข้อมูลในวันที่  $date_view  ')";
	                                         echo                  "</script>";
									           $tb = date("Ymd"); 
											 $tb ="log_$tb";   }
											 
 									 
?>
<html>
<head>
<title>SYSTEM-Proxy-<?php print "$host-$date_view"; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<link href="css/style.css" rel="stylesheet" type="text/css">
<style rel="stylesheet" type="text/css">
span.info {
display:block;
margin:15px 0;
padding:10px 10px 10px 65px;
  no-repeat scroll 10px 50% #D8E5F8;
border-bottom:3px solid #629DE3;
border-top:3px solid #629DE3;
color:#0055BB;
}
.menuhead {
display:block;
margin:1px 0;

no-repeat scroll 1px 50% #D8E5F8;
border-bottom:3px solid #629DE3;
border-top:3px solid #629DE3;
color:#0055BB;
}

a {
	text-decoration: none;
}
 body, td {
line-height:150%; }
</style>

<style type="text/css">

table.imagetable {
	font-family: verdana,arial,sans-serif;
	font-size:11px;
	color:#333333;
	border-width: 1px;
	border-color: #999999;
	border-collapse: collapse;
}
table.imagetable th {
	background:#b5cfd2 url('cell-blue.jpg');
	border-width: 1px;
	padding: 8px;
	border-style: solid;
	border-color: #999999;
no-repeat scroll 1px 50% #D8E5F8;
}
table.imagetable td {
	background:#dcddc0 url('cell-grey.jpg');
	border-width: 1px;
	padding: 8px;
	border-style: solid;
	border-color: #999999;
}
</style>
 <style type="text/css">
.styled-button-2 {
	-webkit-box-shadow:rgba(0,0,0,0.2) 0 1px 0 0;
	-moz-box-shadow:rgba(0,0,0,0.2) 0 1px 0 0;
	box-shadow:rgba(0,0,0,0.2) 0 1px 0 0;
	border-bottom-color:#333;
	border:1px solid #61c4ea;
	background-color:#7cceee;
	border-radius:5px;
	-moz-border-radius:5px;
	-webkit-border-radius:5px;
	color:#333;
	font-family:'Verdana',Arial,sans-serif;
	font-size:14px;
	text-shadow:#b2e2f5 0 1px 0;
	padding:5px
}
</style>
<style type="text/css">
<!--
body {
	background-color: #FFFFFF;
}
-->
</style>
<script language="JavaScript" src="Carlendar/calendar.js"></script>
<link href="Carlendar/calendar-mos.css" rel="stylesheet" type="text/css">
<script language="Javascript" type="text/javascript" src="script/tooltip.js"></script>
<script language="Javascript" type="text/javascript" src="script/ajax.js"></script>
<style type="text/css">

#lyrtooltip {
     position:absolute;
     border:1px solid #FFA500;
     background-color: white;
     padding:3px;
     text-align:left;
}
</style>
<style type="text/css">
<!--
.style1 {
	color: #FFFFFF;
	font-weight: bold;
}
.style2 {color: #000000}
.style3 {color: #000000; font-weight: bold; }
-->
</style>
<script type="text/JavaScript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
</script>
<body>
<form name="form1" method="get" action="list_proxy.php?host=<?php print "$host";?>">
  <?
	
		//$condition = "  ";
		if(trim($txt_search)<>''){
 $txt_search = htmlspecialchars("$txt_search", ENT_QUOTES);
$pattern = '/;/i';
$replacement = NULL;
$txt_search= preg_replace($pattern, $replacement, $txt_search);
		  
			$condition = "  and     msg   like  '%$txt_search%'    ";
		}
		if (empty($offset) || $offset < 0) { 
		   $offset=0; 
		} 
		//    Set $limit,  $limit = Max number of results per 'page' 
		if(!$limit){
			$limit = 300;
		}
		//    Set $totalrows = total number of rows that unlimited query would return 
		//    (total number of records to display across all pages) 
		$sql = "SELECT *  FROM   $tb      where     msg  like '%web-proxy,account $host:%'  
  and  	 	 ( datetime  between  '$Dsearch1' 	and '$Dsearch2')  	$condition";

		$query_data = $db->query($sql);
		$rows = mysql_num_rows($query_data);
			// Set $begin and $end to record range of the current page 
		    $begin =($offset+1); 
		    $end = ($begin+($limit-1)); 
		    if ($end > $totalrows) { 
			   $end = $totalrows; 
		    } 
		$Show = $sql."  ORDER BY   datetime  DESC  LIMIT $offset, $limit";
		$query_data = $db->query($Show);
 
?>

  <table width="1218" border="0" align="center" cellpadding="1" cellspacing="1" class="imagetable">
    <tr bgcolor="#FFFFFF"> 
      <th height="30" colspan="5"> <div align="right"><strong>ค้นหา</strong> 
          <input name="txt_search" type="text" value="<?=$txt_search;?>" size="40">&nbsp;หากต้องการดูทั้งหมดปล่อยว่างไว้
          
<!--          จาก&nbsp;Sever 
          <select name="host">
            <option value="" selected>โปรดเลือก</option>
            <?php echo  "$list_data_server"; ?> 
          </select> -->
           
        </div></th>
    </tr>
	<tr bgcolor="#FFFFFF" >
       <td  colspan="5">
	     <div align="right">
	       <strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">โปรดเลือกโหนด ที่ต้องการแสดงรายงาน  &nbsp;Mikrotik Link&nbsp;
	       <select name="host" >
		
		  <?php
 mysql_select_db($database_edoc, $connect_db)  or trigger_error(mysql_error(),E_USER_ERROR);
 $query_server_HOST = "SELECT  *  FROM   mikrotik_link  where domain='$domain_name'  ";
 $Recordset_server_HOST = mysql_query($query_server_HOST, $connect_db) or trigger_error(mysql_error(),E_USER_ERROR); 
$row_Recordset_server_HOST = mysql_fetch_assoc($Recordset_server_HOST);
do {
?>
            <option value="<?php print "$domain_name.".$row_Recordset_server_HOST[mk_id];?>"><?php print $row_Recordset_server_HOST[link_name];?></option>
      <?php  }   while ($row_Recordset_server_HOST = mysql_fetch_assoc($Recordset_server_HOST));    ?>   
          </select>&nbsp;&nbsp;&nbsp;
		  โดยค้นหาจากวันที่ 
          <input name="date_view" type="text" value="<?php print date("Y-m-d");?>"  id="date_view" onClick="showCalendar('date_view','YYYY-MM-DD')" size="20"   readonly="yes" >&nbsp;&nbsp;
		  ตั้งแต่เวลา-ถึงเวลา</font></strong>
	       <select name="shour" id="shour">
	           <option value="00" selected >00</option>
	         <?php
		 $xDay = 1; 
   while ($xDay <= 23) { 
   if($xDay >10) { $xDay="$xDay"; }
      echo " <option value=$xDay >$xDay</option>\r\n";
      $xDay++; 
   }
   ?>
           </select>
	       :
	       <select name="sdmin" id="sdmin">
	         <?php
		 $xDay = 1; 
   while ($xDay <= 59) { 
   if($xDay >10) { $xDay="$xDay"; }
      echo " <option value=$xDay >$xDay</option>\r\n";
      $xDay++; 
   }
   ?>
           </select>
	       ถึง 
	       <select name="ehour" id="ehour">
	         <option value=23 selected >23</option>
	         <?php
		 $xDay = 1; 
	
   while ($xDay <= 23) { 
   if($xDay >10) { $xDay="$xDay"; }
      echo " <option value=$xDay >$xDay</option>\r\n";
      $xDay++; 
   }
   ?>
           </select>
	       :
	       <select name="emin" id="emin">
	           <option value=00 selected >00</option>
	         <?php
		 $xDay = 1; 
   while ($xDay <= 59) { 
   if($xDay >10) { $xDay="$xDay"; }
      echo " <option value=$xDay >$xDay</option>\r\n";
      $xDay++; 
   }
   ?>
           </select>&nbsp;&nbsp;<input type="submit" name="Submit" value="  แสดงรายงาน  " class="styled-button-2"  >
         </div></td>
    </tr>
    
    <tr bgcolor="#AFFFFF"> 
      <th colspan="5"> <div align="center" class="style1 style2"><strong><font size="3" face="MS Sans Serif, Tahoma, sans-serif">Log  web access <?php echo "ของวันที่ $tb" ?>&nbsp;LINK  &nbsp;</font></strong>
           <?php print $host;?>
      </div></th>
    </tr>
    <tr bgcolor="#AFFFFF">
      <th width="18%" align="center"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">เวลา</font></strong></th> 
      <th width="12%" align="center" bgcolor="AFFFFF"><div align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>Server</strong></font></div></th>
      <th width="17%" align="center" bgcolor="AFFFFF">
	  <strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><span class="style3">User </span></font></strong></th>
    
      <th width="53%" align="center"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">Output </font></strong></th>
    </tr>
    <? $aa=1;
  if($rows<>0){
	 
	  while($result_data = mysql_fetch_array($query_data)){
	  
	     $aa=$aa+1;
	  	$cli=$aa%2;
		if($cli=="0")  {$cli="#F0D2FF" ;  } else {    $cli="#FFFFFF" ;   }
 			
			 if( !preg_match('/DPT=53/',$result_data[msg]))	{		
        	 $User_msg=$result_data[msg];
		     $a_msg= explode(" ",$User_msg) ;
			 
	//	if($a_msg[3]!=NULL)	 {
	 $user_name_logins = getuser_names($a_msg[2],$host,$result_data[datetime],$tb);
	 if($user_name_logins !="NOSECLECT") {
     ?>
    <tr bgcolor="<?php echo "$cli"; ?>" >
      <td class="style2"><div align="center"> <?       date_to_thai($result_data[datetime]);?> </div></td> 
      <td class="style2"  ><div align="center"> <? print $result_data[host];?> </div></td>
      <td height="21" class="style2"  > 
        <div align="center">
         
          <a href="#search" onClick="newwindow=window.open('detail_user.php?id_edit=<? print $user_name_logins;?>','detail_user','height=600,width=600,left=10,top=100,scrollbars=1');newwindow.focus();"> 
          <? print  $user_name_logins;?> 
               </a> </div></td><td class="style2">   
	  &nbsp;&nbsp;
	  <?  
//print $word=$result_data[msg];  
 //print $a_msg[3];
 print substr($result_data[msg],0,80);
	  ?> </td>
    </tr>
    <?
	} //ck user name
 //} // if msg not NULL
	
	} //  DPT=53
			
		}  
	}else{	

  ?>
    <tr bgcolor="<?php echo "$cli"; ?>" > 
      <td colspan="5"><div align="center"><strong><font color="#FF0000">ไม่พบข้อมูล</font></strong></div></td>
    </tr>
    <? 	}
  ?>
  </table>
<br><br>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
          <td background="images/line.jpg">&nbsp;</td>
    </tr>
  </table>
<? if($rows > 0){ ?>
	
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="0">
  <tr> 
          <td><img src="../images/test.gif" width="16" height="16" border="0" align="absmiddle"> 
            <strong>หน้าที่</strong> <?php
// Begin Prev/Next Links 
// Don't display PREV link if on first page 
if ($offset !=0) {   
$prevoffset=$offset-$limit; 

echo   "<a href='list_proxy.php?offset=$prevoffset&txt_search=$txt_search&host=$host&tb=$tb&date_view=$Dsearch&shour=$shour&sdmin=$sdmin&ehour=$ehour&emin=$emin&tb=$tb&Dsearch1=$Dsearch1&Dsearch2=$Dsearch2'>
<font  color=\"red\"><< ก่อนหน้า</font></a>\n\n";
    }
    // Calculate total number of pages in result 
    $pages = intval($rows/$limit); 
     
    // $pages now contains total number of pages needed unless there is a remainder from division  
    if ($rows%$limit) { 
        // has remainder so add one page  
        $pages++; 
    } 
     
    // Now loop through the pages to create numbered links 
    // ex. 1 2 3 4 5 NEXT 
		# ไม่ให้เกิน ร้อยหน้า 
 
	
    for ($i=1;$i<=$pages;$i++) { 
        // Check if on current page 
        if (($offset/$limit) == ($i-1)) { 
            // $i is equal to current page, so don't display a link 
            echo "$i "; 
        } else { 
            // $i is NOT the current page, so display a link to page $i 
            $newoffset=$limit * ($i-1); 
                  echo  "<a href='list_proxy.php?offset=$newoffset&txt_search=$txt_search&host=$host&tb=$tb&date_view=$Dsearch&shour=$shour&sdmin=$sdmin&ehour=$ehour&emin=$emin&tb=$tb&Dsearch1=$Dsearch1&Dsearch2=$Dsearch2' ><font  color=\"black\">$i</font></a>\n\n"; 
        } 
    } 

    // Check to see if current page is last page 
   if (!((($offset/$limit)+1)==$pages) && $pages!=1) { 
        // Not on the last page yet, so display a NEXT Link 
        $newoffset=$offset+$limit; 
        echo   "<a href='list_proxy.php?offset=$newoffset&txt_search=$txt_search&host=$host&tb=$tb&date_view=$Dsearch&shour=$shour&sdmin=$sdmin&ehour=$ehour&emin=$emin&tb=$tb&Dsearch1=$Dsearch1&Dsearch2=$Dsearch2'>
		  <font  color=\"red\">ถัดไป>></font></a>\n"; 
    }
?></td>
    </tr>
  </table>
  <?
	 }
?>
</form>
<?php

mysql_close($connect_db);

 
?>
<p align="right"><a href="index.php"><font color="#0000FF">กลับหน้าหลักผู้ดูแลระบบ</font></a> 
</p>

<div align="center">
<?php //print $sql; 
//print_r($a_msg);
 
 function  getuser_names($id,$host,$times,$tb){
 include('main_connect.php');
   $timess= explode(" ",$times) ;
    $times= $timess[0];
 
	
 $connect_db_syslog= mysql_connect($hostname_edoc, $username_edoc, $password_edoc) or trigger_error(mysql_error(),E_USER_ERROR); 
  mysql_select_db($database_edoc, $connect_db_syslog)  or trigger_error(mysql_error(),E_USER_ERROR);
    mysql_query("SET character_set_results=tis620");
    mysql_query("SET character_set_client=tis620");
    mysql_query("SET character_set_connection=tis620");
    mysql_query("SET collation_connection = tis620_thai_ci");
    mysql_query("SET collation_database = tis620_thai_ci");
    mysql_query("SET  collation_server = tis620_thai_ci");
       $query_Recordset1 = " Select  *  from  radacct  where 	FramedIPAddress = '$id'   and  AcctStartTime like '%$times%'   order by RadAcctId desc  ";
$Recordset1 = mysql_query($query_Recordset1, $connect_db_syslog) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);

if($row_Recordset1[UserName]==NULL) { 
deldata($row_Recordset1[seq],$tb);
return "NOSECLECT";
}else {
return $row_Recordset1[UserName];
}
  }
  
  function deldata($id,$tb){
 include('main_connect.php');
  $connect_db_syslog= mysql_connect($hostname_edoc, $username_edoc, $password_edoc) or trigger_error(mysql_error(),E_USER_ERROR); 
  mysql_select_db("syslog", $connect_db_syslog)  or trigger_error(mysql_error(),E_USER_ERROR);
    mysql_query("SET character_set_results=tis620");
    mysql_query("SET character_set_client=tis620");
    mysql_query("SET character_set_connection=tis620");
    mysql_query("SET collation_connection = tis620_thai_ci");
    mysql_query("SET collation_database = tis620_thai_ci");
    mysql_query("SET  collation_server = tis620_thai_ci");
      $query_Recordset1 = " delete   from  $tb  where seq = '$id'     ";
  mysql_query($query_Recordset1, $connect_db_syslog) or die(mysql_error());
  }?></div><br>
<br>
<br>
<?php // print_r( $a_msg);?>
</body>
</html>
 