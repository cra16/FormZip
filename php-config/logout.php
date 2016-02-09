<?php
session_start();
unset($_SESSION["USER_NAME"]);
unset($_SESSION["USER_PASSWORD"]);
unset($_SESSION['GROUP']);
unset($_SESSION['MODE']);
header("Location:../php-views/firstpage.php");
?>