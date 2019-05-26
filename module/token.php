<?php

@system ("clear");
error_reporting(0);
date_default_timezone_set('Asia/Jakarta');
$date   = date('d-M-Y H:i:s');
@header('Content-Type: text/html; charset=UTF-8');
function token($user, $pass) {
	$ua = 'user-agents.txt';
	$useragent = $ua[rand(0, count($ua) - 1)];
  $cookie = 'cookie.txt';
  touch ($cookie);
$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $me);
	curl_setopt($ch, CURLOPT_POSTFIELDS, 'email='.$user.'&pass='.$pass.'&login=Login');
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
	curl_setopt($ch, CURLOPT_REFERER, 'https://developer.facebook.com');
	$output = curl_exec($ch) or die('Can\'t access '.$url);
	if(stristr($output, '<title>Facebook</title>') || stristr($output, 'id="checkpointSubmitButton"')) {
		return TRUE;
	} else {
		return FALSE;
	}
}
$file = $_SERVER[argv][0];
$user = $_SERVER[argv][1];
$pass = $_SERVER[argv][2];
$me=file_get_contents('https://b-api.facebook.com/method/auth.login?access_token=237759909591655%25257C0f140aabedfb65ac27a739ed1a2263b1&format=json&sdk_version=2&email='.$user.'&locale=en_US&password='.$pass.'&sdk=ios&generate_session_cookies=1&sig=3f555f99fb61fcd7aa0c44f58f522ef6');
$json= json_decode($me, true);
$userid = $json['session_cookies'][0]['value'];
$token = $json['access_token'];
if(preg_match('/session_key/', $me)) {
  $get=fopen("cookie/token.log","w+");
  fwrite($get,$token);
  fclose($get);
  if(file_exists("cookie/token.log")) {
    echo "Tersimpan Di File -> cookie/token.log\n";
  }
}else{
  die("Cek Username / Password ");
}
?>
