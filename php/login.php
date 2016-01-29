
<?php
  //Start session
  session_start();  
  //Unset the variables stored in session
  unset($_SESSION['USER_NAME']);
  unset($_SESSION['USER_PASSWORD']);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=1280">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>iBELONG :: Login</title>

    <!-- Bootstrap -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../css/loginpage.css" rel="stylesheet">
    

  </head>
  <body>

  <!-- Logo Start -->
  <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4">
    <div class ="wrapper">
      <a href="firstpage.php">
      <img src="../img/logo_mint.png" width="100%" height="50%">
      </a>
    </div>
  </div>
  <!-- Logo End -->
 
  <div class="col-xs-8 col-xs-offset-2 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4">
    <h2>LOG INTO IBELONG</h2>
  </div>
 
  <!-- Login Start -->
  <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3 loginbox">
    <form name="loginform" action="login_exec.php" method="POST">
      <div class="form-group">
        <h2>로그인</h2>
        <h4>Apply &amp; Recruit!</h4>
       <input class="form-control" id="his_id" name="his_id" type="text" placeholder="UserId" maxlength="20">
      </div>
      <div class="form-group">
        <input class="form-control" id="his_pw" name="his_pw" type="password" placeholder="Password" maxlength="15">
      </div>
      <!-- Help Button -->
      <div class="col-xs-11 col-xs-offset-1 col-sm-9 col-sm-offset-3 col-md-6 col-md-offset-6 col-lg-5 col-lg-offset-7">
        <button type="button" class="btn btn-default help_content" data-toggle="modal" data-target=".bs-example-modal-lg">For club or academy manager</button>
      </div>
      <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
       
        <h5 class = "explanation">동아리/학회 페이지 등록 방법:</h5>
         <ol>
        <li> 아래 사항들을 정확히 기재하여 ibelong2hgu@gmail.com 으로 메일을 보낸다.
          <br>1) 동아리/학회 이름
          <br>2) 희망하는 아이디
          <br>3) 희망하는 비밀번호
        </li> 
        <li> iBELONG의 Confirm을 받는다.</li>
        <li> 로그인 후 해당 페이지에 접속해 페이지를 수정(소개글 및 사진)한다.
        </li> 
        <li> 해당 페이지에서 '지원서 양식 수정'을 통해 지원서를 만든다.
        </li>
         </ol>
         <br>
         <h4 class = "title"> Contact us!</h4>
         <ul>
        <li>email: ibelong2hgu@gmail.com
        <li>cell-phone:
        <br> 010-5103-2361/
        <br> 010-4952-0181/
        <br> 010-4857-2886  
         </ul>
          </div>
        </div>
      </div>

      <div class="form-group">
        <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3">
          <button type="submit" class="btn btn-primary submit_content">Log in</button>
        </div>
      </div>
    </form>
  </div>

  <!-- Login End -->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js"></script>
  </body>
</html>
