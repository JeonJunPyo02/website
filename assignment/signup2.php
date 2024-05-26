<?php 
// DB 접속 정보 가져오기
require_once("../function/dbconn.php");

// 사용자 입력 값 가져오기
$userid = $_POST['userid'];
$userpw = $_POST['userpw'];
$pwcheck = $_POST['pwcheck'];
$name = $_POST['name'];
$email = $_POST['email'];

// 비밀번호 일치 여부 확인
if($userpw==$pwcheck) {

    // ID 중복 여부 확인 쿼리 작성
    $idcheck = "select userid from users where userid='$userid'";

    // 쿼리 실행 결과 저장
    $result = mysqli_query($conn, $idcheck);
    
    // 맨 위 row 값 저장
    $row = mysqli_fetch_array($result);

    // ID 중복 여부 확인
    if($row) {
        echo "중복된 ID 입니다.";
    } else {
        // 비밀번호 hash 값 저장
        $userpw = md5($userpw);

        // 사용자 정보 추가 쿼리 작성
        $sql = "insert into users(userid, userpw, name, email, created) values('$userid', '$userpw', '$name', '$email', NOW())";

        // 쿼리 실행 결과 저장
        $result2 = mysqli_query($conn, $sql);
        
        echo "회원가입 성공!!";
    }
} else {
    echo "패스워드가 일치하지 않습니다.";
}
?>