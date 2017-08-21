<? 
  include("../include/chklogin.php");  
include("../Connections/dbconnect.php");
include("../Connections/class.php");
include("class.php");
$mdate1 = date("Y-m-d");
if($delete==1){
 $UserName = htmlspecialchars("$UserName", ENT_QUOTES);
$pattern = '/;/i';
$replacement = NULL;
$UserName= preg_replace($pattern, $replacement, $UserName);
mysql_query("delete   from register  where  UserName='$UserName'  and domain='$domian_name' ")   or trigger_error(mysql_error(),E_USER_ERROR); 
mysql_query("delete   from radcheck  where  UserName='$UserName'   ")   or trigger_error(mysql_error(),E_USER_ERROR); 
mysql_query("delete   from radreply  where  UserName='$UserName'   ")   or trigger_error(mysql_error(),E_USER_ERROR); 
mysql_query("delete   from usergroup  where  UserName='$UserName'   ")   or trigger_error(mysql_error(),E_USER_ERROR); 
            echo                  "<script type=text/javascript>";
		    echo                  "alert('เรียบร้อยแล้ว ')";
	        echo                  "</script>";
			echo "<meta http-equiv=refresh content=0;URL=index.php?case_i=7>"; 
			exit();
}
?>
<html>
<head>
<title>สมาชิกที่ลบทิ้งจากระบบ</title>
 
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
<form name="form1" method="post" action="index.php?case_i=7">
  <?
	
		//$condition = "  ";
		if(trim($txt_search)<>''){
 $txt_search = htmlspecialchars("$txt_search", ENT_QUOTES);
$pattern = '/;/i';
$replacement = NULL;
$txt_search= preg_replace($pattern, $replacement, $txt_search);
			$condition = "   and (   register.fullname    like'%$txt_search%'    or  register.per   like'%$txt_search%'  or register.UserName  like '%$txt_search%'  )    ";
		}
		if (empty($offset) || $offset < 0) { 
		   $offset=0; 
		} 
		//    Set $limit,  $limit = Max number of results per 'page' 
		if(!$limit){
			$limit = 20;
		}
		//    Set $totalrows = total number of rows that unlimited query would return 
		//    (total number of records to display across all pages) 
		$sql = "SELECT  *  FROM  register  where register.status='99'   and   domain='$domian_name'   $condition";

		$query_data = $db->query($sql);
		$rows = mysql_num_rows($query_data);
			// Set $begin and $end to record range of the current page 
		    $begin =($offset+1); 
		    $end = ($begin+($limit-1)); 
		    if ($end > $totalrows) { 
			   $end = $totalrows; 
		    } 
		$Show = $sql." ORDER BY    fullname  LIMIT $offset, $limit";
		$query_data = $db->query($Show);

?>
  <table width="100%" border="0" align="center" cellpadding="1" cellspacing="1" class="imagetable">
    <tr bgcolor="#FFFFFF"> 
      <th height="30" colspan="5"> <div align="right"><strong>ค้นหารหัสบัตรประชาชน/ชื่อผู้ใช้งาน</strong> 
          <input name="txt_search" type="text" value="<?=$txt_search;?>" size="40">
          <input type="submit" name="Submit" value="  ค้นหา  " class="styled-button-2"  >
        </div></th>
    </tr>
    <tr bgcolor="#CCFFCC"> 
      <th colspan="5"> <div align="center" class="style1 style2"><font size="3" face="MS Sans Serif, Tahoma, sans-serif"><strong>สมาชิกที่ลบทิ้งจากระบบ</strong></font></div></th>
    </tr>
    <tr bgcolor="#FFFFCC"> 
      <th width="7%"> <div align="center" class="style3"><font size="2"><strong><font face="MS Sans Serif, Tahoma, sans-serif">ลำดับ</font></strong></font></div></th>
      <th width="31%" align="center"><strong><span class="style3"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">ชื่อ-นามสกุล</font></span></strong></th>
      <th width="26%" align="center" bgcolor="#FFFFCC"><strong><span class="style3"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">หมายเลขบัตรประชาชน</font></span></strong></th>
      <th width="10%" align="center"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">กู้คืน</font></strong></th>
      <th width="6%" align="center"><div align="center"><font size="2"><strong><font face="MS Sans Serif, Tahoma, sans-serif">ลบทิ้ง</font></strong></font></div></th>
    </tr>
    <?
  if($rows<>0){
	  $i=1;
	  while($result_data = mysql_fetch_array($query_data)){
	 
	  	    $cli=$i%2;
		if($cli=="0")  {$cli="#AAD2FF" ;  } else {    $cli="#AAD2DD" ;   }
	    ?>
    <tr bgcolor="<?php echo "$cli"; ?>" > 
      <td align="center"> <font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
        <?=($offset + $i);?>
        .</font></td>
      <td height="21" bgcolor="<?php echo "$cli"; ?>"  ><div align="left"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
              <? print $result_data[fullname];?>  </font></div></td>
      <td> <div align="left"></div>
        <div align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><? print $result_data[per];?></font></div></td>
      <td><div align="center"><a href="endble_user.php?UserName=<?php   print $result_data[UserName];?>"><img src="../images/undelete.gif" width="32" height="32" border="0"></a></div></td>
      <td><div align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><a href="index.php?case_i=7&UserName=<?echo $result_data[UserName] ;?>&delete=1" onClick="return Conf<? echo "$result_data[UserName]" ?>(this)"><img src="dlete_xp_icon.png" width="35" height="35" border="0"></a></font></div></td>
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
<br><br>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
          
      <td bgcolor="#999999"><div align="right">คลิกที่ชื่อ-นามสกุลเพื่อดูรายล่ะเอียดผู้ใช้</div></td>
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

echo   "<a href='index.php?case_i=7&offset=$prevoffset&txt_search=$txt_search'>
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
                  echo  "<a href='index.php?case_i=7&offset=$newoffset&txt_search=$txt_search'  
                  onMouseOver=\"window.status='Page $i'; return true\";><font  color=\"black\">$i</font></a>\n\n"; 
        } 
    } 

    // Check to see if current page is last page 
   if (!((($offset/$limit)+1)==$pages) && $pages!=1) { 
        // Not on the last page yet, so display a NEXT Link 
        $newoffset=$offset+$limit; 
        echo   "<a href='index.php?case_i=7&offset=$newoffset&txt_search=$txt_search'>
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
