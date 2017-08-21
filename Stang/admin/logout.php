<?
ob_start();
session_start();
session_destroy();
ob_end_flush();
?>
<html>

<body>
<div align="center"> <?php echo  "<meta http-equiv=refresh content=0;URL=login.php>"; ?> 
</div>
</html>
