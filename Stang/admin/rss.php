<?php	 //    The header line forces XML format to the browser
 
header("Content-Type: text/xml; charset=utf8");  
   
 echo '<?xml version="1.0" encoding="utf8" ?>';
$showTop=10;
$hostname_edoc1 = "127.0.0.1";
$hostname_edoc2 = "localhost";
$database_edoc = "radius";   
$username_edoc = "root";
$password_edoc = "010464088";

$hostname_edoc=$hostname_edoc1;
$connect_db= mysql_connect ($hostname_edoc, $username_edoc, $password_edoc) ;
 mysql_select_db($database_edoc);  //  or trigger_error(mysql_error(),E_USER_ERROR);
     mysql_query("SET character_set_results=tis620");
    mysql_query("SET character_set_client=tis620");
    mysql_query("SET character_set_connection=tis620");
    mysql_query("SET collation_connection = tis620_thai_ci");
    mysql_query("SET collation_database = tis620_thai_ci");
    mysql_query("SET  collation_server = tis620_thai_ci");
 
$query_xmp  = " SELECT *  FROM    seting    ";
$xml_data = mysql_query($query_xmp, $connect_db) or die(mysql_error());
$row_xml = mysql_fetch_assoc($xml_data);
$tbname=$row_xml[tbname];
$tbname=  iconv( 'TIS-620', 'UTF-8', $tbname);

 
$todays=date("Y-m-d");
$query_xmp  = " SELECT *  FROM    question   where status ='0' and time_q like '%$todays%' ";
$xml_data = mysql_query($query_xmp, $connect_db) or die(mysql_error());
$row_xml = mysql_fetch_assoc($xml_data);
$totalRows_xml = mysql_num_rows($xml_data);

?>
   
  <rss version="2.0">
   <channel>
      <title>รายงานแจ้งปัญหาการใช้งาน ของ  <?php $tbname; ?></title> 
     <description>www.thaigqsoft.com</description> 
    <link>http://www.thaigqsoft.com</link> 
 
<?php
do {    
    $No_topic=$row_xml['id'];  //นัมเบอร์
    $title=$row_xml['name'];   //หัวข้อเรื่อง
	$description=$row_xml['question'];  //รายล่ะเอียด
	$pubDate=$row_xml['time_q'];  // วันที่แอดข่าวมีไม่มีก็ได้
	
$title=  iconv( 'TIS-620', 'UTF-8', $title);
$description=  iconv( 'TIS-620', 'UTF-8', $description);	

$title=	htmlspecialchars($title);
$description=	htmlspecialchars($description);   

 

	         echo "<item>\n";
			 echo "<title>$title</title>\n";
		 //  	 echo "<link>$link</link>\n";
			  echo  "<description>$description</description>\n";
		//	 echo  "<pubDate>$pubDate</pubDate>\n";
             echo "</item>\n";
 
 
 			
} while ($row_xml = mysql_fetch_assoc($xml_data));
?>
</channel>
 </rss>