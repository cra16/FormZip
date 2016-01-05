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
    <meta name="viewport" content="width=1280">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>:: 동아리 목록 ::</title>

    <!-- Bootstrap -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../css/club_list.css" rel="stylesheet">

    <script type="text/javascript">
      function help(){
        window.open("help.php","도움말", "left=200, top=200, width=520, height=620 , location=no, scrollbars=no, resizable=yes");
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
        <a class="navbar-brand" href="firstpage.php">iBELONG</a>
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
              //로그인 여부 확인
             if($_SESSION['USER_NAME']){
              $id = $_SESSION['USER_NAME'];
              $sql = "SELECT * FROM student WHERE id = '$id'";
              $check_result = mysqli_query($bd,$sql);
              $check = mysqli_fetch_array($check_result);
              $index = $check['index'];
              $cname = $check['c_name'];
              //관리자 여부 확인
                if($index == 0){
                  echo '<a href="mypage.php">My Page</a>';
                 
                }
                else if($index ==1){
                  echo '<a href="clubpage.php?name='.$cname.'">Club Page</a>'; 
                }
                else{
                  echo '<a href="academypage.php?name='.$cname.'">Academy Page</a>';   
                }
              }
              else
                echo '<a href="agreement.php">Sign Up</a>';
            ?>
          </li>
          <li><a href="#" onclick="help()">Help</a></li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- Menubar end-->  

  <!-- Logo Start -->
  <div class="col-xs-8 col-xs-offset-2 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4">
    <div class ="wrapper">
      <a href="firstpage.php">
      <img src="../img/logo_mint.png" width="100%" height="50%">
    </div>
  </div>
  <!-- Logo End -->


  <!-- Club Search Bar Start -->
  <div class="container col-xs-12 col-md-12 col-lg-12 col-sm-12">
    <div class="row">
      <div class="col-lg-1 col-xs-1 col-md-1 col-sm-1"></div>
      
      <div class="col-lg-10 col-xs-10 col-md-10 col-sm-10">
        <div class="col-lg-6 col-xs-12 col-md-6 col-sm-6 btn-group">
        <a href="clublist.php" class="Search_Bar btn btn-default col-lg-11 col-xs-11 col-md-11 col-sm-11">C l u b</a>
        <a href="#" class="Search_Bar btn btn-default dropdown-toggle col-lg-1 col-xs-1 col-md-1 col-sm-1" data-toggle="dropdown"><span class="caret"></span></a>
        <ul class="dropdown-menu">
          <form action='clublist.php' method='GET' class = "menu-list">
            <input type = 'submit' class="searchbutton" name ='whole' value ='전체' >
            <input type = 'submit' class="searchbutton" name = 'perform' value ='공연/음악' >
            <input type = 'submit' class="searchbutton" name = 'sport' value ='스포츠'>
            <input type = 'submit' class="searchbutton" name = 'academic' value ='학술' >
            <input type = 'submit' class="searchbutton" name = 'computer' value ='전산' >
            <input type = 'submit' class="searchbutton" name = 'religion' value ='종교' >
            <input type = 'submit' class="searchbutton" name = 'volunteer' value ='봉사' >
            <input type = 'submit' class="searchbutton" name = 'display' value ='전시' >
          </form>
        </ul>
        </div>

        <div class="col-lg-6 col-xs-12 col-md-6 col-sm-6 btn-group ">
        <a href="academylist.php" class="Search_Bar col-lg-12 col-xs-12 col-md-12 col-sm-12 btn btn btn-default">Academy</a>
        </div>
      </div>

      <div class="col-lg-1 col-xs-1 col-md-1"></div>
    </div>
  </div>
   <!-- Club Search Bar End-->
 
  <!-- Club Icon Start -->
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
      $sql="SELECT c_name,img_name FROM club WHERE field='$condition'";  
    }else{
      $sql = "SELECT c_name,img_name FROM club";
    } 
      $result=mysqli_query($bd,$sql);

    $i=0;
    $j=0;
    $clubname[$i] = "initialization";
 
  ?>

  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div class="row">
     <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1"></div>
     <div class="col-lg-10 col-xs-10 col-md-10 col-sm-10">
      <form action="clubpage.php" method="GET">
        <?php
        while($clubname[$i] != NULL){
          for($j=0 ; $j<4 ; $j++){
            $clubname = mysqli_fetch_array($result);
            if($clubname[$i] == NULL){
              break;
            }
            
            ?>
            <div class='col-lg-3 col-xs-12 col-md-4 col-sm-6'>
            <img class="group_img" src = "../clubimg/<?php echo $clubname['img_name'] ?>">

            
            <input class = 'group_name' type = 'submit' value = <?php echo $clubname[$i] ?> name = 'name'>
            </div>
        <?php
          } 
        }
        ?>
      </form>
     </div>
     <div class="col-lg-1 col-xs-1 col-sm-1 col-md-1"></div>
    </div>
  </div>
  <!-- Club Icon End -->

  
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js"></script>
  </body>
</html>