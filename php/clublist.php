<?php
  $mysql_hostname = "localhost";
  $mysql_user = "root";
  $mysql_password = "78910";
  $mysql_database = "formzip";
  $con = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) or die("Could not connect database");
  $db = mysql_select_db($mysql_database, $con) or die("Could not select database");
  ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Club List</title>

    <!-- Bootstrap -->
    <link href="bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap.css" rel="stylesheet">
    <link href="clublist.css" rel="stylesheet">

  </head>

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

   <h2>동아리 검색</h2>

   <!-- Club Search Bar-->
   <div>
    <form>
      <fieldset>
        <input type = 'submit' class = "search-button" value ='whole' action='js.php' method='GET'>
        <input type = 'submit' class = "search-button" value ='perform' action='clublist.php' method='GET'>
        <input type = 'submit' class = "search-button" value ='sport' action='clublist.php' method='GET'>
        <input type = 'submit' class = "search-button" value ='academic' action='clublist.php' method='GET'>
        <input type = 'submit' class = "search-button" value ='computer' action='clublist.php' method='GET'>
        <input type = 'submit' class = "search-button" value ='religion' action='clublist.php' method='GET'>
        <input type = 'submit' class = "search-button" value ='volunteer' action='clublist.php' method='GET'>
    </form>
     </fieldset>

   </div>
  <!-- Club Search Bar End-->
  <!-- Club List Buttons Start-->
  <?php
  $whole = $_GET['whole'];
  $perform = $_GET['perform'];
  $sport = $_GET['sport'];
  $academic = $_GET['academic'];
  $computer = $_GET['computer'];
  $religion = $_GET['religion'];
  $volunteer = $_GET['volunteer'];

  if( $perform != NULL ){
    $qry1 = "SELECT c_name FROM club WHERE field = '$perform'";
        $name_result = mysql_query($qry1);
      
        $i=0;
        $j=0;
        $clubname = "c";

        while($clubname[$i] != NULL){
          echo "<tr>";
          for($j=0 ; $j<4 ; $j++){
            echo "<td>";
            $clubname = mysql_fetch_array($name_result);
            $field = mysql_fetch_array($field_result);
            if($clubname[$i] == NULL){
              break;
            }
          echo "<input class = 'club-element' type = 'button' value ='$clubname[$i]' name = '$field' id = '$clubname'/>";
          echo "</td>";
          }
          echo "<br/>";
          echo "</tr>";
        }
        break;
        $perform = NULL;
  }else if( $sport != NULL ){
        $qry1 = "SELECT c_name FROM club WHERE field = '$sport'";
        $name_result = mysql_query($qry1);
      
        $i=0;
        $j=0;
        $clubname = "c";

        while($clubname[$i] != NULL){
          echo "<tr>";
          for($j=0 ; $j<4 ; $j++){
            echo "<td>";
            $clubname = mysql_fetch_array($name_result);
            $field = mysql_fetch_array($field_result);
            if($clubname[$i] == NULL){
              break;
            }
          echo "<input class = 'club-element' type = 'button' value ='$clubname[$i]' name = '$field' id = '$clubname'/>";
          echo "</td>";
          }
          echo "<br/>";
          echo "</tr>";
        }
        break;
        $sport = NULL;
  }else if($academic != NULL){

        $qry1 = "SELECT c_name FROM club WHERE field = '$academic' ";
        $name_result = mysql_query($qry1);
      
        $i=0;
        $j=0;
        $clubname = "c";

        while($clubname[$i] != NULL){
          echo "<tr>";
          for($j=0 ; $j<4 ; $j++){
            echo "<td>";
            $clubname = mysql_fetch_array($name_result);
            $field = mysql_fetch_array($field_result);
            if($clubname[$i] == NULL){
              break;
            }
          echo "<input class = 'club-element' type = 'button' value ='$clubname[$i]' name = '$field' id = '$clubname'/>";
          echo "</td>";
          }
          echo "<br/>";
          echo "</tr>";
        }
        break;
        $academic = NULL;
      }else if( $computer != NULL){
        $qry1 = "SELECT c_name FROM club WHERE field = '$computer'";
        $name_result = mysql_query($qry1);
      
        $i=0;
        $j=0;
        $clubname = "c";

        while($clubname[$i] != NULL){
          echo "<tr>";
          for($j=0 ; $j<4 ; $j++){
            echo "<td>";
            $clubname = mysql_fetch_array($name_result);
            $field = mysql_fetch_array($field_result);
            if($clubname[$i] == NULL){
              break;
            }
          echo "<input class = 'club-element' type = 'button' value ='$clubname[$i]' name = '$field' id = '$clubname'/>";
          echo "</td>";
          }
          echo "<br/>";
          echo "</tr>";
        }
        break;
        $computer = NULL;
      }else if( $religion != NULL){
        $qry1 = "SELECT c_name FROM club WHERE field = '$religion' ";
        $name_result = mysql_query($qry1);
      
        $i=0;
        $j=0;
        $clubname = "c";

        while($clubname[$i] != NULL){
          echo "<tr>";
          for($j=0 ; $j<4 ; $j++){
            echo "<td>";
            $clubname = mysql_fetch_array($name_result);
            $field = mysql_fetch_array($field_result);
            if($clubname[$i] == NULL){
              break;
            }
          echo "<input class = 'club-element' type = 'button' value ='$clubname[$i]' name = '$field' id = '$clubname'/>";
          echo "</td>";
          }
          echo "<br/>";
          echo "</tr>";
        }
        break;
        $religion = NULL;
      
      }else if( $volunteer != NULL ){
        $qry1 = "SELECT c_name FROM club WHERE field = '$volunteer' ";
        $name_result = mysql_query($qry1);
      
        $i=0;
        $j=0;
        $clubname = "c";

        while($clubname[$i] != NULL){
          echo "<tr>";
          for($j=0 ; $j<4 ; $j++){
            echo "<td>";
            $clubname = mysql_fetch_array($name_result);
            $field = mysql_fetch_array($field_result);
            if($clubname[$i] == NULL){
              break;
            }
          echo "<input class = 'club-element' type = 'button' value ='$clubname[$i]' name = '$field' id = '$clubname'/>";
          echo "</td>";
          }
          echo "<br/>";
          echo "</tr>";
        }
        break;
        $volunteer = NULL;
      }else{
        $qry1 = "SELECT c_name FROM club";
        $name_result = mysql_query($qry1);
      
        $i=0;
        $j=0;
        $clubname = "c";

        while($clubname[$i] != NULL){
          echo "<tr>";
          for($j=0 ; $j<4 ; $j++){
            echo "<td>";
            $clubname = mysql_fetch_array($name_result);
            $field = mysql_fetch_array($field_result);
            if($clubname[$i] == NULL){
              break;
            }
          echo "<input class = 'club-element' type = 'button' value ='$clubname[$i]' name = '$field' id = '$clubname'/>";
          echo "</td>";
          }
          echo "<br/>";
          echo "</tr>";
        }
        break;
      }
        ?>


  
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap.min.js"></script>
  </body>
</html>