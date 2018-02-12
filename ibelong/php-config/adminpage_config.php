<?php
// 파일명: adminpage_config.php
// 설명: 관리자 로그인시 관리페이지 접근가능 여부 판단
//	만일 관리자가 아닌 사람이 페이지에 접근 하려고 할시 첫 페이지로 이동
	session_start();

	// 로그인을 하지 않았거나 MODE가 없는경우(MODE가 1이면 동아리, 2이면 학회)
	if(!$_SESSION['USER_NAME']||!$_SESSION['MODE'])
     header("location: ../php-views/firstpage.php");

 	// MODE가 제대로 넘어오지 않는 경우
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