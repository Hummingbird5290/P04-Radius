<? 
  include("../include/chklogin.php");  
include("../Connections/dbconnect.php");
 mysql_select_db($database_edoc);  //  or trigger_error(mysql_error(),E_USER_ERROR);
include("../Connections/class.php");
include("class.php");
 if($fix==1){
mysql_query("update  table_card_user  set active='1' where idcard='$idcard' and domain='$domain_namesss' ") or trigger_error(mysql_error(),E_USER_ERROR); 
 }
 function re_name($mounts)
{
 
  if($mounts=='Jan') { $num_rows="�.�.";}
  if($mounts=='Feb') { $num_rows="�.�."; } 
  if($mounts=='Mar') { $num_rows="��.�."; } 
  if($mounts=='Apr') { $num_rows="��.�."; } 
  if($mounts=='May') { $num_rows="�.�."; } 
  if($mounts=='Jun') { $num_rows="��.�."; } 
  if($mounts=='Jul') { $num_rows="�.�.";  } 
  if($mounts=='Aug') { $num_rows="�.�."; } 
  if($mounts=='Sep') { $num_rows="�.�."; } 
  if($mounts=='Oct') { $num_rows="�.�."; } 
  if($mounts=='Nov') { $num_rows="�.�.";} 
  if($mounts=='Dec') { $num_rows="�.�.";} 
    return $num_rows;
}
 
?>
<html>
<head>
<title>��¡�úѵ�</title>
   
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
<form name="form1" method="post" action="index.php?case_i=85">
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
		$sql = "SELECT  *      FROM       table_card_user       where   domain <> ''  and active='0'
										   $condition    ";

		$query_data = $db->query($sql);  
		$rows = mysql_num_rows($query_data);
			// Set $begin and $end to record range of the current page 
		    $begin =($offset+1); 
		    $end = ($begin+($limit-1)); 
		    if ($end > $totalrows) { 
			   $end = $totalrows; 
		    } 
		$Show = $sql." order by onupdate desc  LIMIT $offset, $limit";
		$query_data = $db->query($Show);

?>
  <table width="85%" border="0" align="center" cellpadding="1" cellspacing="1"  class="imagetable">
    <tr bgcolor="#FFFFFF"> 
      <th height="30" colspan="9"> <div align="right"><strong>�������ʺѵ�</strong> 
          <input name="txt_search" type="text" value="<?=$txt_search;?>" size="40">
          <input type="submit" name="Submit" value="  ����  " class="styled-button-2"  >
        </div></th>
    </tr>
    <tr bgcolor="#CCFFCC"> 
      <th colspan="9"> <div align="center" class="style1 style2"><font size="3" face="MS Sans Serif, Tahoma, sans-serif"><strong> ��¡�úѵ÷��ӡ�� Active</strong></font></div></th>
    </tr>
    <tr bgcolor="#FFFFCC"> 
      <th width="6%"> <div align="center" class="style3"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">�ӴѺ</font></strong></div></th>
      <th width="17%" align="center"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">�����Ţ�ѵ�</font></strong></th>
      <th width="14%" align="center"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">���� Login</font></strong></th>
      <th width="8%" align="center"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">�ѹ������ػѨ�غѹ</font></strong></th>
      <th width="8%" align="center"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">�ӹǹ</font></strong></th>
      <th width="24%" align="center"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">�ѹ��� Active </font></strong></th>
      <th width="13%" align="center"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">Domain</font></strong></th>
      <th width="18%" align="center"><strong><font size="2" face="MS Sans Serif, Tahoma, sans-serif">��Ѻ����</font></strong></th>
      <th width="18%" align="center">fixupdate</th>
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
      <td><?   $query_user = "SELECT      *      FROM       radcheck   where UserName='$result_data[UserName]'   and   Attribute = 'Expiration' ";
$user_db = mysql_query($query_user, $connect_db) or die(mysql_error());
$row_user = mysql_fetch_assoc($user_db);   ;  
 
    #�ӡ���¡�ѹ��� ���� �ҡ�����  $date_db ���� array
			  $a_time= explode(" ",$row_user[Value]) ;
			  $a_time[0];  //�ѹ
			 $a_time[1];  //��͹
			  $a_time[2];  //��
			  $months= re_name($a_time[1]);
			  print   $a_time[0]."-".$months."-".$a_time[2]; 
			  print  "&nbsp;".$a_time[3].":".$a_time[4];
			  ?>			  </td>
      <td> 
        <?   $query_user = "SELECT      *      FROM       card   where idcard='$result_data[idcard]'  ";
$user_db = mysql_query($query_user, $connect_db) or die(mysql_error());
$row_user = mysql_fetch_assoc($user_db);   ;  
print $row_user[date_end]; ?>
     </font></td>
      <td><font size="2" face="MS Sans Serif, Tahoma, sans-serif">
        <?  print   $result_data[onupdate];   ?>
        </font></td>
      <td> <div align="center">
        <?  print   $result_data[domain];   ?>
      </div></td>
      <td><div align="center"><font size="2" face="MS Sans Serif, Tahoma, sans-serif">
           <a href="<?php echo $editFormAction; ?>?case_i=52&uedit=<?php print $result_data[UserName];?>" >
                                                            <img src="pic/calendar.jpg" width="23" height="22" border="0" >                                               </a> 
      </font></div></td>
      <td><div align="center"><a href="index.php?case_i=85&fix=1&idcard=<?php print $result_data[idcard];?>&domain_namesss=<?php print $result_data[domain];?>">fix</a></div></td>
    </tr>
    <?
			$i++;
		}
	}else{
  ?>
    <tr bgcolor="#FFFFFF"> 
      <td colspan="9"><div align="center"><strong><font color="#FF0000">��辺������</font></strong></div></td>
    </tr>
    <?
	}
  
 
  ?>
  </table>
  <div align="right"><br>
    �Ѵ�ʹ����='���¶֧�ʹ�Թ�ҡ�ѵ÷�����͹��Һѭ�� true money �ͧ��ҹ���º��������'<br>
    �͵Ѵ�ʹ����='���¶֧�ʹ�Թ����������ҧ������͹�ʹ��Һѭ�� true money �ͧ��ҹ'<br>
    
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
            <strong>˹�ҷ��</strong> <?php
// Begin Prev/Next Links 
// Don't display PREV link if on first page 
if ($offset !=0) {   
$prevoffset=$offset-$limit; 

echo   "<a href='index.php?case_i=85&offset=$prevoffset&txt_search=$txt_search'>
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
                  echo  "<a href='index.php?case_i=85&offset=$newoffset&txt_search=$txt_search'     >
				  <font  color=\"black\">$i</font></a>\n\n"; 
        } 
    } 

    // Check to see if current page is last page 
   if (!((($offset/$limit)+1)==$pages) && $pages!=1) { 
        // Not on the last page yet, so display a NEXT Link 
        $newoffset=$offset+$limit; 
        echo   "<a href='index.php?case_i=85&offset=$newoffset&txt_search=$txt_search'>
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
//print $sql;
?>
<p align="right">&nbsp;</p>
 
<div align="center"></div>
</body>
</html>
