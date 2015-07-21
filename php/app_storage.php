<?php
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
    $club=mysqli_real_escape_string($bd,test_input($_POST['club']));
    $name=mysqli_real_escape_string($bd,test_input($_POST['name']));
    $stuid=mysqli_real_escape_string($bd,test_input($_POST['stuid']));
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



  echo "<br>";
  echo $name;
  echo "<br>";
    echo $stuid;
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



$sql = "INSERT INTO appstorage (id,name,stuid,major,p_num,gender,served,mail,activity,text1,text2,text3,text4,text5,text6,text7)
VALUES ('$club','$name','$stuid' ,'$major' ,'$p_num' ,'$gender' ,'$served' ,'$mail' ,'$activity' ,'$content1' ,'$content2' ,'$content3' ,'$content4','$content5','$content6','$content7')";

if ($bd->query($sql) === TRUE) {
    echo "New record created successfully";
    header("Location: ../php/firstpage.php");
} else {
    echo "Error: " . $sql . "<br>" . $bd->error;
    header("Location: ../php/firstpage.php");
}

$bd->close();

?>
 
	