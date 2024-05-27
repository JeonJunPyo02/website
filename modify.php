<?php 
// 세션 가져오기
require_once("function/session.php");

// 에러 출력
error_reporting( E_ALL );
ini_set( "display_errors", 1 );

// DB 정보
$conn = mysqli_connect('127.0.0.1', 'user', 'user1234', 'board');

// 게시글의 제목과 내용 가져오기
$idx = $_GET['idx'];
$sql = "select * from post where idx=$idx";
$res = mysqli_fetch_array(mysqli_query($conn, $sql));

$title = $res['title'];
$content = $res['content'];
$file = $res['file'];
?>

<!DOCTYPE html>
<html lang="ko">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name='viewport' content='width=device-width, intial-scale=1.0'>

	<link rel="stylesheet" href="/css/board.css">
	<title>게시글 수정</title>

</head>
<body>
    <a href="index.php"><h1>Alioth's Web Page</h1></a>

    <div class="board_area">

	<h3>게시글 수정</h3>

    <form action="modifyup.php" method="post" enctype="multipart/form-data">
        <!-- modifyup.php 에서 사용할 idx 값 보내주기 -->
        <input type="hidden" name="idx" value=<?=$idx?>>

        <label for="author">작성자 : <?php echo $name?></label> 
        <!-- 현재 세션의 사용자 이름 보내주기 (작성자 검증 목적) -->
		<input type="hidden" name="name" value=<?php echo $name?>><br><br>
        
        <label for="title">제목 :</label>
        <!-- 현 게시물의 제목 출력 및 수정 받기 -->
        <input type="text" class="title" name="title" value="<?=$title?>" required><br><br>
        
        <label for="content">내용 :</label><br>
        <!-- 현 게시물의 내용 출력 및 수정 받기 -->
        <textarea class="content" name="content" rows="15" required><?=$content?></textarea><br><br>
        
        <label for="file">파일 업로드 : <?php if($file) {echo basename($file);} ?></label>
        <input type="file" name="file">

        <div class="write_btn">
        <input type="submit" value="수정하기">
        <div>
    </form>

    </div>
</body>
</html>