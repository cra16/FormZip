<?php
$member = new HisnetValidation();
$member->Validation($_POST['his_id'],$_POST['his_pw']);

class HisnetValidation{
  //학번
  var $stu_id = null;
  //이름
  var $stu_name = null;
  //hisnet id
  var $his_id = null;
  //hisnet pw
  var $his_pw = null;
  //교직원 여부
  var $is_faculty = null;
  // login check
  var $is_login_successed = false;
  /**
   * @function membercraHisValidation
   * @brief 생성자. 학번, 이름, 히즈넷 아이디, 히즈넷 비밀번호, 교직원 여부를 프로퍼티에 넣기
   **/
  function Validation($his_id, $his_pw) {
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
    {
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
    }
    
    // Response result read
    $html = str_get_html($result);  
    if(is_object($html->find('.tblcationTitlecls', 1)))
      echo "i am in!!";

    else
      echo "nothing";
    // $table = $html->find('.tblcationTitlecls', 1)->parent()->parent();
    // $td_id = $table->children(1)->children(1)->innertext;
    // $stu_id = substr($td_id, 11, 19);
    // echo $result;
    // echo "   stu_id:";
    // // Delete temp file after using
    // unlink($ckfile);
  }

  /**
   * @function parseResponse
   * @brief 요청 결과를 해석해서 사용자 정보를 클래스 프로퍼티에 넣는다
   * @param HTTP response $res
   */
  function parseResponse($result) {
    include 'simple_html_dom.php';

    $result = iconv("EUC-KR","UTF-8", $result);

    $html = str_get_html($result);    
    
    $table = $html->find('.tblcationTitlecls', 1)->parent()->parent();
    $td_id = $table->children(1)->children(1)->innertext;
    $td_school = $table->children(4)->children(0)->innertext;
    
    if(!strcmp($td_school,'대학원'))
      $stu_id = substr($td_id, 0, 8);
    else
      $stu_id = substr($td_id, 11, 19);
    $stu_name = $html->find('strong', 0)->innertext;
    
    debugPrint('school:'.$td_school);
    debugPrint('name:'.$stu_name.' and id:'.$stu_id);
    debugPrint('this_name:'.$this->stu_name.' and this_id:'.$this->stu_id);
    
    $this->is_login_successed = 
      (($stu_id==$this->stu_id) && ($this->stu_name==$stu_name));
    
    
  }
  
  function isLoginSuccess() {
    return $this->is_login_successed;
  }
  
}
?>