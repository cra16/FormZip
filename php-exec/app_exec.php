<?php
session_start();
require_once('../php-config/DB_INFO.php');

$club_name=$_POST["name"];

if($club_name="")       //app_make를 통해 정상적인 정보를 받지 않은 경우
{
    header("Location: ../php-views/firstpage.php");
}

$id = $_SESSION["USER_NAME"];
$qry = "SELECT * FROM student WHERE id = '$id'";
            $result = mysqli_query($link,$qry);
            $temp = mysqli_fetch_assoc($result);

$admin=$temp['c_name'];

//POST values
   $served = mysqli_real_escape_string($link,$_POST['r_served']);
    $mail = mysqli_real_escape_string($link,$_POST['r_mail']);
    $activity = mysqli_real_escape_string($link,$_POST['r_activity']);
    
    $sr1 = mysqli_real_escape_string($link,$_POST['sr1']);
    $sr2 = mysqli_real_escape_string($link,$_POST['sr2']);
    $sr3 = mysqli_real_escape_string($link,$_POST['sr3']);
    $sr4 = mysqli_real_escape_string($link,$_POST['sr4']);
    $sr5 = mysqli_real_escape_string($link,$_POST['sr5']);
    $sr6 = mysqli_real_escape_string($link,$_POST['sr6']);
    $sr7 = mysqli_real_escape_string($link,$_POST['sr7']);
    $sr8 = mysqli_real_escape_string($link,$_POST['sr8']);
    $sr9 = mysqli_real_escape_string($link,$_POST['sr9']);
    $sr10 = mysqli_real_escape_string($link,$_POST['sr10']);

    $sr = array("$sr1","$sr2","$sr3","$sr4","$sr5","$sr6","$sr7","$sr8","$sr9","$sr10");

    $title1= addslashes($_POST['title1']);
    $title2= addslashes($_POST['title2']);
    $title3= addslashes($_POST['title3']);
    $title4= addslashes($_POST['title4']);
    $title5= addslashes($_POST['title5']);
    $title6= addslashes($_POST['title6']);
    $title7= addslashes($_POST['title7']);
    
    $title=array("$title1","$title2","$title3","$title4","$title5","$title6","$title7",);

    $explain1= addslashes($_POST['explain1']);
    $explain2= addslashes($_POST['explain2']);
    $explain3= addslashes($_POST['explain3']);
    $explain4= addslashes($_POST['explain4']);
    $explain5= addslashes($_POST['explain5']);
    $explain6= addslashes($_POST['explain6']);
    $explain7= addslashes($_POST['explain7']);
    $explain=array("$explain1","$explain2","$explain3","$explain4","$explain5","$explain6","$explain7");

    $s_month = mysqli_real_escape_string($link,$_POST['s_month']);
    $s_day = mysqli_real_escape_string($link,$_POST['s_day']);
    $month = mysqli_real_escape_string($link,$_POST['month']);
    $day = mysqli_real_escape_string($link,$_POST['day']);

$qry = "SELECT * FROM application WHERE id = '$admin'";
            $result = mysqli_query($link,$qry);
            $isset = mysqli_fetch_assoc($result);

           if($isset['month']!=NULL){
             $del = "DELETE FROM result WHERE club_name = '$admin'";
             mysqli_query($link,$del);
 
           }
           
$sql = "UPDATE application
SET served = '$served' ,mail = '$mail' ,activity = '$activity' ,sr1 = '$sr1' ,sr2 = '$sr2' ,sr3 = '$sr3' ,sr4 = '$sr4' ,sr5 = '$sr5' ,sr6 = '$sr6' ,sr7 = '$sr7' ,title1 = '$title1' ,explain1 = '$explain1' ,title2 = '$title2' ,explain2 = '$explain2' ,title3 = '$title3' ,explain3 = '$explain3' ,title4 = '$title4' ,explain4 = '$explain4' ,title5 = '$title5' ,explain5 = '$explain5' ,title6 = '$title6' ,explain6 = '$explain6' ,title7 = '$title7' ,explain7 = '$explain7',month = '$month' ,day = '$day', s_month = '$s_month', s_day = '$s_day'  WHERE id = '$admin'";


if ($link->query($sql) === TRUE) {
    echo "New record created successfully";
    header("Location: ../php-views/app_preview.php");
} else {
    echo "Error: " . $sql . "<br>" . $link->error;
}

$link->close();
?>
 
    