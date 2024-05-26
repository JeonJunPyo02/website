<?php
    require_once("../function/dbconn.php");

    session_start();
    if(isset($_SESSION['userid'])) {
        $userid = $_SESSION['userid'];
        $logined = TRUE;
    }

    $sql = "select * from users where userid='$userid'";
    $result = mysqli_fetch_array(mysqli_query($conn, $sql));
    
    $userpw = $result['userpw'];
    $name =  $result['name'];
    $email =  $result['email'];
?>