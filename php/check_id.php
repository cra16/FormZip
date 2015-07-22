<?php
  $mysql_hostname = "localhost";      
  $mysql_user = "root";
  $mysql_password = "78910";    
  $mysql_database = "meeting";
  $prefix = "";
  $bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) or die("Could not connect database");
        mysql_select_db($mysql_database, $bd) or die("Could not select database"); 

$id = $_GET['id'];

if(!$id){
  echo"아이디를 입력하세요";
}
else{

  $sql = "SELECT * FROM student WHERE id = '$id'";
  $result = mysql_query($sql);
  $num_record = mysql_num_rows($result);

  if($num_record){
    echo"아이디가 중복됩니다<br>";
    echo"다른 아이디를 사용하세요.<br>";
  }else{
    echo"사용가능한 아이디 입니다.";
  }

  mysql_close();
}
?>