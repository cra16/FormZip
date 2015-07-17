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

//  이미지 저장 start
$file_name = $_FILES['upload_file']['name'];
$tmp_file = $_FILES['upload_file']['tmp_name'];


$s_file_name=iconv('UTF-8','EUC-KR',$file_name); 
$file_path = '../img/'.$s_file_name;

$r = move_uploaded_file($tmp_file, $file_path);



//  이미지 저장 끝

// title, text 정보 불러오기
$title= $_POST['title'];
$text= $_POST['text'];
$club_name= $_POST['name'];

if ($r == true) 
{
    $sql = "UPDATE clubstorage
    SET img_name='$file_name'
    WHERE id='$club_name'";
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
    $sql = "UPDATE clubstorage
    SET title='$title'
    WHERE id='$club_name'";
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

if ($text !=    "") 
{
    $sql = "UPDATE clubstorage
    SET text ='$text'
    WHERE id='$club_name'";
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

?>
 
