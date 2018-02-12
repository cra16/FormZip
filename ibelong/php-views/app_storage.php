<?php
// 파일명: app_storage.php
// 설명: user가 지원서를 쓴 후 지원서 저장
// Session start 
session_start();

 // DB connection
require_once('../php-config/DB_INFO.php');

//로그인 여부 판단
$username = $_SESSION['USER_NAME'];
if(!$username){
  header("location: firstpage.php");
  exit();
}


if(!$_POST['temp'] && !$_POST['real'])
{
  header("location: firstpage.php");
  exit();
}

//POST values
    $club= $_POST['club_name'];
    $major=mysqli_real_escape_string($link,test_input($_POST['major']));
    $p_num=mysqli_real_escape_string($link,test_input($_POST['p_num']));
    $gender=mysqli_real_escape_string($link,test_input($_POST['gender']));
    $served=mysqli_real_escape_string($link,test_input($_POST['served']));
    $mail=$_POST['mail'];
    $activity=mysqli_real_escape_string($link,test_input($_POST['activity']));

    $content1= addslashes($_POST['content1']);
    $content2= addslashes($_POST['content2']);
    $content3= addslashes($_POST['content3']);
    $content4= addslashes($_POST['content4']);
    $content5= addslashes($_POST['content5']);
    $content6= addslashes($_POST['content6']);
    $content7= addslashes($_POST['content7']);
    $content8= addslashes($_POST['content8']);
    $content9= addslashes($_POST['content9']);
    $content10= addslashes($_POST['content10']);

   

  function test_input($data) {
     $data = trim($data);
     $data = stripslashes($data);
     $data = htmlspecialchars($data);
     return $data;
  }

  function check(){
    alert('임시저장no');
  }

$id = $_SESSION['USER_NAME'];
$qry = "SELECT * FROM student WHERE id = '$id'";
$stuid_result = mysqli_query($link,$qry);
$stuid_array = mysqli_fetch_array($stuid_result);
$stuid = $stuid_array['stuid'];
$name = $stuid_array['student_name'];

$sql = "SELECT * FROM result WHERE club_name = '$club' AND id = '$id'";
$result = mysqli_query($link,$sql);

$check = $_POST['real']; //제출값 return
$file_upload = false;
echo "<pre>";
if (is_uploaded_file($_FILES['codefile']['tmp_name'])) {
    $file_upload = true;
    $real_name = basename($_FILES['codefile']['name']);

    $arr = explode(".", $real_name);  
    $arr1 = $arr[0];
    $arr2 = $arr[1];
    $arr3 = $arr[2];
    $arr4 = $arr[3];  

    if($arr4) $file_exe = $arr4;
    else if($arr3 && !$arr4)$file_exe = $arr3;          
    else if($arr2 && !$arr3)$file_exe = $arr2;

    $uploaddir = '/var/www/html/ibelong/userfile/';
    $saved_file = $username."-".trim($name)."-".$club.".".$file_exe;
    $uploadfile = $uploaddir.$saved_file;
    echo $uploadfile;  
    if (move_uploaded_file($_FILES['codefile']['tmp_name'], $uploadfile)) {
        echo "파일이 유효하고, 성공적으로 업로드 되었습니다.\n";
    }else {
        print "파일 업로드 공격의 가능성이 있습니다!\n";   
    }  

    //print_r($_FILES);  
}else{
  //print_r($_FILES);
  print "파일 업로드 공격의 가능성이 있습니다!\n";   

}

          





echo "</pre>";

if( $check ){ //제출
  if(mysqli_num_rows($result) > 0){

    if($file_upload == true){
         $sql = "UPDATE result 
    SET name = '$name',major = '$major',p_num = '$p_num',gender = '$gender',served = '$served',mail = '$mail',
    activity = '$activity',file_name = '$real_name',saved_file = '$saved_file',text1 = '$content1',text2 = '$content2',text3 = '$content3',text4 = '$content4',
    text5 = '$content5',text6 = '$content6',text7 = '$content7',text8 = '$content8',text9 = '$content9',text10 = '$content10', storage = '0' WHERE club_name = '$club' AND id = '$id'";
    }else{
         $sql = "UPDATE result 
    SET name = '$name',major = '$major',p_num = '$p_num',gender = '$gender',served = '$served',mail = '$mail',
    activity = '$activity',text1 = '$content1',text2 = '$content2',text3 = '$content3',text4 = '$content4',
    text5 = '$content5',text6 = '$content6',text7 = '$content7',text8 = '$content8',text9 = '$content9',text10 = '$content10', storage = '0' WHERE club_name = '$club' AND id = '$id'";
    }  

   

    if ($link->query($sql) === TRUE) {
        echo "New record inserted successfully";
        header("Location: ../php-views/individual_page.php");
    } else {
        echo "Error: " . $sql . "<br>" . $link->error;
        //header("Location: ../php/firstpage.php");
    }

    $link->close();
  }
  else{

    if($file_upload == true){
        $sql = "INSERT INTO result (club_name,name,id,stu_id,major,p_num,gender,served,mail,activity,file_name,saved_file,text1,text2,text3,text4,text5,text6,text7,text8,text9,text10,storage)
    VALUES ('$club','$name','$id','$stuid' ,'$major' ,'$p_num' ,'$gender' ,'$served' ,'$mail' ,'$activity','$real_name' ,'$saved_file' ,'$content1' ,'$content2' ,'$content3' ,'$content4','$content5','$content6','$content7','$content8','$content9','$content10','0')";
    }else{
      $sql = "INSERT INTO result (club_name,name,id,stu_id,major,p_num,gender,served,mail,activity,text1,text2,text3,text4,text5,text6,text7,text8,text9,text10,storage)
    VALUES ('$club','$name','$id','$stuid' ,'$major' ,'$p_num' ,'$gender' ,'$served' ,'$mail' ,'$activity' ,'$content1' ,'$content2' ,'$content3' ,'$content4','$content5','$content6','$content7','$content8','$content9','$content10','0')";
    }    
    if ($link->query($sql) === TRUE) {
        echo "New record created successfully";
        header("Location: ../php-views/individual_page.php");
    } else {
        echo "Error: " . $sql . "<br>" . $link->error;
        //header("Location: ../php/firstpage.php");
    }

    $link->close();
  }

}else{ //임시저장
  if(mysqli_num_rows($result) > 0){
   if($file_upload == true){
         $sql = "UPDATE result 
    SET name = '$name',major = '$major',p_num = '$p_num',gender = '$gender',served = '$served',mail = '$mail',
    activity = '$activity',file_name = '$real_name',saved_file = '$saved_file',text1 = '$content1',text2 = '$content2',text3 = '$content3',text4 = '$content4',
    text5 = '$content5',text6 = '$content6',text7 = '$content7',text8 = '$content8',text9 = '$content9',text10 = '$content10', storage = '1' WHERE club_name = '$club' AND id = '$id'";
    }else{
         $sql = "UPDATE result 
    SET name = '$name',major = '$major',p_num = '$p_num',gender = '$gender',served = '$served',mail = '$mail',
    activity = '$activity',text1 = '$content1',text2 = '$content2',text3 = '$content3',text4 = '$content4',
    text5 = '$content5',text6 = '$content6',text7 = '$content7',text8 = '$content8',text9 = '$content9',text10 = '$content10', storage = '1' WHERE club_name = '$club' AND id = '$id'";
    }  

    if ($link->query($sql) === TRUE) {
        echo "New record inserted successfully";
        header("Location: ../php-views/individual_page.php");
    } else {
        //echo "Error: " . $sql . "<br>" . $link->error;
        echo $link->error;
        //header("Location: ../php/firstpage.php");
    }

    $link->close();

  }
  else{
    if($file_upload == true){
        $sql = "INSERT INTO result (club_name,name,id,stu_id,major,p_num,gender,served,mail,activity,file_name,saved_file,text1,text2,text3,text4,text5,text6,text7,text8,text9,text10,storage)
    VALUES ('$club','$name','$id','$stuid' ,'$major' ,'$p_num' ,'$gender' ,'$served' ,'$mail' ,'$activity','$real_name' ,'$saved_file' ,'$content1' ,'$content2' ,'$content3' ,'$content4','$content5','$content6','$content7','$content8','$content9','$content10','1')";
    }else{
      $sql = "INSERT INTO result (club_name,name,id,stu_id,major,p_num,gender,served,mail,activity,text1,text2,text3,text4,text5,text6,text7,text8,text9,text10,storage)
    VALUES ('$club','$name','$id','$stuid' ,'$major' ,'$p_num' ,'$gender' ,'$served' ,'$mail' ,'$activity' ,'$content1' ,'$content2' ,'$content3' ,'$content4','$content5','$content6','$content7','$content8','$content9','$content10','1')";
    }

    if ($link->query($sql) === TRUE) {
        echo "New record created successfully";
        header("Location: ../php-views/individual_page.php");
    } else {
        //echo "Error: " . $sql . "<br>" . $link->error;
        echo $link->error;
        //header("Location: ../php/firstpage.php");
    }

    $link->close();
  }

}

?>
 
  