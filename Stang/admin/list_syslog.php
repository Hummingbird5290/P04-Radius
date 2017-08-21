<? 
  include("../include/chklogin.php");  
  include("../Connections/dbconnect.php");
  include("../include/function.php");  
$Dsearch=$date_view;
if($Dsearch1=='')
                { $Dsearch1="$date_view $shour:$sdmin";  $Dsearch2="$date_view $ehour:$emin";   $MM="( datetime  between  '$Dsearch1' 	and '$Dsearch2')"; 
				$MM= base64_encode ( $MM ); }
else
             {   }

if($Typ_view=="msword")  
{

		     echo "<meta http-equiv=refresh content=0;URL=msword_syslog.php?date_view=$date_view&shour=$shour&sdmin=$sdmin&ehour=$ehour&emin=$emin&host=$host&MM=$MM>"; 
exit();
} 
 mysql_select_db($database_edoc); //  or trigger_error(mysql_error(),E_USER_ERROR);

 consyslog();
 //mysql_select_db($database_syslog, $connect_db_syslog)  or trigger_error(mysql_error(),E_USER_ERROR);
 
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
											 
$query_server = "delete    FROM   $tb  where  msg like '%web-proxy,debug%'   ";
$Recordset_server = mysql_query($query_server, $connect_db) or die(mysql_error());
$row_Recordset_server = mysql_fetch_assoc($Recordset_server);
 
 									 
?>
<html>
<head>
<title>SYSTEMLOG_<?php print "$host-$date_view"; ?></title>
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
}
table.imagetable td {
	background:#dcddc0 url('cell-grey.jpg');
	border-width: 1px;
	padding: 8px;
	border-style: solid;
	border-color: #999999;
}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<link href="css/style.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="Carlendar/calendar.js"></script>
<link href="Carlendar/calendar-mos.css" rel="stylesheet" type="text/css">
<script language="Javascript" type="text/javascript" src="script/tooltip.js"></script>
<script language="Javascript" type="text/javascript" src="script/ajax.js"></script>
<script type="text/JavaScript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
</script>
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
-->
</style>
<body>
<form name="form1" method="get" action="list_syslog.php?host=<?php print "$host";?>">
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
			$limit = 30;
		}
		//    Set $totalrows = total number of rows that unlimited query would return 
		//    (total number of records to display across all pages) 
		$sql = "SELECT *   FROM   $tb  
		                  where       host='$host'
					and	 ( datetime  between  '$Dsearch1' 	and '$Dsearch2') 
						and msg like '%firewall%'    
						 		$condition";

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

  <table width="1166" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#FFFFCC" class="imagetable">
    <tr bgcolor="#FFFFFF"> 
      <th height="30" colspan="4"> <div align="right"><strong>ค้นหา</strong> 
          <input name="txt_search" type="text" value="<?=$txt_search;?>" size="40">
          โดยค้นหาจากวันที่ 
          <input name="date_view" type="text"   value="<?php print date("Y-m-d");?>"    id="date_view" onClick="showCalendar('date_view','YYYY-MM-DD')" size="20"   readonly="yes" >
<!--          จาก&nbsp;Sever 
          <select name="host">
            <option value="" selected>โปรดเลือก</option>
            <?php echo  "$list_data_server"; ?> 
          </select> -->
           
        </div></th>
    </tr>
	<tr bgcolor="#FFFFFF" >
       <th  colspan="4">
	     <div align="right">
	       <strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">Mikrotik Link
           <select name="host" >
		
		  <?php
 mysql_select_db($database_edoc, $connect_db)  or trigger_error(mysql_error(),E_USER_ERROR);
 $query_server_HOST = "SELECT   ip_vpn,link_name   FROM   mikrotik_link  where domain='$domain_name'  ";
 $Recordset_server_HOST = mysql_query($query_server_HOST, $connect_db) or trigger_error(mysql_error(),E_USER_ERROR); 
$row_Recordset_server_HOST = mysql_fetch_assoc($Recordset_server_HOST);
do {
?>
            <option value="<?php print $row_Recordset_server_HOST[ip_vpn];?>"><?php print $row_Recordset_server_HOST[link_name];?>(<?php print $row_Recordset_server_HOST[ip_vpn];?>)</option>
      <?php  }   while ($row_Recordset_server_HOST = mysql_fetch_assoc($Recordset_server_HOST));    ?>   
          </select>&nbsp;&nbsp;ตั้งแต่เวลา 
        ถึงเวลา</font></strong>
	       <select name="shour" id="shour">
	           <option value=00 selected >00</option>
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
           </select>
         </div></th>
    </tr>
    <tr bgcolor="#FFFFFF">
      <th height="30" colspan="4"><div align="right">
        <input type="submit" name="Submit" value="  ค้นหา  "   class="styled-button-2"  >
      </div></th>
    </tr>
    <tr bgcolor="#AFFFFF"> 
      <th colspan="4"> <div align="center" class="style1 style2"><strong><font size="3" face="MS Sans Serif, Tahoma, sans-serif">Log 
          System <?php echo "ของวันที่ $tb" ?>&nbsp;&nbsp;LINK  &nbsp;</font></strong>
   <?php print $host;?>
      </div></th>
    </tr>
    <tr bgcolor="#AFFFFF">
      <th width="12%" align="center"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">เวลา</font></strong></th> 
      <th width="13%" align="center" bgcolor="AFFFFF"><div align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>Server</strong></font></div></th>
      <th width="75%" align="center"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">Output </font></strong></th>
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
			 
     ?>
    <tr bgcolor="<?php echo "$cli"; ?>" >
      <td height="21"><div align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><? print $result_data[datetime];?></font></div></td> 
      <td  ><div align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><? print $result_data[host];?></font></div></td>
      <td><font size="2" face="MS Sans Serif, Tahoma, sans-serif">	  
	  <?  
//print $word=$result_data[msg];  
   print $word=substr($result_data[msg],0,140);
 
	  ?></font></td>
    </tr>
    <?
 
	
	} //  DPT=53
			
		}  
	}else{	

  ?>
    <tr bgcolor="<?php echo "$cli"; ?>" > 
      <td colspan="4"><div align="center"><strong><font color="#FF0000">ไม่พบข้อมูล</font></strong></div></td>
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

echo   "<a href='list_syslog.php?offset=$prevoffset&txt_search=$txt_search&host=$host&tb=$tb&date_view=$Dsearch&shour=$shour&sdmin=$sdmin&ehour=$ehour&emin=$emin&tb=$tb&Dsearch1=$Dsearch1&Dsearch2=$Dsearch2'>
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
                  echo  "<a href='list_syslog.php?offset=$newoffset&txt_search=$txt_search&host=$host&tb=$tb&date_view=$Dsearch&shour=$shour&sdmin=$sdmin&ehour=$ehour&emin=$emin&tb=$tb&Dsearch1=$Dsearch1&Dsearch2=$Dsearch2' ><font  color=\"black\">$i</font></a>\n\n"; 
        } 
    } 

    // Check to see if current page is last page 
   if (!((($offset/$limit)+1)==$pages) && $pages!=1) { 
        // Not on the last page yet, so display a NEXT Link 
        $newoffset=$offset+$limit; 
        echo   "<a href='list_syslog.php?offset=$newoffset&txt_search=$txt_search&host=$host&tb=$tb&date_view=$Dsearch&shour=$shour&sdmin=$sdmin&ehour=$ehour&emin=$emin&tb=$tb&Dsearch1=$Dsearch1&Dsearch2=$Dsearch2'>
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
/*
for ($i = 1; $i <= 600; $i++) {
$db  = mktime(0, 0, 0, date("m")  , date("d")+$i, date("Y"));

$db = date("Ymd", $db); 

$sql = "CREATE TABLE IF NOT EXISTS  log_$db  (
   host  varchar(300) default NULL,
  facility   varchar(300) default NULL,
   priority  varchar(300) default NULL,
   level  varchar(300) default NULL,
   tag  varchar(300) default NULL,
  datetime  datetime default NULL,
   program  varchar(300) default NULL,
  msg  text,
   seq  bigint(20) unsigned NOT NULL auto_increment,
  PRIMARY KEY  (seq),
  KEY host (host),
  KEY  program (program),
  KEY  datetime (datetime),
  KEY  priority  (priority),
  KEY  facility (facility)
) ENGINE=InnoDB DEFAULT CHARSET=tis620;   ";
  print $sql.'<br>';
  $dbquery =mysql_query($sql, $connect_db) or trigger_error(mysql_error(),E_USER_ERROR);
  }
  */
mysql_close($connect_db);

// print $sql;
?>
<p align="right"><a href="index.php"><font color="#0000FF">กลับหน้าหลักผู้ดูแลระบบ</font></a> 
</p>

<div align="center"> <?php // print $sql;?></div>
</body>
</html>
