<?php 
// 에러 체크
error_reporting( E_ALL );
ini_set( "display_errors", 1 );

// 세션
require_once("function/session.php");

// 세션 체크 -> 로그인 사용자만 접근 가능
if(!isset($_SESSION['userid'])) {
	echo "<script>alert('로그인이 필요한 게시판 입니다.');</script>";
	echo "<script>location.replace('index.php')</script>";
}

// DB
$conn = mysqli_connect('127.0.0.1', 'user', 'user1234', 'board');

// 현재 페이지 값
if(isset($_GET['page'])){
    $page = $_GET['page'];
} else {
    $page = 1;
}

$post_num = 10; // 한 페이지 당 게시글 수
$page_num = 5; // 한 블록 당 페이지 수
$sql_num = "select * from post";
$num_res = mysqli_query($conn, $sql_num);
$row_num = mysqli_num_rows($num_res); // 게시판에 있는 총 게시글 수

$block_num = ceil($page / $page_num); // 블록 값 (ceil -> 올림) // 1
$block_start = ($block_num - 1) * $page_num + 1; // 블록의 시작번호 // 1
$block_end = $block_start + $page_num - 1; // 블록의 마지막 번호 // 5

// DB 올라간 총 게시글 수 / 한 페이지에 출력할 페이지 수 = 필요한 페이지 수
$total_page = ceil($row_num / $post_num);

// 블록의 마지막 페이지 번호가 필요한 페이지 수를 넘어가지 않도록 설정
if($block_end > $total_page) {
    $block_end = $total_page;
}

$total_block = ceil($total_page / $page_num); // 필요한 블록 수
$start_num = ($page-1) * $post_num; // 페이지 별 불러올 게시글의 시작 값
$sql = "select * from post order by idx desc limit $start_num, $post_num"; // 페이징에 따른 게시글 불러오기
?>

<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name='viewport' content='width=device-width, intial-scale=1.0'>

    <link rel="stylesheet" href="/css/board.css">

    <title>게시판</title>
</head>

<body>
    <a href="index.php"><h1>Alioth's Web Page</h1></a>

    <div class="board_area">
        <h3>게시판 목록</h3>

        <div class='search_box'>
            <form action='search.php' method='get'>
                <!--카테고리-->
                <select name='category'>
                    <option value='title'>제목</option>
                    <option value='writer'>작성자</option>
                    <option value='content'>내용</option>
                </select>
                <!--검색 입력 창-->
                <input type='text' name='search'> <button>검색</button>
            </form>
        </div>
    
        <table class="middle">
            <!--컬럼 제목-->
            <thead>
                <tr align=center>
                    <th width=80>글 번호</th>
                    <th width=300>제목</th>
                    <th width=120>작성자</th>
                    <th width=150>작성일</th>
                    <th width=70>조회수</th>
                </tr>
            </thead>
            <!--/컬럼 제목-->

            <?php
            $res = mysqli_query($conn, $sql);

            while($row = mysqli_fetch_array($res)){
                $title = $row['title'];
                
                // 제목 너무 길면 ... 으로 대체
                if(strlen($title)>30) {
                    $title = substr($row["title"], 0, 30) . "...";
                }
            ?>

            <!--row 값-->
            <tbody>
                <tr align=center>
                    <td><?php echo $row['idx'];?></td>
                    <td><a href="read.php?idx=<?=$row['idx']?>"><?php echo $title;?></a></td>
                    <td><?php echo $row['writer'];?></td>
                    <td><?php echo $row['created'];?></td>
                    <td><?php echo $row['hit'];?></td>
                </tr>
            </tbody>
            <!--/row 값-->

            <?php
            }
            ?>
        </table>

        <div class="page_num">
            <ul>
                <?php

                // 이전 페이지 버튼
                if($page <= 1){
                } else {
                    $pre = $page-1;
                    echo "<li><a href='?page=$pre'>이전</a></li>";
                }

                // 현 블록의 페이지 버튼
                for($i = $block_start; $i <= $block_end; $i++){
                    if($page == $i){
                        echo "<li><strong>$i</strong></li>";
                    } else {
                        echo "<li><a href='?page=$i'>$i</a></li>";
                    }
                }

                // 다음 페이지 버튼
                if($page >= $total_page){
                } else {
                    $next = $page + 1;
                    echo "<li><a href='?page=$next'>다음</a></li>";
                }
                ?>
            </ul>
        </div>

        <div class="write_btn">
            <!--글쓰기 페이지로 이동하는 버튼-->
            <a href="write.php"><button>글쓰기</button></a>
        </div>
    </div>
</body>

</html>