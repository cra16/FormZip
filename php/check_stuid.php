<?php
require_once('DB_INFO.php');
header('Content-Type: text/html; charset=utf-8');

mysqli_query("set session character_set_connection=utf8;");
mysqli_query("set session character_set_results=utf8;");
mysqli_query("set session character_set_client=utf8;");

$bd=mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD) or die("Could not connect database");
mysqli_set_charset($bd, "utf8");

mysqli_select_db($bd,DB_NAME) or die("Could not select database");
$stuid = $_GET['stuid'];

if(!$stuid){
  echo"학번을 입력하세요";
}
else{

  $sql = "SELECT * FROM student WHERE stuid = '$stuid'";
  $result = mysql_query($sql);
  $num_record = mysql_num_rows($result);

  if($num_record){
    echo"학번이 중복됩니다<br>";
    echo"학번을 다시 입력하세요.<br>";
  }else{
    echo"사용가능한 학번입니다.";
  }

  mysql_close();
}
?>