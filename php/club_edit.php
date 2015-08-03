<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=EUC_KR">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>:: 페이지 수정 ::</title>

    <!-- Bootstrap -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../css/club_edit.css" rel="stylesheet">

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
        <li><a href="#">Login</a></li>
        <li><a href="#">Signup</a></li>
        <li><a href="#">Help</a></li>
      </ul>
    </div>
  </div>
</nav>
   <!-- Menubar end-->  
   




<!--Name Title Start-->
<div id = "navigator">
<h4>동아리 소개 수정 </h4>
</div>
<!--Name Title End-->

<!-- Post Editing Start -->
<div id = "wrap">
<form class = "write-post" action = "js.html" method = "post" onsubmit = "return formCheck();">
  <table class = "write">
    <tr>
      <td class = "post-title" > 
        <h5> 제목 : </h5> 
      </td>
      <td>
        <input class = "post-subject" type = "text" name = "title">
      </td>
    </tr>
    <tr>
      <td colspan="2"> <textarea class = "post-content" rows = "30" name = "content" value = "동아리를 소개해주세요.">
      </textarea>
      </td>
    </tr>
    <tr>
      <td  colspan="2">
        <input class = "post-submit" type = "submit">
      </td>
    </tr>
  </table>
</form>
</div>




<!-- Post Editing End -->





<script>

function formCheck() {

alert(document.forms[0].post-title.value);    // title에 입력된 값을 출력합니다.

}

</script>







    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js"></script>
  </body>
</html>