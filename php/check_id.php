<?php
require_once('DB_INFO.php');
header('Content-Type: text/html; charset=utf-8');

mysqli_query("set session character_set_connection=utf8;");
mysqli_query("set session character_set_results=utf8;");
mysqli_query("set session character_set_client=utf8;");

$bd=mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD) or die("Could not connect database");
mysqli_set_charset($bd, "utf8");

mysqli_select_db($bd,DB_NAME) or die("Could not select database");

$id = $_GET['id'];

if(!$id){
  echo"아이디를 입력하세요";
}
else{

  $sql = "SELECT * FROM student WHERE id = '$id'";
  $result = mysqli_query($bd,$sql);
  $num_record = mysqli_num_rows($bd,$result);
  echo "$num_record"."$id";
  if($num_record){
    echo"아이디가 중복됩니다<br>";
    echo"다른 아이디를 사용하세요.<br>";
  }else{
    echo"사용가능한 아이디 입니다.";
  }

  mysqli_close($bd);
}
?>