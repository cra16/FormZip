<?php
require_once('auth.php');
$label_name = array("이름","학번","학과","전화번호","성별","군필여부","e-mail","활동가능학기");
$question_placeholder= array("Name","Student ID","Major ex) 1전공/2전공","Phone number ex)01012345678","남/여","남성인 경우만 해당","ex)formzip@naver.com","ex)3학기");
$text_name=array("t_name","t_stuid","t_major","t_phonenum","t_gender","t_served","t_mail","t_activity");
$radio_name=array("r_served","r_mail","r_activity");
$sub_radio_name=array("sr1","sr2","sr3","sr4","sr5","sr6","sr7");
?>


<!DOCTYPE HTML> 
<html>

   <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>application making page</title>

    <!-- Bootstrap -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../css/app_make.css" rel="stylesheet">
  </head>

<body> 
  <!-- title -->
  <div class="container">
    <div id="header">
      <h1> <a href="firstpage.php" class="h_logo">F O R M &nbsp;&nbsp;Z I P</a> </h1>
    </div>
  </div>
  <!-- Help box -->
  <div class="helpbox">
    <div id="flip">Help <img src="../img/arrow.png"></div>
    <div id="panel">이름, 학번, 학과, 전화번호, 성별은 기본 항목입니다.<br>군필여부, e-mail, 활동가능학기, 단락텍스트 1~7은 선택사항입니다.<br>선택사항의 사용을 원하시면 'use'를, 아니면 'not use'를 선택해주세요. </div>
  </div>
  <!-- 지원서 내부 -->
<div class="formContentsLayout">
  <form method="POST" action="app_exec.php" class="form-horizontal"> 


    <!-- short text -->
    <?php
      for($i = 0; $i<8; $i++)
      {
    ?>
      <div class="form-group">
        <label class="col-lg-3 control-label"><?php echo $label_name[$i]; ?></label>
        <div class="col-lg-8">
          <input type="text" class="form-control short-length"  placeholder="<?php echo $question_placeholder[$i]; ?>" style="display:block" id="<?php echo $text_name[$i]; ?>">
          <?php
          if($i >=5)
          {
          ?>
          <input type="radio" name="<?php echo $radio_name[$i-5]; ?>" value="use" onclick="Show<?php echo $i-4;?>()" checked>Use
          <input type="radio" name="<?php echo $radio_name[$i-5]; ?>" value="notuse" onclick="Blind<?php echo $i-4;?>()">not Use
          <?php
          }
          ?>
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
        <label class="col-lg-3 control-label">단락 텍스트<?php echo $i+1;?></label>
        <div class="col-lg-9">
          <input type="text" class="form-control"  placeholder="항목 제목-제목을 입력해주세요" style="display:none" name="title<?php echo $i+1;?>" id="title<?php echo $i+1;?>">
          <input type="text" class="form-control"  placeholder="항목 설명-항목에 대한 설명을 입력해주세요" style="display:none" name="explain<?php echo $i+1;?>" id="explain<?php echo $i+1;?>">
          <input type="radio" name="<?php echo $sub_radio_name[$i]; ?>" value="use"  onclick="Sub_Show<?php echo $i+1;?>()">Use
          <input type="radio" name="<?php echo $sub_radio_name[$i]; ?>" value="notuse" onclick="Sub_Blind<?php echo $i+1;?>()" checked>not Use
        </div>
      </div>  
    
    <?php
      }
    ?>

    <!-- due date  -->
    <div class="form-group">
      <label for="select" class="col-lg-2 control-label">제출기한</label>
      <div class="col-lg-10">
        <select class="form-control button-length" name="month">
        <?php
          for($i = 1; $i<13; $i++)
          {
        ?>
          <option value="<?php echo $i; ?>"><?php echo $i; ?>월</option>
    
        <?php
          }
        ?>
        </select>

         <select class="form-control button-length" name="date">
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

    <div class="submit_content">
      <button type="submit">만들기</button>
    </div>
  </form>
</div>

 <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js"></script>
    <!-- app_make JS -->
    <script src="../js/app_make.js"></script>
</body>
</html>