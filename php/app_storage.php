<?php
$servername = "localhost";
$username = "root";
$password = "gksehdeo357";
$dbname = "formzip";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

//POST values
    
    $name=test_input($_POST['name']);
    $stuid=test_input($_POST['stuid']);
    $major=test_input($_POST['major']);
    $p_num=test_input($_POST['p_num']);
    $gender=test_input($_POST['gender']);
    $served=test_input($_POST['served']);
    $mail=$_POST['mail'];
    $activity=test_input($_POST['activity']);

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



$sql = "INSERT INTO appstorage
VALUES ('$name','$stuid' ,'$major' ,'$p_num' ,'$gender' ,'$served' ,'$mail' ,'$activity' ,'$content1' ,'$content2' ,'$content3' ,'$content4','$content5','$content6','$content7')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>
 
	