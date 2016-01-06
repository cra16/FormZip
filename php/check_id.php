<!DOCTYPE html>
<html lang="en">
 
<head>
  <script src="../js/signup.js"></script>
<?php
session_start();
require_once('DB_INFO.php');

$id = $_GET['id'];

if(!$id)
{
  echo"학번을 입력하세요";
}

else{
  $sql = "SELECT * FROM student WHERE id ='$id'";
  $result = mysqli_query($link,$sql);
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

  mysqli_close($link);
}
?>
</head>

<body>
  
</body>
</html>
