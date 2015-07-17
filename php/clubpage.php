<?php
  // Session start 
  session_start();

  // DB connection
  $mysql_hostname = "localhost";      
  $mysql_user = "root";
  $mysql_password = "gksehdeo357";    //수정할 부분->비밀번호입력
  $mysql_database = "formzip";
  $prefix = "";
  $bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) or die("Could not connect database");
    mysql_select_db($mysql_database, $bd) or die("Could not select database"); 
  $club_name= $_POST['name'];

  $qry="SELECT * FROM clubstorage WHERE id='$club_name'";   //clubstorage : 각 동아리의 title, 설명, 사진정보 저장 DB
  $result=mysql_query($qry);

  //Check whether the query was successful or not
  if($result) {

      if(mysql_num_rows($result) > 0) 
      {
        $member = mysql_fetch_assoc($result);
        
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
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title> 동아리 페이지 </title>

    <!-- Bootstrap -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../css/club_page.css" rel="stylesheet">
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
      <a class="navbar-brand" href="firstpage.php">Form_Zip</a>
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
        <li><a href="#">Signup</a></li>
        <li><a href="#">Help</a></li>
      </ul>
    </div>
  </div>
</nav>
   <!-- Menubar end-->  
  

<!--관리자 여부에 따른 action 위치 변경  -->
<?php
//관리자여부 확인
  if($_SESSION['USER_NAME']==$club_name){
    $IsManager="true";
  }

  else{
    $IsManager="false";
  }

?>
  
  
  <div id = "wrap">
    <div id = "navigation">동아리 소개:: </div>
    <!-- 동아리 소개 Start-->
    <div id = "section">
      <div class = "content">
        <div class="form-group">
          <img class = "picture" src = "../clubimg/<?php echo $member['img_name']; ?>">   <!-- *그림 가져오기 -->
        </div>
        <div >
          <h3 class = "title"><?php echo $member['title']; ?></h3>
        </div>    
        <div >
          <p class = "intro"> 
            <?php echo $member['text']; ?>
          </p>
        </div>    
     </div>
    </div>

    <!-- 동아리 소개 End-->
  
    <!-- 동아리 프로필 Start-->
 
    <div id = "aside">
      <table class = "profile">
        <tr>
         <input class = "club-logo" type ="text" value = "<?php echo $club_name; ?>">  <!-- *동아리 이름 (로고)-->
        </tr>
        <?php
        if($IsManager=="true")  //현재 로그인 한 사람이 관리자인 경우 실행
        {
        ?>
        <tr>
          <form action="clubmodify.php" method="POST">
           <button class = "club-result-bt" type="submit" name="name" value="<?php echo $club_name; ?>">페이지 수정</button>
          </form>
        </tr>
        <tr>
          <form action="app_make.php" method="POST">
            <button class = "club-result-bt" type="submit" name="name" value="<?php echo $club_name; ?>">지원서 만들기</button>
          </form>
        </tr>
        <tr>
          <form action="login.php" method="POST">
            <button class = "club-result-bt" type="submit" name="name" value="<?php echo $club_name; ?>">지원자 현황</button>
          </form>
        </tr>
        <?php
        }
        else if($IsManager=="false")  //현재 로그인 개정이 관리자가 아닐경우 실행
        {    
        ?>  
        <tr>
          <td><input class = "club-apply-bt" type ="submit" value = "지원하기"></td>
        </tr>
        <?php
        }
        ?>
      </table>
    </div>





    <!-- 동아리 프로필 End-->
  </div>




    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
</body>
</html>


