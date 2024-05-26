<?php 

// 클래스 자동 로드
require __DIR__.'/vendor/autoload.php';

// jwt 라이브러리 사용
use \Firebase\JWT\JWT;

// DB 접속 정보 가져오기
require_once("../function/dbconn.php");

// 에러 메시지 출력
error_reporting( E_ALL );
ini_set( "display_errors", 1 );

// 사용자 입력 정보 받아오기
$userid = $_POST['userid'];
$userpw = $_POST['userpw'];

// 비밀번호를 HASH 값으로 변경
$userpw = md5($userpw);

// 로그인 검증
$sql = "select name from users where userid='$userid' and userpw='$userpw'";
$result = mysqli_query($conn, $sql);

if($result) {

    // 비밀키 값과 페이로드 작성
    $key = "secretkeyofalioth";
    $payload = array(
        "userid" => $userid,
        "exp" => time() + 3600
    );

    // JWT 생성
    $jwt = JWT::encode($payload, $key, 'HS256');

    // JWT를 쿠키에 담아서 클라이언트에게 전송
    setcookie('jwt', $jwt, time() + 3600, '/', '192.168.0.26', false, true);

    // 생성된 JWT 출력
    // echo json_encode(array("token" => $jwt));

    header("Location: indexjwt.php");
    exit;

} else {
    echo "잘못된 요청";
}

?>