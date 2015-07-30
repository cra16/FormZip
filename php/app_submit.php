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

$club= $_SESSION["GROUP"];
$member;
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
     echo "Data call failed";
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
  $question_placeholder= array($user['student_name'],$user['stuid'],"Major ex) 1전공/2전공","Phone number ex)01012345678","남/여","남성인 경우만 해당","ex)formzip@naver.com","ex)3학기");
  $title=array($member['title1'],$member['title2'],$member['title3'],$member['title4'],$member['title5'],$member['title6'],$member['title7']);
  $explain=array($member['explain1'],$member['explain2'],$member['explain3'],$member['explain4'],$member['explain5'],$member['explain6'],$member['explain7']);
  $pass_name=array("name","stuid","major","p_num","gender","served","mail","activity");
  $text_name=array("content1","content2","content3","content4","content5","content6","content7");
  $stu_number = $user['stuid'];

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

    <script type="text/javascript">
      function ok(){
        var message = "정말 제출하시겠습니까?";
        var result = confirm(message);

        if(result == false){
            return false;
        }
      }
      function disable(){
        alert('이미 제출하셨습니다');
      }
    </script>

  </head>

<body> 
  <div class="container">
    <div id="header">
      <h1> <a href="firstpage.php" class="h_logo">F O R M &nbsp;&nbsp;Z I P</a> </h1>
    </div>
  </div>

 
<div class="formContentsLayout">
  <form method="POST" action="app_storage.php" class="form-horizontal" onsubmit=" return ok() "> 
      <!-- short text -->
    <?php
    for($i = 0; $i<4; $i++)
    {
    ?>
    <div class="form-group">
      <label class="col-lg-3 control-label"><?php echo $label_name[$i]; ?></label>
      <div class="col-lg-8">
        <input type="text" class="form-control short-length"  placeholder="<?php echo $question_placeholder[$i]; ?>"
               style="display:block" id="<?php echo $pass_name[$i]; ?>" 
    <?php if($i < 2){?> disabled title="변경 불가한 항목입니다." <?php } ?> name="<?php echo $pass_name[$i]; ?>"> 
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
            <input type="radio" id="served" name="served" checked  style=margin:"10px" display:"none" value="YES">
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
        <label class="col-lg-3 control-label"><?php echo $label_name[$i]; ?></label>
        <div class="col-lg-8">
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
          <label class="col-lg-3 control-label"><?php echo $title[$i]; ?></label>
          <div class="col-lg-8">
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
      <label class="col-lg-2 control-label">제출기한</label>
    </div>
    <div class="panel panel-default">
      <div class="panel-body">
        <?php echo $member['month'];?>월 <?php echo $member['date'];?>까지
      </div>
    </div>

    <?php
      $query = "SELECT * FROM result WHERE stu_id = '$stu_number' AND storage='0' AND club_name = '$club'";
      $re_query = mysqli_query($bd,$query);
      $fetch = mysqli_fetch_array($re_query);

      if( $fetch[0] != NULL ){
    ?>
      <div class="submit_content">
        <button type="submit" name="name" id = 'temp' value="<?php echo $club; ?>">임시저장</button>
      </div>

      <div class="submit_content">
        <button type="submit" name="name" id ='real' onsubmit ="ok()" value="<?php echo $club; ?>">제출</button>
      </div>
    <?php
      }else{ ?>
        <div class="submit_content">
          <button type="button" name="name" id = 'temp' onclick="disable()" value="<?php echo $club; ?>">임시저장</button>
        </div>

        <div class="submit_content">
        <button type="button" name="name" id ='real' onclick="disable()" value="<?php echo $club; ?>">제출</button>
        </div>
    <?php } ?>
  </form>
</div>

 <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js"></script>
</body>
</html>