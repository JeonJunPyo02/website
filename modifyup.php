<?php 
// 세션 가져오기
require_once("function/session.php");

// 에러 출력
error_reporting( E_ALL );
ini_set( "display_errors", 1 );

// DB 정보
$conn = mysqli_connect('127.0.0.1', 'user', 'user1234', 'board');

// modify.php 의 사용자 입력 값 가져오기
$idx = $_POST['idx'];
$title = $_POST['title'];
$content = $_POST['content'];

// 작성자 검증을 위한 쿼리
$sql = "select writer from post where idx=$idx";
$res = mysqli_fetch_array(mysqli_query($conn, $sql));
$writer = $res['writer'];

// 요청을 보낸 사용자와 게시글 작성자가 일치한지 검증
if($writer==$name) {
    // 게시글 수정 쿼리
    $sql = "update post set title='$title', content='$content' where idx=$idx";
    $res = mysqli_query($conn, $sql);
} else {
    echo "<script>alert('게시글에 대한 권한이 없습니다.')</script>";
    echo "<script>location.href = 'board.php';</script>";
}

if($res==TRUE){
    echo "<script>alert('게시글이 성공적으로 수정됐습니다.')</script>";
} else {
    echo "<script>alert('게시글 수정 실패...')</script>";
}
?>
<script>location.href = 'board.php';</script>