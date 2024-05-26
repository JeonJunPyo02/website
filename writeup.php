<?php
error_reporting( E_ALL );
ini_set( "display_errors", 1 );

$servername = "127.0.0.1";
$username = "user";
$password = "user1234"; 
$dbname = "board";

$conn = mysqli_connect($servername, $username, $password, $dbname);

$title = $_POST['title'];
$content = $_POST['content'];
$name = $_POST['name'];
$hit = 0;

$sql = $conn->prepare("INSERT INTO post(title, content, writer, created, hit) VALUES(?, ?, ?, NOW(), ?)");
$sql->bind_param("sssi", $title, $content, $name, $hit);
$sql->execute();
$result = $sql->affected_rows;

if ($result) {
    echo "<script>alert('성공적으로 글쓰기 완료했습니다!!');</script>";
    echo "<script>location.replace('board.php');</script>";
} else {
    echo "<script>alert('글 작성 실패..');</script>";
}
?>