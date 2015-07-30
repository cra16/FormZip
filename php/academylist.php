<?php
session_start();
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
    <title>Academy List</title>

    <!-- Bootstrap -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../css/club_list.css" rel="stylesheet">

    <script type="text/javascript">
    function help(){
        window.open("help.php","도움말", "left=200, top=200, width=250, height=100 , scrollbars=no, resizable=yes");
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
            //로그인 여부 확인
           if($_SESSION['USER_NAME']){
            $id = $_SESSION['USER_NAME'];
            $sql = "SELECT * FROM student WHERE id = '$id'";
            $check_result = mysqli_query($bd,$sql);
            $check = mysqli_fetch_array($check_result);
            $cname = $check['c_name'];
            //관리자 여부 확인
              if($cname != NULL){
               echo '<a href="clubpage.php">Club Page</a>';  
              }
              else{
               echo '<a href="mypage.php">My Page</a>';
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
  <div class="container" class = "col-lg-4 col-xs-4">
       <div class="col-lg-4 col-xs-4 col-md-4"></div>
      <div id="header" class = "col-xs-4 col-lg-4">
          <a href="firstpage.php" class="h_logo">
          <img src="../img/title.png" class = "h_logo">
        </a>
      </div>
      <div class="col-lg-4 col-xs-4 col-md-4"></div>
  </div>
  <!-- Logo End -->

   <!-- Club Search Bar-->
   <div class="row">
    <div class="col-xs-1 col-md-1"></div>
     <div class="col-xs-10 col-md-10 searchbox">
      <form action='academylist.php' method='GET' class = "menu-list">
        <input type = 'submit' class = "searchbutton" name ='whole' value ='전체' >
        <img src="../img/bar.png">
        <input type = 'submit' class = "searchbutton" name ='GLS' value ='글로벌리더쉽' >
        <img src="../img/bar.png">
        <input type = 'submit' class = "searchbutton" name ='international' value ='국제어문' >
        <img src="../img/bar.png">
        <input type = 'submit' class = "searchbutton" name = 'management' value ='경영경제' >
        <img src="../img/bar.png">
        <input type = 'submit' class = "searchbutton" name = 'law' value ='법' >
        <img src="../img/bar.png">
        <input type = 'submit' class = "searchbutton" name = 'communication_study' value ='언론정보'>
        <img src="../img/bar.png">
        <input type = 'submit' class = "searchbutton" name = 'partial_environment' value ='상담복지' >
        <img src="../img/bar.png">
        <input type = 'submit' class = "searchbutton" name = 'life_sci' value ='생명과학' >
        <img src="../img/bar.png">
        <input type = 'submit' class = "searchbutton" name = 'im_design' value ='공간시스템' >
        <img src="../img/bar.png">
        <input type = 'submit' class = "searchbutton" name = 'computer_science' value ='전산전자' >
        <img src="../img/bar.png">
        <input type = 'submit' class = "searchbutton" name ='industrial_edu' value ='산업디자인' >
        <img src="../img/bar.png">
        <input type = 'submit' class = "searchbutton" name ='GEA' value ='글로벌에디슨아카데미' >
        <img src="../img/bar.png">
        <input type = 'submit' class = "searchbutton" name ='ICT' value ='창의융합교육원' >
    </form>
     </div>
   <div class="col-xs-1 col-md-1"></div>
   </div> 

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
  $sql="SELECT a_name FROM academy WHERE dept='$condition'";  
}else{
  $sql = "SELECT a_name FROM academy";
} 
$result=mysqli_query($bd,$sql);

$i=0;
$j=0;
$academy[$i] = "dd";
?>

<div class="container">
  <div class="row">
    <form action="academypage.php" method="GET"  >
<?php
while($academy[$i] != NULL){
   for($j=0 ; $j<4 ; $j++){
    $academy = mysqli_fetch_array($result);
    if($academy[$i] == NULL){
      break;
    }
    echo " <div class='col-xs-6 col-md-3' >";
    echo "<input class = 'club-element' type = 'submit' value ='$academy[$i]' name='name'>";
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