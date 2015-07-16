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
   	$served= test_input($_POST['r_served']);
   	$mail= test_input($_POST['r_mail']);
    $activity= test_input($_POST['r_activity']);
    
    $sr1=test_input($_POST['sr1']);
    $sr2=test_input($_POST['sr2']);
    $sr3=test_input($_POST['sr3']);
    $sr4=test_input($_POST['sr4']);
    $sr5=test_input($_POST['sr5']);
    $sr6=test_input($_POST['sr6']);
    $sr7=test_input($_POST['sr7']);

    $sr=array("$sr1","$sr2","$sr3","$sr4","$sr5","$sr6","$sr7");

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

    $month=test_input($_POST['month']);
    $date=test_input($_POST['date']);

	function test_input($data) {
	   $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

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

$id=21;

$sql = "INSERT INTO application
VALUES ('$id','$served' ,'$mail' ,'$activity' ,'$sr1' ,'$sr2' ,'$sr3' ,'$sr4' ,'$sr5' ,'$sr6' ,'$sr7' ,'$title1','$explain1','$title2','$explain2','$title3','$explain3','$title4','$explain4','$title5','$explain5','$title6','$explain6','$title7','$explain7','$month','$date')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>
 
	