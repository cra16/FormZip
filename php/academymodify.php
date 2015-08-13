<?php 
  // Session start 
  session_start();
  // Manager judge
  require_once('auth.php');
  // DB connection
  require_once('DB_INFO.php');
  header('Content-Type: text/html; charset=utf-8');

  mysqli_query("set session character_set_connection=utf8;");
  mysqli_query("set session character_set_results=utf8;");
  mysqli_query("set session character_set_client=utf8;");

  $bd=mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD) or die("Could not connect database");
  mysqli_set_charset($bd, "utf8");

  mysqli_select_db($bd,DB_NAME) or die("Could not select database");

  $academy_name= $_GET['name'];

  $qry="SELECT * FROM academy WHERE a_name='$academy_name'";   
  $result=mysqli_query($bd,$qry);

  //Check whether the query was successful or not
  if($result) {

      if(mysqli_num_rows($result) > 0) 
      {
        $member = mysqli_fetch_assoc($result);
        
      }

      else 
      {
       echo "Data call failed";
      }
  }
  else 
  {
    die("Query failed");
  }
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=1280">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title> 학회페이지 변경 </title>

    <!-- Bootstrap -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../css/club_page.css" rel="stylesheet">

    <script type="text/javascript">
    function help(){
        window.open("help.php","도움말", "left=200, top=200, width=520, height=620 , location=no, scrollbars=no, resizable=yes");
    }
    </script>

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
        <li>
        <?php
          echo '<a href="academypage.php?name='.$cname.'">Academy Page</a>';   
               ?>
        </li>
        <li><a href="#" onclick="help()">Help</a></li>
      </ul>
    </div>
  </div>
</nav>
   <!-- Menubar end-->  
   
  
  
  <div id = "wrap">
    <div id = "navigation">Formzip </div>
    <!-- 학회 수정 Start-->
    <div id = "section">
      <form class = "content" method = "POST" action="academyexec.php" enctype="multipart/form-data">
        <img class = "picture" src = "../clubimg/<?php echo $member['img_name']; ?>">   <!-- *그림 가져오기 -->
        
          <div class="containerbox">
            <div class="form-group">
              <label for="inputEmail" class="col-lg-3 control-label">파일 업로드</label>
              <div class="col-lg-10">
              <input type="file" class="form-control" name="upload_file">
              </div>
            </div>
            <div class="form-group">
              <label class="col-lg-3 control-label">Title</label>
              <div class="col-lg-10">
                <input type="text" class="form-control" name="title" placeholder="학회 제목을 입력해주세요" value = '<?php echo $academy_name; ?>'>
              </div>
            </div>

            <div class="form-group">
              <label class="col-lg-3 control-label"> 소개글 </label>
                <div class="col-lg-10">
                <textarea class="form-control" rows="3" name="text" ><?php echo $member['text']; ?></textarea>   
                </div>
            </div>  
          </div>
    </div>
   
    <!-- 학회 소개 End-->

    <!-- 학회 프로필 Start-->
    <div id = "aside">
      <table class = "profile">
        <tr>
          <input class = "club-logo" type ="text" value = "<?php echo $academy_name; ?>">  <!-- *동아리 이름 (로고)-->
        </tr>
        <tr>
          <button class = "club-apply-bt" type="submit" name="name" value="<?php echo $academy_name; ?>">수정하기</button>
        </tr>
      </table>
    </div>
    </form>
    <!-- 학회 프로필 End-->
  </div>




    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
</body>
</html>