<?php
// DB 연결 정보 가져오기
require_once("function/dbconn.php");

// 에러 메시지 출력
error_reporting( E_ALL );
ini_set( "display_errors", 1 );

// input 태그에서 전달된 사용자 입력 값 가져오기
$userid = $_POST['userid'];
$userpw = $_POST['userpw'];
$pwcheck = $_POST['pwcheck'];
$name = $_POST['name'];
$email = $_POST['email'];

// 비밀번호가 일치하다면
if($userpw==$pwcheck) {
    $userpw = md5($userpw);

    // 중복된 id 체크 쿼리 작성
    $idcheck = $conn->prepare("SELECT userid FROM users WHERE userid=?");
    $idcheck->bind_param("s", $userid);
    $idcheck->execute();

    // 반환된 SELECT 결과 저장
    $checkresult = $idcheck->get_result();

    // 반환된 SELECT 결과의 개수 확인(num_rows)
    if ($checkresult->num_rows > 0) {
        echo "<script>alert('중복된 ID 입니다!!');</script>";
    ?>
        <script>
            location.replace('signup.html')
        </script>
    <?php
    } else {
            // 회원 정보 DB 추가 쿼리 작성
        $sql = $conn->prepare("INSERT INTO users(userid,userpw,name,email,created) VALUES(?, ?, ?, ?, NOW())");
        $sql->bind_param("ssss", $userid, $userpw, $name, $email);
        $sql->execute();
        // 쿼리로 영향을 받은 행 개수 확인(affected_rows)
        $result = $sql->affected_rows;
        if ($result > 0) {
            echo "<script>alert('회원가입 성공!!');</script>";
        } else {
            echo "<script>alert('회원가입 실패..');</script>";
        }
    }
// 비밀번호가 일치하지 않다면
} else {
    echo "<script>alert('비밀번호가 일치하지 않습니다.');</script>";
    ?>
    <script>
        location.replace('signup.html')
    </script>
<?php
}

// 연결 닫기
$sql->close();
$idcheck->close();
$conn->close();
?>

<script>
    location.replace('index.php')
</script>