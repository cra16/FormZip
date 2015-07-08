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
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Loginpage</title>

    <!-- Bootstrap -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../css/loginpage.css" rel="stylesheet">

  </head>
  <body>
  <div class="container">
    <div id="header">
      <h1>  <a href="firstpage.html" class="h_logo">F O R M &nbsp;&nbsp;Z I P</a> </h1>
    </div>

    <img src="../img/keyboard.jpg">
    <div class="loginbox">
      <form name="loginform" action="login_exec.php" method="POST">
       <div class="form-group">
          <h2>Apply &amp; Recruit by FormZip</h2>
            <input class="form-control" id="username" name="username" type="text" placeholder="UserId" maxlength="20">
                  
            <div id="form-margin"></div>
                  
            <input class="form-control" id="password" name="password" type="password" placeholder="Password" maxlength="15">
                  
            <div id="form-margin"></div>
        </div> 
        <?php
          if( isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) >0 ) {
           echo '<ul class="err">';
           foreach($_SESSION['ERRMSG_ARR'] as $msg) {
              echo '<li>',$msg,'</li>'; 
          }
          echo '</ul>';
          unset($_SESSION['ERRMSG_ARR']);
          }
        ?>
        
        <div class="submit_content">
          <button type="submit">Log in</button>
        </div>
      </form>
    </div>

  </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
