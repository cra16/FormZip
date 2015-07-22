<?php
  $mysql_hostname = "localhost";      
  $mysql_user = "root";
  $mysql_password = "78910";    
  $mysql_database = "meeting";
  $prefix = "";
  $bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) or die("Could not connect database");
        mysql_select_db($mysql_database, $bd) or die("Could not select database"); 

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