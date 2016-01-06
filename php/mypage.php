<?php
  // Session start 
  session_start();

  // DB connection
  require_once('DB_INFO.php');

 ?>


<!DOCTYPE HTML> 
<html>

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=1280">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>iBELONG :: 마이 페이지</title>

    <!-- Bootstrap -->
    <link href="../css/mypage.css" rel="stylesheet">
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
  </head>

  <body> 
   <!-- Logo Start -->
  <div class="col-xs-8 col-xs-offset-2 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4">
    <div class ="wrapper">
      <a href="firstpage.php">
      <img src="../img/logo_mint.png" width="100%" height="50%">
      </a>
    </div>
  </div>
  <!-- Logo End -->
     
  <!-- 로그인 여부 판단 -->
  <?php
    $id = $_SESSION['USER_NAME'];
     if(!$id){
       header("location: login.php");
       exit();
      }



      //기본정보 Start

    $qry="SELECT * FROM student WHERE id='$id'";   
    $result=mysqli_query($link,$qry);
    $list = mysqli_fetch_array($result);
    $name = $list['student_name'];
    $bday = $list['birth'];
    
    // 비밀번호 체크
    $key = KEY;
    $s_vector_iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_3DES, MCRYPT_MODE_ECB), MCRYPT_RAND);
    $password = mysqli_real_escape_string($link,$list['password']);

    ### 복호화 ####
    $de_str = pack("H*", $password); //hex로 변환한 ascii를 binary로 변환
    $decoding = mcrypt_decrypt(MCRYPT_3DES, $key, $de_str, MCRYPT_MODE_ECB, $s_vector_iv); 
    $check_result = $_POST['check'];
    if($check_result == 'true'){
      echo "<script>alert(\"비밀번호가 정상적으로 수정되었습니다.\");</script>";
    }
   else if($check_result == 'false'){
     echo "<script>alert(\"비밀번호를 정확하게 입력해주세요.\");</script>";
   }
  ?>
  <!-- 로그인 여부 판단 End -->
  <div class="col-xs-12 col-md-12 col-lg-12 col-sm-12">
  <div class = "title">
    <h4> 기본 정보</h4>
  </div>
  <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4">

    <form action="pw_change.php" method="POST" onsubmit="return validateForm()" align="center" class="form-horizontal">
      <div class="form-group">
        <input type="text" class="form-control" value = "<?php echo $name; ?>" disabled>
      </div>

      <div class="form-group">
        <input type="text" class="form-control" value = "<?php echo $id; ?>" disabled>
      </div>
            
      <div class="form-group">
        <input type="text" class="form-control" value = "<?php echo $bday; ?>" disabled>
      </div>  

      <div class="form-group">
        <input type="password" class="form-control" id="current" name="current" maxlength="20" placeholder="기존 비밀번호">
        <div id="pw_cur" class="error" style="display:none"></div> 
      </div>     
     
      <div class="form-group">
        <input type="password" class="form-control" id="newp" name="newp" onkeyup="PwCheck()" maxlength="20" placeholder="새 비밀번호">
        <div id="pw_new" class="error" style="display:none"></div>
      </div>        

      <div class="form-group">
        <input type="password" class="form-control" id="pw" name="pw" onkeyup="PwCheck()" maxlength="20" placeholder="비밀번호 재입력">
        <div id="ps_ck" class="error" style="display:none"></div>
      </div>   

      <div class = "submit_content col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3">
        <input type = "submit" value = "저장">
      </div>
    </form>    
  </div>

  


<!-- 기본 정보 End -->



<!-- 지원서 리스트 Start -->
<div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4">
  <hr class = "line-bar">
   <div class = "title" >
    <h4 id = "line"> 내 지원서</h4>
   </div>
    <table align="center" class="table table-striped">
      <thead>
        <tr>
          <th class = "number">번호</th>
          <th class = "club">동아리</th>
          <th class = "status">제출 현황</th>
        </tr>
      </thead>
      <tbody>

<?php

  $j = 1;
  $id = $id;
  $qry = "SELECT * FROM student WHERE id = '$id'";
  $stuid_result = mysqli_query($link,$qry);
  $stuid_array = mysqli_fetch_array($stuid_result);
  $stuid = $stuid_array['stuid'];

  $qry2 = "SELECT * FROM result WHERE id = '$id'";
  $result=mysqli_query($link,$qry2);

  while($list = mysqli_fetch_array($result)){
    $clubname = $list['club_name'];
    $storage = $list['storage'];

    if($storage == '0'){
      $storage = "제출완료";
    }
    else{
      $storage = "임시저장";
    }
  ?>    
        <tr id = "<?php echo $j; ?>" onclick="location.href='app_submit.php?name=<?php echo "$clubname"; ?>'">
        <th class = "app-number" scope="row">
          <?php echo "$j";
          $j++; ?>
        </th>
         <td class = "app-club">
          <?php echo "$clubname"; ?>
         </td>
        <td class = "app-status">
          <?php echo "$storage"; ?>
        </td>
        </tr>
      
<?php
}

?> 
      </tbody>
    </table>

<!-- 지원서 리스트 Start -->
<table style="text-align:center" class="table table-striped">
  <tbody>
    <tr onclick="location.href='withdrawal.php'">
      <td> 회원탈퇴 바로가기</td>
    </tr>
  </tbody>
</table>
</div>
 <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/mypage.js"></script>
</body>
</html>


