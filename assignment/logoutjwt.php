<?php
// 클라이언트 쿠키 삭제
setcookie('jwt', '', time() - 3600, '/', '192.168.0.26', false, true);

// 로그인 페이지로 리다이렉트
header("Location: login2.html");
exit;
?>