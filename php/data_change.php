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
switch($_GET['mode']){
    case 'insert':
        $info = "INSERT INTO student (id, password, student_name,stuid,birth)
         VALUES ('".mysqli_real_escape_string($connect,$_POST['userid'])."', '".mysqli_real_escape_string($connect,$_POST['pw'])."'
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
