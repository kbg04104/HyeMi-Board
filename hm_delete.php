<?php

/*--- DB 연결 & 쿼리 넣기 ---*/
$db_conn = mysqli_connect("localhost", "root", "autoset", "yjc_test");
$db_select = mysqli_select_db($db_conn, "ci_board");
$query = "select * from ci_board where board_id";
$result = mysqli_query($db_conn, $query);

/*--- 삭제 ---*/
if(isset($_GET['mode']) && $_GET['mode'] == 'delete') {
    $id = $_GET['id'];
    $deleteQuery = "delete from ci_board where board_id = '$id'";
    $result2 = mysqli_query($db_conn, $deleteQuery);

    if(isset($result)) {
        echo "<script>alert('삭제 완료!'); location.replace('./hm_list.php');</script>";
    }

}


?>