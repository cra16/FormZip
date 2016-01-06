<?php
	//Start session
session_start();
require_once('DB_INFO.php');

	//Array to store validation errors
	$errmsg_arr = array();
 
	//Validation error flag
	$errflag = false;
 
	//Sanitize the POST values
	$username = mysqli_real_escape_string($link,$_POST['username']);


     ### 비밀번호 처리 ###
     $key = KEY;
     $s_vector_iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_3DES, MCRYPT_MODE_ECB), MCRYPT_RAND);

     $password = mysqli_real_escape_string($link,$_POST['password']);

     ### 암호화 ###
     $en_str = mcrypt_encrypt(MCRYPT_3DES, $key, $password, MCRYPT_MODE_ECB, $s_vector_iv);
     $encryption = bin2hex($en_str);  

 
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
	$qry="SELECT * FROM student WHERE id='$username' AND password='$encryption'";
	$result=mysqli_query($link,$qry);
 
	//Check whether the query was successful or not
	if($result) {
		if(mysqli_num_rows($result) > 0) {
			//Login Successful
			session_regenerate_id();
			$member = mysqli_fetch_assoc($result);
			$_SESSION['USER_NAME'] = $member['id'];
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