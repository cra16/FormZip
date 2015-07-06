<?php
$connect=mysqli_connect('52.69.55.228', 'root', 'helloworld206') 
         or die('Error connecting to MySQL server')

mysqli_select_db($connect,'formzip');
switch($_GET['mode']){
    case 'insert':
        $info = "INSERT INTO member (id, password, name, s_number, p_number)
         VALUES ('".mysqli_real_escape_string($connect,$_POST['id'])."', '".mysqli_real_escape_string($connect,$_POST['pass'])."'
                   ,'".mysqli_real_escape_string($connect,$_POST['name'])."','".mysqli_real_escape_string($connect,$_POST['stunum'])."'
                   ,'".mysqli_real_escape_string($connect,$_POST['phone'])."' )" ; 
         
        $result = mysqli_query($connect,$info);
         //header("Location: list.php");
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