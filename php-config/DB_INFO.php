<?php
// 파일명: DP_INFO.php
// 설명: 기본적인 db연동

  // Define database connection constants
  define('DB_HOST', "localhost");
  define('DB_USER', "root");
  define('DB_PASSWORD', "gksehdeo357");
  define('DB_NAME', "formzip");
  define('KEY', "1as4fg7jk0");
  // Connect formzip -> 한글깨짐 방지
  header('Content-Type: text/html; charset=utf-8');
  mysqli_query("set session character_set_connection=utf8;");
  mysqli_query("set session character_set_results=utf8;");
  mysqli_query("set session character_set_client=utf8;");
  $link=mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD) or die("Could not connect database");
  mysqli_set_charset($link, "utf8");
  mysqli_select_db($link,DB_NAME) or die("Could not select database");
  // Check connection
  if ($link->connect_error) {
      die("Connection failed: " . $link->connect_error);
  }
?>
