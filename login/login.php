<?php
error_reporting( E_ALL );
ini_set( "display_errors", 1 );

    $userid = $_POST['userid'];
    $userpw = $_POST['userpw'];

    $conn = mysqli_connect('127.0.0.1', 'user', 'user1234', 'member');
    // $sql = "select * from users where id='$userid' and pw='$userpw'";

    $sql = "select * from users where id='$userid' 
    and pw='$userpw'";

    $res = mysqli_fetch_array(mysqli_query($conn, $sql));
    $id = $res['id'];

    if($res) {
        echo "안녕하세요 " . $id . "님!";
        echo "$sql";
    } else {
        echo "존재하지 않는 회원정보 입니다.";
        echo "$sql";
    }


    
?>