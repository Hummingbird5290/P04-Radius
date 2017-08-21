<? 
 include("../include/chklogin.php");    

include("../Connections/dbconnect.php");
mysql_select_db($database_edoc);  //or trigger_error(mysql_error(),E_USER_ERROR);

include("../Connections/class.php");
include("class.php");

?>
<html>
<head>
<title>ผู้ใช้งานที่สมัครเข้ามาใช้งาน</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<link href="../css/style.css" rel="stylesheet" type="text/css">
<body>

<form name="form1" method="post" action="index.php?case_i=1">
  <?
	
		//$condition = "  ";
		if(trim($txt_search)<>''){
		   		 $txt_search = htmlspecialchars("$txt_search", ENT_QUOTES);
 $pattern = '/;/i';
$replacement = NULL;
$txt_search= preg_replace($pattern, $replacement, $txt_search);
			$condition = "      and (   fullname      like'%$txt_search%'   or  per   like'%$txt_search%' ) ";
		}
		if (empty($offset) || $offset < 0) { 
		   $offset=0; 
		} 
		//    Set $limit,  $limit = Max number of results per 'page' 
		if(!$limit){
			$limit = 15;
		}
		//    Set $totalrows = total number of rows that unlimited query would return 
		//    (total number of records to display across all pages) 
		if($_SESSION["adminpass"] <> 'tlog'){   $SS="and domain='$domain_name'";   } else {  $SS=NULL;}
		$sql = "SELECT *  FROM    register   where     status='0'    $SS  $condition";

		$query_data = $db->query($sql);
		$rows = mysql_num_rows($query_data);
			// Set $begin and $end to record range of the current page 
		    $begin =($offset+1); 
		    $end = ($begin+($limit-1)); 
		    if ($end > $totalrows) { 
			   $end = $totalrows; 
		    } 
		$Show = $sql." ORDER BY site,fullname  LIMIT $offset, $limit";
		$query_data = $db->query($Show);

?>
  <table width="100%" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#6A90B5"   class="imagetable">
    <tr bgcolor="#FFFFFF"> 
      <th height="30" colspan="7"> <div align="right"><strong>ค้นหารหัสบัตรประชาชน/ชื่อผู้ใช้งาน</strong> 
          <input name="txt_search" type="text" value="<?=$txt_search;?>" size="40">
          <input type="submit" name="Submit" value="  ค้นหา  "  class="styled-button-2"  >
        </div></th>
    </tr>
    <tr bgcolor="#CCFFCC"> 
      <th colspan="7" align="center" class="scimenu"> ชื่อผู้ใช้งานที่สมัครเข้ามา</th>
    </tr>
    <tr bgcolor="#FFFFCC"> 
      <th width="8%" class="scimenu" align="center">ลำดับ</th>
      <th width="28%" align="center" bgcolor="#FFFFCC" class="scimenu">ชื่อ-นามสกุล</th>
      <th width="16%" align="center" class="scimenu">หมายเลขบัตรประชาชน</th>
      <th width="12%" align="center" class="scimenu">ห้องพัก</td>
      <th width="15%" align="center" class="scimenu"><?php echo "$siteDB"; ?></th>
      <th width="15%" align="center" class="scimenu">เปิดให้ใช้งาน</th>
      <th width="6%" align="center" class="scimenu">ลบ</th>
    </tr>
    <?
  if($rows<>0){
	  $i=1;
	  while($result_data = mysql_fetch_array($query_data)){
	 
 
	    ?>
    <tr bgcolor="#FFFFFF" > 
      <td align="center" class="txtContent3_orange"> <?=($offset + $i);?> .</td>
      <td height="21" class="txtContent3_orange"  > <a href="#search" onClick="newwindow=window.open('detail_userregister.php?id_edit=<? print $result_data[UserName];?>','detail_user','height=450,width=500,left=10,top=100,scrollbars=1');newwindow.focus();">  <? print $result_data[fullname];?></a> </td>
      <td class="txtContent3_orange"> <? print $result_data[per];?></font></td>
      <td class="txtContent3_orange"> <? print $result_data[room];?></font></td>
      <td class="txtContent3_orange"> <? print $result_data[site];?></font></td>
      <td class="txtContent3_orange" align="center"> <a href="endble_user.php?pass=<?echo $result_data[password] ;?>&UserName=<?echo $result_data[UserName] ;?>">
      <img src="../images/icon_sturegis_small.gif" width="16" height="16" border="0"></a> </td>
   
      <td class="txtContent3_orange" align="center"> <a href="delete_register.php?UserName=<?php echo $result_data[UserName] ;?>&delete=1" onClick="return cdelete(this)"><img src="dlete_xp_icon.png" width="35" height="35" border="0"></a> </td>
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

echo   "<a href='index.php?case_i=1&offset=$prevoffset&txt_search=$txt_search'>
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
                  echo  "<a href='index.php?case_i=1&offset=$newoffset&txt_search=$txt_search'  
                 onMouseOver=\"window.status='Page $i'; return true\";><font  color=\"black\">$i</font></a>\n\n"; 
        } 
    } 

    // Check to see if current page is last page 
   if (!((($offset/$limit)+1)==$pages) && $pages!=1) { 
        // Not on the last page yet, so display a NEXT Link 
        $newoffset=$offset+$limit; 
        echo   "<a href='index.php?case_i=1&offset=$newoffset&txt_search=$txt_search'>
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
<div align="right">
  <p><a href="index.php"><font color="#0000FF">กลับหน้าหลักผู้ดูแลระบบ</font></a> 
  </p>
 
</div>
</body>
</html>
