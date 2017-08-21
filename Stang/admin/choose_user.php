<? 
  include("../include/chklogin.php");  
include("../Connections/dbconnect.php");
include("../Connections/class.php");
include("class.php");


?>
<html>
<head>
<title>ค้นหา</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<link href="css/style.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="lib/javascript.js"></script>

<body>
<form name="form1" method="post" action="choose_user.php">
<?
	
		//$condition = "  ";
		if(trim($txt_search)<>''){
		  $txt_search = htmlspecialchars("$txt_search", ENT_QUOTES);
		  $pattern = '/;/i';
$replacement = NULL;
$txt_search= preg_replace($pattern, $replacement, $txt_search);

			$condition = "   and (   radcheck.UserName    like'%$txt_search%'    or  register.room      like'%$txt_search%'   or register.email    like'%$txt_search%'   or  register.fullname      like'%$txt_search%'   or  register.per   like'%$txt_search%'   and register.`status` !='99'  )";
		}
		if (empty($offset) || $offset < 0) { 
		   $offset=0; 
		} 
		//    Set $limit,  $limit = Max number of results per 'page' 
		if(!$limit){
			$limit = 10;
		}
		//    Set $totalrows = total number of rows that unlimited query would return 
		//    (total number of records to display across all pages) 
		$sql = "SELECT 
  radcheck.id,
  radcheck.UserName,
  radcheck.Attribute,
  register.`status`,
  register.UserName,
  register.password,
  register.fullname,
  register.`per`,
  register.room,
  register.tel
FROM
  radcheck
  INNER JOIN register ON (radcheck.UserName = register.UserName)  
    where radcheck.Attribute ='MD5-Password' and  register.domain='$domian_name'  $condition";

		$query_data = $db->query($sql);
		$rows = mysql_num_rows($query_data);
			// Set $begin and $end to record range of the current page 
		    $begin =($offset+1); 
		    $end = ($begin+($limit-1)); 
		    if ($end > $totalrows) { 
			   $end = $totalrows; 
		    } 
		 $Show = $sql." ORDER BY   room   LIMIT $offset, $limit";
		$query_data = $db->query($Show);

?>
<br>
  <table width="100%" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#0066FF">
    <tr bgcolor="#FFFFFF"> 
      <td height="30" colspan="5"> <div align="right"><strong>ชื่อเข้าใช้ระบบ/ชื่อผู้ใช้</strong> 
          <input name="txt_search" type="text" value="<?=$txt_search;?>" size="40">
          <input type="submit" name="Submit" value="  ค้นหา  ">
        </div></td>
    </tr>
    <tr bgcolor="#CAE9FF"> 
      <td colspan="5"> <div align="center"><strong>รายชื่อ</strong></div></td>
    </tr>
    <tr bgcolor="#CAE9FF"> 
      <td width="8%"> <div align="center"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">ลำดับ</font></strong></div></td>
      <td width="9%"> <div align="center"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">ชื่อเข้าใช้งาน</font></strong></div></td>
      <td width="53%" align="center"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">ชื่อ 
        </font></strong></td>
      <td width="17%" align="center"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><?php echo "$roomsDB"; ?> 
        </font></strong></td>
      <td width="13%"> <div align="center"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">เลือก</font></strong></div></td>
    </tr>
    <?
  if($rows<>0){
	  $i=1;
	  while($result_data = mysql_fetch_array($query_data)){
		 
	    ?>
    <tr bgcolor="#FFFFFF"> 
      <td align="center"> <font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
        <?=($offset + $i);?>
        .</font></td>
      <td><div align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><? print $result_data[UserName];?></font></div></td>
      <td><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><? print $result_data[fullname];?></font></td>
      <td><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><? print $result_data[room];?></font></td>
      <td align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><a href="#show" onClick="window.opener.document.form100.UserName.value='<? print $result_data[UserName];?>';window.close();">เลือก</a></font></td>
    </tr>
    <?
			$i++;
		}
	}else{
  ?>
    <tr bgcolor="#FFFFFF"> 
      <td colspan="5"><div align="center"><strong><font color="#FF0000">ไม่พบข้อมูล</font></strong></div></td>
    </tr>
    <?
	}
  ?>
  </table>
<br>
  <? if($rows > 0){ ?>
  <table width="95%" border="0" align="center" cellpadding="3" cellspacing="0">
  <tr> 
          <td><img src="../images/icon_sturegis_small.gif" width="16" height="16" border="0" align="absmiddle"> 
            <strong>หน้าที่</strong> <?php
// Begin Prev/Next Links 
// Don't display PREV link if on first page 
if ($offset !=0) {   
$prevoffset=$offset-$limit; 
echo   "<a href='choose_user.php?offset=$prevoffset&txt_search=$txt_search'>
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
                  echo  "<a href='choose_user.php?offset=$newoffset&txt_search=$txt_search' ". 
                  "onMouseOver=\"window.status='Page $i'; return true\";><font  color=\"black\">$i</font></a>\n\n"; 
        } 
    } 

    // Check to see if current page is last page 
   if (!((($offset/$limit)+1)==$pages) && $pages!=1) { 
        // Not on the last page yet, so display a NEXT Link 
        $newoffset=$offset+$limit; 
        echo   "<a href='choose_user.php?offset=$newoffset&txt_search=$txt_search'>
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
</body>
</html>
