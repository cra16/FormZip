<?php
// 파일명: app_list.php
// 설명: 그룹 관리자가 지원서를 볼 수 있는 display
session_start();
// Manager judge
//require_once('auth.php');
require_once('../php-config/DB_INFO.php');
require_once('../php-config/auth.php');

 $id = $_SESSION["USER_NAME"]; //$id => 아이디
  $qry = "SELECT * FROM student WHERE id = '$id'";
              $result = mysqli_query($link,$qry);
              $check = mysqli_fetch_assoc($result);

$cname= $check['c_name'];
$qry="SELECT * FROM result WHERE club_name='$cname'";   
$result=mysqli_query($link,$qry);

$per_page=10;  //page당 display할 목록의 수
$total_results=mysqli_num_rows($result);  //해당 동아리의 지원자 수
$total_pages=ceil($total_results/$per_page); 
$result=$_GET['currentpage'];

// get the current page or set a default
if (isset($_GET['currentpage']) && is_numeric($_GET['currentpage'])) {
   // cast var as int
   $currentpage = (int) $_GET['currentpage'];
} else {
   // default page num
   $currentpage = 1;
} // end if

// if current page is greater than total pages...
if ($currentpage > $total_pages) {
   // set current page to last page
   $currentpage = $total_pages;
} // end if
// if current page is less than first page...
if ($currentpage < 1) {
   // set current page to first page
   $currentpage = 1;
} // end if

// the offset of the list, based on current page 
$offset = ($currentpage - 1) * $per_page;

// get the info from the db 
$sql = "SELECT * FROM result WHERE club_name='$cname' LIMIT $offset, $per_page";
$result=mysqli_query($link,$sql);
$count=0;
$label_name = array("이름","학번","학과","전화번호","성별","군필여부","e-mail","학기");


$qry="SELECT * FROM application WHERE id='$cname'";   
$temp=mysqli_query($link,$qry);

//Check whether the query was successful or not
if($temp) {

    if(mysqli_num_rows($temp) > 0) 
    {
      $user = mysqli_fetch_assoc($temp); 
    }

 
}


//Sanitize the POST values
$sub_info=array($user['sr1'],$user['sr2'],$user['sr3'],$user['sr4'],$user['sr5'],$user['sr6'],$user['sr7'],$user['sr8'],$user['sr9'],$user['sr10']);
$user_info=array("use","use","use","use","use",$user['served'],$user['mail'],$user['activity']);
$title=array($user['title1'],$user['title2'],$user['title3'],$user['title4'],$user['title5'],$user['title6'],$user['title7'],$user['title8'],$user['title9'],$user['title']);
$explain=array($user['explain1'],$user['explain2'],$user['explain3'],$user['explain4'],$user['explain5'],$user['explain6'],$user['explain7'],$user['explain8'],$user['explain9'],$user['explain10']);



?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=1280">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>iBELONG :: 지원현황</title>

    <!-- Bootstrap -->
    <link href="../css/application_list.css" rel="stylesheet">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/bootstrap.css" rel="stylesheet">    
    <script type="text/javascript">
      function help(){
        window.open("help.php","도움말", "left=200, top=200, width=520, location=no, height=620 , scrollbars=no, resizable=yes");
      }
    </script>
    

<!--     <script src="https://rawgit.com/jackmoore/autosize/master/dist/autosize.min.js"></script> -->

  </head>
  <body>

  <!-- Menubar start-->  
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="../php-views/firstpage.php">iBELONG</a>
      </div>

      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
       
        <ul class="nav navbar-nav navbar-right">
          <li>
            <?php
              if($_SESSION['USER_NAME'])
                echo '<a href="../php-config/logout.php">Logout</a>';
              else
                echo '<a href="login.php">Login</a>';
            ?>
          </li>        
          <li>
        <?php
            //로그인 여부 확인
           if($_SESSION['USER_NAME']){
             $index = $check['index'];
            
            //관리자 여부 확인
              if($index == 0){
                echo '<a href="mypage.php">My Page</a>';
               
              }
              else if($index ==1){
                echo '<a href="clubpage.php?name='.$cname.'">Club Page</a>'; 
              }
              else{
                echo '<a href="academypage.php?name='.$cname.'">Academy Page</a>';   
              }
            }
            else
              echo '<a href="agreement.php">Sign Up</a>';
          ?>
        </li>
         <li><a href="#" onclick = "help()">Help</a></li>
        </ul>
      </div>
    </div>
  </nav>

<!-- Application List Start -->
<div class = "col-xs-12 col-md-6 col-md-offset-3 ">
  <h4 class = "title-name"> ◁ 지원 현황 ▷ </h4>

  <table align="center" class="table table-striped">
    <thead>
      <tr>
        <th class = "sort-student-number">학번</th>
        <th class = "sort-name">이름</th>
        <th class = "sort-sex">성별</th>
        <th class = "sort-file">파일</th>
      </tr>
    </thead>
    <tbody>

  <?php

  while ($list = mysqli_fetch_assoc($result)) {
    $stu_id = $list['stu_id'];
    $name = $list['name'];
    $gender=$list['gender'];
    $file_name = $list['file_name'];
    $saved_file = $list['saved_file']; 
  
   if($list['storage']==0){
  ?>

    <tr class = 'table_row_temp'>
      <td class = 'studnet-number' scope='row'>
      <a href="#" class="btn-example" onclick="wrapWindowByMask(<?php echo $count; ?>)"><?php echo "$stu_id"; ?></a> 
      </td>
      <td class = 'Name'>
      <a href="#" class="btn-example" onclick="wrapWindowByMask(<?php echo $count; ?>)"><?php echo "$name"; ?></a> 
      </td>
      <td class = 'sex'>
      <a href="#" class="btn-example" onclick="wrapWindowByMask(<?php echo $count; ?>)"><?php echo "$gender"; ?></a> 
      </td>
      <td class = 'file'>
        <a href="#" class="btn-example" onclick="wrapWindowByMask(<?php echo $count++; ?>)">
        <?php echo "$file_name"; ?>  


        </a> 
      </td>
    </tr>
  <?php 
    }
    else{ 
    ?>
        <tr class = 'table_row'>
      <td class = 'studnet-number' scope='row'>
      <a href="#" class="btn-example" onclick="wrapWindowByMask(<?php echo $count; ?>)"><?php echo "$stu_id"; ?></a> 
      </td>
      <td class = 'Name'>
      <a href="#" class="btn-example" onclick="wrapWindowByMask(<?php echo $count; ?>)"><?php echo "$name"; ?></a> 
      </td>
      <td class = 'sex'>
      <a href="#" class="btn-example"onclick="wrapWindowByMask(<?php echo $count; ?>)"><?php echo "$gender"; ?></a> 
      </td>
      <td class = 'file'>
        <a href="#" class="btn-example" onclick="wrapWindowByMask(<?php echo $count++; ?>)">
        <?php echo "$file_name"; ?>  


        </a> 
      </td>
    </tr>
<?php
   }
  }
  ?> 
    </tbody>
  </table>
  <div color:black> ※제출이 완료된 지원서는 파란색으로 표시됩니다.</div>
</div>


<center>

  <div class="col-xs-12 col-md-6 col-md-offset-3 ">

    <ul class="pagination pagingbox">
    <?php
    $page_list=5;
    // get the current page or set a default
    if (isset($_GET['currentpage']) && is_numeric($_GET['currentpage'])) {
      $currentpage = (int) $_GET['currentpage'];
    
      if($currentpage > 0 && $currentpage <= $total_pages){
        $start=floor(($currentpage-1)/$page_list)*$page_list+1;
        $end= $start+$page_list-1;
      }
      else{
        $start=1;
        $end=$start+$page_list-1;
      }
    }

    else{
      $start=1;
      $end=$start+$page_list-1;
    }

    // pagination: << 표시
    if($start>1){
    ?>
      <li><a href="app_list.php?currentpage=<?php echo $start-$page_list;?>">«</a></li>
    <?php
    }

    else{
    ?>
      <li><a disabled>«</a></li>
    <?php
    }
    // pagination: 숫자 표시


    for($i=$start; $i<=$end;$i++)
    {
      if($i > $total_pages){
        break;
      }

      if($i==$currentpage){
    ?>
        <li><a href="app_list.php?currentpage=<?php echo $i;?>" id="distinguish"><?php echo $i;?></a></li>          
    <?php
      }

      else{
    ?>
        <li><a href="app_list.php?currentpage=<?php echo $i;?>"><?php echo $i;?></a></li>
    <?php
        }
    ?>
      
    <?php
    }
    // pagination: >> 표시  
      if($end<$total_pages){
    ?>
      <li><a href="app_list.php?currentpage=<?php echo $start+$page_list;?>">»</a></li>
    <?php
    }
   
     else{
    ?>
      <li><a >»</a></li>
    <?php
    }

    ?>
    </ul>
  </div>
</center>
<!-- PDF & 엑셀 다운로드 -->
<div class="col-md-6 col-md-offset-3 ">
  <div class="col-md-6">
    <form action="../php-config/pdf.php" method="POST">
    <button class = "download1 col-md-5 col-md-5 col-xs-5" type="submit" name="name" value="<?php echo $academy_name; ?>">PDF 파일 다운로드</button>
    </form>
  </div>
  <div class="col-md-6">
    <form action="../php-config/download.php" method="POST">
    <button class = "download2 col-md-5 col-md-5 col-xs-5" type="submit" name="name" value="<?php echo $academy_name; ?>">엑셀 파일 다운로드</button>
    </form>
  </div>
</div>




 
  <div id="mask"></div>
<?php
// get the info from the db 
$sql = "SELECT * FROM result WHERE club_name='$cname' LIMIT $offset, $per_page";
$result=mysqli_query($link,$sql);

for($i=0; $i<$count,$list = mysqli_fetch_assoc($result);$i++)
{
 
  $short_info=array($list['name'],$list['stu_id'],$list['major'],$list['p_num'],$list['gender'],$list['served'],$list['mail'],$list['activity']);
  $text_name=array($list['text1'],$list['text2'],$list['text3'],$list['text4'],$list['text5'],$list['text6'],$list['text7'],$list['text8'],$list['text9'],$list['text10']);

?>
  <div class="window<?php echo $i; ?> layer form-horizontal">

  <!-- 이름 / 학번 / 학과 / 전화번호 -->
    <?php
    for($j = 0; $j<4; $j++)
    {
      ?>
     <div class="col-lg-offset-2 col-lg-8 col-md-offset-2 col-md-8 col-xs-offset-2 col-xs-8 form-box">
        <div class="form-label"><?php echo $label_name[$j]; ?>
        <div class="form-input">
          <input type="text" class="form-control short-length" placeholder="<?php echo $short_info[$j]; ?>" id="<?php echo $text_name[$j]; ?>" name="<?php echo $text_name[$j]; ?>" disabled>
        </div></div>
      </div>  
      
    <?php
    }
    ?> 
   <!-- 성별 -->
    <div class="col-lg-offset-2 col-lg-8 col-md-offset-2 col-md-8 col-xs-offset-2 col-xs-8 form-box">
        <div class="form-label"><?php echo $label_name[$j]; ?>
        <div class="form-checkbox">
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
      </div></div>
    </div>  

    <!-- 군필여부 -->
    <?php
    $j = 5;
    if($user_info[$j]=="use" && $list['gender']=='man'){
    ?>
      <div class="col-lg-offset-2 col-lg-8 col-md-offset-2 col-md-8 col-xs-offset-2 col-xs-8 form-box">
        <div class="form-label"><?php echo $label_name[$j]; ?>
        <div class="form-checkbox">
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
        </div></div>
      </div>
    <?php
    }
 

    // 이메일 / 학기
       for($j = 6; $j<8; $j++)
      {
        if($user_info[$j]=="use"){
        
    ?>
      <div class="col-lg-offset-2 col-lg-8 col-md-offset-2 col-md-8 col-xs-offset-2 col-xs-8 form-box">
        <div class="form-label"><?php echo $label_name[$j]; ?>
        <div class="form-input">
          <input type="text" class="form-control short-length"  placeholder="<?php echo $short_info[$j]; ?>"
                 style="display:block" id="<?php echo $text_name[$i]; ?>" name="<?php echo $text_name[$i]; ?>" disabled>
        </div></div>
      </div>  
    
    <?php
        }
      }
    ?>

    <!-- long text -->
    <?php
      for($j = 0; $j<10; $j++)
      {
        if($sub_info[$j]=="notuse")
        {
          break;
        }
        if($sub_info[$j]=="use"){
    ?>

         <div class="col-lg-offset-2 col-lg-8 col-md-offset-2 col-md-8 col-xs-offset-2 col-xs-8 form-box">
            <div class="form-label"><?php echo $title[$j]; ?></div>
          <div class="form-input"><?php echo $text_name[$j]; ?></div>
          <span class="form-help"><?php echo $explain[$j]; ?></span>    
          </div>

    <?php
        }
    ?>
    <?php
      }
    ?> 





    <div class="col-lg-offset-2 col-lg-8 col-md-offset-2 col-md-8 col-xs-offset-2 col-xs-8">
      <a href="#" class="cbtn">Close</a>
    </div>       
  </div>
  
<?php
}
?>
  


  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/app_list.js"></script>
  </body>
</html>


