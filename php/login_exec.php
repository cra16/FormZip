<?php

//Input Validations
  if($_POST['his_id'] == '') {
    $errflag = true;
  }
  if($_POST['his_pw'] == '') {
    $errflag = true;
  }

  //If there are no input information, redirect back to the login form
  if($errflag) {
    session_write_close();
    header("location:login.php");//login page로 변경해야 하는 부분!!
    exit();
  }

// Identify user_id, user_pw
$member = new HisnetValidation();
$member->validation($_POST['his_id'],$_POST['his_pw']);

class HisnetValidation{
  //학번
  var $stu_id = null;
  //이름
  var $stu_name = null;
  //hisnet id
  var $his_id = null;
  //hisnet pw
  var $his_pw = null;
  /**
   * @function membercraHisValidation
   * @brief 생성자. 학번, 이름, 히즈넷 아이디, 히즈넷 비밀번호, 교직원 여부를 프로퍼티에 넣기
   **/
  function validation($his_id, $his_pw){
    // 일단 값이 있는지 검사
    if (empty($his_id))
    return false;
    if (empty($his_pw))
    return false;
   
    $this->his_id = $his_id;
    $this->his_pw = $his_pw;
    // 히즈넷에 요청을 보내서 올바른 사람인지 확인한다.
    $this->requestHisnet();
  }
  
  
  /**
   * @function requestHisnet
   * @brief 히즈넷 서버에 로그인 요청을 보낸다. fsockopen() 사용
   * 먼저 쿠키를 받아낸다.
   * 주의할 점은 /login.asp 와 /goMenu_eval.asp 그리고 /main.asp 3곳에 요청을 다 보내야 한다. (2012년 1월 31일 기준.)
   * 만약 히즈넷의 로그인 알고리즘이 바뀌면 이 부분을 수정해 주어야 한다.
   **/
  function requestHisnet() {
    //Connect with DB
    session_start();
    require_once('DB_INFO.php');
    //simple_html_dom.php is needed to access hisnetpage information
    include 'simple_html_dom.php';
    // Create temorary file for save cookies
    $ckfile = tempnam ("/tmp", "CURLCOOKIE");
    // POST data form for login
    $dataopost = array (
      "Language" => "Korean",
      "f_name" => "",
      "id" => $this->his_id,
      "part" => "",
      "password" => $this->his_pw,
      "x" => 0,
      "y" => 0,
      );
    // Access hisnet basic information
      // 1st request
      $ch = curl_init ("http://hisnet.handong.edu/login/_login.php");
      curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt ($ch, CURLOPT_POST, true);
      curl_setopt ($ch, CURLOPT_POSTFIELDS, $dataopost);
      curl_setopt ($ch, CURLOPT_COOKIEJAR, $ckfile);
      curl_setopt ($ch, CURLOPT_REFERER, "http://hisnet.handong.edu/login/login.php");
      $result = curl_exec ($ch);
      curl_close ($ch);

      // 2nd request
      $ch = curl_init ("http://hisnet.handong.edu/login/goMenu_eval.php?cleaninet=1&language=Korean");
      curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt ($ch, CURLOPT_COOKIEFILE, $ckfile);
      curl_setopt ($ch, CURLOPT_REFERER, "http://hisnet.handong.edu/login/_login.php");
      $result = curl_exec ($ch);
      curl_close ($ch);
      $dataopost = array (
        "memo" => "",
        );

      // 3rd request
      $ch = curl_init ("http://hisnet.handong.edu/main.php");
      curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt ($ch, CURLOPT_POST, true);
      curl_setopt ($ch, CURLOPT_POSTFIELDS, $dataopost);
      curl_setopt ($ch, CURLOPT_COOKIEFILE, $ckfile);
      curl_setopt ($ch, CURLOPT_REFERER, "http://hisnet.handong.edu/login/goMenu_eval.php?cleaninet=1&language=Korean");
      $result = curl_exec ($ch);
      curl_close($ch);

      // 4th request
      $ch = curl_init ("http://hisnet.handong.edu/for_student/main.php");
      curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt ($ch, CURLOPT_COOKIEFILE, $ckfile);
      curl_setopt ($ch, CURLOPT_REFERER, "http://hisnet.handong.edu/main.php");

      $ch = curl_init ("http://hisnet.handong.edu/haksa/hakjuk/HHAK110M.php");
      curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt ($ch, CURLOPT_COOKIEFILE, $ckfile);
      curl_setopt ($ch, CURLOPT_REFERER, "http://hisnet.handong.edu/for_student/main.php");
      $result = curl_exec ($ch);
      $result = iconv("EUC-KR","UTF-8", $result);
      curl_close($ch);
    // Access result read
    $html = str_get_html($result);  
    // Access 'student' DB
    $id = $_POST['his_id'];

    $sql1 = "SELECT * FROM student WHERE id = '$id'";
    $outcome = mysqli_query($link,$sql1);

    // Hisnet login success
    if(is_object($html->find('.tblcationTitlecls', 1)))
    {
      $table = $html->find('.tblcationTitlecls', 1)->parent()->parent();
      $td_id = $table->children(1)->children(1)->innertext;
      $td_birth = $table->children(0)->children(3)->innertext;
      $temp_id = preg_replace("/[^0-9]*/s", "", $td_id);
      $stu_id = substr($temp_id,1,9);
      $stu_name = $html->find('strong', 0)->innertext;
      $stu_birth = substr($td_birth,0,6);

      if($outcome)
      {
        //Login success but no data in DB
        if(mysqli_num_rows($outcome) == 0){
          $sql = "INSERT INTO student (student_name,id,stuid,birth)
          VALUES ('$stu_name','$id','$stu_id','$stu_birth')";
          if ($link->query($sql) === TRUE){
              echo "New record created successfully";
          }
          else{
              echo "New record fail!";
          }
        }
        //Login success and already storage in DB
        else
          echo "already storage";
        $link->close();
      }

      $_SESSION['USER_NAME'] = $id;
      session_write_close();
      header("location: firstpage.php");
      exit();
    }


    // Hisnet login fail
    else{
      //Password handling
      $key = KEY;
      $s_vector_iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_3DES, MCRYPT_MODE_ECB), MCRYPT_RAND);
      $password = mysqli_real_escape_string($link,$_POST['his_pw']);
      //Password encryption
      $en_str = mcrypt_encrypt(MCRYPT_3DES, $key, $password, MCRYPT_MODE_ECB, $s_vector_iv);
      $encryption = bin2hex($en_str);  
      $sql2 = "SELECT * FROM student WHERE id = '$id' AND password = '$encryption'";
      $outcome = mysqli_query($link,$sql2); 
      // Handling club or academy
      if($outcome)
      {
        if(mysqli_num_rows($outcome)>0){
          $_SESSION['USER_NAME'] = $id;
          session_write_close();
         header("location: firstpage.php");
          exit();
        }
        else
          header("location: login.php");
      }

      else
      header("location: login.php");
    }

    // Delete temp file after using
    unlink($ckfile);
  }
}
?>