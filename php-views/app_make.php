<?php
// 파일명: app_make.php
// 설명: 그룹 관리자가 지원서 만들 수 있도록 display
// Session start 
session_start();

require_once('../php-config/DB_INFO.php');
require_once('../php-config/auth.php');

$club= $_GET["name"];
$label_name = array("이름","학번","학과","전화번호","성별","군필여부","e-mail","가능학기수");
$question_placeholder= array("Name","Student ID","Major ex) 1전공/2전공","Phone number ex)01012345678","남/여","남성인 경우만 해당","ex)ibelong@naver.com","ex)3학기");
$text_name=array("t_name","t_stuid","t_major","t_phonenum","t_gender","t_served","t_mail","t_activity");
$radio_name=array("r_served","r_mail","r_activity");
$sub_radio_name=array("sr1","sr2","sr3","sr4","sr5","sr6","sr7","sr8","sr9","sr10");

?>

<!DOCTYPE HTML> 
<html>

   <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>iBELONG :: 지원서 양식 만들기</title>

    <!-- Bootstrap -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../css/app_make.css" rel="stylesheet">
  </head>

<body> 
    <h1><a href="clublist.php">iBELONG</a></h1>
    <h2>Club &#38; Academy application </h2>
    <!-- Help box -->
    <div class="helpbox">
      <div id="flip"> 도움말 <img src="../img/arrow.png"></div>
      <div id="panel">이름, 학번, 학과, 전화번호, 성별은 기본 항목입니다.<br>군필여부, e-mail, 학기수, 질물 1~10은 선택사항입니다.<br>선택사항의 사용을 원하시면 'use'를, 아니면 'not use'를 선택해주세요. </div>
    </div>
  <!-- 지원서 내부 -->
<div class="container">
   <div class="row">

    <?php  
    $qry = "SELECT * FROM application WHERE id = '$club'";
    $result = mysqli_query($link,$qry);
    $isset = mysqli_fetch_assoc($result);

   if($isset['month']!=NULL){
    date_default_timezone_set("Asia/Seoul");
  
    $now_month = (int)date("m");
    $now_day = (int)date("d");
         
    ?>            
    <form method="POST" onsubmit = "return due_isset()"  class="form-horizontal" action="../php-exec/app_exec.php"> 
      <input type="hidden" id = "p_month" name = "p_month" value = "<?php echo $isset['month']; ?>" >
      <input type="hidden" id = "p_day" name = "p_day" value = "<?php echo $isset['day']; ?>" >
      <input type="hidden" id = "p_s_month" name = "p_s_month" value = "<?php echo $isset['s_month']; ?>">
      <input type="hidden" id = "p_s_day" name = "p_s_day" value = "<?php echo $isset['s_day']; ?>">
      <input type="hidden" id = "now_day" name = "now_day" value = "<?php echo $now_day; ?>">
      <input type="hidden" id = "now_month" name = "now_month" value = "<?php echo $now_month; ?>">
    <?php  
     }
     else{
    ?>

    <form method="POST" onsubmit = "return due()"  class="form-horizontal" action="../php-exec/app_exec.php"> 
      <?php   } ?>
      <h3 class = "application">지원서</h3>    
      <div id="divmargin"></div>              
      <h5 class = "club-name"> - <?php echo $club; ?> - </h5> 
      <div id="divmargin"></div>

      <!-- short text -->
      <!-- 이름 / 학번 / 학과 / 전화번호 -->
      <?php
      for($i = 0; $i<4; $i++)
      {
      ?>
      <div class="form-group">
        <label class="col-lg-4 col-lg-offset-3"><?php echo $label_name[$i]; ?></label>
        <div class="col-lg-9 col-lg-offset-3" title="기본 항목입니다.">
          <input type="text" class="form-control short-length"  placeholder="<?php echo $question_placeholder[$i]; ?>"
                 style="display:block" id="<?php echo $text_name[$i]; ?>" name="<?php echo $text_name[$i]; ?>" disabled>
        </div>
      </div>  

      <?php
      }
      ?>
      <!-- 성별 -->
      <div class="form-group">
        <label class="col-lg-4 col-lg-offset-3"><?php echo $label_name[$i]; ?></label>
        <div class="col-lg-9 col-lg-offset-3" title="기본 항목입니다.">
            <input type="radio" id="man" name="gender" value="man" checked  style=margin:"10px" display:"none">
            <label for="man">남자</label>
            <input type="radio" id="woman" name="gender"value="woman" style=margin:"10px" display:"none">
            <label for="woman">여자</label>
        </div>
      </div>  
      <!-- 군필여부 -->
      <?php
      $i = 5;
      ?>
      <div class="form-group">
        <label class="col-lg-4 col-lg-offset-3"><?php echo $label_name[$i]; ?></label>
        <div class="col-lg-9 col-lg-offset-3" id="showbox">
            <input type="radio" id="served" name="served" checked  style=margin:"10px" display:"none">
            <label for="served" id="<?php echo $text_name[$i]; ?>1" >&nbsp;&nbsp;예&nbsp;&nbsp;</label>
            <input type="radio" id="nonserved" name="served" style=margin:"10px" display:"none">
            <label for="nonserved" id="t_served2">아니오</label>
        </div>
        <div class="col-lg-9 col-lg-offset-3">
          <input type="radio" id="<?php echo $radio_name[$i-5]; ?>" name="<?php echo $radio_name[$i-5]; ?>" value="use" onclick="Show<?php echo $i-4;?>()" checked>Use
          <input type="radio" id="<?php echo $radio_name[$i-5]; ?>" name="<?php echo $radio_name[$i-5]; ?>" value="notuse" onclick="Blind<?php echo $i-4;?>()">not Use
        </div>
      </div>  
      <!-- 이메일 / 학기수 -->
      <?php
       for($i = 6; $i<8; $i++)
      {
      ?>
      <div class="form-group">
        <label class="col-lg-4 col-lg-offset-3"><?php echo $label_name[$i]; ?></label>
        <div class="col-lg-9 col-lg-offset-3" title="선택 항목입니다. 사용을 원하실 경우 Use 아닌경우 not Use를 선택해 주세요">
          <input type="text" class="form-control short-length"  placeholder="<?php echo $question_placeholder[$i]; ?>"
                 style="display:block" id="<?php echo $text_name[$i]; ?>" name="<?php echo $text_name[$i]; ?>" disabled>
           <input type="radio" id="<?php echo $radio_name[$i-5]; ?>" name="<?php echo $radio_name[$i-5]; ?>" value="use" onclick="Show<?php echo $i-4;?>()" checked>Use
          <input type="radio" id="<?php echo $radio_name[$i-5]; ?>" name="<?php echo $radio_name[$i-5]; ?>" value="notuse" onclick="Blind<?php echo $i-4;?>()">not Use
        </div>
      </div>  

      <?php
      }
      ?>
      <!-- long text  -->
      <?php
      for($i = 0; $i<7; $i++)
      {
      ?>
      <div class="form-group">
        <label class="col-lg-4 col-lg-offset-3" title="선택 항목입니다. 사용을 원하실 경우 Use 아닌경우 not Use를 선택해 주세요">
        질문 <?php echo $i+1;?></label>
        <div class="col-lg-9 col-lg-offset-3">
          <input type="text" class="form-control"  placeholder="질문을 입력해주세요." style="display:none" name="title<?php echo $i+1;?>" id="title<?php echo $i+1;?>">
          <input type="text" class="form-control"  placeholder="설명-질문에 대한 설명을 입력해주세요" style="display:none" name="explain<?php echo $i+1;?>" id="explain<?php echo $i+1;?>">
          <input type="radio" id="<?php echo $sub_radio_name[$i]; ?>" name="<?php echo $sub_radio_name[$i]; ?>" value="use"  onclick="Sub_Show<?php echo $i+1;?>()">Use
          <input type="radio" id="<?php echo $sub_radio_name[$i]; ?>" name="<?php echo $sub_radio_name[$i]; ?>" value="notuse" onclick="Sub_Blind<?php echo $i+1;?>()" checked>not Use
        </div>
      </div>  

      <?php
      }
      ?>

      <!-- start day -->
      <div class="form-group">
      <label for="select" class="col-lg-4 col-lg-offset-3">시작일</label>
      <div class="col-lg-10 col-lg-offset-3">
        <select class="form-control button-length" name="s_month" id="s_month">
        <?php
          for($i = 1; $i<13; $i++)
          {
        ?>
          <option value="<?php echo $i; ?>"><?php echo $i; ?>월</option>

        <?php
          }
        ?>
        </select>

         <select class="form-control button-length" name="s_day" id="s_day">
          <?php
          for($i = 1; $i<32; $i++)
          {
        ?>
          <option value="<?php echo $i; ?>"><?php echo $i; ?>일</option>

        <?php
          }
        ?>
        </select>
      </div>
      </div>

      <!-- due day  -->
      <div class="form-group">
      <label for="select" class="col-lg-4 col-lg-offset-3">제출기한</label>
      <div class="col-lg-10 col-lg-offset-3">
        <select class="form-control button-length" name="month" id="month">
        <?php
          for($i = 1; $i<13; $i++)
          {
        ?>
          <option value="<?php echo $i; ?>"><?php echo $i; ?>월</option>

        <?php
          }
        ?>
        </select>

         <select class="form-control button-length" name="day" id="day">
          <?php
          for($i = 1; $i<32; $i++)
          {
        ?>
          <option value=" <?php echo $i; ?> "><?php echo $i; ?>일</option>

        <?php
          }
        ?>
        </select>
      </div>
       <button class = "btn btn-primary submit_button" type="submit" name="name" id = 'temp' value="<?php echo $club; ?>">양식 저장</button>     
    </form>
</div>
</div>

 <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js"></script>
    <!-- app_make JS -->
    <script src="../js/app_make.js"></script>
</body>
</html>