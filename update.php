<?php
// 세션 & DB 연결 받아오기
require_once("function/session.php");

// 에러 메시지 출력
error_reporting( E_ALL );
ini_set( "display_errors", 1 );

// 사용자 정보 받아오기
$currentpw = $_POST['currentpw'];
$changepw = $_POST['changepw'];
$changeemail = $_POST['changeemail'];

$currentpw = md5($currentpw);

// 비밀번호 일치 여부 확인
if ($userpw == $currentpw) {

    // 비밀번호 수정
    if ($changepw) {
        $changepw = md5($changepw);
        $sql = "update users set userpw='$changepw' where userid='$userid'";
        mysqli_query($conn, $sql);
    } 

    // 이메일 수정
    if ($changeemail) {
        $sql = "update users set email='$changeemail' where userid='$userid'";
        mysqli_query($conn, $sql);
    }

    echo "<script>alert('회원정보 수정 성공!');</script>";
    echo "<script>location.replace('index.php')</script>";
} else {
	echo "<script>alert('비밀번호가 일치하지 않습니다.');</script>";
    echo "<script>location.replace('mypage.php')</script>";
}

// DB 연결 종료
mysql_close($conn);
?>