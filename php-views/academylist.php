<?php
// 파일명: academylist.php
// 설명: 일반 user가 로그인을 하고 학회버튼을 누를경우 학회 정보 display
  // Session start 
  session_start();
  // Incorrect access
  if(!$_SESSION['USER_NAME']){
  header("Location:firstpage.php");      
  }
?>

<!DOCTYPE html>
<html ng-app ="grouplist">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>:: 학회 목록 ::</title>
    <!-- CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../css/club_list.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.0.8/angular.min.js"></script>
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
            <a class="navbar-brand" href="clublist.php" id = "home_button">iBELONG</a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="../php-config/logout.php">Logout</a></li>
            <li><a href="#" onclick="help()">Help</a></li>
          </ul>
        </div>
      </div>
    </nav>  
    <!-- Menubar end-->  

    <h1><a href="clublist.php">iBELONG</a></H1>

    <div ng-controller="AcademyController">
    <hr>
      <div class = "container">
        <div class="searchbar">
          <a href="clublist.php">To CLUB</a>
        </div>
        <div class="searchbar">
        <form name="myForm">
          <select name="repeatSelect" id="repeatSelect" ng-model="option" class="form-control">
            <option ng-repeat="option in arr" value="{{option}}">{{option}}</option>
          </select>
        </form>
        </div>
    
        <form action="individual_page.php" name="group_name" method="GET">
          <div class="section" ng-repeat = "academy in list | filter: option">
            <div class="block">
            <img src="../clubimg/{{academy.img_name}}">
            </div>
            <div class="block_content">
            <input type="hidden" name = "mode" value = "2">
            <input class="btn btn-default" type = "submit" name = "name" value = "{{academy.a_name}}">
             </div>
          </div>
        </form>

      </div>
    </div>

    <script src="../js/data.js"></script>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js"></script>
  </body>
</html>