<?php
session_start();
// Manager judge
//require_once('auth.php');
require_once('DB_INFO.php');
header('Content-Type: text/html; charset=utf-8');

mysqli_query("set session character_set_connection=utf8;");
mysqli_query("set session character_set_results=utf8;");
mysqli_query("set session character_set_client=utf8;");

$bd=mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD) or die("Could not connect database");
mysqli_set_charset($bd, "utf8");
mysqli_select_db($bd,DB_NAME) or die("Could not select database");


$key = KEY;
$s_vector_iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_3DES, MCRYPT_MODE_ECB), MCRYPT_RAND);

$password = mysqli_real_escape_string($bd,$_POST['current']);
$new_password = mysqli_real_escape_string($bd,$_POST['pw']);

### 암호화 ####
$en_str = mcrypt_encrypt(MCRYPT_3DES, $key, $password, MCRYPT_MODE_ECB, $s_vector_iv);
$encryption = bin2hex($en_str);  

$new_en_str = mcrypt_encrypt(MCRYPT_3DES, $key, $new_password, MCRYPT_MODE_ECB, $s_vector_iv);
$new_encryption = bin2hex($new_en_str); 


$id = $_SESSION['USER_NAME'];


$qry="SELECT * FROM student WHERE id='$id' ";
$result=mysqli_query($bd,$qry);

if(mysqli_num_rows($result) > 0) {
    $member = mysqli_fetch_assoc($result);
  }
 else{
   header("Location: ../php/login.php");
 }?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=1280">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  </head>
<body><?php
if($member['index']==0) {?>
<form name="pw_send" method="POST" action="mypage.php" >
<?php }else{ ?>
<form name="pw_send" method="POST" action="mypage_a.php" >  
<?php
 }
 if($encryption==$member['password']){
   $sql = 'UPDATE student SET password = "'.mysqli_real_escape_string($bd,$new_encryption).'"WHERE id = "'.mysqli_real_escape_string($bd,$_SESSION["USER_NAME"]).'"';
        mysqli_query($bd,$sql);
   echo '<input type="hidden" id="check" name="check" value="true">';
  }
else{
  echo  '<input type="hidden" id="check" name="check" value="false">';	
  } 
?>
 </form>
  <script type="text/javascript">
  document.pw_send.submit();
 </script>

</body>
</html>
