<?php
function hexToBase64($hex)
{
  $base16Chars = array_flip(str_split('0123456789abcdef'));
  $base64Chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+-';
  $hex = strtolower($hex);
  $hexLen = strlen($hex);
  $buffer = 0;
  $bufferedBits = 0;
  $base64 = '';
  for ($i = 0; $i < $hexLen; $i++) {
    $buffer = ($buffer << 4) | $base16Chars[$hex[$i]];
    $bufferedBits += 4;
    if ($bufferedBits >= 6) {
      $bufferedBits -= 6;
      $base64 .= $base64Chars[($buffer >> $bufferedBits) & 63];
      $buffer &= (1 << $bufferedBits) - 1;
    }
  }
  if ($bufferedBits) {
    $base64 .= $base64Chars[$buffer << (6 - $bufferedBits)];
  }
  $base64 .= str_repeat('=', $hexLen % 3);
  return $base64;
}
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
