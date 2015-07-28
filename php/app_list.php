<?php
session_start();
// Manager judge
//require_once('auth.php');
require_once('DB_INFO.php');
header('Content-Type: text/html; charset=utf-8');

mysqli_query("set session character_set_connection=utf8;");
mysqli_query("set session character_set_results=utf8;");
mysqli_query("set session character_set_client=utf8;");

$bd=mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD) or die("Could not connect database");
mysqli_set_charset($bd, "utf8");

mysqli_select_db($bd,DB_NAME) or die("Could not select database");
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>지원자 리스트</title>

    <!-- Bootstrap -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../css/application_list.css" rel="stylesheet">

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
        <a class="navbar-brand" href="firstpage.php">Form_Zip</a>
      </div>

      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
       
        <ul class="nav navbar-nav navbar-right">
          <li>
            <?php
              if($_SESSION['USER_NAME'])
                echo '<a href="logout.php">Logout</a>';
              else
                echo '<a href="login.php">Login</a>';
            ?>
          </li>        
          <li><a href="signup.php">Signup</a></li>
          <li><a href="#">Help</a></li>
        </ul>
      </div>
    </div>
  </nav>

<!-- Application List Start -->
<div class = "col-xs-12 col-md-6 col-md-offset-3 ">
  <h4 class = "title-name"> -- 지원 현황 -- </h4>

  <table align="center" class="table table-striped">
    <thead>
      <tr>
        <th class = "sort-student-number">학번</th>
        <th class = "sort-name">이름</th>
        <th class = "sort-sex">성별</th>
      </tr>
    </thead>
    <tbody>

  <?php
  $club_name=$_SESSION['USER_NAME'];
  $qry="SELECT * FROM result WHERE club_name='$club_name'";   
  $result=mysqli_query($bd,$qry);

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
  $sql = "SELECT * FROM result WHERE club_name='$club_name' LIMIT $offset, $per_page";
  $result=mysqli_query($bd,$sql);

  while ($list = mysqli_fetch_assoc($result)) {
    $stu_id = $list['stu_id'];
    $name = $list['name'];
    $gender=$list['gender']; 

  ?>
    <tr id = '$j'>
      <td class = 'studnet-number' scope='row'>
      <a href="#" class="btn-example" onclick="layer_open('layer2');return false;"><?php echo "$stu_id"; ?></a> 
      </td>
      <td class = 'Name'>
      <a href="#" class="btn-example" onclick="layer_open('layer2');return false;"><?php echo "$name"; ?></a> 
      </td>
      <td class = 'sex'>
      <a href="#" class="btn-example" onclick="layer_open('layer2');return false;"><?php echo "$gender"; ?></a> 
      </td>
    </tr>
  <?php
    }
           
  ?> 
    </tbody>
  </table>


  <div id="pagingbox">
    <ul class="pagination">
    <?php
    $page_list=5;
    // get the current page or set a default
    if (isset($_GET['currentpage']) && is_numeric($_GET['currentpage'])) {
      $currentpage = (int) $_GET['currentpage'];
    
      if($currentpage > 0 && $currentpage <= $total_pages)
      {
        $start=floor(($currentpage-1)/$page_list)*$page_list+1;
        $end= $start+$page_list;
      }

      else
      {
        $start=1;
        $end=$start+$page_list;
      }
    }

    else{
      $start=1;
      $end=$start+$page_list;
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
    ?>
    <?php

      for($i=$start; $i<$end;$i++)
      {
        if($i > $total_pages)
        {
          break;
        }

        if($i==$currentpage)
        {
    ?>
        <li><a href="app_list.php?currentpage=<?php echo $i;?>" id="distinguish"><?php echo $i;?></a></li>          
   <?php
        }

        else
        {
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
</div>

<div class="layer">
  <div class="bg"></div>
  <div id="layer2" class="pop-layer">
    <div class="pop-container">
      <div class="pop-conts">
        <!--content //-->
        <p class="ctxt mb20">Thank you.<br>
          Your registration was submitted successfully.<br>
          Selected invitees will be notified by e-mail on JANUARY 24th.<br><br>
          Hope to see you soon!
        </p>

        <div class="btn-r">
          <a href="#" class="cbtn">Close</a>
        </div>
        <!--// content-->
      </div>
    </div>
  </div>
</div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/app_list.js"></script>
  



  </body>
</html>


