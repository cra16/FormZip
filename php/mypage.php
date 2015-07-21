<?php
  // Session start 
  session_start();


/*
  // DB connection
  require_once('DB_INFO.php');
  header('Content-Type: text/html; charset=utf-8');

  mysqli_query("set session character_set_connection=utf8;");
  mysqli_query("set session character_set_results=utf8;");
  mysqli_query("set session character_set_client=utf8;");

  $bd=mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD) or die("Could not connect database");
  mysqli_set_charset($bd, "utf8");

  mysqli_select_db($bd,DB_NAME) or die("Could not select database");

  $user_id= $_SESSION["USER_NAME"]; 

  $qry="SELECT * FROM application WHERE id='$user_id'";   
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


//Sanitize the POST values
  $short_info=array("use","use","use","use","use",$member['served'],$member['mail'],$member['activity']);
  $sub_info=array($member['sr1'],$member['sr2'],$member['sr3'],$member['sr4'],$member['sr5'],$member['sr6'],$member['sr7']);
  $label_name = array("이름","학번","학과","전화번호","성별","군필여부","e-mail","활동가능학기");
  $question_placeholder= array("Name","Student ID","Major ex) 1전공/2전공","Phone number ex)01012345678","남/여","남성인 경우만 해당","ex)formzip@naver.com","ex)3학기");
  $title=array($member['title1'],$member['title2'],$member['title3'],$member['title4'],$member['title5'],$member['title6'],$member['title7']);
  $explain=array($member['explain1'],$member['explain2'],$member['explain3'],$member['explain4'],$member['explain5'],$member['explain6'],$member['explain7']);

*/
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
   <form method="POST" action="app_exec.php" class="form-horizontal"> 
    
    <!-- 기본정보 Start -->

   <div class = "title">
    <h4> 기본 정보</h4>
   </div>


   <table class = "personal">
    <tr>
      <td class="header"><label>이름</label></td>
      <td class = "content"> <input type="text"  value = "<?php      ?>" class="fixed-name"  placeholder="<?php echo $question_placeholder[$i]; ?>"> </td>
    </tr>
    <tr>
      <td class="header"><label>ID</label></td>
      <td class = "content"> <input type="text" value = "<?php      ?>" class="fixed-id"  placeholder="<?php echo $question_placeholder[$i]; ?>"> </td>
    </tr>
    <tr>
      <td class="header"><label>생년월일</label></td>
      <td class = "bday"> 
        <input type="text" value = "<?php      ?>" class="fixed-bday"  placeholder="<?php echo $question_placeholder[$i]; ?>">

        <input type="text" value = "<?php      ?>" class="fixed-bday"  placeholder="<?php echo $question_placeholder[$i]; ?>">

        <input type="text" value = "<?php      ?>" class="fixed-bday"  placeholder="<?php echo $question_placeholder[$i]; ?>">

      </td>
    </tr>
    <tr>
      <td class="header"><label>기존 비밀번호</label></td>
      <td class = "content"> <input type="text" value = "<?php      ?>" class="password"  placeholder="<?php echo $question_placeholder[$i]; ?>"> </td>
    </tr>
    <tr>
      <td class="header"><label>새 비밀번호</label></td>
      <td class = "content"> <input type="text" value = "<?php      ?>" class="new-password"  placeholder="<?php echo $question_placeholder[$i]; ?>"> </td>
    </tr>
    <tr>
      <td class="header"><label>비밀번호 재입력</label></td>
      <td class = "content"> <input type="text" value = "<?php      ?>" class="new-password"  placeholder="<?php echo $question_placeholder[$i]; ?>"> </td>
    </tr>
   </table>

   <div class = "submit">
      <input type = "submit" value = "저장" class = "save">
   </div>
      



<hr class = "line-bar">



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
        <tr id = "01" class = "clickable-row" data-href="<?php   //지원서 링크 넣기    ?>">
          <th class = "app-number" scope="row">1</th>
          <td class = "app-club">어메이징 스토리</td>
          <td class = "app-status">작성중</td>
        </tr>
        <tr id = "02" class = "clickable-row" data-href="<?php   //지원서 링크 넣기    ?>" >
          <th class = "app-number" scope="row">2</th>
          <td class = "app-club">꾼들 </td>
          <td class = "app-status">제출 완료</td>
        </tr>
        <tr id = "03" class = "clickable-row" data-href="<?php   //지원서 링크 넣기   ?>">
          <th class = "app-number" scope="row">3</th>
          <td class = "app-club">즉흥적 새벽 두시</td>
          <td class = "app-status">작성중</td>
        </tr>
        <tr id = "06" class = "clickable-row" data-href="<?php   //지원서 링크 넣기   ?>">
          <th class = "app-number" scope="row">4</th>
          <td class = "app-club">CRA</td>
          <td class = "app-status">제출 완료</td>
        </tr>  
      </tbody>
    </table>
</div>
<!-- 지원서 리스트 Start -->



 <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js"></script>
</body>
</html>