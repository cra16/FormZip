<?php
 // Session start 
session_start(); 
require_once('../php-config/DB_INFO.php');
$club_name = $_SESSION['USER_NAME'];

if(!$club_name){
	header("location: ../php-views/firstpage.php");
	exit();
}else{
	$sql = "SELECT * FROM student WHERE id = '$club_name'";
	$check_result = mysqli_query($link,$sql);
    $check = mysqli_fetch_array($check_result);
    $index = $check['index'];
    if($index == 0){
    	header("location: ../php-views/firstpage.php");
		exit();
    }
}

$password = mysqli_real_escape_string($link,$_POST['current']);

if($password != $_POST['now']){
	echo '<script language="javascript">';
	echo 'window.location.href="../php-views/mypage_a.php";';
	echo 'alert("현재 비밀번호를 잘못 입력하셨습니다.");';
	echo '</script>';
}
$new_pw = mysqli_real_escape_string($link,$_POST['newp']);
$new_pw = encrypt_decrypt('encrypt',$new_pw);

$sql = "UPDATE `student` SET `password`='$new_pw' WHERE `id`='$club_name'";
$outcome = mysqli_query($link,$sql); 


if($outcome){
	echo '<script language="javascript">';
	echo 'window.location.href="../php-views/mypage_a.php";';
	echo 'alert("정상적으로 변경되었습니다.");';
	echo '</script>';
	exit();
}
else{
	echo '<script language="javascript">';
	echo 'window.location.href="../php-views/mypage_a.php";';
	echo 'alert("에러가 발생하였습니다.");';
	echo '</script>';
	exit();
}




function encrypt_decrypt($action, $string) {
	$output = false;
	$encrypt_method = "AES-256-CBC";
	$secret_key = KEY;
	$secret_iv = KEY;
	// hash
	$key = hash('sha256', $secret_key);

	// iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
	$iv = substr(hash('sha256', $secret_iv), 0, 16);

	if ( $action == 'encrypt' ) {
		$output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
		$output = base64_encode($output);
	} else if( $action == 'decrypt' ) {
		$output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
	}
	return $output;
}
?>