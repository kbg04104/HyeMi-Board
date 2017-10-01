<?php

$id = $_GET['id'];
$pid = $_GET['pid'];
$nick = $_GET['nick'];

$db_conn = mysqli_connect("localhost","root","autoset","yjc_test");
$query = "insert into ci_board (board_pid, user_name, contents) values ('$id','$nick','$pid')";
$result = mysqli_query($db_conn, $query);


$query = "select * from ci_board where board_id=$id";
$row = mysqli_fetch_array(mysqli_query($db_conn, $query));
$sub = $row['subject'];
$con = $row['contents'];

if($result) {
    echo "<script>location.href='hm_contents.php?id=$id&sub=$sub&con=$con'</script>";
} else {
    echo "<script>alert('댓글입력오류!')</script>";
    echo $query;
}


?>