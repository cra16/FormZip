<?php 
// 파일명: academylist_config.php
// 설명: 학회 명단을 가져오기위해 db와 연동

// db와 연동하기 위한 기본 세팅
$db_name  = 'ibelong';
$hostname = 'localhost';
$username = 'root';
$password = 'helloworld206';

// db와 연결(json 방식으로 파일을 보내기 위해 PDO방식 체택)
$dbh = new PDO("mysql:host=$hostname;dbname=$db_name", $username, $password);

//한글 설정
$dbh->exec("set names utf8");

// academy table에서 필요한 내용 select
$sql = 'SELECT a_name,dept,img_name FROM academy';

// use prepared statements, even if not strictly required is good practice
$stmt = $dbh->prepare( $sql );

// execute the query
$stmt->execute();

// fetch the results into an array
$result = $stmt->fetchAll( PDO::FETCH_ASSOC );

// json으로 변경
$json = json_encode( $result );

//close Database
$dbh = null;
// echo the json string
echo $json;
?>