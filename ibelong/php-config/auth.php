<?php
// 파일명: auth.php
// 설명: 유저가 관리자인지 학생인지 판별

session_start();
// 디비연동
require_once('DB_INFO.php');
// USER_NAME은 학생이 입력한 아이디
$username = $_SESSION['USER_NAME'];
$qry="SELECT * FROM student WHERE id='$username'";
$result=mysqli_query($link,$qry);

//Check whether the query was successful or not
	if($result) {
		if(mysqli_num_rows($result) > 0 ) {
			$member = mysqli_fetch_assoc($result);
			//index
			if($member['index']!=1 &&$member['index']!=2 ){
		      header("location: ../php-views/firstpage.php");
		      exit();}
		 }else {
			//Login failed
			header("location: ../php-views/firstpage.php");
							exit();
			  
		}
	}else {
		die("Query failed");
	}