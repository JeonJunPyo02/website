<?php 
require_once("function/session.php");
?>

<!DOCTYPE html>
<html lang="ko">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name='viewport' content='width=device-width, intial-scale=1.0'>
  
  <link rel="stylesheet" href="/css/index.css">

  <title>Alioth's Web Page</title>

</head>

<body>
  <h1>Alioth's Web Page</h1>

  <div class="board-field">
    <a href="board.php">게시판</a>
  </div>

  <div class="account-field">
  <?php 
    if($logined) {
      echo "<a href='mypage.php'>$name</a>"."님";
  ?>
    |
    <a href="function/logout.php">로그아웃</a>
  <?php 
    } else {
  ?>
    <a href="login.html">로그인</a>
    |
    <a href="signup.html">회원가입</a>
  <?php 
    }
  ?>
  </div>
</body>

</html>