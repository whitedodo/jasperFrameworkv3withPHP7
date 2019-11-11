<?php

/*
 * Subject: PHP 7 - 세션 로그인(Session Login)
 * Created Date: 2019-10-29
 * Author: Dodo (rabbit.white@daum.net)
 * Description:
 *
 */

session_start();

# 세션 존재 여부(로그인 상태가 아닐 때 HTML 표시)
if (!isset($_SESSION['id']) &&
    !isset($_SESSION['login_time']) &&
    !isset($_SESSION['token']))
{
    
    ?>

<!doctype html>
<html>
<head>
	<title>세션 로그인</title>
</head>

<body>
	<form method="post" action="index.php/login_session">
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
    
    # 로그인 상태일 때
    echo "Already Login <br>";
    echo "<a href=session_logout.php>Logout</a>";
}

?>