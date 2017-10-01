<?php

date_default_timezone_set("Asia/Seoul");

/*--- DB 접속 --*/
$db_conn = mysqli_connect("localhost","root","autoset", "yjc_test");

/*--- 쿼리 넣기 ---*/
if(isset($_GET['mode']) && $_GET['mode'] == 'write' ){
    $title = $_GET['title'];
    $contents = $_GET['contents'];
    $date = date("Y-m-d-H-i-s");

    $query = "insert into ci_board (subject, contents, reg_date,user_id, user_name) values ('$title','$contents','$date','kbg04104','짬뽕맨')";
    $result = mysqli_query($db_conn, $query);
    if($result)
        echo "<script>location.href = 'hm_list.php'</script>";
    else
        echo "안들어갔네요ㅠ_ㅠ)";
}

?>