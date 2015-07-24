<?php
include('base64.php');
$n = $_GET['n'];
$pwd = $_GET['pwd'];
$res = $pwd;
$pad = 'zzzzzzzzzzzzzzzzzzzzzz';
//echo hash(sha1, $pwd);
for($i=0; $i<$n; $i++){
  $res = hash(sha1, $res);
}
//echo $res;echo '</br>';
$salt = substr($res, 0, 22);
$len = strlen($salt);
$salt = $salt . $pad;
//echo $salt;echo '</br>';
$options = ['cost' => 12, 'salt' => $salt];
//$options = ['cost' => 12];
$bcrypt = password_hash($res, PASSWORD_BCRYPT, $options);
//echo $bcrypt;echo '</br>';
$res = substr($bcrypt, 29, 31);
//echo $res;
//echo '</br>';
$res = hash(sha1, $res);
echo $res;echo '</br>';
echo hexToBase64($res);echo '</br>';
//echo base64_encode($res);echo '</br>';
?>
