<?php 
// 파일명: individual_page.php
// 설명: 각 동아리 페이지

  // Session start 
  session_start();
  if (!array_key_exists('GROUP', $_SESSION)) $_SESSION['GROUP'] = null;
  
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
    <link href="../css/individual_page.css?version=2313" rel="stylesheet">

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

        <img src = "../clubimg/<?php echo $member['img_name']; ?>" class="img-responsive img-thumbnail img_size" alt="Responsive image">

        <div class="col-md-10 col-md-offset-1" style="margin-top:50px;">
        
        <?php 
            if($exist == 1){
                echo "<p>";
                $longtext =  str_replace("\t", "&nbsp; &nbsp; &nbsp; &nbsp;", nl2br($member['text']));
                $longtext =  str_replace("    ", "&nbsp; &nbsp; &nbsp; &nbsp;", $longtext);  
                echo $longtext;
            }else{
                echo "<p style='text-align:center;'>";
                if($_SESSION['GROUP']=="CRA"){
                  echo '10일(일요일) 오후 10시까지 모든 지원자에게 면접 시간에 대한 안내 문자가 발송됩니다.<br> 10시 이후에 문자를 받지 못하신 분들은 010-7766-2016으로 연락 부탁드립니다';
                }else
                echo '현재 서비스를 이용중이지 않습니다.';
            } 
        ?>
        </p>
          
        <p style="font:20px bold;text-align: center;line-height:30px;">
        <?php 
         $due = $individual_page->ApplicationDue($_GET['name']);
          if($exist == 1){
        
        
            echo "지원기간 : ".$due['s_month']."월 ". $due['s_day']."일부터 ".$due['month']."월 ".$due['day']."일 오후 11:59 까지";
        
        ?>
        <form action="app_submit.php" method="GET">
        <button type="submit" class="btn btn-primary submit_button" name="name" value="<?php echo $groupName; ?>">지원하기</button>
        </form>

        <?php
        }
        else{
           if($due['s_month']!=NULL){ 
                echo "지원기간이 아닙니다.<br>";
                echo $due['s_month']."월". $due['s_day']."일부터 ".$due['month']."월".$due['day']."일 오후 11:59 까지";
           }
           else{
              //Not Using
           }   
        }    
        
        ?> </p>

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