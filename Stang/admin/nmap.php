<?
$b="";
$command = "nmap  192.168.3.0/24 -sP";
exec($command, $result, $rval);
for ($i = 0; $i < sizeof($result); $i++) {
echo "$result[$i]<br>";
$b .="$result[$i]";
}


?>