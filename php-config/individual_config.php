<?php
// 파일명: individual_config.php
// 설명: 원하는 학회 또는 동아리에 들어 왔을시 해당 group에 관련된 내용을 전송

class IndividualConfig{
  // 제대로 정보가 들어왔는지 판별
      function validation($groupName,$session){
      // 그룹과 세션 여부 판단
      if (empty($groupName)&&empty($session))
      $errflag = true;
      // 잘못된 경로로 들어올시 clublist로 redirect
      if($errflag) {
      header("location:../php-views/clublist.php");
      exit();
    }
  }   

      // 학회, 동아리 여부확인 및 return
  function Config($groupName,$mode){
    // Connection with DB
    include('DB_INFO.php');

          // 뒤로가기 및 앞으로 가기시 empty 페이지 방지를 위한 내용
      if($groupName != NULL)
      $_SESSION["GROUP"] = $groupName;
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
      // 해당 그룹의 지원기간에 해당할시 view, 아니면 hidden을 위함
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
  // 지원서 마감기한확인을 위한 함수
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