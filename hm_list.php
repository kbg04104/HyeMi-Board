
<?php

/*--- 로그인을 위해 써줌 ---*/
session_start();

/*--- 연결 됐는지 확인 ! --*/
/*if(isset($select)){
    echo "성공";
}*/

/*--- DB 연결 ---*/
$db_conn = mysqli_connect("localhost","root","autoset", "yjc_test");

echo "<script>if(!location.href.match('start')) location.href = 'hm_list.php?start=1'</script>";

/*--- 한 페이지 당 들어갈 레코드 수 --*/
$pageRecordNum = 10;

$query = "select * from ci_board where board_pid = '0' order by board_id";

/*--- 총 레코드 수 ---*/
$allRecordNum = mysqli_num_rows(mysqli_query($db_conn, $query));

if(isset($_GET['start']))
    $start = $_GET['start'];

$recordNum = ($start -1) * $pageRecordNum;

if (!isset($_GET['searchName'])) {
    $query = "select * from ci_board where board_pid = 0 order by board_id desc limit $recordNum, $pageRecordNum";
} else {
    $searchName = $_GET['searchName'];
    $searchValue = $_GET['searchValue'];
    $query = "select * from ci_board where $searchName like '%$searchValue%'  order by board_id desc limit $recordNum, $pageRecordNum";
}

$result = mysqli_query($db_conn, $query);

/*--- 게시판 이름 ---*/
echo "<h1 style='color: red; padding: 3%'>불타는 게시판</h1>";

/*--- 검색 ---*/
echo "<form method='get' action='hm_list.php'>";
echo "<select name = 'searchName'>";
echo "<option value='subject'>제목</option>";
echo "<option value='contents'>내용</option>";
echo "<option value='user_id'>아이디</option>";
echo "<option value='user_name'>작성자</option>";
echo "</select>";
echo "<input type='text' name='searchValue' size='30'>";
echo "<input type='submit' value='검색'>";
echo "<input type='hidden' name = 'start' value='1'>";
echo "</form>";

/*---  list up ---*/

echo "<table boarder collapse = '1' cellpadding = '0' boarder = '1' width = '1000' align = 'center' style='padding: 1%'>";
echo "<tr><th>No</th><th>ID</th><th>작성자</th><th>제목</th><th>조회수</th><th>날짜</th></tr>";
while ($row = mysqli_fetch_array($result)){
    /*foreach($row as $a => $b){
        echo "$a = $b";
    }*/
    echo "<tr style='text-align: center'>";
    echo "<td>".$row['board_id']."</td>";
    echo "<td>".$row['user_id']."</td>";
    echo "<td>".$row['user_name']."</td>";
    echo "<td><a href='hm_contents.php?id=$row[board_id]&sub=$row[subject]&con=$row[contents]'>".$row['subject']."</a></td>";
    //echo "<td>".$row['contents']."</td>";
    echo "<td>".$row['hits']."</td>";
    echo "<td>".$row['reg_date']."</td>";
    echo "</tr>";
    //echo $row['board_id']++;
}

echo "</table>";

/*--- 페이지 수 구하기 (ceil :  반올림) ---*/
$pageNum = ceil(($allRecordNum/$pageRecordNum));

/*--- 페이징 링크 걸기 --*/
for( $i = 1; $i <= $pageNum ; $i++ ) {

    echo "<a href=$_SERVER[PHP_SELF]?start=$i> [$i] </a>";

} //$_SERVER[PHP_SELF] 는 현재 실행 되고 있는 페이지의 url을 구해옴

?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body style="margin: auto; text-align: center">
<form id = "writeForm" method="get" action="hmBoard.php" style="display: none">
    <input type="submit" value="글쓰기">
    <input type="hidden" value = "w" name="write">
</form>
<form id="loginForm" method="get" action="hm_login.php" style="display: none">
    <input type="submit" value="로그인">
    <input type="hidden" value="mode" name ="login">
</form>
<form id="logoutForm" method="post" action="hm_login2.php" style="display: none">
    <input type="submit" value="로그아웃">
    <input type="hidden" value="mode" name="logout">
</form>
</body>
</html>

<?php

/*--- 로그인 상태일때 ---*/
if(isset($_SESSION['id'])) {
    //글쓰기 폼, 로그아웃 폼이 보이게함
    echo "<script>document.getElementById('writeForm').style.display='';</script>";
    echo "<script>document.getElementById('logoutForm').style.display='';</script>";
/*--- 로그인 상태가 아닐 때 ---*/
} else {
    // 로그인 폼이 보이게 함
    echo "<script>document.getElementById('loginForm').style.display='';</script>";
}

?>