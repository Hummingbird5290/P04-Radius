<? 
  include("../include/chklogin.php");  
include("../Connections/dbconnect.php");

include("../Connections/class.php");
include("class.php");

 
$mdate1 = date("Y-m-d"); 
if($txt_search !=null) {     
 $txt_search = preg_replace("/ /i", "", $txt_search);
 }
?>
<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<link href="css/style.css" rel="stylesheet" type="text/css">

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
<body>
<form name="form1" method="post" action="list_user_logl.php">
  <?
	
		//$condition = "  ";
		if(trim($txt_search)<>''){  
		$txt_search = htmlspecialchars("$txt_search", ENT_QUOTES);
$pattern = '/;/i';
$replacement = NULL;
$txt_search= preg_replace($pattern, $replacement, $txt_search);
			$condition = "   where   (radacct.FramedIPAddress   like'%$txt_search%'   or     radcheck.UserName   like'%$txt_search%'    or    register.fullname  like'%$txt_search%'  or  radacct.CallingStationId  like'%$txt_search%' ) and domain='$domain_name' ";
		}
		if (empty($offset) || $offset < 0) { 
		   $offset=0; 
		} 
		//    Set $limit,  $limit = Max number of results per 'page' 
		if(!$limit){
			$limit = 50;
		}
		//    Set $totalrows = total number of rows that unlimited query would return 
		//    (total number of records to display across all pages) 
		$sql = "SELECT 
  radcheck.UserName,
  register.fullname,
  register.room,
  register.site,
  radacct.FramedIPAddress,
  radacct.AcctStartTime,
 radacct.CallingStationId
FROM
  radacct
  INNER JOIN radcheck ON (radacct.UserName = radcheck.UserName)
  INNER JOIN register ON (radcheck.UserName = register.UserName)
     $condition";

		$query_data = $db->query($sql);
		$rows = mysql_num_rows($query_data);
			// Set $begin and $end to record range of the current page 
		    $begin =($offset+1); 
		    $end = ($begin+($limit-1)); 
		    if ($end > $totalrows) { 
			   $end = $totalrows; 
		    } 
		$Show = $sql." ORDER BY register.site,radacct.AcctStartTime  DESC   LIMIT $offset, $limit";
		$query_data = $db->query($Show);

?>
  <table width="100%" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#6A90B5">
    <tr bgcolor="#FFFFFF"> 
      <td height="30" colspan="7"> <div align="right"><strong>ค้นหา IP /ชื่อผู้ใช้งาน</strong> 
          <input name="txt_search" type="text" value="<?=$txt_search;?>" size="40">
          <input type="submit" name="Submit" value="  ค้นหา  ">
        </div></td>
    </tr>
    <tr bgcolor="#6A90B5"> 
      <td colspan="7"> <div align="center" class="style1 style2"><font size="3" face="MS Sans Serif, Tahoma, sans-serif"><strong>รายงานการเข้าใช้งาน</strong></font></div></td>
    </tr>
    <tr bgcolor="#6A90B5"> 
      <td width="6%"> <div align="center" class="style3"><font size="1" face="MS Sans Serif, Tahoma, sans-serif"><strong>ลำดับ</strong></font></div></td>
      <td width="23%" align="center"><strong><span class="style3"><font size="1" face="MS Sans Serif, Tahoma, sans-serif">ชื่อ-นามสกุล</font></span></strong></td>
      <td width="16%" align="center"><strong><font size="1" face="MS Sans Serif, Tahoma, sans-serif">macaddress</font></strong></td>
      <td width="14%" align="center"><font size="1" face="MS Sans Serif, Tahoma, sans-serif"><strong>IP 
        Address</strong></font></td>
      <td width="8%" align="center"><font size="1" face="MS Sans Serif, Tahoma, sans-serif"><strong>เวลาที่เข้าใช้งาน</strong></font></td>
      <td width="8%" align="center"><strong><span class="style3"><font size="1" face="MS Sans Serif, Tahoma, sans-serif">ระงับการใช้งาน</font></span></strong></td>
      <td width="20%" align="center"><font size="1" face="MS Sans Serif, Tahoma, sans-serif"><strong>รายการเข้าใช้งานทั้งหมด</strong></font></td>
    </tr>
    <?
  if($rows<>0){
	  $i=1;
	  while($result_data = mysql_fetch_array($query_data)){
	  $check=$db->query("SELECT 
  radcheck.UserName,
  register.fullname,
  register.room,
  register.site,
  radacct.FramedIPAddress,
  radacct.AcctStartTime,
  radacct.CallingStationId
 
FROM
  radacct
  INNER JOIN radcheck ON (radacct.UserName = radcheck.UserName)
  INNER JOIN register ON (radcheck.UserName = register.UserName)  
  ORDER BY register.site,radacct.AcctStartTime  DESC  
   ");
	  	    $cli=$i%2;
		if($cli=="0")  {$cli="#FFFFFF" ;  } else {    $cli="#77FFFF" ;   }
	    ?>
    <tr bgcolor="<?php echo "$cli"; ?>" > 
      <td align="center"> <font size="1" face="MS Sans Serif, Tahoma, sans-serif"> 
        <?=($offset + $i);?>
        .</font></td>
      <td height="21"  ><div align="left"><font size="1" face="MS Sans Serif, Tahoma, sans-serif"> 
          <a href="#search" onClick="newwindow=window.open('detail_user.php?id_edit=<? print $result_data[UserName];?>','detail_user','height=450,width=500,left=10,top=100,scrollbars=1');newwindow.focus();"> 
      <? print $result_data[fullname];?></a> </font></div></td>
      <td  ><div align="left"><font size="1" face="MS Sans Serif, Tahoma, sans-serif"><? print $result_data[CallingStationId];?></font></div></td>
      <td><div align="left"><font size="1" face="MS Sans Serif, Tahoma, sans-serif"><? print $result_data[FramedIPAddress];?></font></div></td>
      <td><div align="left"><font size="1" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;<? print $result_data[AcctStartTime];?>&nbsp;</font></div></td>
      <td><div align="center"><font size="1" face="MS Sans Serif, Tahoma, sans-serif"><a href="block_user_ok.php?UserName=<?echo $result_data[UserName] ;?>&delete=1" onClick="return bad_user<? echo "$result_data[UserName]" ?>(this)"> 
      <img src="../images/logout.gif" width="34" height="30" border="0"> </a></font></div></td>
      <td><div align="center"><font size="1" face="MS Sans Serif, Tahoma, sans-serif"><a href="show_login.php?id_edit=<? print $result_data[UserName];?>" target="_blank"><img src="../images/icon/Sony Ericsson PC Suite.png" width="32" height="30" border="0"></a></font></div></td>
 
    </tr>
    <?
			$i++;
		}
	}else{
  ?>
    <tr bgcolor="#FFFFFF"> 
      <td colspan="7"><div align="center"><strong><font color="#FF0000">ไม่พบข้อมูล</font></strong></div></td>
    </tr>
    <?
	}
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

echo   "<a href='list_user_logl.php?offset=$prevoffset&txt_search=$txt_search'>
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
                  echo  "<a href='list_user_logl.php?offset=$newoffset&txt_search=$txt_search'   
                 onMouseOver=\"window.status='Page $i'; return true\";><font  color=\"black\">$i</font></a>\n\n"; 
        } 
    } 

    // Check to see if current page is last page 
   if (!((($offset/$limit)+1)==$pages) && $pages!=1) { 
        // Not on the last page yet, so display a NEXT Link 
        $newoffset=$offset+$limit; 
        echo   "<a href='list_user_logl.php?offset=$newoffset&txt_search=$txt_search&txt_search=$txt_search'>
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
 
<div align="center"></div>
</body>
</html>
