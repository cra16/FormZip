<?php
  require_once('DB_INFO.php');
  Header("Content-type: application/vnd.ms-excel");
  Header("Content-type: charset=utf-8");
  header("Content-Disposition: attachment; filename=Download.xls");
 Header("Content-Description: PHP5 Generated Data");
  Header("Pragma: no-cache");
  Header("Expires: 0");

 mysqli_query("set session character_set_connection=utf8;");
mysqli_query("set session character_set_results=utf8;");
mysqli_query("set session character_set_client=utf8;");

  $connect=mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD);
  mysqli_select_db($connect,DB_NAME);
  $result = mysqli_query($connect,'SELECT * FROM student'); 
   mysqli_set_charset($connect, "utf8");

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
  </head>
  <body>
<table border=1 cellpadding=2 cellspacing=5>

<tr bgcolor=#DDDDDD>
<td>index</td>
<td>name</td>
<td>id</td>
<td>password</td>
</tr>
<?php
while($array = mysqli_fetch_array($result)){
?>
    <tr>
        <td width=90>
            <p align=center><?php echo $array[index];?></p>
        </td>
        <td width=250>
            <p align=center><?php echo $array[student_name];?></p>
        </td>
        <td width=50>
            <p align=center><?php echo $array[id];?></p>
        </td>
        <td width=70>
            <p align=center><?php echo $array[password];?></p>
        </td>       
    </tr>      
<?php
   }
?>
  </body>
</html>