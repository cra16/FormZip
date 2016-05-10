<?php
// 파일명: firstpage.php
// 설명: 첫, 로그인 페이지
//Start the session
session_start();
unset($_SESSION['USER_NAME']);

// DB connection
  require_once('../php-config/DB_INFO.php');

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>iBELONG :: HOME</title>

    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../css/firstpage.css" rel="stylesheet">

  </head>
  <body>
    <header class = "header">
      <h1>iBELONG</h1>
      <h2>Club &#38; Academy application </h2>
      <!-- Large modal -->
      <div class= "col-xs-12 col-sm-4 col-sm-offset-4 col-md-2 col-md-offset-5 col-lg-2 col-lg-offset-5">
      <button type="button" class="btn btn-primary join_content" data-toggle="modal" data-target=".bs-example-modal-lg">Join us</button>
      </div>
      <!-- Modal popup -->
      <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <!-- Log in Form -->
          <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 loginbox">
            <form name="loginform" action="../php-exec/login_exec.php" method="POST">
              <h3>LOG IN</h3>
              <div class="form-group">
              <input class="form-control" id="his_id" name="his_id" type="text" placeholder="Hisnet ID" maxlength="20">
              </div>
              <div class="form-group">
              <input class="form-control" id="his_pw" name="his_pw" type="password" placeholder="Hisnet Password" maxlength="15">
              </div>
              <!-- Log in Button -->
              <div class="form-group">
              <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3">
              <button type="submit" class="btn btn-primary submit_content">Log in</button>
              </div>
              </div>
            </form>
          </div>
          </div>
        </div>
        </div>
      </div>
    </header>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js"></script>
  </body>
</html>