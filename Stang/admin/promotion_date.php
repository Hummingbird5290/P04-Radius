 <?php
 
  include("../include/chklogin.php");   
  
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

  function date_to_thai($date_en)
{
     $date_thai_day = date('d',strtotime($date_en));
	 $date_thai_mont = date('m',strtotime($date_en));
	 $date_thai_year = date('Y',strtotime($date_en));
	 $date_thai_time = date('H:i',strtotime($date_en));
$date_thai_year =$date_thai_year +543;

if($date_thai_mont=="1"){ 	$date_thai_mont="�.�."; }
if($date_thai_mont=="2"){ 	$date_thai_mont="�.�."; }
if($date_thai_mont=="3"){ 	$date_thai_mont="��.�."; }
if($date_thai_mont=="4"){ 	$date_thai_mont="��.�."; }
if($date_thai_mont=="5"){ 	$date_thai_mont="�.�."; }
if($date_thai_mont=="6"){ 	$date_thai_mont="��.�."; }
if($date_thai_mont=="7"){ 	$date_thai_mont="�.�."; }
if($date_thai_mont=="8"){ 	$date_thai_mont="�.�."; }
if($date_thai_mont=="9"){ 	$date_thai_mont="�.�."; }
if($date_thai_mont=="10"){ 	$date_thai_mont="�.�."; }
if($date_thai_mont=="11"){ 	$date_thai_mont="�.�."; }
if($date_thai_mont=="12"){ 	$date_thai_mont="�.�."; }
	 
$time_thai=" $date_thai_day  $date_thai_mont  $date_thai_year ����  $date_thai_time �ҷ�  ";
echo $time_thai;
}
  ?>
 <meta http-equiv="Content-Type" content="text/html; charset=windows-874">
 <?php
include("../Connections/dbconnect.php");


		
		
if($Expiration=="�ѹ�֡") {			 
 if($_SESSION["adminpass"]=='demo'){
 
      echo                  "<script type=text/javascript>";
		    echo                  "alert('�����ҹ ���ͺ�к� �������ö ��䢢������� ')";
	        echo                  "</script>";  
  echo "<meta http-equiv=refresh content=0;URL=index.php?case_i=2>";
 exit();
 
}
$Attribute="Expiration";
$data_date="$endday $endmount $endyear 23:50:00";
$a='CREATE TABLE IF NOT EXISTS `noute_data` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `texts` varchar(300) COLLATE tis620_bin DEFAULT NULL,
  `date_add` datetime DEFAULT NULL,
  `UserName` varchar(300) COLLATE tis620_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=tis620 COLLATE=tis620_bin AUTO_INCREMENT=1 ;';
@mysql_query("$a") ; 
$b=date("Y-m-d H:i:s");
$data_ads=$_SESSION[adminpass];

 $query_Recordset1 = "SELECT   *   FROM radcheck  where  UserName  = '$uedit'  and Attribute='Expiration'  ";
$Recordset1 = mysql_query($query_Recordset1, $connect_db) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$time_dateh=$row_Recordset1[Value];

$texts="�����ҹ $uedit �١ ��Ѻ���Ҩҡ $time_dateh ��   $data_date    ";


mysql_query("INSERT INTO  noute_data  (UserName,texts,date_add,admin,domain)
		      values('$uedit', '$texts','$b'  ,'$data_ads','$domain_name' )") or trigger_error(mysql_error(),E_USER_ERROR); 
			  
mysql_query("delete from  radcheck where  UserName='$uedit' and Attribute='Expiration' ") ; 
mysql_query("delete from  radcheck where  UserName='$uedit' and Attribute='Max-All-Session' ") ; 
			  
mysql_query("INSERT INTO  radcheck  (UserName,Attribute,op,Value)
		      values('$uedit', '$Attribute',':=','$data_date'   )") or trigger_error(mysql_error(),E_USER_ERROR); 

		
		      echo                  "<script type=text/javascript>";
		    echo                  "alert('�ѹ�֡����������������� ')";
	        echo                  "</script>";
           echo "<meta http-equiv=refresh content=0;URL=index.php?case_i=2>"; 
		   exit();
		}
		?>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
 <center>
 <b>
���¹�ѹ������آͧ�����ҹ&nbsp;<?php print $uedit;?>
</b> �����������㹰ҹ�����ŻѨ�غѹ &nbsp;
        <?   $query_user = "SELECT      *      FROM       radcheck   where UserName='$uedit'   and   Attribute = 'Expiration' ";
$user_db = mysql_query($query_user, $connect_db) or die(mysql_error());
$row_user = mysql_fetch_assoc($user_db);   ;  
 
    #�ӡ���¡�ѹ��� ���� �ҡ�����  $date_db ���� array
			  $a_time= explode(" ",$row_user[Value]) ;
			  $a_time[0];  //�ѹ
			 $a_time[1];  //��͹
			  $a_time[2];  //��
			  $months= re_name($a_time[1]);
			  print   $a_time[0]."-".$months."-".$a_time[2]; 
			  ?>
<br>
</center>
<form method="post" name="form1" action="<?php echo $editFormAction; ?>?case_i=52">
<table align="center"  class="imagetable">
<th align="right" nowrap bgcolor="#99FFCC"><strong><font size="3" face="MS Sans Serif, Tahoma, sans-serif">�ѹ������ء����ҹ</font></strong></th>
      <td><font size="2" face="MS Sans Serif, Tahoma, sans-serif"> 
        <select name="endday" id="endday">
          <option value="1" selected >1</option>
          <?php
		 $xDay = 2; 
   while ($xDay <= 31) { 
   if($xDay >10) { $xDay="$xDay"; }
      echo " <option value=$xDay >$xDay</option>\r\n";
      $xDay++; 
   }
   ?>
        </select>
        <select name="endmount" id="endmount">
          <option value="Jan" selected>���Ҥ�</option>
          <option value="Feb">����Ҿѹ��</option>
          <option value="Mar">�չҤ�</option>
          <option value="Apr">����¹</option>
          <option value="May">����Ҥ�</option>
          <option value="Jun">�Զع�¹</option>
          <option value="Jul">�á�Ҥ�</option>
          <option value="Aug">�ԧ�Ҥ�</option>
          <option value="Sep">�ѹ��¹</option>
          <option value="Oct">���Ҥ�</option>
          <option value="Nov">��Ȩԡ�¹</option>
          <option value="Dec">�ѹ�Ҥ�</option>
        </select>
        <select name="endyear" id="endyear">
          <option value="2013" selected>2013</option>
 
          <option value="2014">2014</option>
          <option value="2015">2015</option>
          <option value="2016">2016</option>
          <option value="2017">2017</option>
        </select>
        <input type="hidden" name="uedit" id="uedit" value="<?php print $uedit;?>" >
      </font></td>
 
 
  <td><font size="2" face="MS Sans Serif, Tahoma, sans-serif">
    <input type="submit" name="Expiration" value="�ѹ�֡" id="Expiration"  class="styled-button-2"  >
  </font></td>
</table>
</form><br />
<table width="684" border="1" align="center"  class="imagetable">
  <tr>
    <th colspan="2"><div align="center"><strong><font size="3" face="MS Sans Serif">��¡�á�������ѹ��ҹ</font></strong></div></th>
  </tr>
  <tr>
    <th width="356"> <div align="center">�ѹ���ѹ�֡������ </div></th>
    <th width="318">  <div align="center">�����˵�  </div></th>
  </tr>

    <?php 
  $query_Recordset1 = "SELECT   *   FROM noute_data  where UserName ='$uedit'  and domain='$domain_name' order by date_add desc  ";
$Recordset1 = mysql_query($query_Recordset1, $connect_db) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
 
if($row_Recordset1[date_add]!=NULL) {
  do { ?>
    <tr>
    <td>
      <div align="center">
        <?php     date_to_thai($row_Recordset1[date_add]);?>
        </div></td>
    <td><div align="left"><?php print $row_Recordset1[texts];?></div></td>
  </tr>
    <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1));  }?>
</table>

 
 
