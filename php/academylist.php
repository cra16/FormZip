<?php
  $mysql_hostname = "localhost";      
  $mysql_user = "root";
  $mysql_password = "78910";    
  $mysql_database = "meeting";
  $prefix = "";
  $bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) or die("Could not connect database");
        mysql_select_db($mysql_database, $bd) or die("Could not select database"); 
 ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Academy List</title>

    <!-- Bootstrap -->
    <link href="bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap.css" rel="stylesheet">
    <link href="clublist.css" rel="stylesheet">

  </head>
<body>

  <!-- Menubar start-->  
  <nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" 
      data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="firstpage.php">Form_Zip</a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
     
      <ul class="nav navbar-nav navbar-right">
        <li><a href="login.php">Login</a></li>
        <li><a href="signup.php">Signup</a></li>
        <li><a href="#">Help</a></li>
      </ul>
    </div>
  </div>
  </nav>
   <!-- Menubar end-->  

   <h2>학회 검색</h2>

   <!-- Club Search Bar-->
   <div>
    <form action='aa.php' method='GET'>
      <fieldset>
        <input type = 'submit' class = "search-button" name ='whole' value ='전체' >
        <input type = 'submit' class = "search-button" name ='GLS' value ='글로벌리더쉽' >
        <input type = 'submit' class = "search-button" name ='international' value ='국제어문' >
        <input type = 'submit' class = "search-button" name = 'management' value ='경영경제' >
        <input type = 'submit' class = "search-button" name = 'law' value ='법' >
        <input type = 'submit' class = "search-button" name = 'communication_study' value ='언론정보'>
        <input type = 'submit' class = "search-button" name = 'partial_environment' value ='상담복지' >
        <input type = 'submit' class = "search-button" name = 'life_sci' value ='생명과학' >
        <input type = 'submit' class = "search-button" name = 'im_design' value ='공간시스템' >
        <input type = 'submit' class = "search-button" name = 'computer_science' value ='전산전자' >
        <input type = 'submit' class = "search-button" name ='industrial_edu' value ='산업디자인' >
        <input type = 'submit' class = "search-button" name ='GEA' value ='글로벌에디슨아카데미' >
        <input type = 'submit' class = "search-button" name ='ICT' value ='창의융합교육원' >
    </form>
     </fieldset>
   </div>

<?php
$name_arr=array("whole","GLS","international","management","law","communication_study","partial_environment","life_sci","im_design","computer_science","industrial_edu","GEA","ICT");

for($i=0; $i<13;$i++){
  if($_GET[$name_arr[$i]]){
  $condition = $_GET[$name_arr[$i]];
    break;
  }
}

if($condition == NULL){
  $condition = "전체";
}

if( $condition != "전체" ){
  $sql="SELECT academy_name FROM academy WHERE dept='$condition'";  
}else{
  $sql = "SELECT academy_name FROM academy";
} 
$result=mysql_query($sql);

$i=0;
$j=0;
$academy[$i] = "dd";
?>

<form action = "dd.php">
<?php
while($academy[$i] != NULL){
  echo "<tr>";
  for($j=0 ; $j<4 ; $j++){
    echo "<td>";
    $academy = mysql_fetch_array($result);
    if($academy[$i] == NULL){
      break;
    }
    echo "<input class = 'club-element' type = 'submit' value ='$academy[$i]' name='name'/>";
    echo "</td>";
    }
    echo "<br/>";
    echo "</tr>";
    }

?>
</form>



  
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap.min.js"></script>
  </body>
</html>