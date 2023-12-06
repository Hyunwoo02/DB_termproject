<?php
// 세션을 시작합니다.
session_start();

// 모든 세션 변수를 제거하여 로그아웃을 수행합니다.
session_unset();

// 세션을 파괴합니다.
session_destroy();

// 로그인 페이지로 리다이렉트합니다.
header("Location: index.php");
exit();
?>