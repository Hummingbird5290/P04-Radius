<? 
ob_start();
session_start();
ini_set('date.timezone ', 'Asia/Bangkok');
$www=$HTTP_HOST;
if (empty($_SESSION['adminpass']))   // ��Ǩ�ͺ��Ҽ�ҹ��� login �������
     {
		echo "<meta http-equiv=refresh content=0;URL=http://$www/admin/login.php>"; 
       echo"goto  Login  ";
       exit();
     }                                            
?>

