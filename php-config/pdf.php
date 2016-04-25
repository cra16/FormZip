<?php
// 파일명: pdf.php
// 설명: 지원 내용을 pdf로 출력

// Session start 
session_start();
// Manager judge
require_once('auth.php');
// DB connection
require_once('DB_INFO.php');

//지원서 결과 DB로부터 불러오기
$club_name=$_SESSION['USER_NAME'];
$qry="SELECT * FROM result WHERE club_name='$club_name'";   
$result=mysqli_query($link,$qry);

//해당 동아리의 지원 양식
$qry="SELECT * FROM application WHERE id='$club_name'";   
$temp=mysqli_query($link,$qry);

//Check whether the query was successful or not
if($temp) {
    if(mysqli_num_rows($temp) > 0) 
    {
      $member = mysqli_fetch_assoc($temp); 
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
$qestion=array("use","use","use","use","use",$member['served'],$member['mail'],$member['activity']);
$sub_info=array($member['sr1'],$member['sr2'],$member['sr3'],$member['sr4'],$member['sr5'],$member['sr6'],$member['sr7']);
$label_name = array("이름","학번","학과","전화번호","성별","군필여부","e-mail","활동가능학기");
$title=array($member['title1'],$member['title2'],$member['title3'],$member['title4'],$member['title5'],$member['title6'],$member['title7']);
$explain=array($member['explain1'],$member['explain2'],$member['explain3'],$member['explain4'],$member['explain5'],$member['explain6'],$member['explain7']);
$sub_info=array($member['sr1'],$member['sr2'],$member['sr3'],$member['sr4'],$member['sr5'],$member['sr6'],$member['sr7']);

?>

<!DOCTYPE HTML> 
<html>

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>TEMP</title>

    <!-- Bootstrap -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../css/pdf.css" rel="stylesheet">
  </head>

<body> 
<div class="modal" id="pop_up">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="PopUp()">×</button>
        <h4 class="modal-title">지원서 PDF 만들기 안내</h4>
      </div>
      <div class="modal-body">
        <p>PDF변환은 Chrome에서만 가능합니다.</p>
        <p>1. Ctrl+p를 누릅니다.</p>
        <p>2. 좌측 메뉴의 대상에서 저장 방식을 PDF로 설정합니다.</p>
        <p>3. 저장을 누릅니다.</p>
      </div>
     
    </div>
  </div>
</div>

<?php
while ($list = mysqli_fetch_assoc($result)) {  

  $short_info=array($list['name'],$list['stu_id'],$list['major'],$list['p_num'],$list['gender'],$list['served'],$list['mail'],$list['activity']);
  $text_name=array(str_replace("\n","<br>",$list['text1']),str_replace("\n","<br>",$list['text2']),str_replace("\n","<br>",$list['text3']),str_replace("\n","<br>",$list['text4']),str_replace("\n","<br>",$list['text5']),str_replace("\n","<br>",$list['text6']),str_replace("\n","<br>",$list['text7']));

?>
  <div class="formContentsLayout form-horizontal">


    <!-- 이름 / 학번 / 학과 / 전화번호 -->
      <?php
      for($j = 0; $j<4; $j++){
      ?>
        <div class="form-group">
          <label class="col-lg-3 control-label"><?php echo $label_name[$j]; ?></label>
          <div class="col-lg-8">
            <input type="text" class="form-control short-length" placeholder="<?php echo $short_info[$j]; ?>" style="display:block" disabled>
          </div>
        </div>  
        
      <?php } ?> 


    <!-- 성별 -->
      <div class="form-group">
        <label class="col-lg-3 control-label"><?php echo $label_name[$j]; ?></label>
        <div class="col-lg-8">
          <?php
          if($list['gender']=='man'){
          ?>
            <input type="radio" id="man" name="gender" value="man" style=margin:"10px" display:"none">
            <label for="man">남자</label>
          <?php
          }
          else{
          ?>
            <input type="radio" id="woman" name="gender"value="woman" style=margin:"10px" display:"none">
            <label for="woman">여자</label>
          <?php } ?>        
        </div>
      </div>  

     <?php

      $j = 5;
     
      if($qestion[$j]=="use" && $list['gender']=='man'){ 
      ?>
        <div class="form-group">
          <label class="col-lg-3 control-label"><?php echo $label_name[$j]; ?></label>
          <div class="col-lg-8" id="showbox">
          <?php
          if($list['served']=='YES'){
          ?>
              <input type="radio" id="served" name="served"   style=margin:"10px" display:"none">
              <label for="served" id="t_served1" >&nbsp;&nbsp;예&nbsp;&nbsp;</label>
          <?php
          }
          else{
          ?>
               <input type="radio" id="nonserved" name="served" style=margin:"10px" display:"none">
              <label for="nonserved" id="t_served2">아니오</label>
          <?php } ?>  
          </div>
        </div>
      <?php
      }
      

      // 이메일 / 활동가능학기
         for($j = 6; $j<8; $j++)
        {
          if($qestion[$j]=="use"){
          
      ?>
        <div class="form-group">
          <label class="col-lg-3 control-label"><?php echo $label_name[$j]; ?></label>
          <div class="col-lg-8">
            <input type="text" class="form-control short-length"  placeholder="<?php echo $short_info[$j]; ?>"
                   style="display:block"  disabled>
             </div>
        </div>  
      
      <?php
          }
        }
      ?>

      <!-- long text -->
      <?php
        for($j = 0; $j<8; $j++)
        {
          if($sub_info[$j]=="notuse")
          {
            break;
          }
          if($sub_info[$j]=="use"){
      ?>
          <div class="form-group">
            <label class="col-lg-3 control-label"><?php echo $title[$j]; ?></label>
            <div class="col-lg-9">
            <p class="text_box"><?php echo $text_name[$j]; ?></p>
            <span class="help-block"><?php echo $explain[$j]; ?></span>    
            </div>
          </div>  
      <?php
          }
      ?>
      <?php
        }
      ?>

  </div>

<?php } ?>



  
 <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/app_list.js"></script>
</body>
</html>