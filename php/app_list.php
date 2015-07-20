<?php
Header("Content-type: charset=utf-8");
mysqli_query("set session character_set_connection=utf8;");
mysqli_query("set session character_set_results=utf8;");
mysqli_query("set session character_set_client=utf8;");
mysqli_set_charset($connect, "utf8");

  $mysql_hostname = "localhost";      
  $mysql_user = "root";
  $mysql_password = "helloworld206";    
  $mysql_database = "formzip";
  $prefix = "";
  $bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) or die("Could not connect database");
        mysql_select_db($mysql_database, $bd) or die("Could not select database"); 
 ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>지원자 리스트</title>

    <!-- Bootstrap -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../css/application_list.css" rel="stylesheet">

  </head>
  <body>

  <!-- Menubar start-->  
  <nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="firstpage.html">Form_Zip</a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
     
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#">Login</a></li>
        <li><a href="#">Signup</a></li>
        <li><a href="#">Help</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- Application List Start -->
<div id = "wrap">
<h4 class = "title-name"> -- 지원 현황 -- </h4>

<table align="center" class="table table-striped">
  <thead>
    <tr>
      <th class = "sort-student-number">학번</th>
      <th class = "sort-name">이름</th>
      <th class = "sort-sex">성별</th>
    </tr>
  </thead>
  <tbody>
    <?php
    //CLUB get하기
      $club = 'CRA';
      $qry1 = "SELECT name FROM result WHERE club_name = '$club' ";
      $qry2 = "SELECT stu_id FROM result WHERE club_name = '$club' ";
      $qry3 = "SELECT gender FROM result WHERE club_name = '$club' ";
      $name_result = mysql_query($qry1);
      $id_result = mysql_query($qry2);
      $gender_result = mysql_query($qry3);

      $i=0;
      $j=1;
      $name = 'dd';
      while($name[$i]!=NULL){
        $name = mysql_fetch_array($name_result);
        $id = mysql_fetch_array($id_result);
        $gender = mysql_fetch_array($gender_result);      
?>
       <tr id = '$j' class = 'clickable-row' data-href='firstpage.html'>
       <td class = 'studnet-number' scope='row'>
        <?php echo"$id[$i]"; ?> 
       </td>
       <td class = 'Name'>
        <?php echo"$name[$i]"; ?>
       </td>
       <td class = 'sex'>
        <?php echo"$gender[$i]"; ?>
       </td>
       </tr>

      <?php
        $i++;
        $j++;
      }

    ?> 
  </tbody>
</table>
</div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script>
    jQuery(document).ready(function($) {
    $(".clickable-row").click(function() {
        window.document.location = $(this).data("href");
      });
    });

    </script>
  </body>
</html>


