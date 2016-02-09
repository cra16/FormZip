<?php
	session_start();

	// wrong access-> no login
	if(!$_SESSION['USER_NAME']||!$_SESSION['MODE'])
     header("location: ../php-views/firstpage.php");

 	// wring access-> common user
 	if($_SESSION['MODE']!=1 && $_SESSION['MODE']!=2)
     header("location: ../php-views/firstpage.php");

	// DB connection
	require_once('../php-config/DB_INFO.php');
	$mode = $_SESSION['MODE'];
	$group_name = $_SESSION['USER_NAME'];
	if($mode == 1){	//club admin
	  $sql="SELECT * FROM club WHERE c_name='$group_name'";   
	  $result=mysqli_query($link,$sql);  
	}

	else{ //academy admin
	  $sql="SELECT * FROM academy WHERE a_name='$group_name'";   
	  $result=mysqli_query($link,$sql);
	}

	if($result) {
		if(mysqli_num_rows($result) > 0) 
		{
			$member = mysqli_fetch_assoc($result);
		}else{
			echo "Data call failed";
		}
	}
	else 
	{
		die("Query failed");
	}

?>