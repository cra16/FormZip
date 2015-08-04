<?php
// Session start 
session_start();

 // Manager judge
require_once('auth.php');

// DB connection
require_once('DB_INFO.php');
header('Content-Type: text/html; charset=utf-8');

mysqli_query("set session character_set_connection=utf8;");
mysqli_query("set session character_set_results=utf8;");
mysqli_query("set session character_set_client=utf8;");

// Create connection
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 



//  이미지 저장 
$file_name = $_FILES['upload_file']['name'];
$tmp_file = $_FILES['upload_file']['tmp_name'];


$s_file_name=iconv('UTF-8','EUC-KR',$file_name); 
$file_path = '../clubimg/'.$s_file_name;

$r = move_uploaded_file($tmp_file, $file_path);


// title, text 정보 불러오기
$title= $_POST['title'];
$text= $_POST['text'];
$academy_name= $_POST['name'];

if ($r == true) 
{
    $sql = "UPDATE academy
    SET img_name='$file_name'
    WHERE a_name='$academy_name'";
    if ($conn->query($sql) === TRUE) 
    {
        echo "New record created successfully";
    } 
    else 
    {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

}
else 
{
    echo "ERROR: File not moved correctly";
}

if ($title != "") 
{
    $sql = "UPDATE academy
    SET title='$title'
    WHERE a_name='$academy_name'";
    if ($conn->query($sql) === TRUE) 
    {
        echo "New record created successfully";
    } 
    else 
    {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

}
else 
{
    echo "ERROR: File not moved correctly";
}

if ($text !="") 
{
    $sql = "UPDATE academy
    SET text ='$text'
    WHERE a_name='$academy_name'";
    if ($conn->query($sql) === TRUE) 
    {
        echo "New record created successfully";
    } 
    else 
    {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

}
else 
{
    echo "ERROR: File not moved correctly";
}



$conn->close();
header("Location: ../php/academypage.php");    
 
