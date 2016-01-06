<?php
session_start();
require_once('DB_INFO.php');
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=1280">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>iBELONG :: 학회</title>

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
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" 
        data-target="#bs-example-navbar-collapse-1">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="firstpage.php">IBELONG</a>
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
              $check_result = mysqli_query($link,$sql);
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
          <li><a href="#" onclick = "help()">Help</a></li>
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

  <!-- Club Search Bar Start-->
  <div class="container col-xs-12 col-md-12 col-lg-12 col-sm-12">
    <div class="row">
      <div class="col-lg-1 col-xs-1 col-md-1 col-sm-1"></div>
      
      <div class="col-lg-10 col-xs-10 col-md-10 col-sm-10">
        <div class="col-lg-6 col-xs-12 col-md-6 col-sm-6 btn-group ">
        <a href="clublist.php" class="Search_Bar col-lg-12 col-xs-12 col-md-12 col-sm-12 btn btn btn-default">Club</a>
        </div>

        <div class="col-lg-6 col-xs-12 col-md-6 col-sm-6 btn-group">
        <a href="academylist.php" class="Search_Bar btn btn-default col-lg-11 col-xs-11 col-md-11 col-sm-11">Academy</a>
        <a href="#" class="btn btn-default Search_Bar dropdown-toggle col-lg-1 col-xs-1 col-md-1 col-sm-1" data-toggle="dropdown"><span class="caret"></span></a>
        <ul class="dropdown-menu">
          <form action='academylist.php' method='GET' class = "menu-list">
            <input type = 'submit' class = "searchbutton" name ='whole' value ='전체' >
            <input type = 'submit' class = "searchbutton" name ='GLS' value ='글로벌리더쉽' >
            <input type = 'submit' class = "searchbutton" name ='international' value ='국제어문' >
            <input type = 'submit' class = "searchbutton" name = 'management' value ='경영경제' >
            <input type = 'submit' class = "searchbutton" name = 'law' value ='법' >
            <input type = 'submit' class = "searchbutton" name = 'communication_study' value ='언론정보'>
            <input type = 'submit' class = "searchbutton" name = 'partial_environment' value ='상담복지' >
            <input type = 'submit' class = "searchbutton" name = 'life_sci' value ='생명과학' >
            <input type = 'submit' class = "searchbutton" name = 'im_design' value ='공간시스템' >
            <input type = 'submit' class = "searchbutton" name = 'computer_science' value ='전산전자' >
            <input type = 'submit' class = "searchbutton" name ='industrial_edu' value ='산업디자인' >
            <input type = 'submit' class = "searchbutton" name ='GEA' value ='GEA' >
            <input type = 'submit' class = "searchbutton" name ='ICT' value ='창의융합교육원' >
          </form>
        </ul>
        </div>    
      </div>

      <div class="col-lg-1 col-xs-1 col-md-1"></div>
    </div>
  </div>
  <!-- Club Search Bar End-->


  <!-- Academy Icon Start -->
  <?php
    $name_arr=array("whole","GLS","international","management","law","communication_study","partial_environment","life_sci","im_design","computer_science","industrial_edu","GEA","ICT");

    for($i=0; $i<13;$i++){
      if($_GET[$name_arr[$i]]){
      $condition = $_GET[$name_arr[$i]];
        break;
      }
    }

    if($condition == NULL){
      $condition = "전체";
    }

    if($condition != "전체" ){
      $sql="SELECT a_name,img_name FROM academy WHERE dept='$condition'";  
    }else{
      $sql = "SELECT a_name,img_name FROM academy";
    } 
    $result=mysqli_query($link,$sql);

    $i=0;
    $j=0;
    $academy[$i] = "initialization";
  ?>

  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div class="row">
     <div class="col-lg-1 col-xs-1 col-md-1 col-sm-1"></div>
     <div class="col-lg-10 col-xs-10 col-md-10 col-sm-10">
      <form action="academypage.php" method="GET">
        <?php
        while($academy[$i] != NULL){
          for($j=0 ; $j<4 ; $j++){
            $academy = mysqli_fetch_array($result);
            if($academy[$i] == NULL){
              break;
            }
            echo " <div class='col-lg-3 col-xs-12 col-md-4 col-sm-6'>";
            ?>
            <img class="group_img" src = "../clubimg/<?php echo $academy['img_name'] ?>">

            <?php
            echo "<input class = 'group_name' type = 'submit' value ='$academy[$i]' name = 'name'>";
            echo "</div>";
          } 
        }
        ?>
      </form>
     </div>
     <div class="col-lg-1 col-xs-1 col-md-1"></div>
    </div>
  </div>

  <!-- Academy Icon End -->



  
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js"></script>
  </body>
</html>