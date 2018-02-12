 <!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
<body>
 <?php
   require_once('../php/DB_INFO.php');
  header('Content-Type: text/html; charset=utf-8');

  mysqli_query("set session character_set_connection=utf8;");
  mysqli_query("set session character_set_results=utf8;");
  mysqli_query("set session character_set_client=utf8;");

  $bd=mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD) or die("Could not connect database");
  mysqli_set_charset($bd, "utf8");

  mysqli_select_db($bd,DB_NAME) or die("Could not select database");

$key = KEY;
$s_vector_iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_3DES, MCRYPT_MODE_ECB), MCRYPT_RAND);


////동아리 비밀번호////

$num = 54;

 $sql = "SELECT c_name FROM club";

 $result=mysqli_query($bd,$sql);
  

for($i = 0;$i<60;$i++){
//club 	
$password = 'formzip'.$num;
$clubname = mysqli_fetch_array($result);
### 암호화 ####
$en_str = mcrypt_encrypt(MCRYPT_3DES, $key, $password, MCRYPT_MODE_ECB, $s_vector_iv);
$encryption = bin2hex($en_str); 

echo $encryption.'<br>'.'<br>'.'<br>';

 ### 복호화 ####
      $de_str = pack("H*", $encryption); //hex로 변환한 ascii를 binary로 변환
      $decoding = mcrypt_decrypt(MCRYPT_3DES, $key, $de_str, MCRYPT_MODE_ECB, $s_vector_iv);
echo $clubname[0].'----->'.$decoding.'<br>'.'<br>';
echo '==========================='.'<br>';

$num =$num +6;
}

/////////////////////




////학회 비밀번호////
$num = 47;
$sql = "SELECT a_name FROM academy";
$result=mysqli_query($bd,$sql);
  
for($i = 0;$i<70;$i++){
$password = 'freedom'.$num;
$academyname = mysqli_fetch_array($result);
### 암호화 ####
$en_str = mcrypt_encrypt(MCRYPT_3DES, $key, $password, MCRYPT_MODE_ECB, $s_vector_iv);
$encryption = bin2hex($en_str); 

echo $encryption.'<br>'.'<br>'.'<br>';

 ### 복호화 ####
      $de_str = pack("H*", $encryption); //hex로 변환한 ascii를 binary로 변환
      $decoding = mcrypt_decrypt(MCRYPT_3DES, $key, $de_str, MCRYPT_MODE_ECB, $s_vector_iv);
echo $academyname[0].'----->'.$decoding.'<br>'.'<br>';
echo '==========================='.'<br>';

$num =$num +7;
}

///////////////////////


?>
</body>
</html>
