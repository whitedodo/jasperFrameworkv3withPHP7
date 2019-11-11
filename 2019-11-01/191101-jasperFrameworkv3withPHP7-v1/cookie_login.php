<?php

/*
 * Subject: PHP 7 - 쿠키 로그인(Cookie Login)
 * Created Date: 2019-10-29
 * Author: Dodo (rabbit.white@daum.net)
 * Description:
 *
 */


// 세션 존재 여부(로그인 상태가 아닐 때 HTML 표시)
if (!isset($_COOKIE['id']) &&
    !isset($_COOKIE['login_time']) &&
    !isset($_COOKIE['token']))
{

?>

<!doctype html>
<html>
<head>
	<title>로그인 화면</title>
</head>

<body>
	<form method="post" action="index.php/login_cookie">
		<p>
			ID: <input type="text" name="id" />
		</p>
		<p>
			PASSWORD: <input type="password" name="passwd" />
		</p>
		<input type="submit" value="LOGIN" />
	
	</form>
</body>
</html>
<?php 

}else{
    
    // 로그인 상태일 때
    echo "Already Login <br>";
    echo "<a href=cookie_logout.php>Logout</a>";
}

?>