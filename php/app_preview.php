<?php
  // Session start 
  session_start();

  // DB connection
  $mysql_hostname = "localhost";      
  $mysql_user = "root";
  $mysql_password = "gksehdeo357";    //수정할 부분->비밀번호입력
  $mysql_database = "formzip";
  $prefix = "";
  $bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) or die("Could not connect database");
    mysql_select_db($mysql_database, $bd) or die("Could not select database"); 

  $user_id=19; //session['id']에 1을 대체해야
  $member;
  $qry="SELECT * FROM application WHERE id='$user_id'";   //대체 가능한 부분
  $result=mysql_query($qry);

  //Check whether the query was successful or not
  if($result) {

      if(mysql_num_rows($result) > 0) 
      {
        $member = mysql_fetch_assoc($result);
        
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
  <div class="container">
    <div id="header">
      <h1> <a href="firstpage.php" class="h_logo">F O R M &nbsp;&nbsp;Z I P</a> </h1>
    </div>
  </div>

 
<div class="formContentsLayout">
  <form method="POST" action="app_exec.php" class="form-horizontal"> 
    
    <!-- short text -->
    <?php
      for($i = 0; $i<8; $i++)
      {
        if($short_info[$i]=="use"){
    ?>
        <div class="form-group">
          <label class="col-lg-3 control-label"><?php echo $label_name[$i]; ?></label>
          <div class="col-lg-8">
            <input type="text" class="form-control short-length"  placeholder="<?php echo $question_placeholder[$i]; ?>">     
          </div>
        </div>  
    <?php
        }
    ?>
    <?php
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
          <textarea class="form-control" rows="3" id="textArea"></textarea>
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

    <div class="submit_content">
      <button type="submit">제출</button>
    </div>
  </form>
</div>



 <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js"></script>
</body>
</html>