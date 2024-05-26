<?php
error_reporting( E_ALL );
ini_set( "display_errors", 1 );

    $userid = $_POST['userid'];
    $userpw = $_POST['userpw'];

    $conn = mysqli_connect('127.0.0.1', 'user', 'user1234', 'member');
    $sql = "select id, pw from users where id='$userid'";
    
    $res = mysqli_fetch_array(mysqli_query($conn, $sql));
    print_r($res);
    $db_pass = $res['pw'];

    if($db_pass == $userpw) {
        $id = $res['id'];
        echo "안녕하세요 " . $id . "님!";
    } else {
        echo "존재하지 않는 회원정보 입니다.";
    }
?>