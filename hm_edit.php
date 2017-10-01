<?php

$id = $_GET['id'];
$sub = $_GET['sub'];
$contents = $_GET['con'];

/*--- DB연결, 쿼리 넣기 ---*/
$db_conn = mysqli_connect("localhost","root","autoset","yjc_test");
$db_select = mysqli_select_db($db_conn, ci_board);
$query = "select * from ci_board where board_id";
$result = mysqli_query($db_conn, $query);

echo "<form method='get' action='hm_edit2.php'>";
echo "<input type='submit' value='수정'>";
echo "<input type= 'hidden' name='id' value='$id'>";
echo "<table style= 'border: solid 1px #ffffff; padding: 5%; text-align: center ' width='1000' align='center'>";
$row = mysqli_fetch_array($result);

    echo "<tr>";
    echo "<td><input type='text' name='subject' value='$sub' style='width: 30%'></td>";
    echo "</tr>";
    echo "<tr>";
    echo "<th>작성자</th>";
    echo "<td >".$row[user_name]."</td>";
    echo "<th>날짜</th>";
    echo "<td>".$row[reg_date]."</td>";
    echo "<tr>";
    echo "</tr>";
    echo "<tr>";
    echo "<th style='padding: 4%'>내용</th>";
    echo "<td><textarea name='contents' id='contents' value='$contents'></textarea></td>";
    echo "</tr>";
    echo "</table>";
    echo "</form>";


?>
<html>
<body>
<script>
    document.getElementById('contents').value = '<? echo $contents?>';
</script>
</body>
</html>
