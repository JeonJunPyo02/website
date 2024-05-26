<?php
// 세션 저장 경로 /var/lib/php/session
    require_once("function/dbconn.php");

    session_start();
    if(isset($_SESSION['userid'])) {
        $userid = $_SESSION['userid'];
        $logined = TRUE;
    } else {
        $logined = FALSE;
        session_destroy();
    }

    $sql = "select * from users where userid='$userid'";
    $result = mysqli_fetch_array(mysqli_query($conn, $sql));
    
    $userpw = $result['userpw'];
    $name =  $result['name'];
    $email =  $result['email'];
?>