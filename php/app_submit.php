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
mysqli_set_charset($bd, "utf8") or die("Could not select database");
mysqli_select_db($bd,DB_NAME);

//로그인 여부 판단
$userid = $_SESSION['USER_NAME'];
if(!$userid){
  header("location: firstpage.php");
  exit();
}

if(!$_GET['name'])
{
  header("location: firstpage.php");
  exit();
}

$club= $_GET["name"];
$qry="SELECT * FROM application WHERE id='$club'";
$result=mysqli_query($bd,$qry);

//Check whether the query was successful or not
if($result) {

    if(mysqli_num_rows($result) > 0) 
    {
      $member = mysqli_fetch_assoc($result);  
    }

    else 
    {
     echo "지원기간이 아닙니다";
    }
}
else 
{
  die("Query failed");
}

$qry="SELECT * FROM student WHERE id='$userid'";
$result=mysqli_query($bd,$qry);

//Check whether the query was successful or not
if($result) {

    if(mysqli_num_rows($result) > 0) 
    {
      $user = mysqli_fetch_assoc($result); 
    }

    else 
    {
     echo "지원서가 존재하지 않습니다";
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
  $question_placeholder= array($user['student_name'],$user['stuid'],"ex) 1전공/2전공","Phone number","남/여","남성인 경우만 해당","ex)formzip@naver.com","ex)3학기");
  $title=array($member['title1'],$member['title2'],$member['title3'],$member['title4'],$member['title5'],$member['title6'],$member['title7']);
  $explain=array($member['explain1'],$member['explain2'],$member['explain3'],$member['explain4'],$member['explain5'],$member['explain6'],$member['explain7']);
  $pass_name=array("name","stuid","major","p_num","gender","served","mail","activity");
  $text_name=array("content1","content2","content3","content4","content5","content6","content7");
  $stu_number = $user['stuid'];

  $index = $user['index'];

  $my_qry = "SELECT * FROM result WHERE club_name='$club' AND stu_id='$stu_number'";
  $my_result = mysqli_query($bd,$my_qry);

  //Check whether the query was successful or not
  if($my_result) {

      if(mysqli_num_rows($my_result) > 0) //미리 정보 존재
      {
        $my_temp = mysqli_fetch_assoc($my_result);  
        $info = 1;
      }
      else 
      {
       $info = 0;
      }
  }

  $pass_temp = array($my_temp['name'], $my_temp['stu_id'], $my_temp['major'], $my_temp['p_num'], $my_temp['gender'], $my_temp['served'], $my_temp['mail'], 
    $my_temp['activity']);
  $text_temp = array($my_temp['text1'], $my_temp['text2'], $my_temp['text3'], $my_temp['text4'],
    $my_temp['text5'], $my_temp['text6'], $my_temp['text7']);

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

    <script type="text/javascript">
      function ok(){
        var message = "제출 후에는 수정이 불가능하며 임시저장한 내용은 Mypage에서 확인할 수 있습니다.";
        var result = confirm(message);

        if(result == false){
            return false;
        }
      }
      function disable(){
        alert('이미 제출하셨습니다');
      }
      function help(){
        window.open("help.php","도움말", "left=200, top=200, width=350, height=420 , location=no, scrollbars=no, resizable=yes");
      }
      function ok2(){
        var message2 = "임시저장하시겠습니까?";
        var result = confirm(message2);

        if(result == false){
            return false;
        }
      }
      function manager(){
        alert('관리자는 지원이 불가합니다');
        return false;
      }
    </script>

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


<?php
if( $info == 1){ // 정보 존재
?>
  <div class="formContentsLayout">
    <form method="POST" action="app_storage.php" class="form-horizontal" onsubmit=" return ok() " > 
       <h3 class = "application">지원서</h3>    
      <div id="divmargin"></div>              
      <h5 class = "club-name"> - <?php echo $club; ?> - </h5> 
      <div id="divmargin"></div>   

      <hr class = "line-bar">

        <!-- short text -->
      <?php
      for($i = 0; $i<4; $i++)
      {
      ?>
      <div class="form-group">
        <label class="col-lg-3 col-md-3 col-xs-3 control-label"><?php echo $label_name[$i]; ?></label>
        <div class="col-lg-8 col-md-8 col-xs-8">
          <input type="text" class="form-control short-length col-lg-8"  
          placeholder="<?php echo $question_placeholder[$i]; ?>"
                 style="display:block" id="<?php echo $pass_name[$i]; ?>" 
        <?php if($i < 2){?> disabled title="변경 불가한 항목입니다." <?php } ?> 
        name="<?php echo $pass_name[$i]; ?>"
        <?php if($i > 1)?> value = '<?php echo $pass_temp[$i]; ?>' > 
        </div>
      </div>  

      <?php
      }
      ?>
      <!-- 성별 -->
      <div class="form-group">
        <label class="col-lg-3 col-md-3 col-xs-3 control-label"><?php echo $label_name[$i]; ?></label>
        <div class="col-lg-8 col-md-8 col-xs-8">
          <?php
          if($pass_temp[$i] == 'man'){ //정보존재 ?>
            <input type="radio" id="man" name="gender" value="man" checked  style=margin:"10px" display:"none">
            <label for="man">남자</label>
            <input type="radio" id="woman" name="gender"value="woman" style=margin:"10px" display:"none">
            <label for="woman">여자</label>
          <?php
        }else if($pass_temp[$i] == 'woman'){ ?>
            <input type="radio" id="man" name="gender" value="man" style=margin:"10px" display:"none">
            <label for="man">남자</label>
            <input type="radio" id="woman" name="gender" value="woman" checked style=margin:"10px" display:"none">
            <label for="woman">여자</label>
          <?php
        }else{ ?>
            <input type="radio" id="man" name="gender" value="man" style=margin:"10px" display:"none">
            <label for="man">남자</label>
            <input type="radio" id="woman" name="gender" value="woman" style=margin:"10px" display:"none">
            <label for="woman">여자</label>
          <?php
        } ?>
        </div>
      </div>  
      <!-- 군필여부 -->
      <?php
      $i = 5;
      if($short_info[$i]=="use"){
      ?>
        <div class="form-group">
          <label class="col-lg-3 col-md-3 col-xs-3 control-label"><?php echo $label_name[$i]; ?></label>
          <div class="col-lg-8 col-md-8 col-xs-8" id="showbox">
            <?php
            if($pass_temp[$i] == 'YES'){ // yes ?>
              <input type="radio" id="served" name="served" checked  style=margin:"10px" display:"none" value="YES">
              <label for="served" id="t_served1" >&nbsp;&nbsp;예&nbsp;&nbsp;</label>
              <input type="radio" id="nonserved" name="served" style=margin:"10px" display:"none" value="NO">
              <label for="nonserved" id="t_served2">아니오</label>
            <?php
            }else if($pass_temp[$i] == 'NO'){ //no ?>
              <input type="radio" id="served" name="served" style=margin:"10px" display:"none" value="YES">
              <label for="served" id="t_served1" >&nbsp;&nbsp;예&nbsp;&nbsp;</label>
              <input type="radio" id="nonserved" name="served" checked style=margin:"10px" display:"none" value="NO">
              <label for="nonserved" id="t_served2">아니오</label>
            <?php
            }else{  ?>
              <input type="radio" id="served" name="served" style=margin:"10px" display:"none" value="YES">
              <label for="served" id="t_served1" >&nbsp;&nbsp;예&nbsp;&nbsp;</label>
              <input type="radio" id="nonserved" name="served" style=margin:"10px" display:"none" value="NO">
              <label for="nonserved" id="t_served2">아니오</label>
            <?php
            } ?>
          </div>
        </div>
      <?php
      }

      // 이메일 / 활동가능학기
         for($i = 6; $i<8; $i++)
        {
          if($short_info[$i]=="use"){  
      ?>
        <div class="form-group">
          <label class="col-lg-3 col-md-3 col-xs-3 control-label"><?php echo $label_name[$i]; ?></label>
          <div class="col-lg-8 col-md-8 col-xs-8">
            <input type="text" class="form-control short-length" placeholder="<?php echo $question_placeholder[$i]; ?>" 
                   style="display:block" id="<?php echo $pass_name[$i]; ?>" name="<?php echo $pass_name[$i]; ?>"
                   value = '<?php echo $pass_temp[$i]; ?>' >
             </div>
        </div>  
      <?php
          }
        }
      ?>

      <!-- long text -->
      <?php
        for($i = 0; $i<8; $i++)
        {
          if($sub_info[$i]=="notuse")
          {
            break;
          }
          if($sub_info[$i]=="use"){
      ?>
          <div class="form-group">
            <label class="col-lg-3 col-md-3 col-xs-3 control-label"><?php echo $title[$i]; ?></label>
            <div class="col-lg-8 col-md-8 col-xs-8">
            <textarea class="form-control" rows="3" name="<?php echo $text_name[$i]; ?>"><?php if($text_temp[$i] != '0'){ echo $text_temp[$i]; } ?></textarea>
            <span class="help-block"> <?php echo $explain[$i]; ?></span>    
            </div>
          </div>  
      <?php
          }
      ?>
      <?php
        }
      ?>

      <div class="form-group">
        <label class="col-lg-3 col-md-3 col-xs-3 control-label">제출기한</label>
        <p class="panel-body col-lg-8 col-md-8 col-xs-8">
          <?php echo $member['s_month']; ?>월 <?php echo $member['s_day']; ?>일 까지부터
          <?php echo $member['month'];?>월 <?php echo $member['day'];?>일 까지
        </p>
      </div>

      <?php
        $query = "SELECT * FROM result WHERE stu_id = '$stu_number' AND storage='0' AND club_name = '$club'";
        $re_query = mysqli_query($bd,$query);
        $fetch = mysqli_fetch_array($re_query);

        if( $fetch[0] == NULL ){
      ?>
        <div class = "col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-xs-8 col-xs-offset-2">
          <button class = "submit_content col-lg-4 col-md-4 col-xs-4" type="submit" name="temp" id = 'temp' onsubmit ="ok2()" value="<?php echo $club; ?>">임시저장</button>
          <button class = "submit_content col-lg-4 col-md-4 col-xs-4" type="submit" name="real" id ='real' onsubmit ="ok()" value="<?php echo $club; ?>">제출</button>
      </div>
      <?php
        }else{ ?>
        <div class = "col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-xs-8 col-xs-offset-2"> 
          <button class = "submit_content col-lg-4 col-md-4 col-xs-4" type="button" name="name" id = 'temp' onclick="disable()" value="<?php echo $club; ?>">임시저장</button>
          <button class="submit_content" type="button" name="name" id ='real' onclick="disable()" value="<?php echo $club; ?>">제출</button>
        </div>
      <?php } ?>
    </form>
  </div>

<?php 
}else{ //정보 존재하지 않음 
  ?>
  <div class="formContentsLayout">
    <form method="POST" action="app_storage.php" class="form-horizontal" <?php if($index==0){ ?> onsubmit=" return ok() " <?php }else{ ?> onsubmit = "return manager()" <?php } ?>> 
      <h3 class = "application">지원서</h3>    
      <div id="divmargin"></div>              
      <h5 class = "club-name"> - <?php echo $club; ?> - </h5> 
      <div id="divmargin"></div>   

      <hr class = "line-bar">

        <!-- short text -->
      <?php
      for($i = 0; $i<4; $i++)
      {
      ?>
      <div class="form-group">
        <label class="col-lg-3 col-md-3 col-xs-3 control-label"><?php echo $label_name[$i]; ?></label>
        <div class="col-lg-8 col-md-8 col-xs-8">
          <input type="text" class="form-control short-length"  placeholder="<?php echo $question_placeholder[$i]; ?>"
                 style="display:block" id="<?php echo $pass_name[$i]; ?>" 
      <?php if($i < 2){?> disabled title="변경 불가한 항목입니다." <?php } ?> name="<?php echo $pass_name[$i]; ?>"> 
        </div>
      </div>  
      <?php  }  ?>

      <!-- 성별 -->
      <div class="form-group">
        <label class="col-lg-3 col-md-3 col-xs-3  control-label"><?php echo $label_name[$i]; ?></label>
        <div class="col-lg-8 col-md-8 col-xs-8">
            <input type="radio" id="man" name="gender" value="man" style=margin:"10px" display:"none">
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
          <label class="col-lg-3 col-md-3 col-xs-3  control-label"><?php echo $label_name[$i]; ?></label>
          <div class="col-lg-8 col-md-8 col-xs-8" id="showbox">
              <input type="radio" id="served" name="served" style=margin:"10px" display:"none" value="YES">
              <label for="served" id="t_served1" >&nbsp;&nbsp;예&nbsp;&nbsp;</label>
              <input type="radio" id="nonserved" name="served" style=margin:"10px" display:"none" value="NO">
              <label for="nonserved" id="t_served2">아니오</label>
          </div>
        </div>
      <?php
      }

      // 이메일 / 활동가능학기
         for($i = 6; $i<8; $i++)
        {
          if($short_info[$i]=="use"){
          
      ?>
        <div class="form-group">
          <label class="col-lg-3 col-md-3 col-xs-3 control-label"><?php echo $label_name[$i]; ?></label>
        <div class="col-lg-8 col-md-8 col-xs-8">
            <input type="text" class="form-control short-length"  placeholder="<?php echo $question_placeholder[$i]; ?>"
                   style="display:block" id="<?php echo $pass_name[$i]; ?>" name="<?php echo $pass_name[$i]; ?>">
             </div>
        </div>  
      
      <?php
          }
        }
      ?>

      <!-- long text -->

      <?php
        for($i = 0; $i<8; $i++)
        {
          if($sub_info[$i]=="notuse")
          {
            break;
          }
          if($sub_info[$i]=="use"){
      ?>
          <div class="form-group">
            <label class="col-lg-3 col-md-3 col-xs-3 control-label"><?php echo $title[$i]; ?></label>
            <div class="col-lg-8 col-md-8 col-xs-8">
            <textarea class="form-control" rows="3" name="<?php echo $text_name[$i]; ?>"></textarea>
            <span class="help-block"><?php echo $explain[$i]; ?></span>    
            </div>
          </div>  
      <?php
          }
      ?>
      <?php
        }
      ?>

      <div class="form-group">
        <label class="col-lg-3 col-md-3 col-xs-3 control-label">제출기한</label>
        <p class="panel-body col-lg-8 col-md-8 col-xs-8">
          <?php echo $member['s_month']; ?>월 <?php echo $member['s_day']; ?>일 까지부터
          <?php echo $member['month'];?>월 <?php echo $member['day']; ?>일 까지
        </p>


        <br>
             <?php
        $query = "SELECT * FROM result WHERE stu_id = '$stu_number' AND storage='0' AND club_name = '$club'";
        $re_query = mysqli_query($bd,$query);
        $fetch = mysqli_fetch_array($re_query);

        if( $fetch[0] == NULL ){
      ?>
        <div class = "col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-xs-8 col-xs-offset-2">
          <button class = "submit_content col-lg-4 col-md-4 col-xs-4" type="submit" name="temp" id = 'temp' onsubmit = "ok2()" value="<?php echo $club; ?>" >임시저장</button>
          <button class = "submit_content col-lg-4 col-md-4 col-xs-4" type="submit" name="real" id ='real' onsubmit ="ok()" value="<?php echo $club; ?>">제출</button>
       </div> 
      <?php
        }else{ ?>
        <div class = "col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-xs-8 col-xs-offset-2">  
         <button class = "submit_content col-lg-4 col-md-4 col-xs-4" type="button" name="name" id = 'temp' onclick="disable()" value="<?php echo $club; ?>" class = "save col-lg-4">임시저장</button>
         <button class = "submit_content col-lg-4 col-md-4 col-xs-4" type="button" name="name" id ='real' onclick="disable()" value="<?php echo $club; ?>" class = "save col-lg-4">제출</button>
        </div>
  <?php } ?>
<?php
}
?>

      </div>
    
    </form>
  </div>


 <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js"></script>
</body>
</html>