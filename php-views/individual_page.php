<?php 
// 파일명: individual_page.php
// 설명: 각 동아리 페이지
  // Session start 
  session_start();
  include('../php-config/individual_config.php');
  $individual_page = new IndividualConfig();
  $individual_page->validation($_GET['name'],$_SESSION['GROUP']);
  $member = $individual_page->Config($_GET['name'],$_GET['mode']);
  $exist = $individual_page->ApplicationInfo($_GET['name']);
?>

<!DOCTYPE html>
<html ng-app ="grouplist">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>:: clubpage ::</title>
    <!-- CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/bootstrap.css" rel="stylesheet">
    <!-- <link href="../css/club_list.css" rel="stylesheet"> -->
    <link href="../css/individual_page.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.0.8/angular.min.js"></script>
  </head>

  <body>
    <!-- Navigation -->
    <nav class="navbar navbar-default">
      <div class="container-fluid">
      <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
            <a class="navbar-brand" href="clublist.php" id = "home_button">iBELONG</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="../php-config/logout.php">Logout</a></li>
            <li><a href="#" onclick="help()">Help</a></li>
          </ul>
        </div>
      </div>
    </nav>  
    <!-- Navigation end-->  

    <h1><a href="clublist.php">iBELONG</a></h1>
    <h2>Club &#38; Academy application </h2>
    <!-- Page Content -->
    <div class="container">
      <div class="row">
        <!-- blog Entries Column -->
        <div class="well" id="welltext">
        <?php 
          if($_GET['mode'] == 1){
            echo $member['c_name'].'-'.$member['field'];
            $groupName = $member['c_name'];
          }
          else{
            echo $member['a_name'].'-'.$member['title'];
            $groupName= $member['a_name'];
          }
        ?>
        </div>

        <img  src = "../clubimg/<?php echo $member['img_name']; ?>" class="img-responsive img-thumbnail" alt="Responsive image">

        <div class="col-md-8 col-md-offset-2">
        <p><?php echo $member['text']; ?> </p>
        <?php   
          if($exist){
            $due = $individual_page->ApplicationDue($_GET['name']);
        ?>
            <form action="app_submit.php" method="GET">
            <button type="submit" class="btn btn-primary submit_button" name="name" value="<?php echo $groupName; ?>">지원하기</button>
            </form>
        <p>지원기간 : <?php
        echo $due['s_month'].월. $due['s_day'].일부터.$due['month'].월.$due['day'].까지; 
        } ?> </p>

        </div>
      </div>
    </div>

    <script src="../js/data.js"></script>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js"></script>
  </body>
</html>