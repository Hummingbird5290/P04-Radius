 <?php
  include("../include/chklogin.php");   
  ?>
 <meta http-equiv="Content-Type" content="text/html; charset=windows-874">
 <?php
include("../Connections/dbconnect.php");

include("../include/function.php");
 
     
        $id = htmlspecialchars("$id", ENT_QUOTES);
 
$pattern = '/;/i';
$replacement = NULL;
$id= preg_replace($pattern, $replacement, $id);
 
 
##################################################
update("question","status ='1'","where id ='$id'");  

###########################################
            echo                  "<script type=text/javascript>";
		    echo                  "alert('แก้ไขปัญหาเสร็จสิ้น ')";
	        echo                  "</script>";
           echo "<meta http-equiv=refresh content=0;URL=index.php?case_i=8>"; 
 
?>