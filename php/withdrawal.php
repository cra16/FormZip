<?php
  // Session start 
  session_start();
  //로그인 여부 판단
  $username = $_SESSION['USER_NAME'];
  if(!$username){
    header("location: firstpage.php");
    exit();
  }
  // DB connection
  require_once('DB_INFO.php');
  header('Content-Type: text/html; charset=utf-8');

  mysqli_query("set session character_set_connection=utf8;");
  mysqli_query("set session character_set_results=utf8;");
  mysqli_query("set session character_set_client=utf8;");

  $bd=mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD) or die("Could not connect database");
  mysqli_set_charset($bd, "utf8");

  mysqli_select_db($bd,DB_NAME) or die("Could not select database");
   $check_result = $_POST['check'];
 
   if($check_result == 'false'){
     echo "<script>alert(\"비밀번호를 정확하게 입력해주세요.\");</script>";
   }
 ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=1280">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>:: form:zip ::</title>

    <!-- Bootstrap -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../css/withdrawal.css" rel="stylesheet">

    <script type="text/javascript">
      function help(){
        window.open("help.php","도움말", "left=200, top=200, width=520, height=620 , location=no, scrollbars=no, resizable=yes");
      }

      function IsValid(){
        if(!$('input:checkbox[name=check]').is(':checked')){
          alert("no!!");
          return false;
        }
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
<div class="container" class = "col-md-4 col-xs-4">
  <div class="col-md-4 col-xs-4 col-md-4"></div>
    <div id="header" class = "col-xs-4 col-md-4">
      <a href="firstpage.php" class="h_logo">
          <img src="../img/title.png" class = "h_logo">
        </a>
    </div>
  <div class="col-md-4 col-xs-4 col-md-4"></div>
</div>
  <!-- Logo End -->

  <!-- withdrawal start -->
<div class="formContentsLayout">
  
  <h3 class="application"> 탈퇴 안내 </h3>
  <br>
  <p>1.탈퇴 후 회원정보 및 서비스 이용기록은 삭제됩니다.</p>
  <p>&nbsp;&nbsp;회원정보 및 임시저장한 지원서는 모두 삭제되며 삭제된 데이터는 복구되지 않습니다.</p>
  <p>&nbsp;&nbsp;삭제되는 내용을 확인하시고 필요한 정보는 미리 옮겨주세요.</p>
  <p>2.탈퇴 후에도 지원서의 정보는 해당 단체에서 보유할 수 있습니다.</p>
  <p>&nbsp;&nbsp;본인이 작성한 지원서를 제출 할 경우 해당 지원서는 각 단체(동아리 또는 학회를 뜻함)장이</p>
  <p>&nbsp;&nbsp; 열람 또는 보유 할 수 있습니다.</p>
  <p>&nbsp;&nbsp;제출한 지원서의 삭제를 원하시면 각 단체장에게 따로 연락을 해 주시기 바랍니다.</p>
  <br>
  <form method="POST" onsubmit="return IsValid()" action="withdrawal_exec.php"> 
    <div class="form-group">
      <div class="checkbox">
        <label> <input type="checkbox" name="check">안내 사항을 모두 확인하였으며, 이에 동의합니다. </label>
      </div>
    </div>
    <div class="form-group">  
      <label class="col-md-offset-1 col-md-3 control-label">비밀번호 입력</label>
      <div class="col-md-8">
        <input type="password" class="form-control short-length"  placeholder="Please enter your Password" name="pw" maxlength="20">
      </div>
    </div>   
    <div class="form-group">
      <div class = "col-md-4 col-md-offset-4">  
        <button type="submit" name="name" id = 'temp' value="sb" class="submit_content">확인</button>     
      </div> 
    </div> 
  </form>
  <br><br>
</div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js"></script>
  </body>
</html>