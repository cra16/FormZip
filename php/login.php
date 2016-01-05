
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
  <div class="col-xs-8 col-xs-offset-2 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4">
    <div class ="wrapper">
      <a href="firstpage.php">
      <img src="../img/logo_mint.png" width="100%" height="50%">
      </a>
    </div>
  </div>
  <!-- Logo End -->

  <!-- Login Start -->
  <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4">
    <form name="loginform" action="login_exec.php" method="POST">
      <div class="form-group">
        <h2>로그인</h2>
        <h4>Apply &amp; Recruit!</h4>
       <input class="form-control" id="username" name="username" type="text" placeholder="UserId" maxlength="20">
      </div>
      <div class="form-group">
        <input class="form-control" id="password" name="password" type="password" placeholder="Password" maxlength="15">
      </div>
    
      <div class="row extra">
        <div class="col-xs-4 col-sm-4"> 
          <a href="agreement.php">회원가입</a> 
        </div>
        
        <div class="col-xs-4 col-sm-4">            
          <a href="id_find.php">아이디 찾기</a>
        </div>
       
        <div class="col-xs-4 col-sm-4">  
          <a href="pw_find.php">비밀번호 찾기 </a>
        </div>
      </div>

      <div class="submit_content">
        <button type="submit">Log in</button>
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
