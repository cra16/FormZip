<?php
  // Session start 
  session_start();

  // DB connection
  require_once('DB_INFO.php');
  header('Content-Type: text/html; charset=utf-8');

  mysqli_query("set session character_set_connection=utf8;");
  mysqli_query("set session character_set_results=utf8;");
  mysqli_query("set session character_set_client=utf8;");

  $bd=mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD) or die("Could not connect database");
  mysqli_set_charset($bd, "utf8");

  mysqli_select_db($bd,DB_NAME) or die("Could not select database");

 ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>:: 동아리 목록 ::</title>

    <!-- Bootstrap -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../css/club_list.css" rel="stylesheet">

    <script type="text/javascript">
    function help(){
        window.open("help.php","도움말", "left=200, top=200, width=350, height=420 , scrollbars=no, resizable=yes");
      }
    </script>

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
        <li>
          <?php
            if($_SESSION['USER_NAME'])
              echo '<a href="mypage.php">My Page</a>';
            else
              echo '<a href="signup.php">Sign Up</a>';

          ?>
        </li>
        <li><a href="#" onclick="help()">Help</a></li>
      </ul>
    </div>
  </div>
</nav>
   <!-- Menubar end-->  


  <!-- Logo Start -->
  <div class="container" class = "col-lg-12 col-xs-12">
      <div id="header" class = "col-xs-8 col-xs-offset-1 col-lg-4 col-lg-offset-4 col-md-4 col-md-offset-4">
          <a href="firstpage.php" class="h_logo">
          <img src="../img/title.png" class = "h_logo">
        </a>
      </div>
  </div>
  <!-- Logo End -->


   <!-- Club Search Bar-->
<div class="row" class = "col-lg-12 col-xs-12 col-md-12">
  <div class="col-lg-1 col-xs-1 col-md-1"></div>
  <div class="col-xs-10 col-md-10 searchbox">
    <form action='clublist.php' method='GET' class = "menu-list">
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
  <div class="col-lg-1 col-xs-1 col-md-1"></div>
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
  $result=mysqli_query($bd,$sql);

$i=0;
$j=0;
$clubname[$i] = "dd";
?>

 <div class="container col-xs-12 col-md-12 col-lg-12">
  <div class="row">
   <div class="col-lg-1 col-xs-1 col-md-1"></div>
   <div class="col-lg-10 col-xs-10 col-md-10">
    <form action="clubpage.php" method="GET">
      <?php
      while($clubname[$i] != NULL){
        for($j=0 ; $j<3 ; $j++){
          $clubname = mysqli_fetch_array($result);
          if($clubname[$i] == NULL){
            break;
          }
          echo " <div class='col-lg-3 col-xs-4 col-md-4'>";
          echo "<input class = 'club-element' type = 'submit' value ='$clubname[$i]' name = 'name'>";
          echo "</div>";
          } 
      }
      ?>
      <div class="col-lg-1 col-xs-1 col-md-1"></div>
    </form>
   </div>
   <div class="col-lg-1 col-xs-1 col-md-1"></div>
  </div>
</div>

  
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap.min.js"></script>
  </body>
</html>