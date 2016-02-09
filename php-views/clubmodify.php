<?php 
  // Session start 
  session_start();
  // Manager judge
  require_once('../php-config/auth.php');
  // DB connection
  require_once('../php-config/DB_INFO.php');
  
  require_once('../php-config/adminpage_config.php');
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title> iBELONG :: 페이지 수정 </title>

    <!-- Bootstrap -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../css/individual_page.css" rel="stylesheet">
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
  
    <div class="container">
    <!-- 동아리 수정 Start-->
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
      <form class = "content" method = "POST" action="../php-exec/clubexec.php" enctype="multipart/form-data">
        <img class = "img-responsive img-thumbnail" src = "../clubimg/<?php echo $member['img_name']; ?>">   <!-- *그림 가져오기 -->
        
          <div class="containerbox">
            <div class="form-group">
              <label for="inputEmail" class="col-lg-5">이미지 업로드</label>
              <div class="col-lg-10">
              <input type="file" class="form-control" name="upload_file">
              </div>
            </div>
            <div class="form-group">
              <label class="col-lg-5 "> 소개글 </label>
                <div class="col-md-12 control-label">
                <textarea class="form-control" rows="14" name="text" ><?php echo $member['text']; ?></textarea>   
                </div>
            </div>  
          </div>
    
    
      </div>
    </div>
      <button class = "btn btn-primary submit_button" type="submit" name="name" value="<?php echo $group_name; ?>">수정하기</button>
      </form>                               
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js"></script>
</body>
</html>


