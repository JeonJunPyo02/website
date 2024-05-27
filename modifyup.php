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
$file = $_FILES['file'];

// 작성자 검증을 위한 쿼리
$sql = "select writer from post where idx=$idx";
$res = mysqli_fetch_array(mysqli_query($conn, $sql));
$writer = $res['writer'];

// 작성자 검증
if ($writer !== $name) {
    echo "<script>alert('게시글에 대한 권한이 없습니다.')</script>";
    echo "<script>location.href = 'board.php';</script>";
    exit;
}


if($file['name'] !== ''){
    // 파일 업로드 경로
    $path = "file/";
    $file_path = $path . basename($file["name"]); // file/key.png

    // 파일의 확장자를 추출하고 소문자로 변환
    $file_extension = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));

    // 허용된 파일 형식
    $allowedFileTypes = array("jpg", "jpeg", "png", "gif", "pdf");

    // 확장자 검증
    if(!in_array($file_extension, $allowedFileTypes)){
        echo "<script>alert('죄송합니다. 업로드 가능한 파일의 확장자는 JPG, JPEG, PNG, GIF, PDF 입니다.');</script>";
        echo "<script>location.replace('board.php');</script>";
        exit;
    }

    if(move_uploaded_file($file['tmp_name'], $file_path)) {
        // 파일 업로드 있을 시 sql
        $sql = "update post set title='$title', content='$content', file='$file_path' where idx=$idx";
    } else {
        echo "<script>alert('파일 업로드 실패..');</script>";
        echo "<script>location.replace('board.php');</script>";
        exit;
    }
} else {
    // 파일 업로드 없을 시 sql
    $sql = "UPDATE post SET title='$title', content='$content' WHERE idx=$idx";
}

$res = mysqli_query($conn, $sql);

if($res==TRUE){
    echo "<script>alert('게시글이 성공적으로 수정됐습니다.')</script>";
} else {
    echo "<script>alert('게시글 수정 실패...')</script>";
}
?>
<script>location.href = 'board.php';</script>