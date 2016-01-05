
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

 
<div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4 col-lg-4 col-lg-offset-4">
  <form name="loginform" action="tem_login_exec.php" method="POST">
    <div class="form-group">
     
     <input class="form-control" id="his_id" name="his_id" type="text" placeholder="UserId" maxlength="20">
    </div>
    <div class="form-group">
      <input class="form-control" id="his_pw" name="his_pw" type="password" placeholder="Password" maxlength="15">
    </div>
  
  
    <div class="submit_content">
      <button type="submit">Log in</button>
    </div>
  </form>
</div>


 
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js"></script>
  </body>
</html>
