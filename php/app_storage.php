<?php
// Session start 
session_start();

 // DB connection
require_once('DB_INFO.php');
header('Content-Type: text/html; charset=utf-8');

mysqli_query("set session character_set_connection=utf8;");
mysqli_query("set session character_set_results=utf8;");
mysqli_query("set session character_set_client=utf8;");

$bd=mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD) or die("Could not connect database");
mysqli_set_charset($bd, "utf8") or die("Could not select database");


mysqli_select_db($bd,DB_NAME);

//POST values
    $club= $_SESSION["GROUP"];
    $major=mysqli_real_escape_string($bd,test_input($_POST['major']));
    $p_num=mysqli_real_escape_string($bd,test_input($_POST['p_num']));
    $gender=mysqli_real_escape_string($bd,test_input($_POST['gender']));
    $served=mysqli_real_escape_string($bd,test_input($_POST['served']));
    $mail=$_POST['mail'];
    $activity=mysqli_real_escape_string($bd,test_input($_POST['activity']));

    $content1= $_POST['content1'];
    $content2= $_POST['content2'];
    $content3= $_POST['content3'];
    $content4= $_POST['content4'];
    $content5= $_POST['content5'];
    $content6= $_POST['content6'];
    $content7= $_POST['content7'];

   

	function test_input($data) {
	   $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}


    echo $club;
  echo "<br>";
   echo $major;
  echo "<br>";

   echo $p_num;
  echo "<br>";

   echo $gender;
  echo "<br>";

   echo $served;
     echo "<br>";

   echo $mail;
     echo "<br>";

   echo $activity;
     echo "<br>";
 echo "<br>";
   echo $content1;
     echo "<br>";
 echo "<br>";
   echo $content2;
     echo "<br>";
 echo "<br>";
   echo $content3;
     echo "<br>";

   echo $content4;
   echo $content5;
   echo $content6;
   echo $content7;



$id = $_SESSION['USER_NAME'];
$qry = "SELECT * FROM student WHERE id = '$id'";
$stuid_result = mysqli_query($bd,$qry);
$stuid_array = mysqli_fetch_array($stuid_result);
$stuid = $stuid_array['stuid'];
$name = $stuid_array['student_name'];

$sql = "SELECT * FROM result WHERE club_name = '$club' AND stu_id = '$stuid'";
$result = mysqli_query($bd,$sql);

if(mysqli_num_rows($result) > 0){
$sql = "UPDATE result 
SET name = '$name',major = '$major',p_num = '$p_num',gender = '$gender',served = '$served',mail = '$mail',
activity = '$activity',text1 = '$content1',text2 = '$content2',text3 = '$content3',text4 = '$content4',
text5 = '$content5',text6 = '$content6',text7 = '$content7' WHERE club_name = '$club' AND stu_id = '$stuid'";

if ($bd->query($sql) === TRUE) {
    echo "New record inserted successfully";
    header("Location: ../php/clubpage.php");
} else {
    echo "Error: " . $sql . "<br>" . $bd->error;
    //header("Location: ../php/firstpage.php");
}

$bd->close();

}
else{
$sql = "INSERT INTO result (club_name,name,stu_id,major,p_num,gender,served,mail,activity,text1,text2,text3,text4,text5,text6,text7)
VALUES ('$club','$name','$stuid' ,'$major' ,'$p_num' ,'$gender' ,'$served' ,'$mail' ,'$activity' ,'$content1' ,'$content2' ,'$content3' ,'$content4','$content5','$content6','$content7')";

if ($bd->query($sql) === TRUE) {
    echo "New record created successfully";
    header("Location: ../php/clubpage.php");
} else {
    echo "Error: " . $sql . "<br>" . $bd->error;
    //header("Location: ../php/firstpage.php");
}

$bd->close();
}

?>
 
	