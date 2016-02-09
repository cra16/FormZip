<?php
class IndividualConfig{
	function validation($groupName,$session){
	    // Examine hisnet_id and hisnet_pw
	    if (empty($groupName)&&empty($session))
	    $errflag = true;
	    //If there are no input information, redirect back to the login form
	    if($errflag) {
	    header("location:../php-views/clublist.php");
	    exit();
		}
	}   

	function Config($groupName,$mode){
		// Connection with DB

		include('DB_INFO.php');

		// Access from clublist or academylist
  		if($groupName != NULL)
			$_SESSION["GROUP"] = $groupName;

		// Back from application view
  		else
      {
  			$groupName = $_SESSION['GROUP'];
  			$_GET['name']=$groupName;
      }

  	// Mode : Club 
    if($mode == 1)
		  $qry="SELECT * FROM club WHERE c_name='$groupName'";   
		
    // Mode : Academy
    else
      $qry="SELECT * FROM academy WHERE a_name='$groupName'";   

    $result=mysqli_query($link,$qry);
		$member = mysqli_fetch_assoc($result);
    $result->close();
    $link->close();
		return $member;
	}

	function ApplicationInfo($groupName){
		include('DB_INFO.php');
    $sql = "SELECT * FROM application WHERE id = '$groupName'";
    $result = mysqli_query($link,$sql);
    $due = mysqli_fetch_assoc($result);
    date_default_timezone_set("Asia/Seoul");
    $now_month = (int)date("m");
    $now_day = (int)date("d");
    if( $due['month'] == NULL || $due['day'] == NULL || $due['s_day'] == NULL || $due['s_month'] == NULL ){
      $exist = 0;
    }else{
      if( $now_month > $due['s_month'] && $now_month < $due['month'] ){
        $exist = 1;
      }
      else if($now_month == $due['month'] && $now_month == $due['s_month']){
        if($now_day <= $due['day'] && $now_day >= $due['s_day']){
          $exist = 1;
        }
      }
      else if($now_month == $due['month']){
        if($now_day <= $due['day']){
          $exist = 1;
        }
      }else if($now_month == $due['s_month']){
        if($now_day >= $due['s_day']){
          $exist = 1;
        }
      }
    }

    $result->close();
    $link->close();
    return $exist;
	}

  function ApplicationDue($groupName){
    include('DB_INFO.php');
    $sql = "SELECT * FROM application WHERE id = '$groupName'";
    $result = mysqli_query($link,$sql);
    $due = mysqli_fetch_assoc($result);    
    $result->close();
    $link->close();
    return $due;
  }

}
?>