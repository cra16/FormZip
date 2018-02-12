<?php
// 파일명: DP_INFO.php
// 설명: 기본적인 db연동

  // Define database connection constants
  defined("DB_HOST") || define("DB_HOST", "localhost");
  defined("DB_USER") || define("DB_USER", "root");
  defined("DB_PASSWORD") || define("DB_PASSWORD", "123456");
  defined("DB_NAME") || define("DB_NAME", "ibelong");
  defined("KEY") || define("KEY", "1qaz2wsx3edc4rfv5tgb6yhn");

  // Connect formzip -> 한글깨짐 방지
  if(!defined("DB_INFO_HEADER")){
    define("DB_INFO_HEADER", "header");
    header('Content-Type: text/html; charset=utf-8');
  }
  
  $link=mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD) or die("Could not connect database");

  mysqli_query($link,"set session character_set_connection=utf8;");
  mysqli_query($link,"set session character_set_results=utf8;");
  mysqli_query($link,"set session character_set_client=utf8;");
  
  mysqli_set_charset($link, "utf8");
  mysqli_select_db($link,DB_NAME) or die("Could not select database");
  // Check connection
  if ($link->connect_error) {
      die("Connection failed: " . $link->connect_error);
  }
?>
