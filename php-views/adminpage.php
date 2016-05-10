<?php
// 파일명: adminpage.php
// 설명: 그룹 관리지가 어떤것을 할지 display(페이지수정, 지원서 수정, 지원서 만들기 등)
session_start();
	require_once('../php-config/adminpage_config.php');
	require_once('../php-config/individual_config.php');
	$individual_page = new IndividualConfig();

  $individual_page->validation($_GET['name'],$_SESSION['USER_NAME']);
	$exist = $individual_page->ApplicationInfo($group_name);

?>
<!DOCTYPE html>
<html ng-app ="grouplist">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>:: Admin_Page ::</title>
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
            <a class="navbar-brand" href="adminpage.php" id = "home_button">iBELONG</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="logout.php">Logout</a></li>
            <li><a href="#" onclick="help()">Help</a></li>
          </ul>
        </div>
      </div>
    </nav>  
    <!-- Navigation end-->  

    <h1><a href="adminpage.php">iBELONG</a></h1>
    <h2>Club &#38; Academy application </h2>
    <!-- Page Content -->
    <div class="container">
    <div class="row">
        <!-- blog Entries Column -->
        <div class="well" id="welltext">
        <?php 
          if($mode == 1){
            echo $member['c_name'].'-'.$member['field'];
            $groupName = $member['c_name'];
          }
          else{
            echo $member['a_name'].'-'.$member['title'];
            $groupName= $member['a_name'];
          }
        ?>
        </div>


	    <?php if($mode == 1){ ?>
		<form action="clubmodify.php" method="GET">
		<?php }
		else{ ?>
		<form action="academymodify.php" method="GET">
		<?php } ?>
		<button class = "btn btn-primary btn-round" type="submit" name="name" value="<?php echo $group_name; ?>">페이지 수정</button>
		</form>

		<form action="mypage_a.php" method="GET">
		<button class = "btn btn-primary btn-round" type="submit" name="name" value="<?php echo $group_name; ?>">비밀번호 수정</button>
		</form>

		<form action="app_make.php" method="GET">
		<button class = "btn btn-primary btn-round" type="submit" name="name" value="<?php echo $group_name; ?>">지원서 만들기</button>
		</form>

		<?php 
		$qry_d = "SELECT * FROM application WHERE id = '$group_name'";
		$result_d = mysqli_query($link,$qry_d);
		$due = mysqli_fetch_assoc($result_d);
    //지원서 등록여부(날짜로 확인)로 지원서 뷰 여부를 확인해준다
		if($due['month']!=NULL){ ?>
		        <form action="app_preview.php" method="GET">
		        <button class = "btn btn-primary btn-round" type="submit" name="name" value="<?php echo $group_name; ?>">지원서 미리보기</button>
		        </form>
		   <?php  }
		     else 
		     { ?> <input class = "btn btn-primary btn-round" type="button" value="지원서 미리보기" onclick="test()">                      
		        <script type="text/javascript">
		        function test(){
		         alert("만들어진 지원서 양식이 없습니다.");
		          }
		        </script>
		    <?php 
		    }
		    ?>                  
		<form action="app_list.php" method="GET">
		<button class = "btn btn-primary btn-round" type="submit" name="name" value="<?php echo $group_name; ?>">지원 현황</button>
		</form>


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
