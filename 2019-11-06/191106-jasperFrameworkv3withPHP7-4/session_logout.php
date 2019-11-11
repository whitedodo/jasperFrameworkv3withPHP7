<?php

# 세션이 사용되는 곳에서 필수 선언
session_start();

# 세션 파괴하기
session_destroy();

# 세션 만료시키기
setcookie(session_name(), '', time()-99999999, "/");

?>

<meta http-equiv="refresh" content="0;url=session_login.php" />