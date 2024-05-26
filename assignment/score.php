<?php 
// DB 접속 정보
$servername = "localhost";
$username = "user";
$password = "user1234";
$dbname = "score";

// DB 접속
$conn = mysqli_connect($servername, $username, $password, $dbname);

// // 접속 유무 확인
// if($conn) {
//     echo "DB connect OK";
// } else {
//     echo "DB connect Fail";
// }

$name = $_GET['name'];

// sql 쿼리 작성
$sql = "select score from member where name='$name'";

// 쿼리 실행 결과 저장
$result = mysqli_query($conn, $sql);

// 결과 중 맨 위의 row 가져오기
$row = mysqli_fetch_array($result);

// 출력
echo $name . " 학생의 점수는 " . $row['score'] . "입니다.";
?>