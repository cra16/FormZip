<?php
  // Session start 
  session_start();

  // DB connection
  require_once('../php-config/DB_INFO.php');
?>


<!DOCTYPE HTML> 
<html>

   <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=1280">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>iBELONG :: 정보 수정</title>

    <!-- Bootstrap -->
    <link href="../css/mypage.css?version=212" rel="stylesheet">
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <script type="text/javascript">
    function help(){
        window.open("help.php","도움말", "left=200, top=200, width=520, height=620 , location=no, scrollbars=no, resizable=yes");
    }
    </script>

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
      <a class="navbar-brand" href="firstpage.php">iBELONG</a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
     
      <ul class="nav navbar-nav navbar-right">
        <li>
          <?php
            if($_SESSION['USER_NAME'])
              echo '<a href="../php-config/logout.php">Logout</a>';
            else
              echo '<a href="../php-config/login.php">Login</a>';
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
              echo '<a href="firstpage.php">Sign Up</a>';
          ?>
        </li>
        <li><a href="#" onclick = "help()">Help</a></li>
      </ul>
    </div>
  </div>
</nav>

  <div class="formContentsLayout">
 
    
 <!-- 로그인 여부 판단 -->
 <?php
  $id = $_SESSION['USER_NAME'];
   if(!$id){
     header("location: ../php-views/firstpage.php");
     exit();
   }
  $qry="SELECT * FROM student WHERE id='$id'";   
  $result=mysqli_query($link,$qry);
  $list = mysqli_fetch_array($result);
 
 ?> 


    <!-- 기본정보 Start -->
   <div class = "title-name">   
    <h4> 기본 정보</h4>
   </div>

   <?php 

   function encrypt_decrypt($action, $string) {
        $output = false;
        $encrypt_method = "AES-256-CBC";
        $secret_key = KEY;
        $secret_iv = KEY;
        // hash
        $key = hash('sha256', $secret_key);

        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hash('sha256', $secret_iv), 0, 16);

        if ( $action == 'encrypt' ) {
          $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
          $output = base64_encode($output);
        } else if( $action == 'decrypt' ) {
          $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        }
        return $output;
    }

      $password = mysqli_real_escape_string($link,$list['password']);

      $decoding = encrypt_decrypt("decrypt",$password); 

     $check_result = $_POST['check'];
     if($check_result == 'true'){
      echo "<script>alert(\"비밀번호가 정상적으로 수정되었습니다.\");</script>";
     }
     else if($check_result == 'false'){
      echo "<script>alert(\"비밀번호를 정확하게 입력해주세요.\");</script>";
     }
   ?>
   <form action="../php-config/pw_change.php" method="POST" onsubmit="return validateForm()" class="form-horizontal">
    <input type="hidden" id="now" name = "now" value ="<?php echo $decoding; ?>" >
      <div class="form-group">
        <label  class="col-xs-4 col-md-12 control-label">기존 비밀번호</label>
        <div class="col-md-offset-2 col-xs-8 col-md-6">
        <input type="password" class="form-control" id="current" name="current" maxlength="20">
        <div id="pw_cur" class="error" style="display:none"></div>
        </div>
      </div>     
     
      <div class="form-group">
        <label  class="col-xs-4 col-md-12 control-label">새 비밀번호</label>
        <div class="col-md-offset-2 col-xs-8 col-md-6">
        <input type="password" class="form-control" id="newp" name="newp" onkeyup="PwCheck()" maxlength="20">
        <div id="pw_new" class="error" style="display:none"></div>
        </div>
      </div>        

      <div class="form-group">
        <label  class="col-xs-4 col-md-12 control-label">비밀번호 재입력</label>
        <div class="col-md-offset-2 col-xs-8 col-md-6">
        <input type="password" class="form-control" id="pw" name="pw" onkeyup="PwCheck()" maxlength="20">
        <div id="ps_ck" class="error" style="display:none"></div>
        </div>
      </div>             
   

     <div class = "submit">
        <input type = "submit" value = "저장" class = "submit_content">
     </div>
   </form>    
</div>   
<!-- 기본 정보 End -->




 <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/mypage.js"></script>
</body>
</html>