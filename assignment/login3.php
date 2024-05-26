<?php 
// 2. 식별/인증 분리
error_reporting( E_ALL );
ini_set( "display_errors", 1 );

// DB 접속 정보 가져오기
require_once("../function/dbconn.php");

// 사용자 입력 정보 받아오기
$userid = $_POST['userid'];
$userpw = $_POST['userpw'];
$userpw = md5($userpw);

// 쿼리 작성
$sql = "select userpw, name from users where userid='$userid'";

// 쿼리 실행 값 저장
$result = mysqli_query($conn, $sql);

// row 값 저장
$row = mysqli_fetch_array($result);

// 식별 정보가 있을 시, 인증 정보 체크
if($userpw==$row['userpw']) {
    echo "환영합니다. " . $row['name'] . "님";
} else {
    echo "유효하지 않은 사용자입니다.";
}
?>