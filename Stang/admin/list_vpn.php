<? 
  include("../include/chklogin.php");  
include("../Connections/dbconnect.php");
 mysql_select_db($database_edoc); //  or trigger_error(mysql_error(),E_USER_ERROR);
include("../Connections/class.php");
include("class.php");
 
?>
<html>
<head>
<title>รายการบัตร</title>
   
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<link href="css/style.css" rel="stylesheet" type="text/css">


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
<body>
<form name="form1" method="post" action="index.php?case_i=67">
  <?
	
		//$condition = "  ";
		if(trim($txt_search)<>''){
			$condition = "   where       radcheck.UserName      like  '%$txt_search%'       ";
		}
		if (empty($offset) || $offset < 0) { 
		   $offset=0; 
		} 
		//    Set $limit,  $limit = Max number of results per 'page' 
		if(!$limit){
			$limit = 100;
		}
		//    Set $totalrows = total number of rows that unlimited query would return 
		//    (total number of records to display across all pages) 
		$sql = "SELECT 
  radcheck.id,
  radcheck.UserName,
  radcheck.Attribute,
  radcheck.op,
  radcheck.Value,
  connection_history.id,
  connection_history.user_id,
  connection_history.start_time,
  connection_history.end_time,
  connection_history.bytes_received,
  connection_history.bytes_sent,
  INET_NTOA(connection_history.trusted_ip) as  trusted_ip,
  connection_history.trusted_port,
  INET_NTOA(connection_history.ifconfig_pool_remote_ip) as  ifconfig_pool_remote_ip
FROM
  connection_history
  INNER JOIN radcheck ON (connection_history.user_id = radcheck.id)
         $condition";

		$query_data = $db->query($sql);
		$rows = mysql_num_rows($query_data);
			// Set $begin and $end to record range of the current page 
		    $begin =($offset+1); 
		    $end = ($begin+($limit-1)); 
		    if ($end > $totalrows) { 
			   $end = $totalrows; 
		    } 
		$Show = $sql." ORDER BY   start_time desc  LIMIT $offset, $limit";
		$query_data = $db->query($Show);

?>
  <table width="90%" border="0" align="center" cellpadding="1" cellspacing="1">
    <tr bgcolor="#FFFFFF"> 
      <td height="30" colspan="7"> <div align="right"><strong>ค้นหาชื่อผู้ใช้</strong> 
          <input name="txt_search" type="text" value="<?=$txt_search;?>" size="40">
          <input type="submit" name="Submit" value="  ค้นหา  ">
        </div></td>
    </tr>
    <tr bgcolor="#CCFFCC"> 
      <td colspan="10"> <div align="center" class="style1 style2"><font size="3" face="MS Sans Serif, Tahoma, sans-serif"><strong>รายการบัตรที่ยังไม่มีการใช้งาน</strong></font></div></td>
    </tr>
    <tr bgcolor="#FFFFCC"> 
      <td width="5%"> <div align="center" class="style3"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">ลำดับ</font></strong></div></td>
      <td width="13%" align="center"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">ชื่อเข้าใช้</font></strong></td>
      <td width="14%" align="center"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">เวลาเริ่มใช้</font></strong></td>
      <td width="18%" align="center"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">ออกจากระบบ</font></strong></td>
      <td width="15%" align="center"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">bytes_received</font></strong></td>
      <td width="11%" align="center"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">bytes_sent </font></strong></td>
 
	   <td width="9%" align="center"><div align="center"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">เชื่อมต่อ port </font></strong></div></td>
	   	   <td width="15%" align="center"><div align="center"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">IP ที่ได้รับ </font></strong></div></td>
    </tr>
    <?
  if($rows<>0){
	  $i=1;
	  while($result_data = mysql_fetch_array($query_data)){
	  $check=$db->query("  SELECT 
  radcheck.id,
  radcheck.UserName,
  radcheck.Attribute,
  radcheck.op,
  radcheck.Value,
  connection_history.id,
  connection_history.user_id,
  connection_history.start_time,
  connection_history.end_time,
  connection_history.bytes_received,
  connection_history.bytes_sent,
INET_NTOA(connection_history.trusted_ip) as  trusted_ip,
  connection_history.trusted_port,
  INET_NTOA(connection_history.ifconfig_pool_remote_ip) as  ifconfig_pool_remote_ip
FROM
  connection_history
  INNER JOIN radcheck ON (connection_history.user_id = radcheck.id)
         $condition");
	  	    $cli=$i%2;
		if($cli=="0")  {$cli="#AAD2FF" ;  } else {    $cli="#FFFFFF" ;   }
	    ?>
    <tr bgcolor="<?php echo "$cli"; ?>" > 
      <td height="21" align="center"> <font size="1" face="MS Sans Serif, Tahoma, sans-serif"> 
        <?=($offset + $i);?>
        .</font></td>
      <td><div align="left"><font size="1" face="MS Sans Serif, Tahoma, sans-serif"> 
          &nbsp;&nbsp; 
          <?  print   $result_data[UserName];   ?>
          </font></div></td>
      <td><font size="1" face="MS Sans Serif, Tahoma, sans-serif"> 
        <?  print   $result_data[start_time];   ?>
        </font></td>
      <td><font size="1" face="MS Sans Serif, Tahoma, sans-serif">
        <?  print   $result_data[end_time];   ?>
        </font></td>
      <td><div align="center"><font size="1" face="MS Sans Serif, Tahoma, sans-serif">
        <?  print   $result_data[bytes_received];   ?>
      </font></div></td>
 
      <td><div align="center"><font size="1" face="MS Sans Serif, Tahoma, sans-serif">
        <?  print   $result_data[bytes_sent];   ?>
      </font></div></td>
	        <td><div align="center"><font size="1" face="MS Sans Serif, Tahoma, sans-serif">  
			<?  print   $result_data[trusted_port];   ?></font></div></td>
			      <td><div align="center"><font size="1" face="MS Sans Serif, Tahoma, sans-serif">  
				  <?  print   $result_data[ifconfig_pool_remote_ip];   ?></font></div></td>
    </tr>
    <?
			$i++;
		}
	}else{
  ?>
    <tr bgcolor="#FFFFFF"> 
      <td colspan="10"><div align="center"><strong><font color="#FF0000">ไม่พบข้อมูล</font></strong></div></td>
    </tr>
    <?
	}
  
 
  ?>
  </table>
<br><br>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
 
          <td bgcolor="#6699CC">&nbsp;</td>
    </tr>
  </table>
<? if($rows > 0){ ?>
	
<table width="81%" border="0" align="center" cellpadding="3" cellspacing="0">
  <tr> 
          <td><img src="../images/test.gif" width="16" height="16" border="0" align="absmiddle"> 
            <strong>หน้าที่</strong> <?php
// Begin Prev/Next Links 
// Don't display PREV link if on first page 
if ($offset !=0) {   
$prevoffset=$offset-$limit; 

echo   "<a href='index.php?case_i=67&offset=$prevoffset&txt_search=$txt_search'>
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
    for ($i=1;$i<=$pages;$i++) { 
        // Check if on current page 
        if (($offset/$limit) == ($i-1)) { 
            // $i is equal to current page, so don't display a link 
            echo "$i "; 
        } else { 
            // $i is NOT the current page, so display a link to page $i 
            $newoffset=$limit * ($i-1); 
                  echo  "<a href='index.php?case_i=67&offset=$newoffset&txt_search=$txt_search'     >
				  <font  color=\"black\">$i</font></a>\n\n"; 
        } 
    } 

    // Check to see if current page is last page 
   if (!((($offset/$limit)+1)==$pages) && $pages!=1) { 
        // Not on the last page yet, so display a NEXT Link 
        $newoffset=$offset+$limit; 
        echo   "<a href='index.php?case_i=67&offset=$newoffset&txt_search=$txt_search'>
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
<p align="right">&nbsp;</p>
 
<div align="center"></div>
</body>
</html>
