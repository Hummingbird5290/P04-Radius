<? 
  include("../include/chklogin.php");  
include("../Connections/dbconnect.php");
 mysql_select_db($database_edoc);  //  or trigger_error(mysql_error(),E_USER_ERROR);
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
<form name="form1" method="post" action="index.php?case_i=79">
  <?
	
		//$condition = "  ";
		if(trim($txt_search)<>''){
		 $txt_search = htmlspecialchars("$txt_search", ENT_QUOTES);
 
$pattern = '/;/i';
$replacement = NULL;
$txt_search= preg_replace($pattern, $replacement, $txt_search);
			$condition = "        idcard      like'%$txt_search%'        ";
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
		$sql = "SELECT  *      FROM       card_true       where TF <> 1    
										   $condition    ";

		$query_data = $db->query($sql);  
		$rows = mysql_num_rows($query_data);
			// Set $begin and $end to record range of the current page 
		    $begin =($offset+1); 
		    $end = ($begin+($limit-1)); 
		    if ($end > $totalrows) { 
			   $end = $totalrows; 
		    } 
		$Show = $sql." order by domain,date_add desc  LIMIT $offset, $limit";
		$query_data = $db->query($Show);

?>
  <table width="85%" border="0" align="center" cellpadding="1" cellspacing="1"  class="imagetable">
    <tr bgcolor="#FFFFFF"> 
      <th height="30" colspan="7"> <div align="right"><strong>ค้นหารหัสบัตรทรู</strong> 
          <input name="txt_search" type="text" value="<?=$txt_search;?>" size="40">
          <input type="submit" name="Submit" value="  ค้นหา  " class="styled-button-2"  >
        </div></th>
    </tr>
    <tr bgcolor="#CCFFCC"> 
      <th colspan="7"> <div align="center" class="style1 style2"><font size="3" face="MS Sans Serif, Tahoma, sans-serif"><strong><img src="logo_truemoney.png" width="157" height="40"><br>
รายการบัตรที่ทำการ Active</strong></font></div></th>
    </tr>
    <tr bgcolor="#FFFFCC"> 
      <th width="7%"> <div align="center" class="style3"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">ลำดับ</font></strong></div></th>
      <th width="19%" align="center"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">หมายเลขบัตร</font></strong></th>
      <th width="16%" align="center"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">ชื่อ Login</font></strong></th>
      <th width="18%" align="center"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">วันที่ Active </font></strong></th>
      <th width="15%" align="center">Domain</th>
      <th width="15%" align="center"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">สถานะการโอนเข้าบัญชี Truemoney </font></strong></th>
      <th width="13%" align="center"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">จำนวนเงิน</font></strong></th>
    </tr>
    <?
  if($rows<>0){
	  $i=1;
	  while($result_data = mysql_fetch_array($query_data)){
	   
	  	    $cli=$i%2;
		if($cli=="0")  {$cli="#AAD2FF" ;  } else {    $cli="#FFFFFF" ;   }
	    ?>
    <tr bgcolor="<?php echo "$cli"; ?>" > 
      <td height="21" align="center"> <font size="1" face="MS Sans Serif, Tahoma, sans-serif"> 
        <?=($offset + $i);?>
        .</font></td>
      <td><div align="left"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
          &nbsp;&nbsp; 
          <?  print   $result_data[idcard];   ?>
          </font></div></td>
      <td><div align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">
	  <a href="#search" onClick="newwindow=window.open('detail_user.php?id_edit=<? print $result_data[UserName];?>','detail_user','height=600,width=600,left=10,top=100,scrollbars=1');newwindow.focus();"> 
        <?  print   $result_data[UserName];   ?>
		</a>
      </font></div></td>
      <td><font size="2" face="MS Sans Serif, Tahoma, sans-serif">
        <?  print   $result_data[date_add];   ?>
        </font></td>
      <td> <div align="center">
        <?  print   $result_data[domain];   ?>
      </div></td>
      <td><div align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">
          <?php     if($result_data[TF]=="1")              {  print 'ตัดยอดแล้ว';  }  
		         if($result_data[TF]=="0" or $result_data[TF]=NULL)              {  print 'รอตัดยอด';  }  
 ?>
      </font></div></td>
      <td><div align="right"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
          <?  print   number_format($result_data[cost],2);   ?>
          </font></div></td>
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
  <div align="right"><br>
    ตัดยอดแล้ว='หมายถึงยอดเงินจากบัตรทรูได้โอนเข้าบัญชี true money ของท่านเรียบร้อยแล้ว'<br>
    รอตัดยอดแล้ว='หมายถึงยอดเงินอยู่ในระหว่างการรอโอนยอดเข้าบัญชี true money ของท่าน'<br>
    
  </div>
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

echo   "<a href='index.php?case_i=79&offset=$prevoffset&txt_search=$txt_search'>
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
                  echo  "<a href='index.php?case_i=79&offset=$newoffset&txt_search=$txt_search'     >
				  <font  color=\"black\">$i</font></a>\n\n"; 
        } 
    } 

    // Check to see if current page is last page 
   if (!((($offset/$limit)+1)==$pages) && $pages!=1) { 
        // Not on the last page yet, so display a NEXT Link 
        $newoffset=$offset+$limit; 
        echo   "<a href='index.php?case_i=79&offset=$newoffset&txt_search=$txt_search'>
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
//print $sql;
?>
<p align="right">&nbsp;</p>
 
<div align="center"></div>
</body>
</html>
