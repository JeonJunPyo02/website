<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

$servername = "127.0.0.1";
$username = "user";
$password = "user1234";
$dbname = "board";

$conn = mysqli_connect($servername, $username, $password, $dbname);

$title = $_POST['title'];
$content = $_POST['content'];
$name = $_POST['name'];
$hit = 0;
$file = $_FILES['file'];

// 파일 업로드 여부 확인
if ($file['name'] !== '') {
    // 파일이 업로드된 경우
    // 파일 업로드 경로
    $path = "file/";
    $file_path = $path . basename($file["name"]); // file/key.png

    // 파일의 확장자를 추출하고 소문자로 변환
    $file_extension = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));

    // 허용된 파일 형식
    $allowedFileTypes = array("jpg", "jpeg", "png", "gif", "pdf");

    // 확장자 검증
    if (!in_array($file_extension, $allowedFileTypes)) {
        echo "<script>alert('죄송합니다. 업로드 가능한 파일의 확장자는 JPG, JPEG, PNG, GIF, PDF 입니다.');</script>";
        echo "<script>location.replace('board.php');</script>";
        exit; // 종료
    }

    // 파일 업로드 성공 시, DB 글 등록
    if (move_uploaded_file($file['tmp_name'], $file_path)) {
        $sql = $conn->prepare("INSERT INTO post(title, content, writer, created, hit, file) VALUES(?, ?, ?, NOW(), ?, ?)");
        $sql->bind_param("sssis", $title, $content, $name, $hit, $file_path);
    } else {
        echo "<script>alert('파일 업로드 실패..');</script>";
        echo "<script>location.replace('board.php');</script>";
        exit; // 종료
    }
} else {
    // 파일이 업로드되지 않은 경우
    $sql = $conn->prepare("INSERT INTO post(title, content, writer, created, hit) VALUES(?, ?, ?, NOW(), ?)");
    $sql->bind_param("sssi", $title, $content, $name, $hit);
}

$sql->execute();
$result = $sql->affected_rows;

if ($result) {
    echo "<script>alert('성공적으로 글쓰기 완료했습니다!!');</script>";
    echo "<script>location.replace('board.php');</script>";
} else {
    echo "<script>alert('글 작성 실패..');</script>";
    echo "<script>location.replace('board.php');</script>";
}
?>