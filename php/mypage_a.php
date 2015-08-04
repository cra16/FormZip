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


<!DOCTYPE HTML> 
<html>

   <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>:: 마이 페이지 ::</title>

    <!-- Bootstrap -->
    <link href="../css/mypage.css" rel="stylesheet">
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../css/bootstrap.min.css" rel="stylesheet">

   

  </head>

<body> 
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
        <li><a href="#" onclick = "help()">Help</a></li>
      </ul>
    </div>
  </div>
</nav>

  <!-- Logo Start -->
  <div class="container">
    <div id="header-logo">
        <a href="firstpage.php" class="h_logo">
        <img src="../img/title.png" class = "h_logo">
      </a>
    </div>
  </div>
  <!-- Logo End -->
 
  <div class="formContentsLayout">
 
    
 <!-- 로그인 여부 판단 -->
 <?php
  $id = $_SESSION['USER_NAME'];
   if(!$id){
     header("location: login.php");
     exit();
    }
  $qry="SELECT * FROM student WHERE id='$id'";   
  $result=mysqli_query($bd,$qry);
  $list = mysqli_fetch_array($result);
 
 ?> 


    <!-- 기본정보 Start -->
   <div class = "titl-a">
    <h4> 기본 정보</h4>
   </div>

   <?php 
    //비밀번호 체크
    $key = KEY;
      $s_vector_iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_3DES, MCRYPT_MODE_ECB), MCRYPT_RAND);

      $password = mysqli_real_escape_string($bd,$list['password']);

      ### 복호화 ####
      $de_str = pack("H*", $password); //hex로 변환한 ascii를 binary로 변환
      $decoding = mcrypt_decrypt(MCRYPT_3DES, $key, $de_str, MCRYPT_MODE_ECB, $s_vector_iv); 
   
     $check_result = $_POST['check'];
   if($check_result == 'true'){
     echo "<script>alert(\"비밀번호가 정상적으로 수정되었습니다.\");</script>";
  }
   else if($check_result == 'false'){
     echo "<script>alert(\"비밀번호를 정확하게 입력해주세요.\");</script>";
   }
   ?>




   <form action="pw_change.php" method="POST" onsubmit="return validateForm()" class="form-horizontal">
    <input type="hidden" id="now" name = "now" value ="<?php echo $decoding; ?>" >
      <div class="form-group">
        <label  class="col-xs-4 col-md-4 control-label">기존 비밀번호</label>
        <div class="col-xs-8 col-md-6">
        <input type="password" class="form-control" id="current" name="current" maxlength="20">
        <div id="pw_cur" class="error" style="display:none"></div>
        </div>
      </div>     
     
      <div class="form-group">
        <label  class="col-xs-4 col-md-4 control-label">새 비밀번호</label>
        <div class="col-xs-8 col-md-6">
        <input type="password" class="form-control" id="newp" name="newp" onkeyup="PwCheck()" maxlength="20">
        <div id="pw_new" class="error" style="display:none"></div>
        </div>
      </div>        

      <div class="form-group">
        <label  class="col-xs-4 col-md-4 control-label">비밀번호 재입력</label>
        <div class="col-xs-8 col-md-6">
        <input type="password" class="form-control" id="pw" name="pw" onkeyup="PwCheck()" maxlength="20">
        <div id="ps_ck" class="error" style="display:none"></div>
        </div>
      </div>             
   

     <div class = "submit">
        <input type = "submit" value = "저장" class = "save">
     </div>
   </form>    

<!-- 기본 정보 End -->




 <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/mypage.js"></script>
</body>
</html>