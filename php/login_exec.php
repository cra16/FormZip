<?php
	//Start session
	session_start();
    require_once('DB_INFO.php');
	
	$prefix = "";
	$bd = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD) or die("Could not connect database");
	   	mysqli_select_db($bd,DB_NAME) or die("Could not select database");
 
	//Array to store validation errors
	$errmsg_arr = array();
 
	//Validation error flag
	$errflag = false;
 
	//Sanitize the POST values
	$username = mysqli_real_escape_string($bd,$_POST['username']);    
	$password = mysqli_real_escape_string($bd,$_POST['password']);  
 
	//Input Validations
	if($username == '') {
		$errmsg_arr[] = 'id missing';
		$errflag = true;
	}
	if($password == '') {
		$errmsg_arr[] = 'Password missing';
		$errflag = true;
	}
 
	//If there are input validations, redirect back to the login form
	if($errflag) {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		session_write_close();
		header("location: login.php");
		exit();
	}

	//Create query
	$qry="SELECT * FROM student WHERE id='$username' AND password='$password'";
	$result=mysqli_query($bd,$qry);
 
	//Check whether the query was successful or not
	if($result) {
		if(mysqli_num_rows($result) > 0) {
			//Login Successful
			session_regenerate_id();
			$member = mysqli_fetch_assoc($result);
			$_SESSION['USER_NAME'] = $member['id'];
			$_SESSION['USER_PASSWORD'] = $member['password'];
			session_write_close();
			header("location: firstpage.php");
			exit();
		}else {
			//Login failed
			$errmsg_arr[] = 'user name or password not found';
			$errflag = true;
			if($errflag) {
				$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
				session_write_close();
				header("location: login.php");
				exit();
			}
		}
	}else {
		die("Query failed");
	}
?>