<?php
header('Content-Type: text/html; charset=utf-8');

mysqli_query("set session character_set_connection=utf8;");
mysqli_query("set session character_set_results=utf8;");
mysqli_query("set session character_set_client=utf8;");
?>
<html>

<head> 
	<title> 확인 </title>
</head>

<body>
	정말 나가시겠습니까?

	<form action="club_page.php" method="GET">
		<button type="submit" value="yes" >예</button>
	</form>

	<form action="app_submit.php" method="GET">
		<button type ="submit" value="no" >아니오</button>
	</form>

</body>


</html>