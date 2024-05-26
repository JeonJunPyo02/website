<?php 
// 나중에 댓글 작성을 위한 세션 가져오기 + 세션 없으면 게시글 보지 못하게
require_once("function/session.php");

// DB
$conn = mysqli_connect('127.0.0.1', 'user', 'user1234', 'board');

// GET으로 페이지 게시글 idx 받기
$idx = $_GET['idx'];

// idx 값으로 게시글 정보 가져오기
$sql = "select * from post where idx=$idx";
$res = mysqli_fetch_array(mysqli_query($conn, $sql));

// 조회수 적용
$hit = $res['hit'] + 1;
$hit = mysqli_query($conn, "update post set hit=$hit where idx=$idx");

// 출력해줄 정보
$title = $res['title'];
$content = $res['content'];
$content = nl2br($content);

// 수정, 삭제 시 작성자 검증을 위한
$writer = $res["writer"];
?>

<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name='viewport' content='width=device-width, intial-scale=1.0'>

    <link rel="stylesheet" href="/css/board.css">
    <title>게시글</title>
</head>

<body>
    <a href="index.php"><h1>Alioth's Web Page</h1></a>

    <div class="board_area">

        <!--게시글 출력-->
        <div class="board_text">
            <?php
            echo "<p><strong>제목 : $title</strong></p>";
            echo "내용 : <br>";
            // $content = wordwrap($content, 85, "\n", true);
            echo $content;
            ?>
        </div>

        <?php 
        // 작성자만이 수정, 삭제 버튼이 보이도록 설정
        if($writer==$name) {
        ?>
            <div class="buttons">
                <a class="button" href="board.php">목록</a>
                <a class="button" href="modify.php?idx=<?=$idx?>">수정</a>
                <a class="button" href="delete.php?idx=<?=$idx?>">삭제</a>
            </div>
        <?php
        } else {
            // 작성자가 아닌 경우 목록으로 돌아가는 버튼만 출력
        ?>
            <div class="buttons">
                <a class="button" href="board.php">목록</a>
            </div>
        <?php
        }
        ?>
    </div>

</body>

</html>