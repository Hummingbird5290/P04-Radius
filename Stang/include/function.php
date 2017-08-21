
<?php

function removesql($sql){
$pattern = '/;/i';
$replacement = NULL;
$sql= preg_replace($pattern, $replacement, $sql);
return  $sql;
}


function re_name($mounts)
{
  if($mounts=='Jan') { $num_rows="01"; }
  if($mounts=='Feb') { $num_rows="02"; } 
  if($mounts=='Mar') { $num_rows="03"; } 
  if($mounts=='Apr') { $num_rows="04"; } 
  if($mounts=='May') { $num_rows="05"; } 
  if($mounts=='Jun') { $num_rows="06"; } 
  if($mounts=='Jul') { $num_rows="07"; } 
  if($mounts=='Aug') { $num_rows="08"; } 
  if($mounts=='Sep') { $num_rows="09"; } 
  if($mounts=='Oct') { $num_rows="10"; } 
  if($mounts=='Nov') { $num_rows="11"; } 
  if($mounts=='Dec') { $num_rows="12"; } 
    return $num_rows;
}

function re_name2($mounts)
{
  if($mounts=='01') { $num_rows="Jan"; }
  if($mounts=='02') { $num_rows="Feb"; } 
  if($mounts=='03') { $num_rows="Mar"; } 
  if($mounts=='04') { $num_rows="Apr"; } 
  if($mounts=='05') { $num_rows="May"; } 
  if($mounts=='06') { $num_rows="Jun"; } 
  if($mounts=='07') { $num_rows="Jul"; } 
  if($mounts=='08') { $num_rows="Aug"; } 
  if($mounts=='09') { $num_rows="Sep"; } 
  if($mounts=='10') { $num_rows="Oct"; } 
  if($mounts=='11') { $num_rows="Nov"; } 
  if($mounts=='12') { $num_rows="Dec"; } 
    return $num_rows;
}

function re_name4($g)
{
$rec1Arr = explode('/', $g); $date_thai_mont  =  $rec1Arr[1];
if($date_thai_mont=="1"){ 	$date_thai_mont="ม.ค."; }
if($date_thai_mont=="2"){ 	$date_thai_mont="ก.พ."; }
if($date_thai_mont=="3"){ 	$date_thai_mont="มี.ค."; }
if($date_thai_mont=="4"){ 	$date_thai_mont="เม.ย."; }
if($date_thai_mont=="5"){ 	$date_thai_mont="พ.ค."; }
if($date_thai_mont=="6"){ 	$date_thai_mont="มิ.ย."; }
if($date_thai_mont=="7"){ 	$date_thai_mont="ก.ค."; }
if($date_thai_mont=="8"){ 	$date_thai_mont="ส.ค."; }
if($date_thai_mont=="9"){ 	$date_thai_mont="ก.ย."; }
if($date_thai_mont=="10"){ 	$date_thai_mont="ต.ค."; }
if($date_thai_mont=="11"){ 	$date_thai_mont="พ.ย."; }
if($date_thai_mont=="12"){ 	$date_thai_mont="ธ.ค."; }
    return  "$rec1Arr[0] $date_thai_mont $rec1Arr[2] ";
}
//แปลงเวลาจากฐานข้อมูล Mysql to เวลาไทย
function date_to_thai($date_en)
{
     $date_thai_day = date('d',strtotime($date_en));
	 $date_thai_mont = date('m',strtotime($date_en));
	 $date_thai_year = date('Y',strtotime($date_en));
	 $date_thai_time = date('H:i',strtotime($date_en));
$date_thai_year =$date_thai_year +543;

if($date_thai_mont=="1"){ 	$date_thai_mont="ม.ค."; }
if($date_thai_mont=="2"){ 	$date_thai_mont="ก.พ."; }
if($date_thai_mont=="3"){ 	$date_thai_mont="มี.ค."; }
if($date_thai_mont=="4"){ 	$date_thai_mont="เม.ย."; }
if($date_thai_mont=="5"){ 	$date_thai_mont="พ.ค."; }
if($date_thai_mont=="6"){ 	$date_thai_mont="มิ.ย."; }
if($date_thai_mont=="7"){ 	$date_thai_mont="ก.ค."; }
if($date_thai_mont=="8"){ 	$date_thai_mont="ส.ค."; }
if($date_thai_mont=="9"){ 	$date_thai_mont="ก.ย."; }
if($date_thai_mont=="10"){ 	$date_thai_mont="ต.ค."; }
if($date_thai_mont=="11"){ 	$date_thai_mont="พ.ย."; }
if($date_thai_mont=="12"){ 	$date_thai_mont="ธ.ค."; }
	 
$time_thai=" $date_thai_day&nbsp;$date_thai_mont&nbsp;$date_thai_year เวลา  $date_thai_time นาที  ";
echo $time_thai;
}

function date_to_thai_return($date_en)
{
     $date_thai_day = date('d',strtotime($date_en));
	 $date_thai_mont = date('m',strtotime($date_en));
	 $date_thai_year = date('Y',strtotime($date_en));
	 $date_thai_time = date('H:i',strtotime($date_en));
$date_thai_year =$date_thai_year +543;

if($date_thai_mont=="1"){ 	$date_thai_mont="ม.ค."; }
if($date_thai_mont=="2"){ 	$date_thai_mont="ก.พ."; }
if($date_thai_mont=="3"){ 	$date_thai_mont="มี.ค."; }
if($date_thai_mont=="4"){ 	$date_thai_mont="เม.ย."; }
if($date_thai_mont=="5"){ 	$date_thai_mont="พ.ค."; }
if($date_thai_mont=="6"){ 	$date_thai_mont="มิ.ย."; }
if($date_thai_mont=="7"){ 	$date_thai_mont="ก.ค."; }
if($date_thai_mont=="8"){ 	$date_thai_mont="ส.ค."; }
if($date_thai_mont=="9"){ 	$date_thai_mont="ก.ย."; }
if($date_thai_mont=="10"){ 	$date_thai_mont="ต.ค."; }
if($date_thai_mont=="11"){ 	$date_thai_mont="พ.ย."; }
if($date_thai_mont=="12"){ 	$date_thai_mont="ธ.ค."; }
	 
$time_thai=" $date_thai_day  $date_thai_mont  $date_thai_year เวลา  $date_thai_time นาที  ";
return $time_thai;
}
//============== insert ==============
function insert($field,$value,$table)
{
$sql = "INSERT INTO $table ($field) VALUES ($value)";
$result= mysql_query($sql);
return $result;
}

//=============== select ==================
function selectdb($table,$condition)
{
$sql = "select * from $table $condition";
$dbquery = mysql_query($sql);
$result= mysql_fetch_array($dbquery);
return $result;
}

//=============== Numrow ==================
function num_record($table,$condition)
{
$sql = "select * from $table $condition";
$dbquery = mysql_query($sql);
$num_rows = mysql_num_rows($dbquery);
return $num_rows;
}



//=============== หาผลรวม ==================  
function num_lines($filess,$table,$condition) 
{ 
$sql = "select   count($filess)   from  $table";//  $condition"; 
$dbquery = mysql_query($sql); 
$result = mysql_fetch_array($db_query);
$aas=$result[log_time_date];
echo "$sql";
return $aas; 
} 





//=============== update ==================
function update($table,$command,$condition)
{
$sql = "UPDATE $table SET $command $condition";
$pattern = '/;/i';
$replacement = NULL;
$sql= preg_replace($pattern, $replacement, $sql);
$result = mysql_query($sql);
return $result;
}

//=============== หาผลรวมของตาราง==================
function sumdb($table,$fdb,$condition)
{
$sql = "SELECT * , sum($fdb) as   total_workdb     from  $table  $condition  ";

$result = mysql_query($sql);
return $result;
}

//=============== chk  file type  ==================
function chkType($chk_type_files,$files_pass)  {
     
   $files_pass="No";    //// กรณี มีการอัพโหลดเข้ามาตั้งค่าเริ่มต้นเป็น No ไม่รับ ไว้ก่อน

   
  if($chk_type_files =="") {   $files_pass="None";  }  //ไม่ได้ upload รูป
               else        
				   {
  
  //กรณีอัพโหลดเอกสาร
  if( $chk_type_files =="application/pdf" || $chk_type_files=="text/plain"
                                          || $chk_type_files=="application/msword"  
	                                      ||  $chk_type_files=="application/x-shockwave-flash" )
                                                                        {   $files_pass="Docs" ; } 
			   
	   
  //กรณีอัพโหลดรูปภาพ

               if( $chk_type_files =="image/gif" || $chk_type_files=="image/bmp"   ||   $chk_type_files=="image/pjpeg"
				                                 || $chk_type_files=="image/pjpeg"  
				                                 ||  $chk_type_files=="image/x-png" )
                                                                       
			                                                            {   $files_pass="jpg" ; } 
			                                                                                       
			  
 	
	  
	  	   }//จบ ไม่ได้ upload รูป
return  $files_pass;


}

//=============== ลบไฟล์  ==================
function del_data($pic_del)
{   

    unlink($pic_del); //ลบไฟลเดิมที่ server ทิ้ง 
                                      
return ;
   }
   
   #########check tables
 
function mysql_is_table($tbl) 
{ 
    $tables = array(); 

    $q = @mysql_query("SHOW TABLES"); 
    while ($r = @mysql_fetch_array($q)) { $tables[] = $r[0]; } 
    @mysql_free_result($q); 
    @mysql_close($link); 
    if (in_array($tbl, $tables)) { return TRUE; } 
    else { return FALSE; } 
} 
 

?>

