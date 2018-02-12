<?php
// 파일명: logout.php
// 설명: 기존에 선언한 session 파괴 후 첫 페이지로 이동

session_start();
unset($_SESSION["USER_NAME"]);
unset($_SESSION["USER_PASSWORD"]);
unset($_SESSION['GROUP']);
unset($_SESSION['MODE']);
header("Location:../php-views/firstpage.php");
?>