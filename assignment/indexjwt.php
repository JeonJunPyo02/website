<?php 
require __DIR__.'/vendor/autoload.php';
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

// JWT 쿠키 확인
$jwt = $_COOKIE['jwt'] ?? null;

// 에러 메시지 출력
error_reporting( E_ALL );
ini_set( "display_errors", 1 );

?>

<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name='viewport' content='width=device-width, intial-scale=1.0'>
    <link rel="stylesheet" href="/css/index.css">

    <title>Alioth's Web Page</title>

</head>

<body>
    <h1>Alioth's Web Page</h1>

    <div class="account-field">
    <?php 
    if($jwt) {
        // 비밀키 값
        $key = "secretkeyofalioth";
        try {
            // JWT 디코딩
            $decoded = JWT::decode($jwt, new Key($key, 'HS256'));
        } catch (Exception $e) {
            // 발급해준 토큰이 아닌 경우
            // echo 'Token is invalid: ' . $e->getMessage();
            echo "<script>alert('Token is invalid');</script>";
            echo "<a href='login2.html'>로그인 |</a>";
            echo "<a href='signup2.html'> 회원가입</a>";
            exit;
        }
        $userid = $decoded->userid;

        // 만료 시간 체크
        $exp = $decoded->exp;
        $time = time();
        if ($time < $exp) {
            echo "<a href='mypage.php'>$userid</a>"."님";
    ?>
                |
                <a href="logoutjwt.php">로그아웃</a>
    <?php
        } else {
            // echo "토큰 만료로 재 로그인 하세요";
        } 
    } else {
    ?>
    <a href="login2.html">로그인</a>
    |
    <a href="signup2.html">회원가입</a>
    <?php 
    }
    ?>
    </div>
</body>

</html>