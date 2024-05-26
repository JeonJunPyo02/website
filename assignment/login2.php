<?php 
// 1. 식별/인증 동시

error_reporting( E_ALL );
ini_set( "display_errors", 1 );

// DB 접속 정보 가져오기
require_once("../function/dbconn.php");

// 사용자 입력 정보 받아오기
$userid = $_POST['userid'];
$userpw = $_POST['userpw'];
$userpw = md5($userpw);

// 쿼리 작성
$sql = "select * from users where userid='$userid' and userpw='$userpw'";

// 쿼리 실행 값 저장
$result = mysqli_query($conn, $sql);

if($result) {
    // row 값 저장
    $row = mysqli_fetch_array($result);
    echo "환영합니다. " . $row['name'] . "님";
} else {
    echo "유효하지 않은 사용자입니다.";
}
?>