<?php
session_start();
require_once('DB_INFO.php');
header('Content-Type: text/html; charset=utf-8');

mysqli_query("set session character_set_connection=utf8;");
mysqli_query("set session character_set_results=utf8;");
mysqli_query("set session character_set_client=utf8;");

$connect=mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD) or die("Could not connect database");;
mysqli_set_charset($connect, "utf8") or die("Could not select database");


mysqli_select_db($connect,DB_NAME);


$key = KEY;
$s_vector_iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_3DES, MCRYPT_MODE_ECB), MCRYPT_RAND);

$password = mysqli_real_escape_string($connect,$_POST['pw']);

### 암호화 ####
$en_str = mcrypt_encrypt(MCRYPT_3DES, $key, $password, MCRYPT_MODE_ECB, $s_vector_iv);
$encryption = bin2hex($en_str);  

switch($_GET['mode']){
    case 'insert':
        //중복확인 안하고 접근 막기
        $id= $_POST['userid'];
        $sql = "SELECT * FROM student WHERE id ='$id'";
        $result = mysqli_query($connect,$sql);
        $num_record = mysqli_num_rows($result);
        if($num_record>0){
        header("Location: ../php/signup.php");
        break;
        }


        $info = "INSERT INTO student (id, password, student_name,stuid,birth)
         VALUES ('".mysqli_real_escape_string($connect,$_POST['userid'])."', '".$encryption."'
                   ,'".mysqli_real_escape_string($connect,$_POST['name'])."', '".mysqli_real_escape_string($connect,$_POST['stuid'])."', '".mysqli_real_escape_string($connect,$_POST['birth'])."')" ; 
        mysqli_query($connect,$info);
        header("Location: ../php/firstpage.php");
        break;
   /* case 'delete':
        mysql_query('DELETE FROM topic WHERE id = '.mysql_real_escape_string($_POST['id']));
        header("Location: list.php"); 
        break;*/
    case 'modify':
        $qry = 'UPDATE student SET password = "'.mysqli_real_escape_string($connect,$_POST['pw']).'"WHERE id = "'.mysqli_real_escape_string($connect,$_SESSION["USER_NAME"]).'"';
        mysqli_query($connect,$qry);
        header("Location: ../php/firstpage.php");
        break;
}  mysqli_close($connect);
?>
