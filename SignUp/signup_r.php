<?php
$connect=mysqli_connect('localhost', 'root', 'helloworld206');

if(!$connect){
   print("연결실패".$mydb);
   die("종료됩니다.");
  }else{
   print("성공");
}


mysqli_select_db($connect,'formzip');
switch($_GET['mode']){
    case 'insert':
        $info = "INSERT INTO member (id, password, name, s_number, p_number)
         VALUES ('".mysqli_real_escape_string($connect,$_POST['id'])."', '".mysqli_real_escape_string($connect,$_POST['pass'])."'
                   ,'".mysqli_real_escape_string($connect,$_POST['name'])."','".mysqli_real_escape_string($connect,$_POST['stunum'])."'
                   ,'".mysqli_real_escape_string($connect,$_POST['phone'])."' )" ; 
        echo $info;

        $result = mysqli_query($connect,$info);
        // header("Location: ../First_Page/FirstPage.html");
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
