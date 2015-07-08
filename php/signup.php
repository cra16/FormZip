<?php
require_once('DB_INFO.php');
header('Content-Type: text/html; charset=utf-8');

mysqli_query("set session character_set_connection=utf8;");
mysqli_query("set session character_set_results=utf8;");
mysqli_query("set session character_set_client=utf8;");

$connect=mysqli_connect('DB_HOST', 'DB_USER', 'DB_PASSWORD');
mysqli_set_charset($connect, "utf8");


mysqli_select_db($connect,'DB_NAME');
switch($_GET['mode']){
    case 'insert':
        $info = "INSERT INTO student (id, password, name)
         VALUES ('".mysqli_real_escape_string($connect,$_POST['userid'])."', '".mysqli_real_escape_string($connect,$_POST['pw'])."'
                   ,'".mysqli_real_escape_string($connect,$_POST['name'])."')" ; 
        echo $info;

        $result = mysqli_query($connect,$info);
       header("Location: ../html/firstpage.html");
        break;
   /* case 'delete':
        mysql_query('DELETE FROM topic WHERE id = '.mysql_real_escape_string($_POST['id']));
        header("Location: list.php"); 
        break;
    case 'modify':
        mysql_query('UPDATE topic SET title = "'.mysql_real_escape_string($_POST['title']).'", description = "'.mysql_real_escape_string($_POST['description']).'" WHERE id = '.mysql_real_escape_string($_POST['id']));
        header("Location: list.php?id={$_POST['id']}");
        break;*/
}  mysqli_close($connect);
?>