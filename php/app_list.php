<?php
session_start();
// Manager judge
require_once('auth.php');
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
      <a class="navbar-brand" href="firstpage.html">Form_Zip</a>
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
<div id = "wrap">
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

$per_page=5;  //page당 display할 목록의 수
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
$sql = "SELECT * FROM result LIMIT $offset, $per_page";
$result=mysqli_query($bd,$sql);

while ($list = mysqli_fetch_assoc($result)) {
  $stu_id = $list['stu_id'];
  $name = $list['name'];
  $gender=$list['gender']; 

?>
       <tr id = '$j' class = 'clickable-row' data-href='firstpage.html'>
       <td class = 'studnet-number' scope='row'>
        <?php echo "$stu_id"; ?> 
       </td>
       <td class = 'Name'>
        <?php echo "$name"; ?>
       </td>
       <td class = 'sex'>
        <?php echo "$gender"; ?>
       </td>
       </tr>

      <?php
      }
         
      ?> 
  </tbody>
</table>



<ul class="pagination">
<?php
// get the current page or set a default
if (isset($_GET['currentpage']) && is_numeric($_GET['currentpage'])) {
  $currentpage = (int) $_GET['currentpage'];

  if($currentpage > 0 && $currentpage <= $total_pages)
  {
    $start=floor(($currentpage-1)/4)*4+1;
    $end= $start+4;
  }

  else
  {
    $start=1;
    $end=$start+4;
  }
}

else{
  $start=1;
  $end=$start+4;
}

if($start>1){
?>
  <li><a href="app_list.php?currentpage=<?php echo $start-4;?>">«</a></li>
<?php
}

?>


  

<?php

  for($i=$start; $i<=$end;$i++)
  {
    if($i > $total_pages)
    {
      break;
    }
?>
    <li><a href="app_list.php?currentpage=<?php echo $i;?>"><?php echo $i;?></a></li>
<?php
  }

  if($end<$total_pages){
?>
  <li><a href="app_list.php?currentpage=<?php echo $start+$per_page;?>">»</a></li>
<?php
}

?>

</ul>

</div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script>
    jQuery(document).ready(function($) {
    $(".clickable-row").click(function() {
        window.document.location = $(this).data("href");
      });
    });

    </script>



  </body>
</html>


