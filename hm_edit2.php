<?php
$id = $_GET['id'];
$subject = $_GET['subject'];
$contents = $_GET['contents'];


/*--- DB연결, 쿼리 넣기 ---*/
$db_conn = mysqli_connect("localhost","root","autoset","yjc_test");
$db_select = mysqli_select_db($db_conn, ci_board);

$queryEdit = "update ci_board set subject='$subject', contents='$contents', reg_date = now() where board_id = '$id'";
$result = mysqli_query($db_conn, $queryEdit);
if($result)
    echo "<script>location.href = 'hm_list.php'</script>";
else
    //echo $queryEdit; 확인용
    echo "<script>alert('수정안됐다고!')</script>";




?>