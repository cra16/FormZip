<?php
//==============================================================================/
// file name: auth.php                                                         //
//what to do: confirm that user is admin or common user                        //
//==============================================================================/
session_start();
require_once('DB_INFO.php');

$username = $_SESSION['USER_NAME'];
$qry="SELECT * FROM student WHERE id='$username'";
$result=mysqli_query($link,$qry);

//Check whether the query was successful or not
	if($result) {
		if(mysqli_num_rows($result) > 0 ) {
			$member = mysqli_fetch_assoc($result);
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