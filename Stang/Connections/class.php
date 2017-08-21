<?
class DB{

function query($query){
$QID = mysql_query($query);

    mysql_query("SET character_set_results=tis620");
    mysql_query("SET character_set_client='tis620'");
    mysql_query("SET character_set_connection='tis620'");
   mysql_query("collation_connection = tis620_thai_ci");
    mysql_query("collation_database = tis620_thai_ci");
    mysql_query("collation_server = tis620_thai_ci");


	if(!$QID){
		echo "<br><br><b><font face='MS Sans Serif' size='1' color='#000099'>Query : \"$query\" </font><br>
				  <font face='MS Sans Serif' size='1' color='#FF0000'>Error : \"".mysql_error()."\"</font></b>
				  <br>";
		exit; 
		return $QID;
	}else{
		return $QID;
	}
}

}
?>