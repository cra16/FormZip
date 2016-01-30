<?php
session_start();
unset($_SESSION["USER_NAME"]);
unset($_SESSION["USER_PASSWORD"]);
header("Location:firstpage.php");
?>