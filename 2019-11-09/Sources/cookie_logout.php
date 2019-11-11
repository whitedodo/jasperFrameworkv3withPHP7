<?php

# 쿠키 파괴 하기
setcookie("id", '', time()-99999999, "/");
setcookie("login_time", '', time()-99999999, "/");
setcookie("token", '', time()-99999999, "/");

?>

<meta http-equiv="refresh" content="0;url=cookie_login.php" />