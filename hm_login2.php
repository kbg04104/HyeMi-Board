<?php

/*--- 로그인 폼 파일에서 받아온 네임 ---*/
$loginId = $_POST['loginId'];
$loginPw = $_POST['loginPw'];

/*--- DB 연결 & 쿼리넣기 --*/
$dbconn = mysqli_connect("localhost","root","autoset");
$dbSelect = mysqli_select_db($dbconn, "yjc_test");
// loginID를 가져오는 이유 : 이걸 안가져오면 DB 맨 위에 있는 ID와 패스워드만 가져옴
$query = "select * from customer where id='$loginId'";
$result = mysqli_query($dbconn, $query);
$array = mysqli_fetch_array($result);

/*--- logout일때 다시 list로 ---*/
if($_POST['mode'] == 'logout'){

    session_start();        // session start 꼭!! 해주고 unset, destroy 해줄것
    session_unset();        // unset을 이용하여 세션에 저장된 값 제거
    session_destroy();      // destroy를 이용하여 세션 완전히 종료

    echo "<script>location.href = 'hm_list.php'</script>";
}
else{
    if( $loginPw == $array['password'] ){
        session_start();    // 무조건 해라
        $_SESSION['id'] = $loginId;
        $_SESSION['pw'] = $loginPw;
        $_SESSION['name'] = $array['name'];
        //var_dump($_SESSION); 확인용
        echo "<script>location.href = 'hm_list.php'</script>";

    } else {
        echo "<script>alert('실패'); history.back();</script>";   // 실패 하면 history.back을 이용해 원래 페이지로 돌아감
    }
}



?>