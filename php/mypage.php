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
  <div class="container" class = "col-lg-12 col-xs-12">
      <div id="header" class = "col-xs-8 col-xs-offset-2 col-lg-4 col-lg-offset-4 col-md-4 col-md-offset-4">
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
      <td class = "content"> 

<?php
  $id="haein722"; // session 
  $qry="SELECT * FROM student WHERE id='$id'";   
  $result=mysqli_query($bd,$qry);
  $list = mysqli_fetch_array($result);
  $name = $list['student_name'];
  $bday = $list['birth'];
  echo "<input type='text' value = '$name' disabled >";
?>
      </td>
    </tr>
    <tr>
      <td class="header"><label>ID</label></td>
      <td class = "content"> 
<?php
  echo "<input type='text' value = '$id' disabled >";
?>
      </td>
    </tr>
    <tr>
      <td class="header"><label>생년월일</label></td>
      <td class = "bday"> 
<?php
  $year = 1900 + $bday/10000;
  $month = ($bday/100)%100;
  $day = $bday%10000;
  echo "<input type='text' value = '1994' class='fixed-bday'>";
  echo "<input type='text' value = '07' class='fixed-bday'>";
  echo "<input type='text' value = '22' class='fixed-bday'>";
  
?>
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

<?php

  $i = 0;
  $j = 1;
  $id = "21300739";
  $qry2 = "SELECT * FROM result WHERE stu_id = '$id'";
  $result=mysqli_query($bd,$qry2);

  while($list = mysqli_fetch_array($result)){
    $clubname = $list['club_name'];
  ?>
        <tr id = '$j' class = "clickable-row" data-href='firstpage.html'>
        <th class = "app-number" scope="row">
          <?php echo "$j";?>
        </th>
         <td class = "app-club">
          <?php echo "$clubname"; ?>
         </td>
        <td class = "app-status">
          <?php echo "제출중"; ?>
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
</body>
</html>