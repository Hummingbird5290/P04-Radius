<?php include("../include/chklogin.php");    
 
?> 
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<?php
// Test CVS
 
if($_FILES['files_name']['tmp_name'] !=NULL) {
require_once 'Excel/reader.php';

include("../Connections/dbconnect.php");
include("../include/function.php");

$data_file=$_FILES['files_name']['tmp_name']; 
// ExcelFile($filename, $encoding);
$data = new Spreadsheet_Excel_Reader();


// Set output Encoding.
$data->setOutputEncoding('tis620');

/***
* if you want you can change 'iconv' to mb_convert_encoding:
* $data->setUTFEncoder('mb');
*
**/

/***
* By default rows & cols indeces start with 1
* For change initial index use:
* $data->setRowColOffset(0);
*
**/



/***
*  Some function for formatting output.
* $data->setDefaultFormat('%.2f');
* setDefaultFormat - set format for columns with unknown formatting
*
* $data->setColumnFormat(4, '%.3f');
* setColumnFormat - set format for column (apply only to number fields)
*
**/

$data->read($data_file);

/*


 $data->sheets[0]['numRows'] - count rows
 $data->sheets[0]['numCols'] - count columns
 $data->sheets[0]['cells'][$i][$j] - data from $i-row $j-column

 $data->sheets[0]['cellsInfo'][$i][$j] - extended info about cell
    
    $data->sheets[0]['cellsInfo'][$i][$j]['type'] = "date" | "number" | "unknown"
        if 'type' == "unknown" - use 'raw' value, because  cell contain value with format '0.00';
    $data->sheets[0]['cellsInfo'][$i][$j]['raw'] = value if cell without format 
    $data->sheets[0]['cellsInfo'][$i][$j]['colspan'] 
    $data->sheets[0]['cellsInfo'][$i][$j]['rowspan'] 
*/

//error_reporting(E_ALL);
// ini_set("display_errors", 1);

for ($i = 1; $i <= $data->sheets[0]['numRows']; $i++) {
	for ($j = 1; $j <= $data->sheets[0]['numCols']; $j++) {
	
		$row_readE[$i][$j]=$data->sheets[0]['cells'][$i][$j];
		
	}
	

}
$data_s=count ($row_readE);
 
for ($i = 2;  $i <=  $data_s; $i++) {

$UserName   =  $row_readE[$i][1];
$password     =  $row_readE[$i][2];
$fullname       =  $row_readE[$i][3];
$strID             =  $row_readE[$i][4];

$room                  =  $row_readE[$i][5];//แผนก
$tel             =  $row_readE[$i][6];   
$email            =   $row_readE[$i][7];
$site               =   $_POST["site"];   

if($UserName   !=''  and  $password  !='') {
  $UserName = htmlspecialchars("$UserName", ENT_QUOTES);
 $password = htmlspecialchars("$password", ENT_QUOTES);
 $room = htmlspecialchars("$room", ENT_QUOTES);
 $fullname = htmlspecialchars("$fullname", ENT_QUOTES);
 $email = htmlspecialchars("$email", ENT_QUOTES);
 $tel = htmlspecialchars("$tel", ENT_QUOTES);
 $site = htmlspecialchars("$site", ENT_QUOTES);
 $strID = htmlspecialchars("$strID", ENT_QUOTES);
 $pattern = '/;/i';
$replacement = NULL;
$UserName= preg_replace($pattern, $replacement, $UserName);
 $password= preg_replace($pattern, $replacement, $password);
 $room= preg_replace($pattern, $replacement, $room);
 $fullname= preg_replace($pattern, $replacement, $fullname);
 $email= preg_replace($pattern, $replacement, $email);
 $tel= preg_replace($pattern, $replacement, $tel);
 $site= preg_replace($pattern, $replacement, $site);
$strID= preg_replace($pattern, $replacement, $strID);

$password=md5($password);
 
 $query_Recordset_mk_online = " Select *  from register    where  UserName='$UserName'   ";
$Recordset1 = mysql_query($query_Recordset_mk_online, $connect_db) or die(mysql_error());
$row_Recordset_online_mk = mysql_fetch_assoc($Recordset1);
if($row_Recordset_online_mk[UserName] ==''){
###################################################################################
  mysql_query("INSERT INTO  register    (UserName,password,per,room,tel,fullname,status,email,site,domain)
		      values('$UserName','$password','$strID','$room','$tel','$fullname','1','$email','$site','$domain_name')", $connect_db) or die(mysql_error());
 ###################################################################################

mysql_query("delete  from   radcheck    where  UserName='$UserName' ", $connect_db) or die(mysql_error());

mysql_query("INSERT INTO  radcheck     (UserName,Attribute ,op ,Value)
		                                                                          values('$UserName','MD5-Password',':=','$password')", $connect_db) or die(mysql_error());
$Attribute="Expiration";
																										  
 $data_date23="$endday $endmount $endyear 23:50:00";
 /*
$data_date='01 May 2014 00:00:00';
if($room=='1d'){$FD=86400;}
if($room=='1w'){$FD=604800;}
if($room=='4w2d'){$FD=2514000;}
if($room=='12h'){$FD=43200;}
if($room=='3d'){$FD=259200;}
 */
//mysql_query("INSERT INTO  radcheck     (UserName,Attribute ,op ,Value)
//		                                                                          values('$UserName','Max-All-Session',':=','$FD')") ;
																				  
mysql_query("INSERT INTO  radcheck     (UserName,Attribute ,op ,Value)
		                                                                          values('$UserName','Expiration',':=','$data_date23')", $connect_db) or die(mysql_error());
																				  
	mysql_query("INSERT INTO  radcheck     (UserName,Attribute ,op ,Value)
		                                                                          values('$UserName','Simultaneous-Use',':=','1')", $connect_db) or die(mysql_error());																	  

 mysql_query("delete   from  usergroup    where  UserName='$UserName' ", $connect_db) or die(mysql_error());
 																										  
mysql_query("INSERT INTO  usergroup     (UserName,GroupName ,priority)
		                                                                          values('$UserName','$GroupName','1')", $connect_db) or die(mysql_error());
###################################################################################
 
print "Register User  $UserName  OK <br> ";
}// if ซ่ามี user ซ้ำป่าว
} //ตรวจสอบค่าว่าง
}
//print_r($data);
//print_r($data->formatRecords);
?>
<a href="index.php?case_i=31">กลับหน้าหลัก</a> 
<?
} else 
{
	  echo "<meta http-equiv=refresh content=0;URL=index.php?a=200>"; 
		 	exit();  
}
?>
