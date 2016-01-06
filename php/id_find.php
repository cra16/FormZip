<?php
  // Session start 
  session_start();

  // DB connection
  require_once('DB_INFO.php');
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=1280">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title> iBELONG :: ID 찾기</title>

    <!-- Bootstrap -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../css/id_find.css" rel="stylesheet">
    <link rel="shortcut icon" href="../img/logo.png" />
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
      <a class="navbar-brand" href="firstpage.php">iBELONG</a>
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
        <li><a href="signup.php">Signup</a></li>
        <li><a href="#">Help</a></li>
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
      </a>
    </div>
  </div>
  <!-- Logo End -->


 <div class="col-xs-12 col-sm-6 col-sm-offset-3 col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4">
    <form method="POST" action="id_find.php" class="form-horizontal"> 
      <div class="form-group">  
        <div id="title"> <h2> 아이디 찾기 </h2> </div>
          <div class="form-group">
            <label class="col-xs-2 col-sm-2 col-md-2 col-lg-2"> 이름</label>
            <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
            <input class="form-control" name="name" type="text" placeholder="Name" maxlength="15">
            </div>
          </div>

           <div class="form-group">
            <label class="col-xs-2 col-sm-2 col-md-2 col-lg-2"> 학번</label>
            <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
            <input class="form-control" name="stuid" type="text" placeholder="Stuid ex)21200000" maxlength="8">
            </div>
          </div>

          <div class="form-group">
            <label class="col-xs-2 col-sm-2 col-md-2 col-lg-2"> 생년월일</label>
            <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
            <input class="form-control" name="birth" type="text" placeholder="6자리 입력 ex)930102" maxlength="6">
            </div>
          </div>        
      </div>  

      <div class="submit_content">
        <button type="submit" value="id_find" name="id_find" onclick="myFunction()">확인</button>
      </div>
    </form>
  </div>
</div>





    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>



<?php
$name= $_POST['name'];
$stuid=$_POST['stuid'];
$birth=$_POST['birth'];
$qry="SELECT * FROM student WHERE student_name='$name'";
$result=mysqli_query($link,$qry);

//student table이 존재하고 POST값이 != NULL(값이 입력 받을때)
if($result && $name!="") {
  if(mysqli_num_rows($result) > 0) {
    $member = mysqli_fetch_assoc($result);

// DB에 입력한 값이 존재하면 display
    if($member['stuid']==$stuid && $member['birth']==$birth){
      echo "<script>alert('아이디: ".$member['id']."')</script>"; 
    }
  }
}
?>
</body>
</html>