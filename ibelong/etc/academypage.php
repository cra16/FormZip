<?php 
  // Session start 
  session_start();

  // DB connection
  require_once('DB_INFO.php');

  if($_GET['name']!=""){
   $academy_name= $_GET['name'];
   $_SESSION["GROUP"] = $academy_name;
  }
  else{
     if($_SESSION['GROUP']==NULL)
      header("location: login.php");

    $academy_name=$_SESSION['GROUP'];
    $_GET['name']=$academy_name;
  }
  
  $qry="SELECT * FROM academy WHERE a_name='$academy_name'";   
  $result=mysqli_query($link,$qry);

  //Check whether the query was successful or not
  if($result) {

      if(mysqli_num_rows($result) > 0) 
      {
        $member = mysqli_fetch_assoc($result);
      }else{
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
    <title> iBELONG :: 학회 페이지 </title>

    <!-- Bootstrap -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../css/club_page.css" rel="stylesheet">
  </head>

  <script type="text/javascript">
    function help(){
        window.open("help.php","도움말", "left=200, top=200, width=520, height=620 , location=no, scrollbars=no, resizable=yes");
      }
    function warning(){
        alert("지원을 원하실 경우 로그인을 해 주세요");
      }
    function nonexist(){
      alert('해당기간이 아닙니다');
    }
  </script>
  
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
            //로그인 여부 확인
           if($_SESSION['USER_NAME']){
            $id = $_SESSION['USER_NAME'];
            $sql = "SELECT * FROM student WHERE id = '$id'";
            $check_result = mysqli_query($link,$sql);
            $check = mysqli_fetch_array($check_result);
            $index = $check['index'];
            $cname = $check['c_name'];
            //관리자 여부 확인
              if($index == 0){
                echo '<a href="mypage.php">My Page</a>';
               
              }
              else if($index ==1){
                echo '<a href="clubpage.php?name='.$cname.'">Club Page</a>'; 
              }
              else{
                echo '<a href="academypage.php?name='.$cname.'">Academy Page</a>';   
              }
            }
            else
              echo '<a href="agreement.php">Sign Up</a>';
          ?>
        </li>
        <li><a href="#" onclick="help()">Help</a></li>
      </ul>
    </div>
  </div>
</nav>
   <!-- Menubar end-->  
  
  
  <div id = "wrap">
    <div id = "navigation">학회 소개:: </div>
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

    <!-- 학회 소개 End-->
  
    <!-- 학회 프로필 Start-->
 
    <div id = "aside">
      <table class = "profile">
        <tr>
         <p class = "club-logo"><?php echo $academy_name; ?></p> <!-- *학회 이름 (로고)-->
        </tr>
        <?php
         //관리자여부 확인
           if($cname==$academy_name){
              $IsManager="true";
            }
            else{
              $IsManager="false";
            }  

        if($IsManager=="true")  //현재 로그인 한 사람이 관리자인 경우 실행
        {
        ?>
        <tr>
          <form action="academymodify.php" method="GET">
<button type="button" class="btn btn-default">Default</button>
          </form>
        </tr>
        <tr>
          <form action="mypage_a.php" method="GET">
           <button class = "btn btn-default" type="submit" name="name" value="<?php echo $academy_name; ?>">비밀번호 수정</button>
          </form>
        </tr>
        <tr>
          <form action="app_make.php" method="GET">
            <button class = "btn btn-default" type="submit" name="name" value="<?php echo $academy_name; ?>">지원서 만들기</button>
          </form>
        </tr>
        <tr>
          <?php 
            $qry_d = "SELECT * FROM application WHERE id = '$academy_name'";
            $result_d = mysqli_query($link,$qry_d);
            $due = mysqli_fetch_assoc($result_d);

           if($due['month']!=NULL){ ?>
                    <form action="app_preview.php" method="GET">
                    <button class = "btn btn-default" type="submit" name="name" value="<?php echo $academy_name; ?>">지원서 미리보기</button>
                    </form>
               <?php  }
                 else 
                 { ?> <input class = "btn btn-default" type="button" value="지원서 미리보기" onclick="test()">                      
                    <script type="text/javascript">
                    function test(){
                     alert("만들어진 지원서 양식이 없습니다.");
                      }
                    </script>
                <?php 
                }
                ?>                  
        </tr>
        <tr>
          <form action="app_list.php" method="GET">
            <button class = "btn btn-default" type="submit" name="name" value="<?php echo $academy_name; ?>">지원 현황</button>
          </form>
        </tr>
        <?php
        }
        else if($IsManager=="false")  //현재 로그인 개정이 관리자가 아닐경우 실행
        {
          if($id) // 로그인을 한 경우 지원하기 가능
          { 
            $qry_d = "SELECT * FROM application WHERE id = '$academy_name'";
            $result_d = mysqli_query($link,$qry_d);
            $due = mysqli_fetch_assoc($result_d);
            date_default_timezone_set("Asia/Seoul");
          
            $now_month = (int)date("m");
            $now_day = (int)date("d");
            
            $exist = 0;

           if( $due['month'] == NULL || $due['day'] == NULL || $due['s_day'] == NULL || $due['s_month'] == NULL ){
              $exist = 0;
            }else{
              if( $now_month > $due['s_month'] && $now_month < $due['month'] ){
                $exist = 1;
              }
              else if($now_month == $due['month'] && $now_month == $due['s_month']){
                if($now_day <= $due['day'] && $now_day >= $due['s_day']){
                  $exist = 1;
                }
              }
              else if($now_month == $due['month']){
                if($now_day <= $due['day']){
                  $exist = 1;
                }
              }else if($now_month == $due['s_month']){
                if($now_day >= $due['s_day']){
                  $exist = 1;
                }
              }
            }

            if( $exist == 1 ){ // 지원서가 있을 경우 
        ?>  
              <form action="app_submit.php" method="GET">
              <tr>
                <button class = "club-apply-bt" type="submit" name="name" value="<?php echo $academy_name; ?>">지원하기</button>
              </tr>
              </from>
              <?php
                echo $due['s_month']; ?>월 <?php echo $due['s_day']; ?>일 ~
                <?php echo $due['month']; ?>월 <?php echo $due['day']; ?>일 
            <?php
            }
            else{ //지원서가 없을 경우 ?>
              <form >
              <tr>
                <button class = "club-apply-bt" type="button" name="name" onclick = "nonexist()" value="지원하기">지원하기</button>
              </tr>
              </from>
              <?php
              echo "지원기간이 아닙니다";
           }

          }
          else // 로그인을 하지 않은경우 지원하기 불가능
          {    
          ?>  
          <form action="login.php" method="POST">
          <tr>
            <td><input class = "club-apply-bt" type ="submit" value = "지원하기" onclick="warning()"></td>
          </tr>
        </from>
           <?php
           echo '로그인 후 지원가능합니다';
          }
       }
        ?>
      </table>
    </div>

    <!-- 동아리 프로필 End-->
  </div>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js"></script>
</body>
</html>
