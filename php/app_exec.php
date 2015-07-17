<?php
session_start();
require_once('DB_INFO.php');
header('Content-Type: text/html; charset=utf-8');

mysqli_query("set session character_set_connection=utf8;");
mysqli_query("set session character_set_results=utf8;");
mysqli_query("set session character_set_client=utf8;");

$conn=mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD) or die("Could not connect database");
mysqli_set_charset($conn, "utf8");


mysqli_select_db($conn,DB_NAME) or die("Could not select database");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

//POST values
   $served = mysqli_real_escape_string($conn,$_POST['r_served']);
    $mail = mysqli_real_escape_string($conn,$_POST['r_mail']);
    $activity = mysqli_real_escape_string($conn,$_POST['r_activity']);
    
    $sr1 = mysqli_real_escape_string($conn,$_POST['sr1']);
    $sr2 = mysqli_real_escape_string($conn,$_POST['sr2']);
    $sr3 = mysqli_real_escape_string($conn,$_POST['sr3']);
    $sr4 = mysqli_real_escape_string($conn,$_POST['sr4']);
    $sr5 = mysqli_real_escape_string($conn,$_POST['sr5']);
    $sr6 = mysqli_real_escape_string($conn,$_POST['sr6']);
    $sr7 = mysqli_real_escape_string($conn,$_POST['sr7']);

    $sr = array("$sr1","$sr2","$sr3","$sr4","$sr5","$sr6","$sr7");

    $title1= $_POST['title1'];
    $title2= $_POST['title2'];
    $title3= $_POST['title3'];
    $title4= $_POST['title4'];
    $title5= $_POST['title5'];
    $title6= $_POST['title6'];
    $title7= $_POST['title7'];

    $title=array("$title1","$title2","$title3","$title4","$title5","$title6","$title7");

    $explain1=$_POST['explain1'];
    $explain2=$_POST['explain2'];
    $explain3=$_POST['explain3'];
    $explain4=$_POST['explain4'];
    $explain5=$_POST['explain5'];
    $explain6=$_POST['explain6'];
    $explain7=$_POST['explain7'];
    
    $explain=array("$explain1","$explain2","$explain3","$explain4","$explain5","$explain6","$explain7");

    $month = mysqli_real_escape_string($conn,$_POST['month']);
    $date = mysqli_real_escape_string($conn,$_POST['date']);

/*

출력 확인부분
echo $served;
echo "<br>";

echo $mail;
echo "<br>";
echo $activity;
echo "<br>";
    

for($i =0; $i <7;$i++)
{
    echo $sr[$i];
    echo "<br>";
}

for($i=0; $i <7; $i++)
{
    if($sr[$i]=="notuse")
    {
        $$title[$i] = "notuse";
        $explain[$i] = "notuse";
    }

}


*/
$admin = $_SESSION["USER_NAME"];

<<<<<<< HEAD
$id=21;

$sql = "INSERT INTO application
VALUES ('$id','$served' ,'$mail' ,'$activity' ,'$sr1' ,'$sr2' ,'$sr3' ,'$sr4' ,'$sr5' ,'$sr6' ,'$sr7' ,'$title1','$explain1','$title2','$explain2','$title3','$explain3','$title4','$explain4','$title5','$explain5','$title6','$explain6','$title7','$explain7','$month','$date')";
=======
$sql = "UPDATE application
SET served = '$served' ,mail = '$mail' ,activity = '$activity' ,sr1 = '$sr1' ,sr2 = '$sr2' ,sr3 = '$sr3' ,sr4 = '$sr4' ,sr5 = '$sr5' ,sr6 = '$sr6' ,sr7 = '$sr7' ,title1 = '$title1' ,explain1 = '$explain1' ,title2 = '$title2' ,explain2 = '$explain2' ,title3 = '$title3' ,explain3 = '$explain3' ,title4 = '$title4' ,explain4 = '$explain4' ,title5 = '$title5' ,explain5 = '$explain5' ,title6 = '$title6' ,explain6 = '$explain6' ,title7 = '$title7' ,explain7 = '$explain7' ,month = '$month' ,date = '$date'  WHERE id = '$admin'";
>>>>>>> world

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();




?>
 
	