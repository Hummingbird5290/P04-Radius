<? 
  include("../include/chklogin.php");  
include("../Connections/dbconnect.php");
include("../Connections/class.php");
include("../include/function.php");
include("class.php");

if($chk_delete="1") {
  $id = htmlspecialchars("$id", ENT_QUOTES);
 $sql = "delete from question   where id='$id'  ";
$dbquery = mysql_select_db($database_edoc); mysql_query($sql);
}
?>
<html>
<head>
<title>�����ҹ�����Ѥ��������ҹ</title>
 
      <script language="JavaScript">

function bad_user<? echo "$result_data[fullname]" ?>(object) {
if (confirm("�׹�ѹ [ <? echo "$result_data[fullname]       "      ?> ] ") ==true) {
return true;
}
return false;
}

</script>
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
<form name="form1" method="post" action="index.php?case_i=9">
  <?
	
		//$condition = "  ";
		if(trim($txt_search)<>''){
		  $txt_search = htmlspecialchars("$txt_search", ENT_QUOTES);
			$condition = "   and  name    like'%$txt_search%'    or  question       like'%$txt_search%'   or   ip   like'%$txt_search%'       ";
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
		$sql = "SELECT *  FROM    question   where status ='1'  and  domain='$domain_name'   $condition";

		$query_data = $db->query($sql);
		$rows = mysql_num_rows($query_data);
			// Set $begin and $end to record range of the current page 
		    $begin =($offset+1); 
		    $end = ($begin+($limit-1)); 
		    if ($end > $totalrows) { 
			   $end = $totalrows; 
		    } 
		$Show = $sql." ORDER BY   id   DESC   LIMIT $offset, $limit";
		$query_data = $db->query($Show);

?>
  <table width="100%" border="0" align="center" cellpadding="1" cellspacing="1" class="imagetable">
    <tr bgcolor="#FFFFFF"> 
      <th height="30" colspan="5"> <div align="right"><strong>���� </strong> 
          <input name="txt_search" type="text" value="<?=$txt_search;?>" size="40">
          <input type="submit" name="Submit" value="  ����  " class="styled-button-2"  >
        </div></th>
    </tr>
    <tr bgcolor="#6A90B5"> 
      <th colspan="5"> <div align="center" class="style1 style2"><font size="3" face="MS Sans Serif, Tahoma, sans-serif"><strong>��¡�ûѭ�ҷ�����Ѻ����������</strong></font></div></th>
    </tr>
    <tr bgcolor="#6A90B5"> 
      <th width="9%"> <div align="center" class="style3"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>�ӴѺ</strong></font></div></th>
      <th width="46%" align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>���ͼ����</strong></font></th>
      <th width="33%" align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>Time 
        </strong></font></th>
      <th width="12%" align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>ź���</strong></font></th>
      <th width="12%" align="center"><div align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>�������</strong></font></div></th>
    </tr>
    <?
  if($rows<>0){
	  $i=1;
	  while($result_data = mysql_fetch_array($query_data)){
	   
	  	    $cli=$i%2;
		if($cli=="0")  {$cli="#AAD2FF" ;  } else {    $cli="#FFFFFF" ;   }
	    if($result_data[status]=="1" ) {$img_i='<img src="../images/icon_info.gif" width="13" height="13" border="0">';  } 
		 if($result_data[status]=="0" ) {$img_i='<img src="../images/icon_infon.jpg" width="13" height="13" border="0">';  } 
		?>
    <tr bgcolor="<?php echo "$cli"; ?>" > 
      <td height="21" align="center"> <font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
        <?=($offset + $i);?>
        .</font></td>
      <td><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><a href=detail_problem.php?id=<? print $result_data[id];?> target="_blank"><? print $result_data[name];?></a></font></td>
      <td><div align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><? print  date_to_thai($result_data[time_q]);?></font></div></td>
      <td><div align="center"><a href="index.php?case_i=9&chk_delete=1&id=<? print $result_data[id];?>"><img src="images/delete.gif" width="16" height="16" border="0"></a></div></td>
      <td><div align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif"><a href="clear_problem.php?id=<?echo $result_data[id] ;?>&delete=1" ><?php print $img_i; ?></a></font></div></td>
    </tr>
    <?
			$i++;
		}
	}else{
  ?>
    <tr bgcolor="#FFFFFF"> 
      <td colspan="5"><div align="center"><strong><font color="#FF0000">��辺������</font></strong></div></td>
    </tr>
    <?
	}
  ?>
  </table>
  <div align="right"><img src="../images/icon_info.gif" width="13" height="13" border="0">=�������<br>
                                     <img src="../images/icon_infon.jpg" width="13" height="13" border="0">=�ѧ�����ӡ�����
    <br>
  </div>
  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
          
      <td  bgcolor="#6A90B5"><div align="right"><strong><font color="#FF0000">��ԡ�����ͼ�����������������´�ѭ��</font></strong></div></td>
    </tr>
  </table>
<? if($rows > 0){ ?>
	
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="0">
  <tr> 
          <td><img src="../images/test.gif" width="16" height="16" border="0" align="absmiddle"> 
            <strong>˹�ҷ��</strong> <?php
// Begin Prev/Next Links 
// Don't display PREV link if on first page 
if ($offset !=0) {   
$prevoffset=$offset-$limit; 

echo   "<a href='index.php?case_i=9&offset=$prevoffset&txt_search=$txt_search'>
<font  color=\"red\"><< ��͹˹��</font></a>\n\n";
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
                  echo  "<a href='index.php?case_i=9&offset=$newoffset&txt_search=$txt_search'>
                 <font  color=\"black\">$i</font></a>\n\n"; 
        } 
    } 

    // Check to see if current page is last page 
   if (!((($offset/$limit)+1)==$pages) && $pages!=1) { 
        // Not on the last page yet, so display a NEXT Link 
        $newoffset=$offset+$limit; 
        echo   "<a href='index.php?case_i=9&offset=$newoffset&txt_search=$txt_search'>
		  <font  color=\"red\">�Ѵ�>></font></a>\n"; 
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
<p align="right"><a href="index.php"><font color="#0000FF">��Ѻ˹����ѡ�������к�</font></a> 
</p>
 
<div align="center"></div>
</body>
</html>
