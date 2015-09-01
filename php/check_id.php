<!DOCTYPE html>
<html lang="en">
 
<head>
  <script src="../js/signup.js"></script>
<?php
session_start();
require_once('DB_INFO.php');
header('Content-Type: text/html; charset=utf-8');

mysqli_query("set session character_set_connection=utf8;");
mysqli_query("set session character_set_results=utf8;");
mysqli_query("set session character_set_client=utf8;");

$bd=mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD) or die("Could not connect database");
mysqli_set_charset($bd, "utf8");

mysqli_select_db($bd,DB_NAME) or die("Could not select database");

$id = $_GET['id'];

if(!$id)
{
  echo"학번을 입력하세요";
}

else{
  $sql = "SELECT * FROM student WHERE id ='$id'";
  $result = mysqli_query($bd,$sql);
  $num_record = mysqli_num_rows($result);
  if($num_record>0){
    echo "이미 사용중인 아이디입니다.";
    echo " <script> opener.document.all.checkid.value=0; </script>";
    echo " <script>  opener.document.all.userIdMsg.style.display='block';</script>";
    echo " <script>  opener.document.all.userIdMsg.innerHTML='이미 사용중인 아이디 입니다.';</script>";
    echo " <script>  opener.document.all.userIdMsg.style.color='#FF8080';</script>";
  
  }

  else{
    echo "사용 가능한 아이디입니다.";
    echo " <script> opener.document.all.checkid.value=1; </script>";
    echo " <script> opener.document.all.userid.disabled=true; </script>";
    echo " <script>  opener.document.all.userIdMsg.style.display='block';</script>";
    echo " <script>  opener.document.all.userIdMsg.innerHTML='확인되었습니다.';</script>";
    echo " <script>  opener.document.all.userIdMsg.style.color='#66FF66';</script>";


  }

  mysqli_close($bd);
}
?>
</head>

<body>
  
</body>
</html>
