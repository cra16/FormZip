<?php
  // Session start 
  session_start();

  // DB connection
  require_once('DB_INFO.php');
  header('Content-Type: text/html; charset=utf-8');

  mysqli_query("set session character_set_connection=utf8;");
  mysqli_query("set session character_set_results=utf8;");
  mysqli_query("set session character_set_client=utf8;");

  $bd=mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD) or die("Could not connect database");
  mysqli_set_charset($bd, "utf8");

  mysqli_select_db($bd,DB_NAME) or die("Could not select database");

 ?>


<!DOCTYPE HTML> 
<html>

   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
      <title>:: 마이 페이지 ::</title>

      <!-- Bootstrap -->
      <link href="../css/mypage.css" rel="stylesheet">
      <link href="../css/bootstrap.css" rel="stylesheet">
      <link href="../css/bootstrap.min.css" rel="stylesheet">
  </head>

<body> 
  <!-- Logo Start -->
  <div class="container">
    <div id="header-logo">
        <a href="firstpage.php" class="h_logo">
        <img src="../img/title.png" class = "h_logo">
      </a>
    </div>
  </div>
  <!-- Logo End -->
 
  <div class="formContentsLayout">
 
    
 <!-- 로그인 여부 판단 -->
 <?php
  $id = $_SESSION['USER_NAME'];
   if(!$id){
     header("location: login.php");
     exit();
    }



    //기본정보 Start

  $qry="SELECT * FROM student WHERE id='$id'";   
  $result=mysqli_query($bd,$qry);
  $list = mysqli_fetch_array($result);
  $name = $list['student_name'];
  $bday = $list['birth'];

  //비밀번호 체크
  $key = KEY;
  $s_vector_iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_3DES, MCRYPT_MODE_ECB), MCRYPT_RAND);

  $password = mysqli_real_escape_string($bd,$list['password']);

  ### 복호화 ####
  $de_str = pack("H*", $password); //hex로 변환한 ascii를 binary로 변환
  $decoding = mcrypt_decrypt(MCRYPT_3DES, $key, $de_str, MCRYPT_MODE_ECB, $s_vector_iv); 
 ?> 
     
   <div class = "title">
    <h4> 기본 정보</h4>
   </div>

    <div class="form-horizontal">
      <div class="form-group">
        <label  class="col-lg-3 control-label">이름</label>
        <div class="col-lg-6">
          <input type="text" class="form-control" id="inputEmail" placeholder="<?php echo $name; ?>" disabled>
        </div>
      </div> 
      <div id="divmargin"></div> 
      
      <div class="form-group">
        <label  class="col-lg-3 control-label">ID</label>
        <div class="col-lg-6">
          <input type="text" class="form-control" id="inputEmail" placeholder="<?php echo $id; ?>" disabled>
        </div>
      </div> 
      <div id="divmargin"></div> 

      <div class="form-group">
        <label  class="col-lg-3 control-label">생년월일</label>
        <div class="col-lg-6">
          <input type="text" class="form-control" id="inputEmail" placeholder="<?php echo $bday; ?>"  disabled>
        </div>
      </div> 
      <div id="divmargin"></div> 
    </div>
    

  
<?php
$label_name=array("기존 비밀번호","새 비밀번호","비밀번호 재입력");
$pw_id_name=array("current","newp","pw");
  

?>

   <form class="form-horizontal" action="data_change.php?mode=modify" method="POST" onsubmit="return validateForm()">
    <input type="hidden" id="now" name = "now" value ="<?php echo $decoding; ?>" >


      <?php
      for($i=0; $i<3; $i++){
      ?>
      <div class="form-group">
        <label  class="col-lg-3 control-label"><?php echo $label_name[$i]; ?></label>
        <div class="col-lg-6">
          <input type="password" class="form-control" id="<?php echo $pw_id_name[$i]; ?>" name="<?php echo $pw_id_name[$i]; ?>" onkeyup=PwCheck()>
        </div>
      </div> 
      <div id="divmargin"></div> 
      <?php } ?>  
      
      <div id="ps_ck" class="error" style="display:none"></div> 
  

   <div class = "submit">
      <input type = "submit" value = "저장" class = "save">
   </div>
   </form>    





<!-- 기본 정보 End -->



<!-- 지원서 리스트 Start -->
<div>
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
  $stuid_result = mysqli_query($bd,$qry);
  $stuid_array = mysqli_fetch_array($stuid_result);
  $stuid = $stuid_array['stuid'];

  $qry2 = "SELECT * FROM result WHERE stu_id = '$stuid'";
  $result=mysqli_query($bd,$qry2);

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
          <?php echo "$j";?>
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
</div>
<!-- 지원서 리스트 Start -->



 <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/mypage.js"></script>
</body>
</html>