<?php
session_start();
require_once('DB_INFO.php');

$key = KEY;
$s_vector_iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_3DES, MCRYPT_MODE_ECB), MCRYPT_RAND);

$password = mysqli_real_escape_string($link,$_POST['pw']);

### 암호화 ####
$en_str = mcrypt_encrypt(MCRYPT_3DES, $key, $password, MCRYPT_MODE_ECB, $s_vector_iv);
$encryption = bin2hex($en_str);  

switch($_GET['mode']){
    case 'insert':
        //중복확인 안하고 접근 막기
        $id= $_POST['userid'];
        $sql = "SELECT * FROM student WHERE id ='$id'";
        $result = mysqli_query($link,$sql);
        $num_record = mysqli_num_rows($result);
        if($num_record>0){
        header("Location: ../php/signup.php");
        break;
        }

        $_SESSION['USER_NAME']=$id; // 회원가입 후 바로 로그인 가능
        $info = "INSERT INTO student (id, password, student_name,stuid,birth)
         VALUES ('".mysqli_real_escape_string($link,$_POST['userid'])."', '".$encryption."'
                   ,'".mysqli_real_escape_string($link,$_POST['name'])."', '".mysqli_real_escape_string($link,$_POST['stuid'])."', '".mysqli_real_escape_string($link,$_POST['birth'])."')" ;
        mysqli_query($link,$info);
        header("Location: ../php/firstpage.php");
        break;
   /* case 'delete':
        mysql_query('DELETE FROM topic WHERE id = '.mysql_real_escape_string($_POST['id']));
        header("Location: list.php"); 
        break;*/
    case 'modify':
        $qry = 'UPDATE student SET password = "'.mysqli_real_escape_string($link,$encryption).'"WHERE id = "'.mysqli_real_escape_string($link,$_SESSION["USER_NAME"]).'"';
        mysqli_query($link,$qry);
        header("Location: ../php/clubpage.php");
        break;
}  mysqli_close($link);
?>
