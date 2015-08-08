<?php
// Session start 
session_start();

//로그인 확인 여부
$id = $_SESSION['USER_NAME'];
if(!$id){
  header("location: firstpage.php");
  exit();
}

// DB connection
require_once('DB_INFO.php');
header('Content-Type: text/html; charset=utf-8');

mysqli_query("set session character_set_connection=utf8;");
mysqli_query("set session character_set_results=utf8;");
mysqli_query("set session character_set_client=utf8;");

// Create connection
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 


### 비밀번호 암호화된것 복호화 하기 ####
$key = KEY;
$s_vector_iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_3DES, MCRYPT_MODE_ECB), MCRYPT_RAND);
$password = mysqli_real_escape_string($conn,$_POST['pw']);
$en_str = mcrypt_encrypt(MCRYPT_3DES, $key, $password, MCRYPT_MODE_ECB, $s_vector_iv);
$encryption = bin2hex($en_str);  

$qry = "SELECT * FROM student WHERE id = '$id'";
$result = mysqli_query($conn,$qry);
$user = mysqli_fetch_assoc($result);

$password=$user['password'];
$user_id=$user['stuid'];
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  </head>
<body><?php
if($encryption != $password){?>    <!--비밀번호가 일치하지 않는 경우  -->
<form name="pw_send" method="POST" action="withdrawal.php" >
<input type="hidden" id="check" name="check" value="false">
 </form>
  <script type="text/javascript">
  document.pw_send.submit();
 </script>

</body>
</html>
<?php } 

else // 비밀번호가 일치하는 경우
{ 
  $sql1 = "DELETE FROM student WHERE id='$id'"; 
  $sql2 = "DELETE FROM result WHERE stu_id= '$user_id'";
  if($result=mysqli_query($conn,$sql1)){
    unset($_SESSION["USER_NAME"]);
    unset($_SESSION["USER_PASSWORD"]);
    echo "Data deleted";  
  }          

  else{
    echo "failed";
  }

  if($result=mysqli_query($conn,$sql2)){
    echo "Data deleted";
  }          

  else{
    echo "failed";
  }
  header("Location: ../php/firstpage.php");
}