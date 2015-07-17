<?php
session_start();
require_once('DB_INFO.php');
header('Content-Type: text/html; charset=utf-8');

mysqli_query("set session character_set_connection=utf8;");
mysqli_query("set session character_set_results=utf8;");
mysqli_query("set session character_set_client=utf8;");

$connect=mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD);
mysqli_set_charset($connect, "utf8");


mysqli_select_db($connect,DB_NAME);

$username = $_SESSION['USER_NAME'];
$qry="SELECT * FROM student WHERE id='$username'";
$result=mysqli_query($connect,$qry);

//Check whether the query was successful or not
	if($result) {
		if(mysqli_num_rows($result) > 0 ) {
			$member = mysqli_fetch_assoc($result);
			if($member['index']!=1){
		      header("location: login.php");
		      exit();}
		 }else {
			//Login failed
			header("location: login.php");
							exit();
			  
		}
	}else {
		die("Query failed");
	}