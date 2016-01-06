<?php
// Session start 
session_start();

 // Manager judge
require_once('auth.php');

// DB connection
require_once('DB_INFO.php');


//  이미지 저장 
$file_name = $_FILES['upload_file']['name'];
$tmp_file = $_FILES['upload_file']['tmp_name'];


$s_file_name=iconv('UTF-8','EUC-KR',$file_name); 
$file_path = '../clubimg/'.$s_file_name;

$r = move_uploaded_file($tmp_file, $file_path);


// title, text 정보 불러오기
$title= addslashes($_POST['title']);
$text= addslashes($_POST['text']);
$club_name= $_POST['name'];

//update photo
if ($r == true) 
{
    $sql = "UPDATE club
    SET img_name='$file_name'
    WHERE c_name='$club_name'";
    if ($link->query($sql) === TRUE)
    {
        echo "New record created successfully";
    } 
    else 
    {
        echo "Error: " . $sql . "<br>" . $link->error;
    }

}
else 
{
    echo "ERROR: File not moved correctly";
}
//update title
if ($title != "") 
{
    $sql = "UPDATE club
    SET title='$title'
    WHERE c_name='$club_name'";
    if ($link->query($sql) === TRUE)
    {
        echo "New record created successfully";
    } 
    else 
    {
        echo "Error: " . $sql . "<br>" . $link->error;
    }

}
else 
{
    echo "ERROR: File not moved correctly";
}
//update content
if ($text !="") 
{
    $sql = "UPDATE club
    SET text ='$text'
    WHERE c_name='$club_name'";
    if ($link->query($sql) === TRUE)
    {
        echo "New record created successfully";
    } 
    else 
    {
        echo "Error: " . $sql . "<br>" . $link->error;
    }

}
else 
{
    echo "ERROR: File not moved correctly";
}



$link->close();
header("Location: ../php/clubpage.php");    
 
?>