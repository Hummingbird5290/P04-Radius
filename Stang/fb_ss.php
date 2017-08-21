 <?php 
 function get_fcontent( $url )
{
  $ch = curl_init();
  $timeout = 10;
  curl_setopt( $ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; rv:1.7.3) Gecko/20041001 Firefox/0.10.1" );
  curl_setopt($ch,CURLOPT_URL,$url);
  curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
  curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
  $data = curl_exec($ch);
  curl_close($ch);
  return $data;
}
print $data=get_fcontent( "http://m.facebook.com/Fixitcenter");
?>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
 
 
  <iframe src="http://www.facebook.com/plugins/like.php?href=https://www.facebook.com/Fixitcenter" crolling="no" frameborder="0" style="border:none; overflow:hidden; width:60px; height:30px;" allowTransparency="true"></iframe>
</span></p>
