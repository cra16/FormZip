<?php
session_start();
  $mysql_hostname = "localhost";      
  $mysql_user = "root";
  $mysql_password = "gksehdeo357";    
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
    <title>Club List</title>

    <!-- Bootstrap -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../css/clublist.css" rel="stylesheet">

  </head>
<body>

  <!-- Menubar start-->  
  <nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" 
      data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="firstpage.php">Form_Zip</a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
     
      <ul class="nav navbar-nav navbar-right">
        <li>
          <?php
            if($_SESSION['USER_NAME'])
              echo '<a href="logout.php">Logout</a>';
            else
              echo '<a href="login.php">Login</a>';
          ?>

        </li>       
        <li><a href="signup.php">Signup</a></li>
        <li><a href="#">Help</a></li>
      </ul>
    </div>
  </div>
  </nav>
   <!-- Menubar end-->  

  <h2>FORM ZIP</h2>
  <h3>apply  recruit</h3>

   <!-- Club Search Bar-->
<div class="row">
  <div class="col-xs-6 col-md-2"></div>
  <div class="col-xs-6 col-md-8 searchbox">
    <form action='demo.php' method='GET'>
      <input type = 'submit' class="searchbutton" name ='whole' value ='전체' >
      <img src="../img/bar.png">
      <input type = 'submit' class="searchbutton" name = 'perform' value ='공연/음악' >
      <img src="../img/bar.png">
      <input type = 'submit' class="searchbutton" name = 'sport' value ='스포츠'>
      <img src="../img/bar.png">
      <input type = 'submit' class="searchbutton" name = 'academic' value ='학술' >
      <img src="../img/bar.png">
      <input type = 'submit' class="searchbutton" name = 'computer' value ='전산' >
      <img src="../img/bar.png">
      <input type = 'submit' class="searchbutton" name = 'religion' value ='종교' >
      <img src="../img/bar.png">
      <input type = 'submit' class="searchbutton" name = 'volunteer' value ='봉사' >
      <img src="../img/bar.png"> 
      <input type = 'submit' class="searchbutton" name = 'display' value ='전시' >
    </form>
  </div>
  <div class="col-xs-6 col-md-2"></div>
</div> 

 
<?php
$name_arr=array("whole","perform","sport","academic","computer","religion","volunteer","display");

for($i=0; $i<8;$i++){
  if($_GET[$name_arr[$i]]){
    $condition = $_GET[$name_arr[$i]];
    break;
  }
}

if($condition == NULL){
  $condition = "전체";
}

if( $condition != "전체" ){
  $sql="SELECT c_name FROM club WHERE field='$condition'";  
}else{
  $sql = "SELECT c_name FROM club";
} 
$result=mysql_query($sql);

$i=0;
$j=0;
$clubname[$i] = "dd";
?>

 <div class="container">
  <div class="row">
    <form action="clubpage.php" method="POST">
      <?php
      while($clubname[$i] != NULL){
        for($j=0 ; $j<4 ; $j++){
          $clubname = mysql_fetch_array($result);
          if($clubname[$i] == NULL){
            break;
          }
          echo " <div class='col-xs-6 col-md-3'>";
          echo "<input class = 'club-element' type = 'submit' value ='$clubname[$i]' name = 'name' src='../clubimg/3.jpg'>";
          echo "</div>";
          } 
      }
      ?>
    </form>
  </div>
</div>

  

  
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap.min.js"></script>
  </body>
</html>