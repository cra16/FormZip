<?php
  // Session start 
  session_start();
  // Manager judge
  require_once('auth.php');
  // DB connection
  require_once('DB_INFO.php');

  $id = $_SESSION["USER_NAME"]; //$id => 아이디
  $qry = "SELECT * FROM student WHERE id = '$id'";
              $result = mysqli_query($link,$qry);
              $temp = mysqli_fetch_assoc($result);

  $user_id=$temp['c_name'];   //$user_id => 해당 동아리 이름



  $qry="SELECT * FROM application WHERE id='$user_id'";   
  $result=mysqli_query($link,$qry);

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
    die("Query failed_d");
  }

  $qry_index = "SELECT * FROM student WHERE id = '$id'";
  $re_index = mysqli_query($link,$qry_index);

    //Check whether the query was successful or not
  if($re_index) {

      if(mysqli_num_rows($re_index) > 0) 
      {
        $user = mysqli_fetch_assoc($re_index); 
      }

      else 
      {
       echo "Data call failed";
      }
  }
  else 
  {
    die("Query failed_index");
  }

//Sanitize the POST values
  $short_info=array("use","use","use","use","use",$member['served'],$member['mail'],$member['activity']);
  $sub_info=array($member['sr1'],$member['sr2'],$member['sr3'],$member['sr4'],$member['sr5'],$member['sr6'],$member['sr7'],$member['sr8'],$member['sr9'],$member['sr10']);
  $label_name = array("이름","학번","학과","전화번호","성별","군필여부","e-mail","학기수");
  $question_placeholder= array("Name","Student ID","Major ex) 1전공/2전공","Phone number ex)01012345678","남/여","남성인 경우만 해당","ex)ibelong@naver.com","ex)3학기");
  $title=array($member['title1'],$member['title2'],$member['title3'],$member['title4'],$member['title5'],$member['title6'],$member['title7'],$member['title8'],$member['title9'],$member['title10']);
  $explain=array($member['explain1'],$member['explain2'],$member['explain3'],$member['explain4'],$member['explain5'],$member['explain6'],$member['explain7'],$member['explain8'],$member['explain9'],$member['explain10']);
?>




<!DOCTYPE HTML> 
<html>

   <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=1280">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>application making page</title>

    <!-- Bootstrap -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../css/app_make.css" rel="stylesheet">

    
  </head>

<body> 
  <!-- Logo Start -->
  <div class="container" class = "col-lg-12 col-xs-12">   
      <div id="header" class = "col-xs-8 col-xs-offset-2 col-lg-4 col-lg-offset-4 col-md-4 col-md-offset-4">
          <a href="firstpage.php" class="h_logo">
          <img src="../img/title.png" class = "h_logo">
        </a>
      </div>
   <div id="divmargin"></div> 
</div>
  <!-- Logo End -->
<h2 class = "title-b"> 미리보기 </h2>

<div id="divmargin"></div>    
<div class="formContentsLayout">
    <h3 class = "application">지원서</h3>    
    <div id="divmargin"></div>              
    <h5 class = "club-name"> - <?php echo $user_id; ?> - </h5> 
    <div id="divmargin"></div> 
  <?php
  if( $user['index'] == 1){ ?>
    <form method="POST" action="clubpage.php" class="form-horizontal"> 
  <?php
  }else { ?>
  <form method="POST" action="academypage.php" class="form-horizontal"> 
  <?php } ?>
      
    <!-- short text -->
    <!-- short text -->
    <!-- 이름 / 학번 / 학과 / 전화번호 -->
    <?php
    for($i = 0; $i<4; $i++)
    {
    ?>
    <div class="form-group">
      <label class="col-lg-3 control-label"><?php echo $label_name[$i]; ?></label>
      <div class="col-lg-8">
        <input type="text" class="form-control short-length"  placeholder="<?php echo $question_placeholder[$i]; ?>"
               style="display:block" id="<?php echo $text_name[$i]; ?>" name="<?php echo $text_name[$i]; ?>" disabled>
      </div>
    </div>  

    <?php
    }
    ?>
    <!-- 성별 -->
    <div class="form-group">
      <label class="col-lg-3 control-label"><?php echo $label_name[$i]; ?></label>
      <div class="col-lg-8">
          <input type="radio" id="man" name="gender" value="man" checked  style=margin:"10px" display:"none">
          <label for="man">남자</label>
          <input type="radio" id="woman" name="gender"value="woman" style=margin:"10px" display:"none">
          <label for="woman">여자</label>
      </div>
    </div>  
    <!-- 군필여부 -->
    <?php
    $i = 5;
    if($short_info[$i]=="use"){
    ?>
      <div class="form-group">
        <label class="col-lg-3 control-label"><?php echo $label_name[$i]; ?></label>
        <div class="col-lg-8" id="showbox">
            <input type="radio" id="served" name="served" checked  style=margin:"10px" display:"none">
            <label for="served" id="t_served1" >&nbsp;&nbsp;예&nbsp;&nbsp;</label>
            <input type="radio" id="nonserved" name="served" style=margin:"10px" display:"none">
            <label for="nonserved" id="t_served2">아니오</label>
        </div>
      </div>
    <?php
    }

    // 이메일 / 학기수
       for($i = 6; $i<8; $i++)
      {
        if($short_info[$i]=="use"){
        
    ?>
      <div class="form-group">
        <label class="col-lg-3 control-label"><?php echo $label_name[$i]; ?></label>
        <div class="col-lg-8">
          <input type="text" class="form-control short-length"  placeholder="<?php echo $question_placeholder[$i]; ?>"
                 style="display:block" id="<?php echo $text_name[$i]; ?>" name="<?php echo $text_name[$i]; ?>" disabled>
           </div>
      </div>  
    
    <?php
      }
      }
    ?>

    <!-- long text -->
    <?php
      for($i = 0; $i<10; $i++)
      {
        if($sub_info[$i]=="notuse")
        {
          break;
        }
        if($sub_info[$i]=="use"){
    ?>
        <div class="form-group">
          <label class="col-lg-3 control-label"><?php echo $title[$i]; ?></label>
          <div class="col-lg-8">
          <textarea class="form-control" rows="3" id="textArea" disabled></textarea>
          <span class="help-block"><?php echo $explain[$i]; ?></span>    
          </div>
        </div>  
    <?php
        }
    ?>
    <?php
      }
    ?>
    <div class = "form-group">
    <div class="form-group">
      <label class="col-lg-3 control-label">제출기한</label>
      <div class="col-lg-8">
        <?php echo $member['s_month']; ?>월 <?php echo $member['s_day']; ?>일 부터
        <?php echo $member['month']; ?>월 <?php echo $member['day']; ?>일 까지
      </div>
     <div class = "col-lg-6 col-lg-offset-4 col-md-6 col-md-offset-4 col-xs-6 col-xs-offset-4">  
      <button class = "submit_content col-lg-4 col-md-4 col-xs-4" type="submit">확인</button>
    </div>

    </div>
  </div>
  </form>
</div>

 <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js"></script>
</body>
</html>